<?php

namespace App\Http\Controllers;

use \App\Models\ManufacturingProducts;
use Illuminate\Http\Request;
use DB;

class ProductsController extends Controller
{

    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'product_code' => 'required',
        //     'product_name' => '',
        //     'product_category' => '',
        //     'product_type' => '',
        //     'sales_price_wt' => '',
        //     'unit' => '',
        //     'internal_description' => '',
        //     'bar_code' => ''
        // ]);
        try {

            $form_data = $request->input();
            \App\Models\ManufacturingProducts::create($form_data);

            /* Insert Product Record to man_products table */
            //$imagePath = request('picture')->store('uploads', 'public');

            // $form_data = $request->input();
            // $data = new ManufacturingProducts();
            // $data->product_code = $form_data['product_code'];
            // $data->product_name = $form_data['product_name'];
            // $data->product_category = $form_data['product_category'];
            // $data->product_type = $form_data['product_type'];
            // $data->sales_price_wt = $form_data['sales_price_wt'];
            // $data->unit = $form_data['unit'];
            // $data->internal_description = $form_data['internal_description'];
            // $data->bar_code = $form_data['bar_code'];
            // $data->picture = $imagePath;
            // $data->save();

            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return $e;
        }

        //dd(request()->all());
    }

    public function update(Request $request, $id)
    {
        try {
            /* Update Product Record from man_products table */
            $imagePath = request('picture')->store('uploads', 'public');
            $form_data = $request->input();
            $data = ManufacturingProducts::find($id);
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
            $data = ManufacturingProducts::find($id);
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
