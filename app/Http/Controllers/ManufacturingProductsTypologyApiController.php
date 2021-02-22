<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\ManufacturingProductsTypology;

class ManufacturingProductsTypologyApiController extends Controller
{
    public function index()
    {   
        $man_products_typology_list = ManufacturingProductsTypology::get();

        return response()->json($man_products_typology_list);
    }

    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'product_type' => ['required', 'max:20', 'unique:man_products_typology'],
            'product_subtype' => ['required', 'max:20'],
            'procurement_method' => ['required', 'max:20'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $man_products_typology = ManufacturingProductsTypology::create($validator->valid());

        return response()->json($man_products_typology);
    }

    public function show($products_type)
    {
        $man_products_typology = ManufacturingProductsTypology::find($products_type);

        if (is_null($man_products_typology)){
            return response()->json()
                ->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return response()->json($man_products_typology);
    }

    public function update(Request $request, $products_type)
    {
        $man_products_typology = ManufacturingProductsTypology::find($products_type);

        if (is_null($man_products_typology)){
            return response()->json()
                ->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'product_subtype' => ['required', 'max:20'],
            'procurement_method' => ['required', 'max:20'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $man_products_typology->fill($validator->valid());
        $man_products_typology->save();

        return response()->json($man_products_typology);
    }

    public function destroy($products_type)
    {
        $man_products_typology = ManufacturingProductsTypology::find($products_type);

        if (is_null($man_products_typology)){
            return response()->json()
                ->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        $man_products_typology->delete();

        return response()->json($products_type);
    }
}
