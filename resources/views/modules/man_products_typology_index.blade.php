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
                            onclick="window.open('/manufacturing/products-typology/create', '_blank');">
                            Add New
                        </button>
                    </div>
                </div>

                <table id="example" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <td>product_type</td>
                            <td>product_subtype</td>
                            <td>procurement_method</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($man_products_typology_list as $man_products_typology)
                            <tr>
                                <td>{{ $man_products_typology->product_type }}</td>
                                <td>{{ $man_products_typology->product_subtype }}</td>
                                <td>{{ $man_products_typology->procurement_method }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <script>
                    $(document).ready(function() {
                        let table = $('#example').DataTable();

                        $('#example tbody').on('click', 'tr', function () {
                            var data = table.row( this ).data();
                            window.open('/manufacturing/products-typology/' + data[0], '_blank');
                        });
                    });
                </script>

            </div>
        </div>
    </div>
@endsection('content')