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
                            onclick="window.open('/manufacturing/categorization/create', '_blank');">
                            Add New
                        </button>
                    </div>
                </div>

                <table id="example" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <td>accounting_family</td>
                            <td>product_category</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($man_categorization_list as $man_categorization)
                            <tr>
                                <td>{{ $man_categorization->accounting_family }}</td>
                                <td>{{ $man_categorization->product_category }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <script>
                    $(document).ready(function() {
                        let table = $('#example').DataTable();

                        $('#example tbody').on('click', 'tr', function () {
                            var data = table.row( this ).data();
                            window.open('/manufacturing/categorization/' + data[1], '_blank');
                        });
                    });
                </script>

            </div>
        </div>
    </div>
@endsection('content')