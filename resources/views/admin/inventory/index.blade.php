@extends('admin.layouts.app')

@section('title', 'Gestión del Inventario')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Gestión del Inventario</h1>

    {{-- Botón para agregar nuevo inventario --}}
    <a href="{{ route('admin.inventory.create') }}" style="
        background-color: #3182ce; /* Azul similar al bg-blue-600 */
        color: white;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 5px;
        text-decoration: none; /* Elimina el subrayado predeterminado */
        display: inline-block;
        text-align: center;
        transition: background-color 0.3s ease, transform 0.2s ease;
    " onmouseover="this.style.backgroundColor='#2b6cb0'; this.style.transform='translateY(-2px)';"
        onmouseout="this.style.backgroundColor='#3182ce'; this.style.transform='translateY(0)';"
        onfocus="this.style.boxShadow='0 0 0 4px rgba(49, 130, 206, 0.5)';" onblur="this.style.boxShadow='none';">
        Agregar Nuevo Inventario
    </a>

    {{-- Mostrar alertas de éxito --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabla de inventario --}}
    <table class="table-auto w-full bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">Producto</th>
                <th class="px-4 py-2">Talla</th>
                <th class="px-4 py-2">Color</th>
                <th class="px-4 py-2">Cantidad</th>
                {{-- <th class="px-4 py-2">Imagen</th> --}}
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inventories as $inventory)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $inventory->product->product_name ?? 'Sin Producto' }}</td>
                            <td class="px-4 py-2">{{ $inventory->size->size_name ?? 'Sin Talla' }}</td>
                            <td class="px-4 py-2">{{ $inventory->color->color_name ?? 'Sin Color' }}</td>
                            <td class="px-4 py-2">{{ $inventory->quantity }}</td>
                            {{-- <td class="px-4 py-2">
                                @if ($inventory->productImage)
                                <img src="{{ asset($inventory->productImage->image_path) }}" alt="Imagen del Producto"
                                    class="w-16 h-16 object-cover rounded">
                                @else
                                <span class="text-gray-500">Sin Imagen</span>
                                @endif
                            </td> --}}
                            {{-- Acciones: Editar y Eliminar --}}
                            <td class="px-4 py-2 flex space-x-2">
                                <a href="{{ route('admin.inventory.edit', $inventory->id_inventory) }}" style="
                    background-color: #3182ce; /* Azul similar al bg-blue-600 */
                    color: white;
                    padding: 10px 20px;
                    font-size: 14px;
                    font-weight: bold;
                    border-radius: 5px;
                    text-decoration: none; /* Elimina el subrayado predeterminado */
                    display: inline-block;
                    text-align: center;
                    transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
                " onmouseover="this.style.backgroundColor='#2b6cb0'; this.style.transform='translateY(-3px)';"
                                    onmouseout="this.style.backgroundColor='#3182ce'; this.style.transform='translateY(0)';"
                                    onfocus="this.style.boxShadow='0 0 0 4px rgba(49, 130, 206, 0.5)';"
                                    onblur="this.style.boxShadow='none';">
                                    Editar
                                </a>

                                <form action="{{ route('admin.inventory.destroy', $inventory->id_inventory) }}" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de eliminar este registro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Eliminar</button>
                                </form>
                            </td>
                        </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">No hay registros de inventario disponibles.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection