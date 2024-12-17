@extends('admin.layouts.app')

@section('title', 'Gestión de Productos')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Gestión de Productos</h1>

    <a href="{{ route('admin.products.create') }}" style="
      display: inline-block;
      padding: 12px 24px;
      background-color: #007bff;
      color: white;
      font-size: 16px;
      font-weight: bold;
      text-decoration: none;
      text-align: center;
      border-radius: 5px;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
   " onmouseover="this.style.backgroundColor='#0056b3'; this.style.transform='translateY(-2px)';"
        onmouseout="this.style.backgroundColor='#007bff'; this.style.transform='translateY(0)';"
        onfocus="this.style.boxShadow='0 0 0 4px rgba(0, 123, 255, 0.5)';" onblur="this.style.boxShadow='none';">
        Crear Producto
    </a>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">Imagen</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Marca</th>
                <th class="px-4 py-2">Precio</th>
                <th class="px-4 py-2">Estado</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="border-b">
                    <td class="px-4 py-2">
                        @if ($product->image)
                            <img src="https://aplicacionesenlanube.cetivirgendelapuerta.com/ecalzaditosuns/public/storage/{{ $product->image }}"
                                alt="{{ $product->product_name }}" class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="text-gray-500">Sin imagen</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $product->product_name }}</td>
                    <td class="px-4 py-2">{{ $product->brand->brand_name ?? 'Sin Marca' }}</td>
                    <td class="px-4 py-2">{{ number_format($product->price, 2) }} USD</td>
                    <td class="px-4 py-2">{{ $product->status ? 'Activo' : 'Inactivo' }}</td>
                    <td class="actions">
                        <!-- Ver Producto -->
                        <form action="{{ route('admin.products.show', $product->id_product) }}" method="GET"
                            class="inline-form">
                            <button type="submit" style="
                                    padding: 10px 20px;
                                    background-color: #28a745;
                                    color: white;
                                    font-size: 14px;
                                    font-weight: bold;
                                    border: none;
                                    border-radius: 5px;
                                    cursor: pointer;
                                    transition: background-color 0.3s ease, transform 0.2s ease;
                                    text-decoration: none;
                                "
                                onmouseover="this.style.backgroundColor='#218838'; this.style.transform='translateY(-2px)';"
                                onmouseout="this.style.backgroundColor='#28a745'; this.style.transform='translateY(0)';"
                                onfocus="this.style.boxShadow='0 0 0 4px rgba(40, 167, 69, 0.5)';"
                                onblur="this.style.boxShadow='none';">
                                Ver
                            </button>
                        </form>

                        <!-- Editar Producto -->
                        <form action="{{ route('admin.products.edit', $product->id_product) }}" method="GET"
                            class="inline-form">
                            <button type="submit" style="
                                    padding: 10px 20px;
                                    background-color: #007bff;
                                    color: white;
                                    font-size: 14px;
                                    font-weight: bold;
                                    border: none;
                                    border-radius: 5px;
                                    cursor: pointer;
                                    transition: background-color 0.3s ease, transform 0.2s ease;
                                    text-decoration: none;
                                "
                                onmouseover="this.style.backgroundColor='#0056b3'; this.style.transform='translateY(-2px)';"
                                onmouseout="this.style.backgroundColor='#007bff'; this.style.transform='translateY(0)';"
                                onfocus="this.style.boxShadow='0 0 0 4px rgba(0, 123, 255, 0.5)';"
                                onblur="this.style.boxShadow='none';">
                                Editar
                            </button>
                        </form>

                        <!-- Eliminar Producto -->
                        <form action="{{ route('admin.products.destroy', $product->id_product) }}" method="POST"
                            class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="
                                    padding: 10px 20px;
                                    background-color: #dc3545;
                                    color: white;
                                    font-size: 14px;
                                    font-weight: bold;
                                    border: none;
                                    border-radius: 5px;
                                    cursor: pointer;
                                    transition: background-color 0.3s ease, transform 0.2s ease;
                                    text-decoration: none;
                                " onclick="return confirm('¿Estás seguro?')"
                                onmouseover="this.style.backgroundColor='#c82333'; this.style.transform='translateY(-2px)';"
                                onmouseout="this.style.backgroundColor='#dc3545'; this.style.transform='translateY(0)';"
                                onfocus="this.style.boxShadow='0 0 0 4px rgba(220, 53, 69, 0.5)';"
                                onblur="this.style.boxShadow='none';">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection