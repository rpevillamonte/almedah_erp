<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\ManufacturingCategorization;

class ManufacturingCategorizationController extends Controller
{

    public function index()
    {   
        $man_categorization_list = ManufacturingCategorization::get();

        return view('modules.man_categorization_index', [
            'man_categorization_list' => $man_categorization_list
        ]);
    }

    public function create()
    {
        return view('modules.man_categorization_create');
    }

    public function show($product_category){
        $man_categorization = ManufacturingCategorization::findOrFail($product_category);

        return view('modules.man_categorization_show', [
            'man_categorization' => $man_categorization
        ]);
    }

    public function edit($product_category){
        $man_categorization = ManufacturingCategorization::findOrFail($product_category);

        return view('modules.man_categorization_edit', [
            'man_categorization' => $man_categorization
        ]);
    }
}
