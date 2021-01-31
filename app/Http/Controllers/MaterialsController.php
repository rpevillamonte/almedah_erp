<?php

namespace App\Http\Controllers;

use \App\Models\ManufacturingMaterials;
use Illuminate\Http\Request;
use DB;

class MaterialsController extends Controller
{

    public function store(Request $request)
    {

        try {
            /* Insert Material Record to env_raw_materials table */
            $imagePath = request('material_image')->store('uploads', 'public');
            $form_data = $request->input();
            $data = new ManufacturingMaterials();
            $data->item_code = $form_data['material_code'];
            $data->item_name = $form_data['material_name'];
            $data->category_id  = $form_data['material_category'];
            $data->unit_price = $form_data['unit_price'];
            $data->total_amount = $form_data['total_amount'];
            $data->rm_status = $form_data['rm_status'];
            $data->item_image = $imagePath;
            $data->save();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return $e;
            // return response()->json([
            //     'status' => 'failed'
            // ]);
        }

        //dd(request()->all());
    }

    public function update(Request $request, $id)
    {
        try {
            /* Update Product Record from man_products table */
            $imagePath = request('picture')->store('uploads', 'public');
            $form_data = $request->input();
            $data = ManufacturingMaterials::find($id);
            $data->product_code = $form_data['product_code'];
            $data->product_name = $form_data['product_name'];
            $data->product_category = $form_data['product_category'];
            $data->product_type = $form_data['product_type'];
            $data->sales_price_wt = $form_data['sales_price_wt'];
            $data->unit = $form_data['unit'];
            $data->internal_description = $form_data['internal_description'];
            $data->bar_code = $form_data['bar_code'];
            $data->picture = $imagePath;
            $data->save();

            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed'
            ]);
        }
    }

    public function delete($id)
    {
        try {
            /* Delete Product Record from man_products table */
            $data = ManufacturingMaterials::find($id);
            $data->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed'
            ]);
        }
    }
}
