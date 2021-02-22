@extends('layouts.app')
@section('content')
    <div class="container mt-3 rounded">
        <div class="row d-flex justify-content-center">
            <div class="col-sm p-4 bg-light">

                <h4 class="font-weight-bold text-black">Create Manufacturing Categorization</h4>

                <form method="POST" enctype="multipart/form-data" action="/api/manufacturing/categorization">
                    @csrf
                    <div class="form-group">
                        <label for="accounting_family">accounting_family</label>
                        <input type="text" class="form-control" id="accounting_family" name="accounting_family">
                    </div>
                    <div class="form-group">
                        <label for="product_category">product_category</label>
                        <input type="text" class="form-control" id="product_category" name="product_category">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>

            </div>
        </div>
    </div>
@endsection('content')