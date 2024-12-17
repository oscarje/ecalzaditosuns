@extends('admin.layouts.app')

@section('title', 'Editar Categoría')

@section('content')
<div class="container mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-semibold mb-6">Editar Categoría</h1>

    <form action="{{ route('admin.categories.update', $category->id_category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Nombre de la Categoría</label>
            <input type="text" name="category_name" class="w-full border p-2 rounded"
                value="{{ old('category_name', $category->category_name) }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Descripción</label>
            <textarea name="category_description"
                class="w-full border p-2 rounded">{{ old('category_description', $category->category_description) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Estado</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <button type="submit" style="
        padding: 10px 20px;
        background-color: #3182ce; /* Azul similar al bg-blue-600 */
        color: white;
        font-size: 14px;
        font-weight: bold;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    " onmouseover="this.style.backgroundColor='#2b6cb0'; this.style.transform='translateY(-2px)';"
            onmouseout="this.style.backgroundColor='#3182ce'; this.style.transform='translateY(0)';"
            onfocus="this.style.boxShadow='0 0 0 4px rgba(49, 130, 206, 0.5)';" onblur="this.style.boxShadow='none';">
            Actualizar Categoría
        </button>
 
    </form>
</div>
@endsection