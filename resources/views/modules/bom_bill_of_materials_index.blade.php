@extends('layouts.app')
@section('content')
    <div class="container mt-3 rounded">
        <div class="row d-flex justify-content-center">
            <div class="col-sm p-4 bg-light">

                <h4 class="font-weight-bold text-black">Bill Of Materials Bill Of Materials</h4>

                <div class="row pb-2">
                    <div class="col-12 text-right">
                        <button 
                            type="button" 
                            class="btn btn-outline-primary" 
                            onclick="window.open('/bill-of-materials/bill-of-materials/create', '_blank');">
                            Add New
                        </button>
                    </div>
                </div>

                <table id="example" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <td>id</td>
                            <td>customer_id</td>
                            <td>product_code</td>
                            <td>quantity</td>
                            <td>unit</td>
                            <td>bom_status</td>
                            <td>currency</td>
                            <td>is_active</td>
                            <td>is_default</td>
                            <td>allow_alternative_item</td>
                            <td>set_rate_sub_assembly_item</td>
                            <td>total_cost</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bom_bill_of_materials_list as $bom_bill_of_materials)
                            <tr>
                                <td>{{ $bom_bill_of_materials->id }}</td>
                                <td>{{ $bom_bill_of_materials->customer_id }}</td>
                                <td>{{ $bom_bill_of_materials->product_code }}</td>
                                <td>{{ $bom_bill_of_materials->quantity }}</td>
                                <td>{{ $bom_bill_of_materials->unit }}</td>
                                <td>{{ $bom_bill_of_materials->bom_status }}</td>
                                <td>{{ $bom_bill_of_materials->currency }}</td>
                                <td>{{ $bom_bill_of_materials->is_active ? 'true' : 'false' }}</td>
                                <td>{{ $bom_bill_of_materials->is_default ? 'true' : 'false' }}</td>
                                <td>{{ $bom_bill_of_materials->allow_alternative_item ? 'true' : 'false' }}</td>
                                <td>{{ $bom_bill_of_materials->set_rate_sub_assembly_item ? 'true' : 'false' }}</td>
                                <td>{{ $bom_bill_of_materials->total_cost }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <script>
                    $(document).ready(function() {
                        let table = $('#example').DataTable();

                        $('#example tbody').on('click', 'tr', function () {
                            var data = table.row( this ).data();
                            window.open('/bill-of-materials/bill-of-materials/' + data[0], '_blank');
                        });
                    });
                </script>

            </div>
        </div>
    </div>
@endsection('content')