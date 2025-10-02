<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Tool;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tools = Tool::all();

        return view('container.tools.index', compact('tools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('container.tools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|in:disponible,agotado',
            'url_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:0',
        ]);

        // Guardar la imagen en storage/app/public/tools
        $path = $request->file('url_img')->store('tools', 'public');

        // Crear la herramienta
        Tool::create([
            'nombre' => $validated['nombre'],
            'estado' => $validated['estado'],
            'stock' => $validated['stock'],
            'url_img' => $path, // guardamos la ruta de la imagen
        ]);

        return redirect()->route('tools.index')->with('success', 'Herramienta creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tool $tool)
    {
        //
    }

    // Editar herramienta
    public function edit(Tool $tool)
    {
        return view('container.tools.edit', compact('tool'));
    }

    // Actualizar herramienta
    public function update(Request $request, Tool $tool)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'estado' => 'required|in:disponible,agotado',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Si hay nueva imagen
        if ($request->hasFile('imagen')) {
            // Opcional: borrar imagen anterior
            if ($tool->url_img && \Storage::exists('public/'.$tool->url_img)) {
                \Storage::delete('public/'.$tool->url_img);
            }

            // Guardar nueva imagen
            $path = $request->file('imagen')->store('tools', 'public');
            $validated['url_img'] = $path; // aquí se actualiza el campo en BD
        }

        // Actualizar herramienta
        $tool->update($validated);

        return redirect()->route('tools.index')
            ->with('success', 'Herramienta actualizada correctamente.');
    }

    public function destroy(Tool $tool)
    {
        // 1) Verificar si existe algún préstamo NO devuelto
        // Soportamos tanto relación singular "inventory" como plural "inventories"
        $hasActiveLoan = false;

        if (method_exists($tool, 'inventory')) {
            $hasActiveLoan = $tool->inventory()->where('devuelto', false)->exists();
        } elseif (method_exists($tool, 'inventories')) {
            $hasActiveLoan = $tool->inventories()->where('devuelto', false)->exists();
        } else {
            // fallback directo sobre la tabla inventories
            $hasActiveLoan = Inventory::where('tool_id', $tool->id)->where('devuelto', false)->exists();
        }

        if ($hasActiveLoan) {
            return back()->with('error', 'No se puede eliminar la herramienta: existen préstamos activos que no han sido devueltos.');
        }

        // 2) Si llegamos acá, todos los préstamos relacionados están devueltos (o no hay préstamos).
        // Vamos a intentar: a) anular la FK en los registros devueltos (tool_id => null) y b) eliminar la herramienta.
        DB::beginTransaction();

        try {
            // eliminar imagen (si aplica)
            if ($tool->url_img && Storage::disk('public')->exists($tool->url_img)) {
                Storage::disk('public')->delete($tool->url_img);
            }

            // Intentar poner tool_id = null para los registros devueltos
            // (preserva el historial; requiere que tool_id sea nullable y/o que FK permita set null)
            Inventory::where('tool_id', $tool->id)
                ->where('devuelto', true)
                ->update(['tool_id' => null]);

            // Finalmente eliminamos la herramienta
            $tool->delete();

            DB::commit();

            return redirect()->route('tools.index')->with('success', 'Herramienta eliminada correctamente.');
        } catch (QueryException $e) {
            DB::rollBack();

            // Mensaje útil para el desarrollador: sugerimos cambiar la FK o limpiar registros.
            return back()->with('error',
                'No se pudo eliminar la herramienta por una restricción de integridad. '
                .'Asegura que la columna `tool_id` en `inventories` sea nullable y que la FK tenga onDelete SET NULL, '
                .'o elimina/actualiza manualmente los registros relacionados antes de borrar.');
        }
    }

    public function prestar(Request $request, Tool $tool)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        // Verificar stock
        if ($tool->stock < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        // Descontar stock
        $tool->stock -= $request->cantidad;
        $tool->save();

        // Registrar en inventario con usuario
        Inventory::create([
            'tool_id' => $tool->id,
            'product_id' => null,
            'user_id' => Auth::id(), // 🔹 Guarda el usuario actual
            'cantidad' => $request->cantidad,
            'devuelto' => false,
        ]);

        return back()->with('success', 'Préstamo registrado correctamente.');
    }
}
