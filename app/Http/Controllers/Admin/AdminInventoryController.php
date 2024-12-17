<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Http\Request;
use App\Models\ProductImage;

class AdminInventoryController extends Controller
{
    // Mostrar el listado del inventario
    public function index()
    {
        // dd('holaaaa');
        $inventories = Inventory::with(['product', 'size', 'color'])->get();
        // dd($inventories);
        return view('admin.inventory.index', compact('inventories'));
    }

    // Mostrar el formulario para crear un nuevo registro de inventario
    public function create()
    {
        $products = Product::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.inventory.create', compact('products', 'sizes', 'colors'));
    }

    // Guardar un nuevo registro en el inventario
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_sku' => 'required|exists:products,product_sku',
            'id_size' => 'required|exists:sizes,id_size',
            'id_color' => 'required|exists:colors,id_color',
            'quantity' => 'required|integer|min:0',
        ]);

        // dd($validatedData);

        Inventory::create($validatedData);

        return redirect()->route('admin.inventory.index')->with('success', 'Inventario creado exitosamente.');
    }

    // Mostrar el formulario para editar un registro del inventario
    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        $products = Product::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.inventory.edit', compact('inventory', 'products', 'sizes', 'colors'));
    }

    // Actualizar un registro del inventario
    public function update(Request $request, $id)
{
    // Encuentra el inventario basado en el ID
    $inventory = Inventory::findOrFail($id);

    // Validar los datos del formulario
    $request->validate([
        'product_sku' => 'required',
        'id_size' => 'required',
        'id_color' => 'required',
        'quantity' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de la imagen
    ]);

    // Actualizar los campos del inventario
    $inventory->product_sku = $request->input('product_sku');
    $inventory->id_size = $request->input('id_size');
    $inventory->id_color = $request->input('id_color');
    $inventory->quantity = $request->input('quantity');
    $inventory->save();

    // Verificar si se ha subido una imagen
    if ($request->hasFile('image')) {
        // Obtener el archivo de imagen
        $image = $request->file('image');
        
        // Obtener el nombre del archivo original y quitar la extensión
        $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        
        // Agregar un sufijo para evitar conflictos, por ejemplo, el ID del producto o un timestamp
        $imageName = 'product_' . $inventory->product_sku . '.' . $image->getClientOriginalExtension();
        
        // Almacenar la imagen en la carpeta 'products'
        $imagePath = $image->storeAs('public/products', $imageName);

        // Cambiar la ruta para que sea accesible públicamente
        $imagePath = 'products/' . $imageName;  // Solo dejamos la parte que empieza con 'products/'

        // Obtener el product_id a partir del product_sku
        $product = Product::where('product_sku', $inventory->product_sku)->first();
        
        if ($product) {
            $product_id = $product->id_product; // ID del producto

            // Insertar la imagen en la tabla `product_images`
            ProductImage::create([
                'product_id' => $product_id,  // Usamos el ID del producto
                'color_id' => $inventory->id_color,      // ID del color
                'image_path' => $imagePath               // Ruta de la imagen almacenada sin 'storage/'
            ]);
        }
    }

    // Redirigir a la lista de inventarios con un mensaje de éxito
    return redirect()->route('admin.inventory.index')->with('success', 'Inventario actualizado correctamente.');
}







    // Eliminar un registro del inventario
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect()->route('admin.inventory.index')->with('success', 'Inventario eliminado exitosamente.');
    }

}
