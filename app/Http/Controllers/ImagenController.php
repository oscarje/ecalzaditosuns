<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Imagen;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        // Validar la imagen
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Subir la imagen y obtener su ruta en el disco 'public'
        $path = $request->file('imagen')->store('imagenes', 'public'); // Nota el 'public' aquí

        // Obtener la URL pública de la imagen
        $url = Storage::url($path);

        // Guardar la URL en la base de datos
        Imagen::create([
            'url' => $url,
        ]);

        return back()->with('success', 'Imagen subida correctamente');
    }
}
