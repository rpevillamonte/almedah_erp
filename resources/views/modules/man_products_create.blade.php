@extends('layouts.app')
@section('content')
    <div class="container mt-3 rounded">
        <div class="row d-flex justify-content-center">
            <div class="col-sm p-4 bg-light">

                <h4 class="font-weight-bold text-black">Create Manufacturing Products</h4>

                <form method="POST" enctype="multipart/form-data" action="/api/manufacturing/products">
                    @csrf
                    <div class="form-group">
                        <label for="picture">picture</label>
                        <input type="file" class="form-control" id="picture" name="picture">
                    </div>
                    <div class="form-group">
                        <label for="product_code">product_code</label>
                        <input type="text" class="form-control" id="product_code" name="product_code">
                    </div>
                    <div class="form-group">
                        <label for="product_name">product_name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name">
                    </div>
                    <div class="form-group">
                        <label for="product_category">product_category</label>
                        <input type="text" class="form-control" id="product_category" name="product_category">
                    </div>
                    <div class="form-group">
                        <label for="product_type">product_type</label>
                        <input type="text" class="form-control" id="product_type" name="product_type">
                    </div>
                    <div class="form-group">
                        <label for="sales_price_wt">sales_price_wt</label>
                        <input type="text" class="form-control" id="sales_price_wt" name="sales_price_wt">
                    </div>
                    <div class="form-group">
                        <label for="unit">unit</label>
                        <input type="text" class="form-control" id="unit" name="unit">
                    </div>
                    <div class="form-group">
                        <label for="internal_description">internal_description</label>
                        <input type="text" class="form-control" id="internal_description" name="internal_description">
                    </div>
                    <div class="form-group">
                        <label for="bar_code">bar_code</label>
                        <input type="text" class="form-control" id="bar_code" name="bar_code">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>

            </div>
        </div>
    </div>
@endsection('content')