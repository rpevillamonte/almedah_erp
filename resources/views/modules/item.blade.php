<script>
    // Creating a custom reset method since the native reset
    // function also resets the values of the materials in case
    // they've been changed in the inventory tab
    function resetProductForm(){
        $('#product_name').val(null);
        $('#internal_description').val(null);
        $('#product_type').val(null);
        $('#product_type').selectpicker('refresh');
        $('#unit').val(null);
        $('#unit').selectpicker('refresh');
        $('#attribute').val(null);
        $('#attribute').selectpicker('refresh');
        $('#materials').val(null);
        $('#materials').selectpicker('refresh');
        $('[name="product_category"]').val("none");
        $('[name="procurement_method"]').val("none");
        // Changing the input type to reset the file list
        $('input[name="picture"]')[0].type='';
        $('input[name="picture"]')[0].type='file';
        $('#bar_code').val(null);
        $('#sales_price_wt').val(null);
        materialList = [];
        // Removing each of the selected material badges
        $('.material-badge').each(function(){
            this.remove();
        });
    }
    // Function is called whenever a material is updated
    // Dynamically changes the qty/name on the badge
    function updatedMaterial(id, amount=null, name=null){
        $('#materials option[value="'+id+'"]').html(name);
        $('#materials').selectpicker('refresh');
        $('#raw_'+id).val(amount);
        $('#material-badge-qty-'+id).html(amount);
        $('#material-badge-name-'+id).html(name);
        
    }
    function deleteProduct(id) {
        if (confirm("Are you sure?")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: 'delete-product/' + id,
                data: null,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == "success") {
                        $(document).ready(function() {
                            sessionStorage.setItem("status", "success");
                            $('#divMain').load('/item');
                        });
                    } else {
                        $(document).ready(function() {
                            sessionStorage.setItem("status", "error");
                            $('#divMain').load('/item');
                        });
                    }

                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                    $(document).ready(function() {
                        sessionStorage.setItem("status", "error");
                        $('#divMain').load('/item');
                    });
                }
            });
        }
        return false;
    }
