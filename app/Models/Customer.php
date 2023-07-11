<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'customer_id',
        'address',
        'image',
    ];
    
    public function pesanan(){
        return $this->hasMany(Pesanan::class, 'id_customer');
    }

}
