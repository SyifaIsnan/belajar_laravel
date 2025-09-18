<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = "products"; #untuk memanggil nama table
    protected $fillable = [
        "name",
        "description",
        "price",
        "stock"
    ];

    protected $hidden = [
        "price" #supaya ga bisa keliatan price nya (cuma buat contoh aja)
    ];
}
