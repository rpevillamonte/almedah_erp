<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\BillOfMaterialsBillOfMaterials;

class BillOfMaterialsBillOfMaterialsController extends Controller
{

    public function index()
    {   
        $bom_bill_of_materials_list = BillOfMaterialsBillOfMaterials::get();

        return view('modules.bom_bill_of_materials_index', [
            'bom_bill_of_materials_list' => $bom_bill_of_materials_list
        ]);
    }

    public function create()
    {
        return view('modules.bom_bill_of_materials_create');
    }

    public function show($id){
        $bom_bill_of_materials = BillOfMaterialsBillOfMaterials::findOrFail($id);

        return view('modules.bom_bill_of_materials_show', [
            'bom_bill_of_materials' => $bom_bill_of_materials
        ]);
    }

    public function edit($id){
        $bom_bill_of_materials = BillOfMaterialsBillOfMaterials::findOrFail($id);

        return view('modules.bom_bill_of_materials_edit', [
            'bom_bill_of_materials' => $bom_bill_of_materials
        ]);
    }
}
