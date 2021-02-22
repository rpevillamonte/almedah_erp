<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ManufacturingProducts;

class BillOfMaterialsBillOfMaterials extends Model
{
    use HasFactory;
    protected $table = "bom_bill_of_materials";
    public $timestamps = true;
    protected $fillable = [
        'id',
        'customer_id',
        'product_code',
        'quantity',
        'unit',
        'bom_status',
        'currency',
        'is_active',
        'is_default',
        'allow_alternative_item',
        'set_rate_sub_assembly_item',
        'total_cost',
    ];
    protected $casts = [
        'id' => 'integer',
        'customer_id' => 'integer',
        'quantity' => 'integer',
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'allow_alternative_item' => 'boolean',
        'set_rate_sub_assembly_item' => 'boolean',
        'total_cost' => 'integer',
    ];

    public function product_code()
    {
        return $this->belongsTo(ManufacturingProducts::class, 'product_code');
    }
}
