@extends('admin.layouts.app')

@section('title', 'Gestión de Colores')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Gestión de Colores</h1>

    <a href="{{ route('admin.colors.create') }}" style="
        display: inline-block;
        padding: 10px 20px;
        background-color: #3182ce; /* Azul similar al bg-blue-600 */
        color: white;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    " onmouseover="this.style.backgroundColor='#2b6cb0'; this.style.transform='translateY(-2px)';"
        onmouseout="this.style.backgroundColor='#3182ce'; this.style.transform='translateY(0)';"
        onfocus="this.style.boxShadow='0 0 0 4px rgba(49, 130, 206, 0.5)';" onblur="this.style.boxShadow='none';">
        Crear Color
    </a>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nombre del Color</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($colors as $color)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $color->id_color }}</td>
                            <td class="px-4 py-2">{{ $color->color_name }}</td>
                            <td class="px-4 py-2 flex space-x-2">
                                <a href="{{ route('admin.colors.edit', $color->id_color) }}" style="
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #3182ce; /* Azul similar al bg-blue-600 */
                    color: white;
                    font-size: 14px;
                    font-weight: bold;
                    text-align: center;
                    text-decoration: none;
                    border-radius: 5px;
                    transition: background-color 0.3s ease, transform 0.2s ease;
                " onmouseover="this.style.backgroundColor='#2b6cb0'; this.style.transform='translateY(-2px)';"
                                    onmouseout="this.style.backgroundColor='#3182ce'; this.style.transform='translateY(0)';"
                                    onfocus="this.style.boxShadow='0 0 0 4px rgba(49, 130, 206, 0.5)';"
                                    onblur="this.style.boxShadow='none';">
                                    Editar
                                </a>

                                <form action="{{ route('admin.colors.destroy', $color->id_color) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded"
                                        onclick="return confirm('¿Estás seguro de eliminar este color?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection