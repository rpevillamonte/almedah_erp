<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\ManufacturingProductsTypology;

class ManufacturingProductsTypologyController extends Controller
{

    public function index()
    {   
        $man_products_typology_list = ManufacturingProductsTypology::get();

        return view('modules.man_products_typology_index', [
            'man_products_typology_list' => $man_products_typology_list
        ]);
    }

    public function create()
    {
        return view('modules.man_products_typology_create');
    }

    public function show($product_type){
        $man_products_typology = ManufacturingProductsTypology::findOrFail($product_type);

        return view('modules.man_products_typology_show', [
            'man_products_typology' => $man_products_typology
        ]);
    }

    public function edit($product_type){
        $man_products_typology = ManufacturingProductsTypology::findOrFail($product_type);

        return view('modules.man_products_typology_edit', [
            'man_products_typology' => $man_products_typology
        ]);
    }
}
