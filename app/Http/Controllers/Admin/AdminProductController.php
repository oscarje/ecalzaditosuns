<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
// use App\Http\Controllers\Admin\DB;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class AdminProductController extends Controller
{
    /**
     * Muestra la lista de productos.
     */
    public function index()
    {
        $products = Product::with('brand', 'categories')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $colors = Color::all();
        return view('admin.products.create', compact('brands', 'categories', 'colors'));
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // Validación de campos
            'product_sku' => 'required|unique:products,product_sku|max:255',
            'product_name' => 'required|max:255',
            'product_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'id_brand' => 'required|exists:brands,id_brand',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id_category',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'color_id' => 'nullable|exists:colors,id_color',
            'status' => 'required|boolean',
            'additional_images' => 'nullable|array', // Validación para imágenes adicionales
            'additional_images.*' => 'image|mimes:jpg,jpeg,png|max:2048' // Validación para cada imagen adicional
        ]);
        // dd($request->additional_images);

        // Subir imagen principal
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Crear producto
        $product = Product::create($validatedData);

        // Asociar categorías
        if ($request->has('categories')) {
            $product->categories()->attach($request->categories);
        }

        if ($request->hasFile('additional_images')) {
            dd($request->file('additional_images'));
            foreach ($request->file('additional_images') as $image) {
                $additionalImagePath = $image->store('product_images', 'public');

                // Verifica si la imagen se ha guardado correctamente

                $product->images()->create(['image_path' => $additionalImagePath]);
            }
        }


        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('admin.products.index')
            ->with('success', 'Producto creado con éxito');
    }

    /**
     * Muestra los detalles de un producto.
     */
    public function show($id)
    {
        $product = Product::with('brand', 'categories')->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Muestra el formulario para editar un producto.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::all();
        $categories = Category::all();
        // Obtener los colores disponibles desde el modelo Color
    $colors = Color::all();
        return view('admin.products.edit', compact('product', 'brands', 'categories'));
    }

    /**
     * Actualiza un producto existente en la base de datos.
     */

     public function update(Request $request, $id)
     {
         $product = Product::findOrFail($id);
     
         // Validar los datos
         $validated = $request->validate([
             'product_name' => 'required|string|max:255',
             'price' => 'required|numeric',
             'product_description' => 'nullable|string',
             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validar la imagen
         ]);
     
         // Si hay una nueva imagen
         if ($request->hasFile('image')) {
             // Eliminar la imagen anterior si existe
             if ($product->image) {
                 Storage::delete('public/' . $product->image);  // Eliminar la imagen anterior
             }
     
             // Subir la nueva imagen
             $imagePath = $request->file('image')->store('products', 'public');
             // Guardar la ruta de la nueva imagen en la base de datos
             $product->image = $imagePath;
         }
     
         // Actualizar otros campos
         $product->product_name = $validated['product_name'];
         $product->price = $validated['price'];
         $product->product_description = $validated['product_description'];
         $product->status = $request->input('status', 1);  // Por si no se pasa el estado, por defecto será 1 (activo)
     
         // Guardar el producto
         $product->save();
     
         // Redirigir a la lista de productos con un mensaje de éxito
         return redirect()->route('admin.products.index')->with('success', 'Producto actualizado correctamente');
     }
     




    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Actualizar los registros relacionados en cart_details para que no hagan referencia al producto eliminado
        DB::table('cart_details')->where('id_product', $product->id_product)->update(['id_product' => null]);

        // Desvincular categorías
        $product->categories()->detach();

        // Eliminar el producto
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
