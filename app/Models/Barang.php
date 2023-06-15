<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    public function pesanan(){
        return $this->hasMany(Pesanan::class, 'id_barang');
    }
}
