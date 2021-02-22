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
                            onclick="window.open('/bill-of-materials/bill-of-materials/{{ $bom_bill_of_materials->id }}/edit', '_blank');">
                            Edit
                        </button>

                        <form method="POST" enctype="multipart/form-data" action="/api/bill-of-materials/bill-of-materials/{{ $bom_bill_of_materials->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-primary">Delete</button>
                        </form>
                    </div>
                </div>

                <div>
                    <h5 class="font-weight-bold text-black">id</h5>
                    {{ $bom_bill_of_materials->id }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">customer_id</h5>
                    {{ $bom_bill_of_materials->customer_id }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">product_code</h5>
                    {{ $bom_bill_of_materials->product_code }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">quantity</h5>
                    {{ $bom_bill_of_materials->quantity }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">unit</h5>
                    {{ $bom_bill_of_materials->unit }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">bom_status</h5>
                    {{ $bom_bill_of_materials->bom_status }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">currency</h5>
                    {{ $bom_bill_of_materials->currency }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">is_active</h5>
                    {{ $bom_bill_of_materials->is_active ? 'true' : 'false' }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">is_default</h5>
                    {{ $bom_bill_of_materials->is_default ? 'true' : 'false' }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">allow_alternative_item</h5>
                    {{ $bom_bill_of_materials->allow_alternative_item ? 'true' : 'false' }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">set_rate_sub_assembly_item</h5>
                    {{ $bom_bill_of_materials->set_rate_sub_assembly_item ? 'true' : 'false' }}
                </div>
                <div>
                    <h5 class="font-weight-bold text-black">total_cost</h5>
                    {{ $bom_bill_of_materials->total_cost }}
                </div>
            </div>
        </div>
    </div>
@endsection('content')