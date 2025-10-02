<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Mostrar lista
    public function index()
    {
        $products = Product::all();

        return view('container.product.index', compact('products'));
    }

    // Formulario de creación
    public function create()
    {
        return view('container.product.create');
    }

    // Guardar producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'url_img' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('url_img')->store('products', 'public');

        Product::create([
            'nombre' => $request->nombre,
            'stock' => $request->stock,
            'url_img' => $path,
        ]);

        return redirect()->route('products.index')->with('success', 'Producto creado con éxito.');
    }

    // Prestar (descontar stock y registrar en inventario)
    public function prestar(Request $request, Product $product)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        if ($product->stock < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        // Descontar stock (no se devuelve)
        $product->stock -= $request->cantidad;
        $product->save();

        // Registrar en inventario
        Inventory::create([
            'tool_id' => null,
            'product_id' => $product->id,
            'cantidad' => $request->cantidad,
            'devuelto' => true, // en productos siempre se marca como "consumido"
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Producto descontado correctamente.');
    }

    // Editar
    public function edit(Product $product)
    {
        return view('container.product.edit', compact('product'));
    }

    // Actualizar
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'url_img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('url_img')) {
            $path = $request->file('url_img')->store('products', 'public');
            $product->url_img = $path;
        }

        $product->nombre = $request->nombre;
        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Producto actualizado con éxito.');
    }

    public function destroy(Product $product)
    {
        // Borrar la imagen si existe
        if ($product->url_img && Storage::disk('public')->exists($product->url_img)) {
            Storage::disk('public')->delete($product->url_img);
        }

        // Eliminar producto
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado con éxito.');
    }
}
