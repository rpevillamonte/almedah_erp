<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturingProducts extends Model
{
    use HasFactory;
    protected $table = 'man_products';
    public $timestamps = true;
    protected $fillable = [
        'product_code',
        'product_name',
        'product_category',
        'product_type',
        'sales_price_wt',
        'unit',
        'internal_description',
        'bar_code',
        'picture'
    ];
}
