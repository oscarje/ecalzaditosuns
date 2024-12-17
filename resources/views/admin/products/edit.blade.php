@extends('admin.layouts.app')

@section('title', 'Editar Producto')

@section('content')
<div class="container mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-semibold mb-6">Editar Producto</h1>

    <form action="{{ route('admin.products.update', $product->id_product) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-4">
            <label class="block text-gray-700">Nombre del Producto</label>
            <input type="text" name="product_name" class="w-full border p-2 rounded"
                value="{{ old('product_name', $product->product_name) }}" required>
            @error('product_name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Marca</label>
            <select name="id_brand" class="w-full border p-2 rounded">
                @foreach($brands as $brand)
                    <option value="{{ $brand->id_brand }}" {{ $product->id_brand == $brand->id_brand ? 'selected' : '' }}>
                        {{ $brand->brand_name }}
                    </option>
                @endforeach
            </select>
            @error('id_brand')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Categorías</label>
            @foreach($categories as $category)
                <label class="inline-flex items-center">
                    <input type="checkbox" name="categories[]" value="{{ $category->id_category }}" {{ in_array($category->id_category, old('categories', $product->categories->pluck('id_category')->toArray())) ? 'checked' : '' }}>
                    <span class="ml-2">{{ $category->category_name }}</span>
                </label>
            @endforeach
            @error('categories')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Precio</label>
            <input type="number" name="price" class="w-full border p-2 rounded"
                value="{{ old('price', $product->price) }}" step="0.01" required>
            @error('price')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Descripción</label>
            <textarea name="product_description"
                class="w-full border p-2 rounded">{{ old('product_description', $product->product_description) }}</textarea>
            @error('product_description')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Estado</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('status')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Imagen Principal -->
        <div class="mb-4">
            <label class="block text-gray-700">Imagen Principal Actual</label>
            @if($product->image)
                <img src="https://aplicacionesenlanube.cetivirgendelapuerta.com/ecalzaditosuns/public/storage/{{ $product->image }}"
                    alt="{{ $product->product_name }}" class="w-16 h-16 object-cover rounded">
            @else
                <p class="text-gray-500">No hay imagen disponible.</p>
            @endif
            <label class="block text-gray-700 mt-2">Subir Nueva Imagen Principal</label>
            <input type="file" name="image" class="w-full border p-2 rounded">
            @error('image')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit"
            style="background-color: #16a34a; color: white; padding: 12px 24px; border-radius: 8px; font-size: 16px; font-weight: 600; text-align: center; cursor: pointer; border: none; transition: all 0.3s ease;"
            onmouseover="this.style.backgroundColor='#15803d'; this.style.transform='scale(1.05)';"
            onmouseout="this.style.backgroundColor='#16a34a'; this.style.transform='scale(1)';"
            onfocus="this.style.boxShadow='0 0 0 3px rgba(22, 163, 74, 0.5)';" onblur="this.style.boxShadow='none';">
            Actualizar Producto
        </button>


    </form>
</div>
@endsection