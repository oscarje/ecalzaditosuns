@extends('admin.layouts.app')

@section('title', 'Listado de Categorías')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Gestión de Categorias</h1>

    <a href="{{ route('admin.categories.create') }}" style="
       display: inline-block;
       padding: 10px 20px;
       background-color: #3182ce; /* Azul similar al bg-blue-600 */
       color: white;
       font-size: 14px;
       font-weight: bold;
       border-radius: 5px;
       text-decoration: none;
       transition: background-color 0.3s ease, transform 0.2s ease;
       cursor: pointer;
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
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Descripción</th>
                <th class="px-4 py-2">Estado</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $category->category_name }}</td>
                                <td class="px-4 py-2">{{ $category->category_description }}</td>
                                <td class="px-4 py-2">{{ $category->status ? 'Activo' : 'Inactivo' }}</td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <a href="{{ route('admin.categories.edit', $category->id_category) }}" style="
                       display: inline-block;
                       padding: 10px 20px;
                       background-color: #3182ce; /* Azul similar al bg-blue-600 */
                       color: white;
                       font-size: 14px;
                       font-weight: bold;
                       border-radius: 5px;
                       text-decoration: none;
                       transition: background-color 0.3s ease, transform 0.2s ease;
                       cursor: pointer;
                   " onmouseover="this.style.backgroundColor='#2b6cb0'; this.style.transform='translateY(-2px)';"
                                        onmouseout="this.style.backgroundColor='#3182ce'; this.style.transform='translateY(0)';"
                                        onfocus="this.style.boxShadow='0 0 0 4px rgba(49, 130, 206, 0.5)';"
                                        onblur="this.style.boxShadow='none';">
                                        Editar
                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category->id_category) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection