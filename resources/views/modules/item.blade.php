<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'almedah_erp_db');

try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}

?>

<div class="container mt-3 rounded">
    <div class="row d-flex justify-content-center">

        <div class="col-sm p-4 bg-light">
            <h4 class="font-weight-bold text-black">Product List</h4>
            <div id="alert-message">
            </div>
            <div class="row pb-2">
                <div class="col-12 text-right">
                    <p><button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#create-product-form"><i class="fas fa-plus" aria-hidden="true"></i> Add New</button></p>
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
                        <td>Product Code</td>
                        <td>Product Name</td>
                        <td>Type</td>
                        <td>Category</td>
                        <td>View</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input">
                                </div>
                            </td>
                            <td>{{ $product->PRODUCT_CODE }}</td>
                            <td>{{ $product->PRODUCT_NAME }}</td>
                            <td class="text-black-50">
                            @if($product->PRODUCT_TYPE === 'Product')
                                <span class="dot-green"></span>
                            @elseif ($product->PRODUCT_TYPE === 'Raw')
                                <span class="dot-orange"></span>
                            @else
                                <span class="dot-blue"></span>
                            @endif
                                {{ $product->PRODUCT_TYPE }}
                            </td>
                            <td class="text-black-50">{{ $product->PRODUCT_CATEGORY }}</td>
                            <td class="text-black-50 text-center"><a href='#' onclick="$('#image-view').attr('src', 'storage/{{ $product->PICTURE }}'); $('#product-name').text('{{ $product->PRODUCT_NAME }}');" data-toggle="modal" data-target="#exampleImage">View</a></td>
                            <td class="">
                                <ul class="list-inline m-0">
                                   <li class="list-inline-item">
                                        <button data-toggle="modal" data-target="#update-product-form-{{ $product->PRODUCT_CODE }}" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></button>
                                   </li>
                                    <li class="list-inline-item">
                                        <button onclick="deleteProduct('{{ $product->PRODUCT_CODE }}')" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title" id="product-name">Sample Picture</h4>
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
<div class="modal fade" id="create-product-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="product-form" method="POST" enctype="multipart/form-data" action="/create-product" onsubmit="return false">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Code</label>
                                <input class="form-control" type="text" name="product_code" placeholder="Ex. EM181204" required>
                                @error('product_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input class="form-control" type="text" name="product_name" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Product Type</label>
                        <select id="product_type" class="form-control" name="product_type" required>
                            <option value="none" selected disabled hidden>
                                Select an Option
                            </option>
                            <?php
                                $sql = "SELECT * FROM MAN_PRODUCTS_TYPOLOGY";
                                if($stmt=$pdo->prepare($sql)) {
                                    if($stmt->execute()) {
                                        $rows = $stmt->fetchAll();
                                        foreach($rows as $row) {
                            ?>
                            <option value="<?=$row['PRODUCT_TYPE']?>"><?=$row['PRODUCT_TYPE']?></option>
                            <?php
                                        }
                                    }
                                }
                            ?>
                        </select>
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



                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <label for="">Product Category</label>
                                <select class="form-control" name="product_category" required>
                                    <option value="none" selected disabled hidden>
                                        Select Category
                                    </option>
                                    <?php
                                    $sql = "SELECT PRODUCT_CATEGORY FROM MAN_CATEGORIZATION";

                                    if ($stmt = $pdo->prepare($sql)) {
                                        if ($stmt->execute()) {

                                            $rows = $stmt->fetchAll();

                                            foreach ($rows as $row) {
                                    ?>
                                    <option value="<?= $row['PRODUCT_CATEGORY'] ?>" name="category"><?= $row['PRODUCT_CATEGORY'] ?></option>
                                    <?php
                                            }
                                        }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-7">
                                <div class="form-group">
                                    <label for="">Accounting Family</label>
                                    <select name="accounting_family" id="" class="form-control">
                                        <option value="none" selected disabled hidden>
                                            Select an Accounting Family
                                        </option>
                                        <option value="Consumable">Consumable</option>
                                        <option value="Equipment">Equipment</option>
                                        <option value="Components">Components</option>
                                    </select>
                                </div>
                        </div> 
                    </div>

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
                        <input class="form-control" type="text" name="barcode" required placeholder="Ex. 036000291452">
                    </div>


                    <div class="form-group">
                        <label for="">Sales Price W.T.</label>
                        <input class="form-control" type="text" name="sales_price_wt" required placeholder="Ex. 1000">
                    </div>


                    <div class="form-group">
                        <label for="">Unit</label>
                        <select class="form-control" name="unit" required>
                            <option value="none" selected disabled hidden>
                                Select an Option
                            </option>
                            <option value="KG">KG</option>
                            <option value="MM">MM</option>
                            <option value="CM">CM</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Item Description</label>
                        <textarea class="form-control" type="text" name="internal_description" style="resize:none;"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="product-form-btn" class="btn btn-primary" data-dismiss="modal">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Product Modal -->
@foreach ($products as $product)
<div class="modal fade" id="update-product-form-{{ $product->PRODUCT_CODE }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update {{ $product->PRODUCT_NAME }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-product-form-{{ $product->PRODUCT_CODE }}" method="POST" enctype="x-www-form-urlencoded" action="/update-product/{{ $product->PRODUCT_CODE }}">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Code</label>
                                <input class="form-control" type="text" name="edit_product_code" value="{{ $product->PRODUCT_CODE }}" required> 
                                @error('product_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input class="form-control" type="text" name="edit_product_name" value="{{ $product->PRODUCT_NAME }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Product Type</label>
                        <select class="form-control" name="edit_product_type" required>
                            <option value="{{ $product->PRODUCT_TYPE }}" selected hidden>
                                {{ $product->PRODUCT_TYPE }}
                            </option>
                            <option value="Product">Product</option>
                            <option value="Raw">Raw Materials</option>
                            <option value="Service">Service</option>
                        </select>
                    </div>

                    <div class="row" id="edit_product_selected" style="display: none;">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Product Subtype</label>
                                <select class="form-control" name="" required>
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
                                <select class="form-control" name="procurement_method" required>
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

                    <div class="form-group" id="edit-made-to-selected" style="display: none;">
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
                        $("#edit_product_type").change(function() {
                            if ($(this).val() == "Product") {
                                $("#edit_product_selected").show();
                            } else {
                                $("#edit_product_selected").hide();
                            }
                        });

                        $("#edit_procurement_method").change(function() {
                            if ($(this).val() == "produce" || $(this).val() == "buy and produce") {
                                $("#edit-made-to-selected").show();
                            } else {
                                $("#edit-made-to-selected").hide();
                            }
                        });
                    </script>



                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Product Category</label>
                                <select class="form-control" name="edit_product_category" required>
                                    <option value="{{ $product->PRODUCT_CATEGORY }}" selected hidden>
                                        {{ $product->PRODUCT_CATEGORY }}
                                    </option>
                                    <?php
                                    $sql = "SELECT PRODUCT_CATEGORY FROM MAN_CATEGORIZATION";

                                    if ($stmt = $pdo->prepare($sql)) {
                                        if ($stmt->execute()) {

                                            $rows = $stmt->fetchAll();

                                            foreach ($rows as $row) {
                                    ?>
                                                <option value="<?= $row['PRODUCT_CATEGORY'] ?>" name="category"><?= $row['PRODUCT_CATEGORY'] ?></option>
                                    <?php
                                            }
                                        }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group p-2">
                        <label for="">Image</label>
                        <img id="edit_img_tmp-{{ $product->PRODUCT_CODE }}" src="storage/{{ $product->PICTURE }}" style="width:100%;">
                        <input class="form-control" type="file" value="{{ $product->PICTURE }}" name="edit_picture" onchange="readURL2(this, '{{ $product->PRODUCT_CODE }}');" required>
                    </div>

                    <script>
                        function readURL2(input, product_code) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    $('#edit_img_tmp-' + product_code).attr('src', e.target.result)
                                };

                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    </script>

                    <div class="form-group">
                        <label for="">Barcode</label>
                        <input value="{{ $product->BARCODE }}" class="form-control" type="text" name="edit_barcode" required placeholder="Ex. 036000291452" required>
                    </div>


                    <div class="form-group">
                        <label for="">Sales Price W.T.</label>
                        <input value="{{ $product->SALES_PRICE_WT }}" class="form-control" type="text" name="edit_sales_price_wt" required placeholder="Ex. 1000">
                    </div>


                    <div class="form-group">
                        <label for="">Unit</label>
                        <select class="form-control" name="edit_unit" required>
                            <option value="{{ $product->UNIT }}" selected hidden>
                                {{ $product->UNIT }}
                            </option>
                            <option value="KG">KG</option>
                            <option value="MM">MM</option>
                            <option value="CM">CM</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Item Description</label>
                        <textarea class="form-control" type="text" name="edit_internal_description" style="resize: none;">{{ $product->INTERNAL_DESCRIPTION }}</textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" onclick="updateProduct('{{ $product->PRODUCT_CODE }}');" class="btn btn-primary" data-dismiss="modal">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    $(document).ready(function(e) {
        /*Insert Record AJAX*/
        $('#product-form-btn').on('click', (function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content'),
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
                    }
                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                }
            });
        }));
        /*Update Record AJAX*/
    });

    function updateProduct(product_code) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content'),
            }
        });
        var formData = new FormData($('#edit-product-form-' + product_code)[0]);
        $.ajax({
            type: 'POST',
            url: 'update-product/' + product_code,
            data: formData,
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
    
    /*Delete Product*/
    function deleteProduct(product_code) {
        if (confirm("Are you sure?")) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: 'delete-product/' + product_code,
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
                        //$('#divMain').load('/item');
                    });
                }
            });
        }
        return false;
    }

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