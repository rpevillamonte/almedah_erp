<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturingBOM extends Model
{
    use HasFactory;
    protected $table = 'bom_bill_of_materials';
    public $timestamps = true;
    protected $fillable = [
        
    ];
}
