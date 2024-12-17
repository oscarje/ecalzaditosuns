<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\ProductImage; // Asegúrate de importar el modelo ProductImage
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // Obtener los últimos 5 productos agregados, ordenados por fecha de creación
        $latestProducts = Product::latest()->take(5)->get();

        // Obtener todos los productos para las tarjetas
        $allProducts = Product::all();

        return view('index', compact('latestProducts', 'allProducts'));
    }

    public function show($sku)
    {
        // Buscar el producto por su SKU
        $product = Product::where('product_sku', $sku)->firstOrFail();
        // Obtener las imágenes asociadas al producto y sus colores
        $images = ProductImage::where('product_id', $product->id_product)
            ->with('color')  // Relación con colores
            ->get();

        // Obtener los colores y tamaños disponibles para este producto desde la tabla inventory
        $inventory = Inventory::where('product_sku', $sku)
            ->with(['color', 'size'])  // Cargar las relaciones de color y tamaño
            ->get();

        // Crear arreglos de colores y tamaños para pasarlos a la vista
        $colors = $inventory->pluck('color')->unique('id_color');
        $sizes = $inventory->pluck('size')->unique('id_size');

        // Pasar el producto, imágenes, colores y tamaños a la vista
        return view('cliente.product.show', compact('product', 'colors', 'sizes', 'images'));
    }


    // Método para crear un producto con su imagen principal
    public function store(Request $request)
    {
        // Validación de los datos del producto
        $request->validate([
            'product_sku' => 'required|string|max:100',
            'product_name' => 'required|string|max:100',
            'product_description' => 'nullable|string',
            'price' => 'required|numeric',
            'id_brand' => 'nullable|integer|exists:brands,id_brand',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Imagen principal
            'status' => 'nullable|boolean',
            'images' => 'nullable|array',  // Validación para las imágenes adicionales
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validación de cada imagen adicional
            'colors' => 'nullable|array',  // Colores asociados a las imágenes
            'colors.*' => 'integer|exists:colors,id_color', // Colores existentes
        ]);

        // Subir la imagen principal y obtener su ruta
        $imageUrl = null;
        if ($request->hasFile('image')) {
            // Subir la imagen principal al disco público y obtener el path
            $path = $request->file('image')->store('products', 'public');
            // Obtener la URL pública de la imagen
            $imageUrl = Storage::url($path);
        }

        // Crear el producto
        $product = Product::create([
            'product_sku' => $request->product_sku,
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'price' => $request->price,
            'id_brand' => $request->id_brand,
            'image' => $imageUrl,  // Guardar la URL de la imagen principal
            'status' => $request->status ?? 1,  // Si no se especifica status, asignar 1 por defecto
        ]);

        // Si se han subido imágenes adicionales
        if ($request->has('images') && $request->has('colors')) {
            foreach ($request->images as $index => $image) {
                // Subir cada imagen adicional
                $path = $image->store('product_images', 'public');
                $imagePath = Storage::url($path);

                // Crear una entrada en la tabla product_images
                ProductImage::create([
                    'product_id' => $product->id_product,
                    'color_id' => $request->colors[$index],  // Asociar el color correspondiente a la imagen
                    'image_path' => $imagePath,
                ]);
            }
        }

        return back()->with('success', 'Producto creado correctamente');
    }

    public function edit($id)
    {
        $product = Product::with('categories', 'brands')->findOrFail($id);
        $categories = Category::all();  // Cargar todas las categorías disponibles
        $brands = Brand::all();  // Cargar todas las marcas disponibles

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }


}
