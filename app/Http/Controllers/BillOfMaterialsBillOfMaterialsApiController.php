<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\BillOfMaterialsBillOfMaterials;

class BillOfMaterialsBillOfMaterialsApiController extends Controller
{
    public function index()
    {   
        $bom_bill_of_material_list = BillOfMaterialsBillOfMaterials::get();

        return response()->json($bom_bill_of_material_list);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => ['required', 'size:6'],
            'product_code' => ['required', 'max:10', 'exists:man_products'],
            'quantity' => ['required', 'digits_between:0,10'],
            'unit' => ['required', 'max:6'],
            'bom_status' => ['required', 'max:10'],
            'currency' => ['required', 'max:6'],
            'is_active' => ['required', 'boolean'],
            'is_default' => ['required', 'boolean'],
            'allow_alternative_item' => ['required', 'boolean'],
            'set_rate_sub_assembly_item' => ['required', 'boolean'],
            'total_cost' => ['required', 'digits_between:0,10'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $bom_bill_of_material = BillOfMaterialsBillOfMaterials::create($validator->valid());

        return response()->json($bom_bill_of_material);
    }

    public function show($id)
    {
        $bom_bill_of_material = BillOfMaterialsBillOfMaterials::find($id);

        if (is_null($bom_bill_of_material)){
            return response()->json()
                ->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return response()->json($bom_bill_of_material);
    }

    public function update(Request $request, $id)
    {
        $bom_bill_of_material = BillOfMaterialsBillOfMaterials::find($id);

        if (is_null($bom_bill_of_material)){
            return response()->json()
                ->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'customer_id' => ['required', 'size:6'],
            'product_code' => ['required', 'max:10', 'exists:man_products'],
            'quantity' => ['required', 'digits_between:0,10'],
            'unit' => ['required', 'max:6'],
            'bom_status' => ['required', 'max:10'],
            'currency' => ['required', 'max:6'],
            'is_active' => ['required', 'boolean'],
            'is_default' => ['required', 'boolean'],
            'allow_alternative_item' => ['required', 'boolean'],
            'set_rate_sub_assembly_item' => ['required', 'boolean'],
            'total_cost' => ['required', 'digits_between:0,10'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $bom_bill_of_material->fill($validator->valid());
        $bom_bill_of_material->save();

        return response()->json($bom_bill_of_material);
    }

    public function destroy($id)
    {
        $bom_bill_of_material = BillOfMaterialsBillOfMaterials::find($id);

        if (is_null($bom_bill_of_material)){
            return response()->json()
                ->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        $bom_bill_of_material->delete();

        return response()->json($id);
    }
}
