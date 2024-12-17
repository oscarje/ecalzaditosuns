<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;

    // Asegúrate de agregar 'url' a la propiedad $fillable
    protected $fillable = ['url'];  // Solo el campo 'url' es asignable

    // Si no deseas utilizar asignación masiva, puedes usar $guarded
    // protected $guarded = [];
}
