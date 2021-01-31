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

<script>
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
                    <?php
                    $sql = "SELECT * FROM MAN_PRODUCTS";

                    if ($stmt = $pdo->prepare($sql)) {
                        if ($stmt->execute()) {

                            $rows = $stmt->fetchAll();

                            foreach ($rows as $row) {
                    ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                        </div>
                                    </td>
                                    <td><?= $row["product_code"] ?></td>
                                    <td><?= $row["product_name"] ?></td>
                                    <td class="text-black-50">
                                        <?php
                                        $color = "";
                                        if ($row["product_type"] == "Product") {
                                            $color = "green";
                                        } else if ($row["product_type"] == "Raw") {
                                            $color = "orange";
                                        } else {
                                            $color = "blue";
                                        }
                                        ?>
                                        <span class="dot-<?= $color ?>"></span>
                                        <?= $row["product_type"] ?>
                                    </td>
                                    <td class="text-black-50"><?= $row["product_category"] ?></td>
                                    <td class="text-black-50 text-center"><a href='#' onclick="$('#image-view').attr('src', 'storage/<?= $row["picture"] ?>')" data-toggle="modal" data-target="#exampleImage">View</a></td>
                                    <td class="">
                                        <ul class="list-inline m-0">
                                            <li class="list-inline-item">
                                                <button data-toggle="modal" data-target="#update-product-form" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" onclick="$('#edit_product_code').val('<?= $row["product_code"] ?>'); $('#edit_product_name').val('<?= $row["product_name"] ?>'); $('#edit_bar_code').val('<?= $row["bar_code"] ?>'); $('#edit_sales_price_wt').val('<?= $row["sales_price_wt"] ?>'); $('#edit_internal_description').val('<?= $row["internal_description"] ?>'); $('#edit-product-form').attr('action', 'update-product/<?= $row["id"] ?>')"><i class="fa fa-edit"></i></button>
                                            </li>
                                            <li class="list-inline-item">
                                                <button onclick="deleteProduct(<?= $row["id"] ?>)" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></button>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                    <?php
                            }
                        }
                    }
                    ?>
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
                <form id="product-form" method="post" enctype="multipart/form-data" action="/create-product" onsubmit="return false">
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
                            <option value="Product">Product</option>
                            <option value="Raw">Raw Material</option>
                            <option value="Service">Service</option>
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
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Product Category</label>
                                <select class="form-control" name="product_category" required>
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
                        <input class="form-control" type="text" name="bar_code" required placeholder="Ex. 036000291452">
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
                        <textarea class="form-control" type="text" name="internal_description"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="product-form-btn" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Product Modal -->
<div class="modal fade" id="update-product-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-product-form" method="post" enctype="multipart/form-data" action="">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Code</label>
                                <input id="edit_product_code" class="form-control" type="text" name="product_code" placeholder="Ex. EM181204" required>
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
                                <input id="edit_product_name" class="form-control" type="text" name="product_name" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Product Type</label>
                        <select id="edit_product_type" class="form-control" name="product_type" required>
                            <option value="none" selected disabled hidden>
                                Select an Option
                            </option>
                            <option value="Product">Product</option>
                            <option value="Raw">Raw Material</option>
                            <option value="Service">Service</option>
                        </select>
                    </div>

                    <div class="row" id="edit_product_selected" style="display: none;">
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
                                <select id="edit_procurement_method" class="form-control" name="procurement_method" required>
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
                                <select class="form-control" name="product_category" required>
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
                        <img id="edit_img_tmp" src="../images/thumbnail.png" style="width:100%;">
                        <input class="form-control" type="file" name="picture" onchange="readURL2(this);" required>
                    </div>

                    <script>
                        function readURL2(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    $('#edit_img_tmp')
                                        .attr('src', e.target.result)
                                };

                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    </script>

                    <div class="form-group">
                        <label for="">Barcode</label>
                        <input id="edit_bar_code" class="form-control" type="text" name="bar_code" required placeholder="Ex. 036000291452">
                    </div>


                    <div class="form-group">
                        <label for="">Sales Price W.T.</label>
                        <input id="edit_sales_price_wt" class="form-control" type="text" name="sales_price_wt" required placeholder="Ex. 1000">
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
                        <textarea id="edit_internal_description" class="form-control" type="text" name="internal_description"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="update-product-form-btn" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(e) {
        /*Insert Record AJAX*/
        $('#product-form-btn').on('click', (function(e) {
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
                    }
                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                }
            });
        }));

        /*Update Record AJAX*/
        $('#update-product-form-btn').on('click', (function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault();
            var formData = new FormData($('#edit-product-form')[0]);
            $.ajax({
                type: 'POST',
                url: $('#edit-product-form').attr('action'),
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
        }));
        /*Delete Product*/
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