@extends('admin.layouts.app')

@section('title', 'Agregar Inventario')

@section('content')
<div class="container mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-semibold mb-6">Agregar Nuevo Inventario</h1>

    <form action="{{ route('admin.inventory.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label>Producto</label>
            <select name="product_sku" class="w-full border p-2 rounded">
                @foreach($products as $product)
                    <option value="{{ $product->product_sku }}">{{ $product->product_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label>Talla</label>
            <select name="id_size" class="w-full border p-2 rounded">
                @foreach($sizes as $size)
                    <option value="{{ $size->id_size }}">{{ $size->size_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label>Color</label>
            <select name="id_color" class="w-full border p-2 rounded">
                @foreach($colors as $color)
                    <option value="{{ $color->id_color }}">{{ $color->color_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label>Cantidad</label>
            <input type="number" name="quantity" class="w-full border p-2 rounded" min="0" required>
        </div>

        <button type="submit" style="
        background-color: #3182ce; /* Azul similar al bg-blue-600 */
        color: white;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 5px;
        border: none;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
    " onmouseover="this.style.backgroundColor='#2b6cb0'; this.style.transform='translateY(-3px)';"
            onmouseout="this.style.backgroundColor='#3182ce'; this.style.transform='translateY(0)';"
            onfocus="this.style.boxShadow='0 0 0 4px rgba(49, 130, 206, 0.5)';" onblur="this.style.boxShadow='none';">
            Guardar
        </button>

    </form>
</div>
@endsection