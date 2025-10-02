<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::with(['tool', 'product', 'user'])->get();

        return view('container.inventories.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        //
    }

    public function devolver(Inventory $inventory)
    {
        if ($inventory->devuelto) {
            return back()->with('error', 'Este préstamo ya fue devuelto.');
        }

        // Sumar stock de la herramienta
        $tool = $inventory->tool;
        $tool->stock += $inventory->cantidad;
        $tool->save();

        // Marcar como devuelto
        $inventory->devuelto = true;
        $inventory->save();

        return back()->with('success', 'Herramienta devuelta correctamente.');
    }
}
