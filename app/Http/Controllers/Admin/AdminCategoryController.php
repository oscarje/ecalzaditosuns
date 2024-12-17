<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    // Mostrar el listado de categorías
    public function index()
    {
        $categories = Category::all(); // Puedes usar paginate() si necesitas paginación
        return view('admin.categories.index', compact('categories'));
    }

    // Mostrar el formulario para crear una nueva categoría
    public function create()
    {
        return view('admin.categories.create');
    }

    // Guardar una nueva categoría
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|max:255',
            'category_description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        Category::create($validatedData); // Guardar la nueva categoría

        return redirect()->route('admin.categories.index')->with('success', 'Categoría creada exitosamente.');
    }

    // Mostrar el formulario para editar una categoría existente
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    // Actualizar una categoría
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|max:255',
            'category_description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validatedData); // Actualizar la categoría

        return redirect()->route('admin.categories.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    // Eliminar una categoría
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete(); // Eliminar la categoría

        return redirect()->route('admin.categories.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
