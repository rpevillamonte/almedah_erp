<?php

namespace App\Http\Controllers;

use \App\Models\ManufacturingMaterials;
use App\Models\MaterialCategory;
use Illuminate\Http\Request;
use DB;
use Exception;

class MaterialsController extends Controller
{
    function index(){
        $raw_materials = ManufacturingMaterials::with('category')->get();
        $man_mats_categories = MaterialCategory::get();
        return view('modules.inventory', [
            'raw_materials' => $raw_materials,
            'categories' => $man_mats_categories
        ]);
    }

    function get($id)
    {
        $material_details = ManufacturingMaterials::with('category')->find($id);
        return $material_details;
    }

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
                'status' => 'success',
                'image' => $imagePath,
                'id' => $data->id,
                'category_title' => $data->category->category_title
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
            /* Update Product Record from env_raw_materials table */
            $data = ManufacturingMaterials::find($id);
            $imagePath = "";
            if (request('material_image')) {
                $imagePath = request('material_image')->store('uploads', 'public');
                $data->item_image = $imagePath;
            }
            $form_data = $request->input();
            $data->item_code = $form_data['material_code'];
            $data->item_name = $form_data['material_name'];
            $data->category_id  = $form_data['material_category'];
            $data->unit_price = $form_data['unit_price'];
            $data->total_amount = $form_data['total_amount'];
            $data->rm_status = $form_data['rm_status'];
            $data->save();

            return response()->json([
                'status' => 'success',
                'image' => $imagePath,
                'id' => $data->id,
                'category_title' => $data->category->category_title
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed ' . $e
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
                'status' => 'failed ' . $e
            ]);
        }
    }

    public function storeCategory(Request $request){
        try {
            /* Insert Category to env_raw_categories table */
            $form_data = $request->input();
            $data = new MaterialCategory();
            $data->category_title = $form_data['category_title'];
            $data->description = $form_data['category_description'];
            $data->quantity  = $form_data['category_quantity'];
            $data->save();
            return response()->json([
                'status' => 'success',
                'id' => $data->id,
                'category_title' => $data->category_title
            ]);
        } catch (Exception $e) {
            return $e;
            // return response()->json([
            //     'status' => 'failed'
            // ]);
        }
    }
}
