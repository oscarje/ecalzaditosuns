@extends('admin.layouts.app')

@section('title', 'Crear Producto')

@section('content')
<div class="container mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-semibold mb-6">Crear Nuevo Producto</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">SKU del Producto</label>
            <input type="text" name="product_sku" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Nombre del Producto</label>
            <input type="text" name="product_name" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Marca</label>
            <select name="id_brand" class="w-full border p-2 rounded" required>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id_brand }}">{{ $brand->brand_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Precio</label>
            <input type="number" name="price" class="w-full border p-2 rounded" step="0.01" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Descripción</label>
            <textarea name="product_description" class="w-full border p-2 rounded"></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Estado</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Imagen Principal</label>
            <input type="file" name="image" class="w-full border p-2 rounded" required>
        </div>

        <button type="submit" style="background-color: #007bff; color: white; font-size: 14px; padding: 10px 20px; border-radius: 5px;">
            Crear Producto
        </button>
    </form>
</div>
@endsection