</script>
<div class="container mt-3 rounded">
    <div class="row d-flex justify-content-center">
        <div class="col-sm p-4 bg-light">
            <h4 class="font-weight-bold text-black">Item List</h4>
            <div id="alert-message">
            </div>

            <div class="row pb-2">
                <div class="col-12 text-right">
                    <p><button type="button" class="btn btn-outline-primary btn-sm" onclick="$('#item_code').hide();$('#productFormLabel').html('New Item');$('#create-product-form').modal('show'); resetProductForm()"><i class="fas fa-plus" aria-hidden="true"></i> Add New</button></p>
                </div>
            </div>
            <table id="example" class="table table-striped table-bordered hover" style="width:100%">
                <thead>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td>
                        <td>Item Code</td>
                        <td>Item Name</td>
                        <td>Status</td>
                        <td>Type</td>
                        <td>Unit</td>
                        <td>View</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($man_products as $product)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input">
                                </div>
                            </td>
                            <td class="font-weight-bold">{{ $product->product_code }}</td>
                            <td class="font-weight-bold">{{ $product->product_name }}</td>
                            <td>
                                <?php
                                $color = "";
                                if ($product->product_status == "Template") {
                                    $color = "orange";
                                } else if ($product->product_status == "Variant") {
                                    $color = "green";
                                } else {
                                    $color = "blue";
                                }
                                ?>
                                <span class="dot-<?= $color ?>"></span>
                                {{ $product->product_status }}
                            </td>
                            <td class="text-black-50">
                                {{ $product->product_type }}
                            </td>
                            <td class="text-black-50">
                                {{ $product->unit }}
                            </td>
                            <td class="text-black-50 text-center"><a href='#' onclick="$('#image-view').attr('src', 'storage/<?= $product->picture ?>')" data-toggle="modal" data-target="#exampleImage">View</a></td>
                            <td class="">
                                <ul class="list-inline text-center">
                                    <li class="list-inline-item">
                                        <button data-toggle="modal" data-target="#create-product-form" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" onclick="$('#item_code').show();$('#product_code').val('<?= $product->product_code ?>'); $('#product_name').val('<?= $product->product_name ?>'); $('.selectpicker').selectpicker('val', '<?= $product->product_type ?>'); $('#img_tmp').attr('src', 'storage/<?= $product->picture ?>'); $('#bar_code').val('<?= $product->bar_code ?>'); $('#sales_price_wt').val('<?= $product->sales_price_wt ?>'); $('.selectpicker1').selectpicker('val', '<?= $product->unit ?>'); $('#internal_description').val('<?= $product->internal_description ?>'); $('#product-form').attr('action', 'update-product/<?= $product->id ?>'); $('#productFormLabel').html('Edit Item'); get_attribute(<?= $product->id ?>); $('#product_status').val('<?= $product->product_status ?>');"><i class="fa fa-edit"></i></button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button onclick="deleteProduct(<?= $product->id ?>)" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button data-toggle="modal" data-target="#create-product-form" onclick="$('#item_code').show();$('#product_code').val('<?= $product->product_code ?>'); $('.selectpicker').selectpicker('val', '<?= $product->product_type ?>'); $('#productFormLabel').html('Add Variant for item (<b><?= $product->product_code ?></b>)'); $('.selectpicker1').selectpicker('val', '<?= $product->unit ?>'); $('#internal_description').val('<?= $product->internal_description ?>'); $('#product_status').val('Variant'); get_attribute(<?= $product->id ?>)" class="btn btn-secondary btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Add Variant"><i class="fa fa-plus-circle"></i></button>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <script>
                $(document).ready(function() {
                    $('#example').dataTable({
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
<!-- IMAGE PART MODAL -->
<div class="modal fade" id="exampleImage" tabindex="-1" role="dialog" aria-labelledby="exampleImageLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sample Picture</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-0 p-0">
                <img id="image-view" src="../images/thumbnail.png" style="width:100%;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<form id="product-form" method="POST" enctype="multipart/form-data" action="/create-product">
    <div class="modal fade" id="create-product-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productFormLabel">Item</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                    <div class="text-right buttons">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#create-product-form').modal('hide'); $('#img_tmp').attr('src', '../images/thumbnail.png');">Close</button>
                        <button type="submit" id="product-form-btn" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                <div class="modal-body">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-sm" style="display:none;" id="item_code">
                                <div class="form-group">
                                    <label for="">Item Code</label>
                                    <input readonly class="form-control" type="text" id="product_code" name="product_code" placeholder="Ex. EM181204" required>
                                    @error('product_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="">Item Name</label>
                                    <input class="form-control" type="text" id="product_name" name="product_name" placeholder="Ex. EM Hopper" required>
                                </div>
                            </div>
                        </div>

                        <input value="Template" class="form-control" type="text" id="product_status" name="product_status" hidden required>

                        <div class="form-group">
                            <label>Item Group</label>
                            <select id="product_type" class="selectpicker form-control" name="product_type" data-container="body" data-live-search="true" title="Select an Option" data-hide-disabled="true">
                                <option value="none" selected disabled hidden>
                                    Select an Option
                                </option>
                                @foreach ($item_groups as $item_group)
                                    <option value="{{ $item_group->item_group }}">{{ $item_group->item_group }}</option>
                                @endforeach
                                <option value="New">
                                    &#43; Create a new Item Group
                                </option>
                            </select>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $('.selectpicker').selectpicker();
                                    $('#product_type').on('change', function() {
                                        if (this.value == "New") {
                                            $('#item-group-modal').modal('toggle');
                                        }
                                    });
                                    $('#item-group-modal').on('shown.bs.modal', function() {
                                        $(document).off('focusin.modal');
                                    });
                                });
                            </script>
                        </div>
                        <div class="row" id="product_selected" style="display: none;">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Product Subtype</label>
                                    <select class="form-control" name="product_category" required>
                                        <option value="none" selected disabled hidden>
                                            Select an Option
                                        </option>
                                        <option>Finished Product</option>
                                        <option>Semi-finished </option>
                                        <option>Component</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Procurement Method</label>
                                    <select id="procurement_method" class="form-control" name="procurement_method" required>
                                        <option value="none" selected disabled hidden>
                                            Select an Option
                                        </option>
                                        <option value="buy">Buy</option>
                                        <option value="produce">Produce</option>
                                        <option value="buy and produce">Buy & Produce</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="made-to-selected" style="display: none;">
                            <label for="">Made to ?</label>
                            <select class="form-control" name="procurement_method" required>
                                <option value="none" selected disabled hidden>
                                    Select an Option
                                </option>
                                <option value="Made-to-Stock">Made-to-Stock</option>
                                <option value="Made-to-Order">Made-to-Order</option>
                            </select>
                        </div>

                        <script>
                            $("#product_type").change(function() {
                                if ($(this).val() == "Product") {
                                    $("#product_selected").show();
                                } else {
                                    $("#product_selected").hide();
                                }
                            });

                            $("#procurement_method").change(function() {
                                if ($(this).val() == "produce" || $(this).val() == "buy and produce") {
                                    $("#made-to-selected").show();
                                } else {
                                    $("#made-to-selected").hide();
                                }
                            });
                        </script>

                        <div class="form-group p-2">
                            <label for="">Image</label>
                            <img id="img_tmp" src="../images/thumbnail.png" style="width:100%;">
                            <input class="form-control" type="file" name="picture" onchange="readURL1(this);" required>
                        </div>

                        <script>
                            function readURL1(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function(e) {
                                        $('#img_tmp')
                                            .attr('src', e.target.result)
                                    };

                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>

                        <div class="form-group">
                            <label for="">Barcode</label>
                            <input class="form-control" type="text" id="bar_code" name="bar_code" required placeholder="Ex. 036000291452">
                        </div>

                        <div class="form-group">
                            <label for="">Sales Price W.T.</label>
                            <input class="form-control" type="text" id="sales_price_wt" name="sales_price_wt" required placeholder="Ex. 1000">
                        </div>

                        <div class="form-group">
                            <label>Unit of Measurement</label>
                            <select id="unit" class="selectpicker1 form-control" name="unit" data-container="body" data-live-search="true" title="Select an Option" data-hide-disabled="true">
                                <option value="none" selected disabled hidden>
                                    Select an Option
                                </option>
                                @foreach ($product_units as $unit)
                                    <option value="{{ $unit->unit }}">{{ $unit->unit }}</option>
                                @endforeach
                                <option value="New">
                                    &#43; Create a new UOM
                                </option>
                            </select>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $('.selectpicker1').selectpicker();
                                    $('#unit').on('change', function() {
                                        if (this.value == "New") {
                                            $('#add-unit-modal').modal('toggle');
                                        }
                                    });
                                    $('#add-unit-modal').on('shown.bs.modal', function() {
                                        $(document).off('focusin.modal');
                                    });
                                });
                            </script>
                        </div>

                        <div id="attributes_div">
                        </div>

                        <div class="form-group" id="attribute_group">
                            <label>Attributes</label>
                            <select id="attribute" class="selectpicker2 form-control" name="attribute" data-container="body" data-live-search="true" title="Select attribute" data-hide-disabled="true">
                                <option value="none" selected disabled hidden>
                                    Select an Option
                                </option>
                                @foreach ($product_variants as $variant)
                                    <option value="{{ $variant->attribute }} >">{{ $variant->attribute }}</option>
                                @endforeach
                                <option value="New">
                                    &#43; Create a new Attribute
                                </option>
                            </select>

                            <script type="text/javascript">
                                attributeList = ""
                                attributeList = (typeof attributeList != 'undefined' && attributeList instanceof Array) ? attributeList : []

                                $(document).ready(function() {
                                    $('.selectpicker2').selectpicker();
                                    $('#attribute').on('change', function() {
                                        if (this.value == "New") {
                                            $('#add-attribute-modal').modal('toggle');
                                        } else {
                                            if (attributeList.indexOf(this.value) !== -1) {
                                                alert("Value exists!");
                                            } else {
                                                $('#attributes_div').append('<span class="badge badge-success m-1 p-1">' + this.value + '</span><input type="text" name="attribute_array[]" value="' + this.value + '" hidden>');
                                                attributeList.push(this.value);
                                            }
                                        }
                                    });

                                    $('#add-attribute-modal').on('shown.bs.modal', function() {
                                        $(document).off('focusin.modal');
                                    });
                                });
                            </script>
                        </div>

                        <div class="form-group" id="materials-picker">
                            <label>Materials</label>
                            <select id="materials" class="selectpicker3 form-control" name="materials" data-container="body" data-live-search="true" title="Select Materials" data-hide-disabled="true">
                                <option value="none" selected disabled hidden>
                                    Select a Material
                                </option>
                                @foreach ($raw_mats as $raw_mat)
                                    <option value="{{ $raw_mat->id }}">{{ $raw_mat->item_name }}</option>
                                @endforeach
                            </select>

                            @foreach ($raw_mats as $raw_mat)
                                <input id="raw_{{ $raw_mat->id }}" type="text" value="{{ $raw_mat->total_amount }}" hidden>
                            @endforeach

                            <script type="text/javascript">
                                materialList = (typeof materialList != 'undefined' && materialList instanceof Array) ? materialList : []
                                $(document).ready(function() {
                                    $('.selectpicker3').selectpicker();
                                    $('#materials').on('change', function() {

                                        if (materialList.indexOf(this.value) !== -1) {
                                            alert("Value exists!");
                                        } else {
                                            if ($('#raw_' + this.value).val() > 0) {
                                                $('#materials_div').append('<div class="col-sm material-badge" id="material-badge-'+this.value+'"><label class="badge badge-success m-1 p-2"><span id="material-badge-name-'+this.value+'">' + $('#materials option:selected').html() + '</span> (<span id="material-badge-qty-'+ this.value + '">' + $('#raw_' + this.value).val() + '</span> Stocks Available)</label><input type="text" class="form-control" placeholder="Qty."></div>');
                                            } else {
                                                $('#materials_div').append('<div class="col-sm material-badge" id="material-badge-'+this.value+'"><label style="cursor: pointer;" onclick="$(`#create-product-form`).hide(); $(`body`).removeClass(`modal-open`); $(`.modal-backdrop`).remove(); $(`#divMain`).load(`/inventory`);" class="badge badge-danger m-1 p-2">' + $('#materials option:selected').html() + ' (' + $('#raw_' + this.value).val() + ' Stocks Left)</label></div>');
                                            }
                                            materialList.push(this.value);
                                        }

                                    });
                                });
                            </script>
                            <div class="row" id="materials_div" style="background:#ecf0f1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Item Description</label>
                            <textarea class="form-control" type="text" id="internal_description" name="internal_description"></textarea>
                        </div>

                        <div class="modal-footer">

                        </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    //GET ATTRIBUTE
    function get_attribute(id) {
        $('#attribute_group').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: '/get-attribute/' + id,
            data: null,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                data.status.forEach(function(arrayItem) {
                    console.log(arrayItem);
                    $('#attributes_div').append(`
                    <div class="form-group">
                        <label>${arrayItem.attribute}</label>
                        <input name="attribute_array[]" value="${arrayItem.attribute}" class="form-control" type="text" hidden>
                        <input name="attribute_value_array[]" class="form-control" type="text">
                    </div>                  
                    `);
                });

            },
            error: function(data) {}
        });
    }
