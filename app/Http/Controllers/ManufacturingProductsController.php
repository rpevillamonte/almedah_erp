<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\ManufacturingProducts;

class ManufacturingProductsController extends Controller
{

    public function index()
    {   
        $man_products_list = ManufacturingProducts::get();

        return view('modules.man_products_index', [
            'man_products_list' => $man_products_list
        ]);
    }

    public function create()
    {
        return view('modules.man_products_create');
    }

    public function show($product_code){
        $man_products = ManufacturingProducts::findOrFail($product_code);

        return view('modules.man_products_show', [
            'man_products' => $man_products
        ]);
    }

    public function edit($product_code){
        $man_products = ManufacturingProducts::findOrFail($product_code);

        return view('modules.man_products_edit', [
            'man_products' => $man_products
        ]);
    }
}
