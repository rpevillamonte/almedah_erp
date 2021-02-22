@extends('layouts.app')
@section('content')
    <div class="container mt-3 rounded">
        <div class="row d-flex justify-content-center">
            <div class="col-sm p-4 bg-light">

                <h4 class="font-weight-bold text-black">Edit Manufacturing Categorization</h4>

                <form method="POST" enctype="multipart/form-data" action="api/manufacturing/categorization/{{ $man_categorization->product_category }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="accounting_family">accounting_family</label>
                        <input type="text" class="form-control" id="accounting_family" name="accounting_family" value="{{ $man_categorization->accounting_family }}">
                    </div>
                    <div class="form-group">
                        <label for="product_category">product_category</label>
                        <input type="text" class="form-control" id="product_category" name="product_category" value="{{ $man_categorization->product_category }}" disabled>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>
        </div>
    </div>
@endsection('content')