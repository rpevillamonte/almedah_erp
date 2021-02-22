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
    function deleteMaterial(id) {
        if (confirm("Are you sure?")) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: 'delete-material/' + id,
                data: null,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == "success") {
                        $(document).ready(function() {
                            sessionStorage.setItem("status", "success");
                            $('#divMain').load('/inventory');
                        });
                    } else {
                        $(document).ready(function() {
                            sessionStorage.setItem("status", "error");
                            $('#divMain').load('/inventory');
                        });
                    }

                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                    $(document).ready(function() {
                        sessionStorage.setItem("status", "error");
                        $('#divMain').load('/inventory');
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
            <h4 class="font-weight-bold text-black">Inventory List</h4>
            <div id="alert-message">
            </div>
            <div class="row pb-2">
                <div class="col-12 text-right">
                    <p><button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#create-material-form"><i class="fas fa-plus" aria-hidden="true"></i> Add New</button></p>
                </div>
            </div>


            <table id="inventoryTable" class="table table-striped table-bordered hover" style="width:100%">
                <thead>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td>
                        <td>Item Code</td>
                        <td>Item Name</td>
                        <td>Unit Price (PHP)</td>
                        <td>Total Amount</td>
                        <td>RM Status</td>
                        <td>View</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM env_raw_materials";

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
                                    <td><?= $row["item_code"] ?></td>
                                    <td><?= $row["item_name"] ?></td>

                                    <td class="text-black-50"><?= $row["unit_price"] ?></td>
                                    <td class="text-black-50"><?= $row["total_amount"] ?></td>
                                    <td class="text-black-50"><?= $row["rm_status"] ?></td>
                                    <td class="text-black-50 text-center"><a href='#' onclick="$('#image-view').attr('src', 'storage/<?= $row["item_image"] ?>')" data-toggle="modal" data-target="#exampleImage">View</a></td>
                                    <td class="">
                                        <ul class="list-inline m-0">
                                            <li class="list-inline-item">
                                                <button data-toggle="modal" data-target="#update-product-form" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></button>
                                            </li>
                                            <li class="list-inline-item">
                                                <button onclick="deleteMaterial(<?= $row["id"] ?>)" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></button>
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
                    $('#inventoryTable').dataTable({
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

<!-- Add Material Modal -->
<div class="modal fade" id="create-material-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="material-form" method="post" enctype="multipart/form-data" action="/create-material" onsubmit="return false">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Material Code</label>
                                <input class="form-control" type="text" name="material_code" placeholder="Ex. MT181204" required>
                                @error('product_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Material Name</label>
                                <input class="form-control" type="text" name="material_name" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Material Categories</label>
                                <select class="form-control" name="material_category" required>
                                    <option value="none" selected disabled hidden>
                                        Select an Option
                                    </option>
                                    <?php
                                    $sql = "SELECT * FROM env_materials_categories";

                                    if ($stmt = $pdo->prepare($sql)) {
                                        if ($stmt->execute()) {

                                            $rows = $stmt->fetchAll();

                                            foreach ($rows as $row) {
                                    ?>
                                                <option value="<?= $row['category_id'] ?>" name="category"><?= $row['category_title'] ?></option>
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
                        <input class="form-control" type="file" name="material_image" onchange="readURL1(this);" required>
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
                        <label for="">Unit Price</label>
                        <input class="form-control" type="text" name="unit_price" required placeholder="Ex. 100">
                    </div>


                    <div class="form-group">
                        <label for="">Total Amount</label>
                        <input class="form-control" type="text" name="total_amount" required placeholder="Ex. 500">
                    </div>


                    <div class="form-group">
                        <label for="">RM Status</label>
                        <select class="form-control" name="rm_status" required>
                            <option value="none" selected disabled hidden>
                                Select an Option
                            </option>
                            <option value="To Purchase">To Purchase</option>
                            <option value="Available">Available</option>
                            <option value="Not Available">Not Available</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Material Description</label>
                        <textarea class="form-control" type="text" name="material_description"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="material-form-btn" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(e) {
        /*Insert Record AJAX*/
        $('#material-form-btn').on('click', (function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData($('#material-form')[0]);
            $.ajax({
                type: 'POST',
                url: $('#material-form').attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    //console.log("success");
                    if (data.status == "success") {
                        $(document).ready(function() {
                            sessionStorage.setItem("status", "success");
                            $('#divMain').load('/inventory');
                        });
                    }
                },
                error: function(data) {
                    console.log("error");
                    console.log(data);
                }
            });
        }));

        /*Update Record AJAX
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
        }));*/
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