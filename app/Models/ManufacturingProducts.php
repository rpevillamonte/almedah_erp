<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ManufacturingCategorization;
use App\Models\ManufacturingProductsTypology;

class ManufacturingProducts extends Model
{
    use HasFactory;
    protected $table = 'man_products';
    protected $primaryKey = 'product_code';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'picture',
        'product_code',
        'product_name',
        'product_category',
        'product_type',
        'sales_price_wt',
        'unit',
        'internal_description',
        'bar_code'
    ];

    public function product_category()
    {
        return $this->belongsTo(ManufacturingCategorization::class, 'product_category');
    }

    public function product_type()
    {
        return $this->belongsTo(ManufacturingProductsTypology::class, 'product_type');
    }
}
