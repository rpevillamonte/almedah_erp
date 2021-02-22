@extends('layouts.app')
@section('content')
    <div class="container mt-3 rounded">
        <div class="row d-flex justify-content-center">
            <div class="col-sm p-4 bg-light">

                <h4 class="font-weight-bold text-black">Manufacturing Products Typology</h4>

                <div class="row pb-2">
                    <div class="col-12 text-right">
                        <button 
                            type="button" 
                            class="btn btn-outline-primary" 
                            onclick="window.open('/manufacturing/products-typology/{{ $man_products_typology->product_type }}/edit', '_blank');">
                            Edit
                        </button>

                        <form method="POST" enctype="multipart/form-data" action="/api/manufacturing/products-typology/{{ $man_products_typology->product_type }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-primary">Delete</button>
                        </form>
                    </div>
                </div>

                <div>
                    <h5 class="font-weight-bold text-black">product_type</h5>
                    {{ $man_products_typology->product_type }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">product_subtype</h5>
                    {{ $man_products_typology->product_subtype }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">procurement_method</h5>
                    {{ $man_products_typology->procurement_method }}
                </div>
            </div>
        </div>
    </div>
@endsection('content')