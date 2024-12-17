<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class AdminBrandController extends Controller
{
    // Mostrar el listado de marcas
    public function index()
    {
        $brands = Brand::all(); // Puedes usar paginate() si necesitas paginación
        return view('admin.brands.index', compact('brands'));
    }

    // Mostrar el formulario para crear una nueva marca
    public function create()
    {
        return view('admin.brands.create');
    }

    // Guardar una nueva marca
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|max:255',
            'brand_description' => 'nullable|string',
        ]);

        Brand::create($validatedData); // Guardar la nueva marca

        return redirect()->route('admin.brands.index')->with('success', 'Marca creada exitosamente.');
    }

    // Mostrar el formulario para editar una marca existente
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    // Actualizar una marca
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|max:255',
            'brand_description' => 'nullable|string',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->update($validatedData); // Actualizar la marca

        return redirect()->route('admin.brands.index')->with('success', 'Marca actualizada exitosamente.');
    }

    // Eliminar una marca
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete(); // Eliminar la marca

        return redirect()->route('admin.brands.index')->with('success', 'Marca eliminada exitosamente.');
    }
}
