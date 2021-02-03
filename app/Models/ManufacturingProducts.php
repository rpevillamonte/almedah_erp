<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturingProducts extends Model
{
    use HasFactory;
    protected $table = 'MAN_PRODUCTS';
    protected $primaryKey = 'PRODUCT_CODE';
    public $timestamps = true;
    protected $fillable = [
        'product_code',
        'product_name',
        'product_category',
        'product_type',
        'sales_price_wt',
        'unit',
        'internal_description',
        'barcode',
        'picture'
    ];
}
