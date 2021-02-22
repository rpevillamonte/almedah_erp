@extends('layouts.app')
@section('content')
    <div class="container mt-3 rounded">
        <div class="row d-flex justify-content-center">
            <div class="col-sm p-4 bg-light">

                <h4 class="font-weight-bold text-black">Edit Manufacturing Categorization</h4>

                <form method="POST" enctype="multipart/form-data" action="/api/bill-of-materials/bill-of-materials/{{ $bom_bill_of_materials->id }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="customer_id">id</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{ $bom_bill_of_materials->id }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="customer_id">customer_id</label>
                        <input type="text" class="form-control" id="customer_id" name="customer_id" value="{{ $bom_bill_of_materials->customer_id }}">
                    </div>
                    <div class="form-group">
                        <label for="product_code">product_code</label>
                        <input type="text" class="form-control" id="product_code" name="product_code" value="{{ $bom_bill_of_materials->product_code }}">
                    </div>
                    <div class="form-group">
                        <label for="quantity">quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $bom_bill_of_materials->quantity }}">
                    </div>
                    <div class="form-group">
                        <label for="unit">unit</label>
                        <input type="text" class="form-control" id="unit" name="unit" value="{{ $bom_bill_of_materials->unit }}">
                    </div>
                    <div class="form-group">
                        <label for="bom_status">bom_status</label>
                        <input type="text" class="form-control" id="bom_status" name="bom_status" value="{{ $bom_bill_of_materials->bom_status }}">
                    </div>
                    <div class="form-group">
                        <label for="currency">currency</label>
                        <input type="text" class="form-control" id="currency" name="currency" value="{{ $bom_bill_of_materials->currency }}">
                    </div>
                    <div class="form-group">
                        <label for="is_active">is_active</label>
                        <select id="is_active" class="form-control" name="is_active">
                            <option value="1" {{ $bom_bill_of_materials->is_active ? 'selected': '' }}>true</option>
                            <option value="0" {{ $bom_bill_of_materials->is_active ? '': 'selected' }}>false</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="is_default">is_default</label>
                        <select id="is_default" class="form-control" name="is_default">
                        <option value="1" {{ $bom_bill_of_materials->is_default ? 'selected': '' }}>true</option>
                            <option value="0" {{ $bom_bill_of_materials->is_default ? '' : 'selected' }}>false</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="allow_alternative_item">allow_alternative_item</label>
                        <select id="allow_alternative_item" class="form-control" name="allow_alternative_item">
                        <option value="1" {{ $bom_bill_of_materials->allow_alternative_item ? 'selected': '' }}>true</option>
                            <option value="0" {{ $bom_bill_of_materials->allow_alternative_item ? '': 'selected' }}>false</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="set_rate_sub_assembly_item">set_rate_sub_assembly_item</label>
                        <select id="set_rate_sub_assembly_item" class="form-control" name="set_rate_sub_assembly_item">
                        <option value="1" {{ $bom_bill_of_materials->set_rate_sub_assembly_item ? 'selected': '' }}>true</option>
                            <option value="0" {{ $bom_bill_of_materials->set_rate_sub_assembly_item ? '': 'selected' }}>false</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="total_cost">total_cost</label>
                        <input type="number" class="form-control" id="total_cost" name="total_cost" value="{{ $bom_bill_of_materials->total_cost }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>
        </div>
    </div>
@endsection('content')