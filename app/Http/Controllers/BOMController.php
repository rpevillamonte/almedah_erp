<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManufacturingProducts;
use App\Models\BillOfMaterials;
use Exception;
use DB;

class BOMController extends Controller
{
    //
    public function index() {
        $man_boms = BillOfMaterials::get();
        return view('modules.bom', ['man_boms' => $man_boms]);
    }

    public function store(Request $request) {
        try {
            $form_data = $request->input();
            $data = new BillOfMaterials();
            $data->product_code = $form_data["product_code"];
            $data->quantity = $form_data["quantity"];
            $data->unit = $form_data["item_uom"];
            $data->currency = $form_data["currency"];
            $data->is_active = $form_data["is_active"];
            $data->is_default = $form_data["is_default"];
            $data->allow_alternative_item = $form_data["alt_item"];
            $data->set_rate_assembly_item = $form_data["sub_item"];
            //$data = $for_

            $data->save();
        } catch (Exception $e) {
            return $e;
        }
    }

    public function search_product(Request $request) {
        try {
            $product_code = $request->input();
            $data = ManufacturingProducts::select('product_name', 'unit')->where('product_code', $product_code)->first();
            return response()->json([
                'product_name' => $data->product_name,
                'product_unit' => $data->unit
            ]);
        } catch (Exception $e) {
            return $e;
        }
    }
}