</script>

<!-- ADD ITEM GROUP MODAL -->
<div class="modal fade" id="item-group-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form id="add-item-group-form" method="POST" action="#">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Item Group</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#item-group-modal').modal('hide')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="">Item Group Name</label>
                                <input class="form-control" type="text" id="item_group" name="item_group" required placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeSelectPickerModal($('#product_type'), $('#item-group-modal'))">Close</button>
                    <button type="submit" id="add-item-group-form-btn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        $("#add-item-group-form").on("submit", function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData($('#add-item-group-form')[0]);
            console.log(formData);
            $.ajax({
                type: 'POST',
                url: '/create-item-group',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == "success") {
                        $('#item-group-modal').modal('hide');
                        var item_group = $('#item_group').val();
                        $('#product_type').prepend('<option value="' + item_group + '">' + item_group + '</option>');
                        $('.selectpicker').selectpicker('refresh');
                        $('.selectpicker').selectpicker('val', item_group);
                        $('#item_group').val('');

                        $('#create-product-form').modal('show');

                        $('#create-product-form').on('shown.bs.modal', function() {
                            $('#product_type').focus();
                            $(document).off('focusin.modal');
                            $('.modal').css('overflow-y', 'auto');
                        });


                    } else {
                        $(document).ready(function() {
                            sessionStorage.setItem("status", "error");
                            $('#divMain').load('/item');
                        });
                    }

                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                    $(document).ready(function() {
                        sessionStorage.setItem("status", "error");
                        $('#divMain').load('/item');
                    });
                }
            });
            return false; 
        });
    </script>
