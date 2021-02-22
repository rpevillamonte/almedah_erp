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
                            onclick="window.open('/manufacturing/products/create', '_blank');">
                            Add New
                        </button>
                    </div>
                </div>

                <table id="example" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <td>picture</td>
                            <td>product_code</td>
                            <td>product_name</td>
                            <td>product_category</td>
                            <td>product_type</td>
                            <td>sales_price_wt</td>
                            <td>unit</td>
                            <td>internal_description</td>
                            <td>bar_code</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($man_products_list as $man_products)
                            <tr>
                                <td>{{ $man_products->picture }}</td>
                                <td>{{ $man_products->product_code }}</td>
                                <td>{{ $man_products->product_name }}</td>
                                <td>{{ $man_products->product_category }}</td>
                                <td>{{ $man_products->product_type }}</td>
                                <td>{{ $man_products->sales_price_wt }}</td>
                                <td>{{ $man_products->unit }}</td>
                                <td>{{ $man_products->internal_description }}</td>
                                <td>{{ $man_products->bar_code }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <script>
                    $(document).ready(function() {
                        let table = $('#example').DataTable();

                        $('#example tbody').on('click', 'tr', function () {
                            var data = table.row( this ).data();
                            window.open('/manufacturing/products/' + data[1], '_blank');
                        });
                    });
                </script>

            </div>
        </div>
    </div>
@endsection('content')