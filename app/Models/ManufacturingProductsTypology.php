<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturingProductsTypology extends Model
{
    use HasFactory;
    protected $table = 'man_products_typology';
    protected $primaryKey = 'product_type';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'product_type',
        'product_subtype',
        'procurement_method',
    ];
}