</div>


<!-- ADD UNIT  MODAL -->
<div class="modal fade" id="add-unit-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form id="add-unit-form" method="POST" action="#">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        New UOM</h4>
                    <button type="button" class="close" aria-label="Close" onclick="$('#add-unit-modal').modal('hide')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="">
                                    UOM Name</label>
                                <input class="form-control" type="text" id="unit_name" name="unit_name" required placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeSelectPickerModal($('#unit'), $('#add-unit-modal'))">Close</button>
                    <button type="submit" id="add-unit-form-btn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        $("#add-unit-form").on("submit", function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData($('#add-unit-form')[0]);
            console.log(formData);
            $.ajax({
                type: 'POST',
                url: '/create-product-unit',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == "success") {
                        $('#add-unit-modal').modal('hide');
                        var unit_name = $('#unit_name').val();
                        $('#unit').prepend('<option value="' + unit_name + '">' + unit_name + '</option>');
                        $('.selectpicker1').selectpicker('refresh');
                        $('.selectpicker1').selectpicker('val', unit_name);
                        $('#unit_name').val('');


                        $('#create-product-form').modal('show');
                        $('#create-product-form').on('shown.bs.modal', function() {
                            $(document).off('focusin.modal');
                            $('#unit').focus();
                            $('.modal').css('overflow-y', 'auto');
                        });



                    } else {
                        $(document).ready(function() {
                            sessionStorage.setItem("status", "error");
                            $('#divMain').load('/item');
                        });
                    }

                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                    $(document).ready(function() {
                        sessionStorage.setItem("status", "error");
                        $('#divMain').load('/item');
                    });
                }
            });
            return false;
        });
    </script>
