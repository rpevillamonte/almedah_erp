<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\ManufacturingProducts;

class ManufacturingProductsApiController extends Controller
{
    public function index()
    {   
        $man_products_list = ManufacturingProducts::get();

        return response()->json($man_products_list);
    }

    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'picture' => ['required', 'image'],
            'product_code' => ['required', 'max:10', 'unique:man_products'],
            'product_name' => ['required', 'max:30'],
            'product_category' => ['required', 'max:20', 'exists:man_categorization,product_category'],
            'product_type' => ['required', 'max:20', 'exists:man_products_typology,product_type'],
            'sales_price_wt' => ['required', 'digits_between:0,6'],
            'unit' => ['required', 'max:6'],
            'internal_description' => ['required', 'max:300'],
            'bar_code' => ['required', 'size:12'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $path = $validator->valid()['picture']->store('public/uploads/pictures');
        $man_products = ManufacturingProducts::create(array_replace($validator->valid(), ['picture' => basename($path)]));

        return response()->json($man_products);
    }

    public function show($products_code)
    {
        $man_products = ManufacturingProducts::find($products_code);

        if (is_null($man_products)){
            return response()->json()
                ->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return response()->json($man_products);
    }

    public function update(Request $request, $products_code)
    {
        $man_products = ManufacturingProducts::find($products_code);

        if (is_null($man_products)){
            return response()->json()
                ->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'picture' => ['required', 'image'],
            'product_name' => ['required', 'max:30'],
            'product_category' => ['required', 'max:20', 'exists:man_categorization,product_category'],
            'product_type' => ['required', 'max:20', 'exists:man_products_typology,product_type'],
            'sales_price_wt' => ['required', 'digits_between:0,6'],
            'unit' => ['required', 'max:6'],
            'internal_description' => ['required', 'max:300'],
            'bar_code' => ['required', 'size:12'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $path = $validator->valid()['picture']->store('public/uploads/pictures');
        $man_products->fill(array_replace($validator->valid(), ['picture' => basename($path)]));
        $man_products->save();

        return response()->json($man_products);
    }

    public function destroy($products_code)
    {
        $man_products = ManufacturingProducts::find($products_code);

        if (is_null($man_products)){
            return response()->json()
                ->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        $man_products->delete();

        return response()->json($products_code);
    }
}
