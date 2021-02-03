<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use \App\Models\ManufacturingProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index() {
        $products = DB::table('MAN_PRODUCTS')->get();
        return view('modules.item', compact('products'));
    }

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
            //$form_data = $request->input();
            //\App\Models\ManufacturingProducts::create($form_data);

            /* Insert Product Record to man_products table */
            $imagePath = request('picture')->store('storage', 'public');

            $form_data = $request->input();
            $data = new ManufacturingProducts();
            $data->product_code = $form_data['product_code'];
            $data->product_name = $form_data['product_name'];
            $data->product_category = $form_data['product_category'];
            $data->product_type = $form_data['product_type'];
            $data->sales_price_wt = $form_data['sales_price_wt'];
            $data->unit = $form_data['unit'];
            $data->internal_description = $form_data['internal_description'];
            $data->barcode = $form_data['barcode'];
            $data->picture = $imagePath;
            $data->save();

            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return $e;
        }

        //dd(request()->all());
    }

    public function update(Request $request, $product_code)
    {
        try {
            /* Update Product Record from man_products table */
            $imagePath = request('edit_picture');
            $form_data = $request->input();
            if(empty($form_data))
                dd($form_data);
            $data = ManufacturingProducts::find($product_code);
            $data->product_code = $form_data['edit_product_code'];
            $data->product_name = $form_data['edit_product_name'];
            $data->product_category = $form_data['edit_product_category'];
            $data->product_type = $form_data['edit_product_type'];
            $data->sales_price_wt = $form_data['edit_sales_price_wt'];
            $data->unit = $form_data['edit_unit'];
            $data->internal_description = $form_data['edit_internal_description'];
            $data->barcode = $form_data['edit_barcode'];
            if($imagePath != null) {
                $imagePath = $imagePath->store('storage', 'public');
                $data->picture = $imagePath;
            }
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

    public function delete($product_code)
    {
        try {
            /* Delete Product Record from man_products table */
            $data = ManufacturingProducts::find($product_code);
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