</div>

<!-- ADD ATTRIBUTE  MODAL -->
<div class="modal fade" id="add-attribute-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form id="add-attribute-form" method="POST" action="#">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        New Attribute</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#add-attribute-modal').modal('hide')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="">
                                    Attribute Name</label>
                                <input class="form-control" type="text" id="attribute_name" name="attribute_name" required placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeSelectPickerModal($('#attribute'), $('#add-attribute-modal'))">Close</button>
                    <button type="submit" id="add-attribute-form-btn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        $("#add-attribute-form").on("submit", function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData($('#add-attribute-form')[0]);
            console.log(formData);
            $.ajax({
                type: 'POST',
                url: '/create-attribute',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == "success") {
                        $('#add-attribute-modal').modal('hide');
                        var attribute_name = $('#attribute_name').val();
                        $('#attribute').prepend('<option value="' + attribute_name + '">' + attribute_name + '</option>');
                        $('.selectpicker2').selectpicker('refresh');
                        $('.selectpicker2').selectpicker('val', attribute_name);
                        $('#attribute_name').val('');

                        $('#create-product-form').modal('show');
                        $('#create-product-form').on('shown.bs.modal', function() {
                            $(document).off('focusin.modal');
                            $('#attribute').focus();
                            $('.modal').css('overflow-y', 'auto');
                        });

                        if (attributeList.indexOf(attribute_name) !== -1) {
                            alert("Value exists!");
                        } else {
                            attributeList.push(attribute_name);
                            $('#attributes_div').append('<span class="badge badge-success m-1 p-1">' + attribute_name + '</span><input type="text" name="attribute_array[]" value="' + attribute_name + '">');
                            $('.modal').css('overflow-y', 'auto');
                        }


                    } else {
                        $(document).ready(function() {
                            sessionStorage.setItem("status", "error");
                            $('#divMain').load('/item');
                        });
                    }

                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                    $(document).ready(function() {
                        sessionStorage.setItem("status", "error");
                        $('#divMain').load('/item');
                    });
                }
            });
            return false;
        });
    </script>
</div>



<script>
    // General function for closing modals & resetting the respective select element
    function closeSelectPickerModal(selectPicker, modal){
        if(selectPicker.selectpicker && modal.modal){
            modal.modal('hide');
            selectPicker.val('none');
            selectPicker.selectpicker('refresh');
        }
    }
    $(document).on('hidden.bs.modal', '.modal', function () {
        $('.modal:visible').length && $(document.body).addClass('modal-open');
    });
    $(document).ready(function(e) {
        $(".modal-backdrop").remove();
        /*Insert Record AJAX*/
        $('#product-form').on('submit', (function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData($('#product-form')[0]);
            $.ajax({
                type: 'POST',
                url: $('#product-form').attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    //console.log("success");

                    if (data.status == "success") {
                        $(document).ready(function() {
                            sessionStorage.setItem("status", "success");
                            $('#divMain').load('/item');
                        });
                    } else {
                        console.log("error");
                        console.log(data);
                    }
                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                }
            });
            return false;
        }));


    });

    $(document).ready(function() {
        var status = sessionStorage.getItem("status");
        if (status == "success") {
            $('#alert-message').html(`
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                Success!
            </div>            
            `);
        } else if (status == "error") {
            $('#alert-message').html(`
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                Error!
            </div>            
            `);
        }
        sessionStorage.removeItem("status");
    });
</script>