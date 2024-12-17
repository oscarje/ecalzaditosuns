@extends('admin.layouts.app')

@section('title', 'Editar Color')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Editar Color</h1>

    <form action="{{ route('admin.colors.update', $color->id_color) }}" method="POST"
        class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="color_name" class="block text-sm font-medium text-gray-700">Nombre del Color</label>
            <input type="text" id="color_name" name="color_name" value="{{ old('color_name', $color->color_name) }}"
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-300">
            @error('color_name')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" style="
        background-color: #3182ce; /* Azul similar al bg-blue-600 */
        color: white;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        text-align: center;
        transition: background-color 0.3s ease, transform 0.2s ease;
    " onmouseover="this.style.backgroundColor='#2b6cb0'; this.style.transform='translateY(-2px)';"
            onmouseout="this.style.backgroundColor='#3182ce'; this.style.transform='translateY(0)';"
            onfocus="this.style.boxShadow='0 0 0 4px rgba(49, 130, 206, 0.5)';" onblur="this.style.boxShadow='none';">
            Actualizar
        </button>

    </form>
</div>
@endsection