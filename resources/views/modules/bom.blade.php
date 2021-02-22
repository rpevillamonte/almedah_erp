<div class="container mt-3 rounded">
    <div class="row d-flex justify-content-center">
        <div class="col-sm p-4 bg-light">
            <h4 class="font-weight-bold text-black">BOM</h4>
            <div id="alert-message">
            </div>
            <div class="row pb-2">
                <div class="col-12 text-right">
                    <p><button id="addBOM" data-bs-target="newBOMForm" type="button" class="btn btn-outline-primary btn-sm" ><i class="fas fa-plus" aria-hidden="true"></i> Add New</button></p>
                </div>
            </div>
            <table id="BOMtable" class="table table-striped table-bordered hover" style="width:100%">
                <thead>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td>
                        <td>
                            <small>Name</small>
                        </td>
                        <td>
                            <small>Status</small>
                        </td>
                        <td>
                            <small>Item</small>
                        </td>
                        <td>
                            <small>Is Active</small>
                        </td>
                        <td>
                            <small>Is Default</small>
                        </td>
                        <td>
                            <small>Total Cost</small>
                        </td>
                        <td>
                            <small>ETC</small>
                        </td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($man_boms as $bom)
                    <tr>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td>
                        <td>
                            <a name="BOM-{{ $bom['product_code'] }}" href='javascript:onclick=openBlueprint();'>
                                <small>BOM-{{ $bom['product_code'] }}</small>
                            </a>
                        </td>
                        <td>
                            <small>Default</small>
                        </td>
                        <td class="text-black-20">
                            <small>{{ $bom['product_code'] }}</small>
                        </td>
                        <td class="text-black-50">
                            @if($bom['is_active']===1)
                                <small>✓</small>
                            @endif
                        </td>
                        <td class="text-black-50">
                            @if($bom['is_default']===1)
                                <small>✓</small>
                            @endif
                        </td>
                        <td></td>
                        <td class="text-black-50">
                            
                        </td>
                        <td>
                            <small>
                                <span class="fas fa-comments"></span>0
                            </small>
                        </td>
                    </tr>
                    @endforeach
                    <!--<tr>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td>
                        <td class="font-weight-bold"></td>
                        <td class="font-weight-bold"></td>
                        <td>
                            <span class="dot-black"></span>
                        </td>
                        <td class="text-black-50">
                        </td>
                        <td class="text-black-50">
                        </td>
                        <td class="text-black-50 text-center"><a href='#'>View</a></td>
                        <td class="">
                            <ul class="list-inline text-center">
                                <li class="list-inline-item">
                                    <button data-toggle="modal" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></button>
                                </li>
                                <li class="list-inline-item">
                                    <button onclick="" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></button>
                                </li>
                                <li class="list-inline-item">
                                    <button data-toggle="modal" class="btn btn-secondary btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Add Variant"><i class="fa fa-plus-circle"></i></button>
                                </li>
                            </ul>
                        </td>
                    </tr>-->
                </tbody>
            </table>
            <script>
                $(document).ready(function() {
                    $('#BOMtable').dataTable({
                        columnDefs: [{
                            orderable: false,
                            targets: 0
                        }],
                        order: [
                            [1, 'asc']
                        ]
                    });
                });
            </script>
        </div>
    </div>
</div>

<script>
    $('#addBOM').on('click', function (event) {
        $('#contentBOM').load('/newbom');
    });
</script>



<!-- end document-->