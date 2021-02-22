@extends('layouts.app')
@section('content')
    <div class="container mt-3 rounded">
        <div class="row d-flex justify-content-center">
            <div class="col-sm p-4 bg-light">

                <h4 class="font-weight-bold text-black">Create Manufacturing Products Typology</h4>

                <form method="POST" enctype="multipart/form-data" action="/api/manufacturing/products-typology">
                    @csrf
                    <div class="form-group">
                        <label for="product_type">product_type</label>
                        <input type="text" class="form-control" id="product_type" name="product_type">
                    </div>
                    <div class="form-group">
                        <label for="product_subtype">product_subtype</label>
                        <input type="text" class="form-control" id="product_subtype" name="product_subtype">
                    </div>
                    <div class="form-group">
                        <label for="procurement_method">procurement_method</label>
                        <input type="text" class="form-control" id="procurement_method" name="procurement_method">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>

            </div>
        </div>
    </div>
@endsection('content')