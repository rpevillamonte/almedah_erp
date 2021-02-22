@extends('layouts.app')
@section('content')
    <div class="container mt-3 rounded">
        <div class="row d-flex justify-content-center">
            <div class="col-sm p-4 bg-light">

                <h4 class="font-weight-bold text-black">Manufacturing Products</h4>

                <div class="row pb-2">
                    <div class="col-12 text-right">
                        <button 
                            type="button" 
                            class="btn btn-outline-primary" 
                            onclick="window.open('/manufacturing/products/{{ $man_products->product_code }}/edit', '_blank');">
                            Edit
                        </button>

                        <form method="POST" enctype="multipart/form-data" action="/api/manufacturing/products/{{ $man_products->product_code }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-primary">Delete</button>
                        </form>
                    </div>
                </div>

                <div>
                    <h5 class="font-weight-bold text-black">picture</h5>
                    <a href="{{ url('storage/uploads/pictures', $man_products->picture) }}">{{ $man_products->picture }}</a>
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">product_code</h5>
                    {{ $man_products->product_code }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">product_name</h5>
                    {{ $man_products->product_name }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">product_category</h5>
                    {{ $man_products->product_category }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">product_name</h5>
                    {{ $man_products->product_name }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">product_type</h5>
                    {{ $man_products->product_type }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">sales_price_wt</h5>
                    {{ $man_products->sales_price_wt }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">unit</h5>
                    {{ $man_products->unit }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">internal_description</h5>
                    {{ $man_products->internal_description }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">bar_code</h5>
                    {{ $man_products->bar_code }}
                </div>
            </div>
        </div>
    </div>
@endsection('content')