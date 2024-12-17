<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class AdminColorController extends Controller
{
    /**
     * Muestra la lista de colores.
     */
    public function index()
    {
        $colors = Color::all();
        return view('admin.colors.index', compact('colors'));
    }

    /**
     * Muestra el formulario para crear un nuevo color.
     */
    public function create()
    {
        return view('admin.colors.create');
    }

    /**
     * Almacena un nuevo color en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'color_name' => 'required|string|max:255|unique:colors',
        ]);
        // dd($request->color_name);

        Color::create(['color_name' => $request->color_name]);

        return redirect()->route('admin.colors.index')->with('success', 'Color creado exitosamente.');
    }

    /**
     * Muestra un color específico.
     */
    public function show($id)
    {
        $color = Color::findOrFail($id);
        return view('admin.colors.show', compact('color'));
    }

    /**
     * Muestra el formulario para editar un color específico.
     */
    public function edit($id)
    {
        $color = Color::findOrFail($id);
        return view('admin.colors.edit', compact('color'));
    }

    /**
     * Actualiza un color en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $color = Color::findOrFail($id);

        $request->validate([
            'color_name' => 'required|string|max:255',
        ]);

        $color->update(['color_name' => $request->color_name]);
        // dd($color);


        return redirect()->route('admin.colors.index')->with('success', 'Color actualizado exitosamente.');
    }

    /**
     * Elimina un color de la base de datos.
     */
    public function destroy($id)
    {
        $color = Color::findOrFail($id);
        $color->delete();

        return redirect()->route('admin.colors.index')->with('success', 'Color eliminado exitosamente.');
    }
}
