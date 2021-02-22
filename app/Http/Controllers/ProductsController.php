<?php

namespace App\Http\Controllers;

use App\Models\ItemGroup;
use App\Models\ManufacturingMaterials;
use App\Models\UnitOfMeasurement;
use \App\Models\ManufacturingProducts;
use \App\Models\ProductAttribute;
use \App\Models\ProductVariantWithValue;
use Illuminate\Http\Request;
use DB;
use PhpOption\None;
use Exception;

class ProductsController extends Controller
{
    function index()
    {
        $man_products = ManufacturingProducts::get();
        $item_groups = ItemGroup::all();
        $raw_mats = ManufacturingMaterials::all();
        $product_units = UnitOfMeasurement::all();
        $product_variants = ProductAttribute::all();
        return view('modules.item', [
            "man_products"=>$man_products,
            "item_groups"=>$item_groups,
            "raw_mats"=>$raw_mats,
            "product_units"=>$product_units,
            "product_variants"=>$product_variants,
        ]);
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

            // $form_data = $request->input();
            // \App\Models\ManufacturingProducts::create($form_data);

            /* Insert Product Record to man_products table */
            $imagePath = request('picture')->store('uploads', 'public');

            $form_data = $request->input();
            $data = new ManufacturingProducts();

            $data->product_name = $form_data['product_name'];
            $data->product_status = $form_data['product_status'];
            $data->product_type = $form_data['product_type'];
            $data->product_category = (isset($form_data['product_category'])) ? $form_data['product_category'] : null;
            $data->sales_price_wt = $form_data['sales_price_wt'];
            $data->unit = $form_data['unit'];
            $data->internal_description = $form_data['internal_description'];
            $data->bar_code = $form_data['bar_code'];
            $data->picture = $imagePath;


            if ($form_data['product_status'] == "Template") {
                $concat = substr($form_data['product_name'], 0, 3) . "-" . substr($form_data['product_type'], 0, 3);
                $code = strtoupper(str_replace(' ', '', $concat));
                $data->product_code = $code;
            } else {
                $code = $form_data['product_code'];
                if (isset($form_data['attribute_value_array'])) {
                    for ($i = 0; $i < count($form_data['attribute_value_array']); $i++) {
                        $code .= "-" . $form_data['attribute_value_array'][$i];
                    }
                }
                $data->product_code = strtoupper(str_replace(' ', '', $code));
            }

            $data->save();

            if (isset($form_data['attribute_array']) && isset($form_data['attribute_value_array'])) {
                $i = 0;
                foreach ($form_data['attribute_array'] as $attribute) {
                    $variants = new ProductVariantWithValue();
                    $variants->product_id = $data->id;
                    $variants->attribute = $attribute;
                    $variants->value = $form_data['attribute_value_array'][$i];
                    $variants->save();
                    $i++;
                }
            } else if (isset($form_data['attribute_array'])) {
                foreach ($form_data['attribute_array'] as $attribute) {
                    $variants = new ProductVariantWithValue();
                    $variants->product_id = $data->id;
                    $variants->attribute = $attribute;
                    $variants->save();
                }
            }

            // if (isset($form_data['attribute_value_array'])) {
            //     foreach ($form_data['attribute_array'] as $attribute_value) {
            //         //$ProductVariantWithValueData = ProductVariantWithValue::where([['product_id', '=', $form_data['attribute_id']], ['attribute', '=', $form_data['attribute_name_array'][(int)$i]]])->first();
            //         // $ProductVariantWithValueData->value = $attribute_value;
            //         // $ProductVariantWithValueData->save();

            //         $variants = new ProductVariantWithValue();
            //         $variants->product_id = $data->id;
            //         $variants->attribute = $attribute;
            //         $variants->save();                    

            //     }
            // }


            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'error' => $e

            ]);
        }

        //dd(request()->all());
    }

    public function update(Request $request, $id)
    {
        try {
            /* Update Product Record from man_products table */
            $data = ManufacturingProducts::find($id);
            $form_data = $request->input();
            $imagePath = "";
            if (request('picture')) {
                $imagePath = request('picture')->store('uploads', 'public');
                $data->picture = $imagePath;
            }

            $data->product_code = $form_data['product_code'];
            $data->product_name = $form_data['product_name'];
            $data->product_status = $form_data['product_status'];
            $data->product_type = $form_data['product_type'];
            $data->sales_price_wt = $form_data['sales_price_wt'];
            $data->unit = $form_data['unit'];
            $data->internal_description = $form_data['internal_description'];
            $data->bar_code = $form_data['bar_code'];


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

    public function add_item_group(Request $request)
    {
        try {
            $form_data = $request->input();
            $data = new ItemGroup();
            $data->item_group = $form_data['item_group'];
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
    public function add_product_unit(Request $request)
    {
        try {
            $form_data = $request->input();
            $data = new UnitOfMeasurement();
            $data->unit = $form_data['unit_name'];
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
    public function add_attribute(Request $request)
    {
        try {
            $form_data = $request->input();
            $data = new ProductAttribute();
            $data->attribute = $form_data['attribute_name'];
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

    public function get_attribute($id)
    {
        try {
            /* Delete Product Record from man_products table */
            $data = ProductVariantWithValue::where('product_id', $id)->get();
            return response()->json([
                'status' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed'
            ]);
        }
    }
}
