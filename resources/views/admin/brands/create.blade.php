@extends('admin.layouts.app')

@section('title', 'Crear Categoría')

@section('content')
<div class="container mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-semibold mb-6">Crear Nueva Marca</h1>

    <form action="{{ route('admin.brands.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Nombre de la Marca</label>
            <input type="text" name="brand_name" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Descripción</label>
            <textarea name="brand_description" class="w-full border p-2 rounded"></textarea>
        </div>

        <button type="submit" style="
            padding: 10px 20px;
            background-color: #3182ce; /* Azul similar al bg-blue-600 */
            color: white;
            font-size: 14px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-decoration: none;
        " onmouseover="this.style.backgroundColor='#2b6cb0'; this.style.transform='translateY(-2px)';"
            onmouseout="this.style.backgroundColor='#3182ce'; this.style.transform='translateY(0)';"
            onfocus="this.style.boxShadow='0 0 0 4px rgba(49, 130, 206, 0.5)';" onblur="this.style.boxShadow='none';">
            Crear Marca
        </button>

    </form>
</div>
@endsection