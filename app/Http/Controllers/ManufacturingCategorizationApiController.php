<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\ManufacturingCategorization;

class ManufacturingCategorizationApiController extends Controller
{
    public function index()
    {   
        $man_categorization_list = ManufacturingCategorization::get();

        return response()->json($man_categorization_list);
    }

    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'accounting_family' => ['required', 'max:20'],
            'product_category' => ['required', 'max:20', 'unique:man_categorization'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $man_categorization = ManufacturingCategorization::create($validator->valid());

        return response()->json($man_categorization);
    }

    public function show($product_category)
    {
        $man_categorization = ManufacturingCategorization::find($product_category);

        if (is_null($man_categorization)){
            return response()->json()
                ->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return response()->json($man_categorization);
    }

    public function update(Request $request, $product_category)
    {
        $man_categorization = ManufacturingCategorization::find($product_category);

        if (is_null($man_categorization)){
            return response()->json()
                ->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'accounting_family' => ['required', 'max:20'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $man_categorization->fill($validator->valid());
        $man_categorization->save();

        return response()->json($man_categorization);
    }

    public function destroy($product_category)
    {
        $man_categorization = ManufacturingCategorization::find($product_category);

        if (is_null($man_categorization)){
            return response()->json()
                ->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        $man_categorization->delete();

        return response()->json($product_category);
    }
}
