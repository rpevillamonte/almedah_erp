<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturingCategorization extends Model
{
    use HasFactory;
    protected $table = 'man_categorization';
    protected $primaryKey = 'product_category';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'accounting_family',
        'product_category',
    ];
}
