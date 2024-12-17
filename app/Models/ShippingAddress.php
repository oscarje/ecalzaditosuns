<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $table = 'shipping_addresses';
    protected $primaryKey = 'id_address';
    protected $fillable = [
        'id_user', 'address_line1', 'address_line2', 'city', 'state', 'postal_code', 'country'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
