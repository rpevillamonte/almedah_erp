@extends('layouts.app')
@section('content')
    <div class="container mt-3 rounded">
        <div class="row d-flex justify-content-center">
            <div class="col-sm p-4 bg-light">

                <h4 class="font-weight-bold text-black">Manufacturing Categorization</h4>

                <div class="row pb-2">
                    <div class="col-12 text-right">
                        <button 
                            type="button" 
                            class="btn btn-outline-primary" 
                            onclick="window.open('/manufacturing/categorization/{{ $man_categorization->product_category }}/edit', '_blank');">
                            Edit
                        </button>

                        <form method="POST" enctype="multipart/form-data" action="/api/manufacturing/categorization/{{ $man_categorization->product_category }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-primary">Delete</button>
                        </form>
                    </div>
                </div>

                <div>
                    <h5 class="font-weight-bold text-black">accounting_family</h5>
                    {{ $man_categorization->accounting_family }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">product_category</h5>
                    {{ $man_categorization->product_category }}
                </div>
            </div>
        </div>
    </div>
@endsection('content')