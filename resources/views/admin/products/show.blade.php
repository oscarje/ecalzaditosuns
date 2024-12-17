@extends('admin.layouts.app')

@section('title', 'Detalles del Producto')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6" style="font-size: 1.75rem; color: #333;">Detalles del Producto</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <!-- Título del Producto -->
        <h2 class="text-xl font-bold text-center text-gray-800" style="font-size: 1.5rem;">
            <strong>{{ $product->product_name }}</strong></h2>

        <!-- Información del Producto -->
        <div class="mt-6 text-gray-700">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p><strong>SKU:</strong> {{ $product->product_sku }}</p>
                    <p><strong>Marca:</strong> {{ $product->brand->brand_name ?? 'Sin Marca' }}</p>
                    <p><strong>Precio:</strong> {{ number_format($product->price, 2) }} USD</p>
                    <p><strong>Estado:</strong> {{ $product->status ? 'Activo' : 'Inactivo' }}</p>
                    <p><strong>Descripción:</strong> {{ $product->product_description }}</p>

                    <!-- Mostrar categorías -->
                    <div class="mt-4">
                        <strong>Categorías:</strong>
                        <ul class="list-disc list-inside">
                            @foreach ($product->categories as $category)
                                <li>{{ $category->category_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Imagen Principal -->
                <div class="flex justify-center items-center">
                    <div class="w-24 h-24 overflow-hidden rounded-full shadow-lg">
                        @if($product->image)
                            <img src="https://aplicacionesenlanube.cetivirgendelapuerta.com/ecalzaditosuns/public/storage/{{ $product->image }}"
                                alt="Imagen principal del producto" class="object-cover w-full h-full">
                        @else
                            <p class="text-gray-500">No hay imagen principal disponible para este producto.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-6 text-center">
            <!-- Botones con estilo -->
            <a href="{{ route('admin.products.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded"
                style="background-color: #2563EB; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold; transition: background-color 0.3s;">
                Volver a la lista de productos
            </a>

            <a href="{{ route('admin.products.edit', $product->id_product) }}"
                class="bg-yellow-500 text-white px-4 py-2 rounded ml-2"
                style="background-color: #FBBF24; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: bold; margin-left: 10px; transition: background-color 0.3s;">
                Editar Producto
            </a>
        </div>
    </div>
</div>
@endsection