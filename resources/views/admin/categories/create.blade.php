@extends('admin.layouts.app')

@section('title', 'Crear Categoría')

@section('content')
<div class="container mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-semibold mb-6">Crear Nueva Categoría</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Nombre de la Categoría</label>
            <input type="text" name="category_name" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Descripción</label>
            <textarea name="category_description" class="w-full border p-2 rounded"></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Estado</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Crear Categoría</button>
    </form>
</div>
@endsection
