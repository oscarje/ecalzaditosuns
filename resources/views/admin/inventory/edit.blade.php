@extends('admin.layouts.app')

@section('title', 'Editar Inventario')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded">
    <h1 class="text-2xl font-semibold mb-6">Editar Inventario</h1>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <ul class="list-disc ml-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario para editar inventario --}}
    <form action="{{ route('admin.inventory.update', $inventory->id_inventory) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- Producto --}}
        <div class="mb-4">
            <label for="product_sku" class="block text-gray-700 font-medium mb-2">Producto</label>
            <select id="product_sku" name="product_sku" class="w-full border-gray-300 rounded px-3 py-2">
                <option value="">Seleccionar Producto</option>
                @foreach ($products as $product)
                    <option value="{{ $product->product_sku }}" {{ $inventory->product_sku == $product->product_sku ? 'selected' : '' }}>
                        {{ $product->product_name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Talla --}}
        <div class="mb-4">
            <label for="id_size" class="block text-gray-700 font-medium mb-2">Talla</label>
            <select id="id_size" name="id_size" class="w-full border-gray-300 rounded px-3 py-2">
                <option value="">Seleccionar Talla</option>
                @foreach ($sizes as $size)
                    <option value="{{ $size->id_size }}" {{ $inventory->id_size == $size->id_size ? 'selected' : '' }}>
                        {{ $size->size_name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Color --}}
        <div class="mb-4">
            <label for="id_color" class="block text-gray-700 font-medium mb-2">Color</label>
            <select id="id_color" name="id_color" class="w-full border-gray-300 rounded px-3 py-2">
                <option value="">Seleccionar Color</option>
                @foreach ($colors as $color)
                    <option value="{{ $color->id_color }}" {{ $inventory->id_color == $color->id_color ? 'selected' : '' }}>
                        {{ $color->color_name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Cantidad --}}
        <div class="mb-4">
            <label for="quantity" class="block text-gray-700 font-medium mb-2">Cantidad</label>
            <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $inventory->quantity) }}"
                class="w-full border-gray-300 rounded px-3 py-2" min="0" required>
        </div>

        {{-- Agregar Imagen --}}
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-medium mb-2">Imagen</label>
            <input type="file" id="image" name="image" class="w-full border-gray-300 rounded px-3 py-2">
            @if($inventory->image)
                <div class="mt-2">
                    <p class="text-sm text-gray-600">Imagen actual:</p>
                    <img src="{{ asset($inventory->image) }}" alt="Imagen del producto" class="w-24 h-24 object-cover mt-2">
                </div>
            @endif
        </div>


        {{-- Botones de acción --}}
        <div class="flex space-x-4">
            <button type="submit"
                style="background-color: #2563EB; color: white; padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer;">
                Guardar Cambios
            </button>

            <a href="{{ route('admin.inventory.index') }}"
                style="background-color: #4B5563; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                Cancelar
            </a>

        </div>
    </form>
</div>
@endsection