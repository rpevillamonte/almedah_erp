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

<div class="px-3 mt-3 rounded">
    <div class="row d-flex justify-content-center">
        <div class="col-sm p-4 bg-light">
            <h4 class="font-weight-bold text-black">Employee List</h4>

            <div class="alert alert-success alert-dismissible" id="employee-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            </div>
            <div class="alert alert-danger alert-dismissible" id="employee-danger" style="display:none;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            </div>

            <div class="row pb-2">
                <div class="col-12 text-right">
                    <p><button type="button" class="btn btn-outline-primary btn-sm" onclick='$("#create-employee-modal").modal("toggle");'><i class="fas fa-plus" aria-hidden="true"></i> Add New</button></p>
                </div>
            </div>
            <div class="employeedata">
                <table id="employeeTable" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <td>Employee ID</td>
                            <td>Last Name</td>
                            <td>First Name</td>
                            <td>Position</td>
                            <td>Gender</td>
                            <td>Image</td>
                            <td>Contact Number</td>
                            <td>Email</td>
                            <td class="d-none"></td>
                            <td>Active Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM env_employees";
                        if ($stmt = $pdo->prepare($sql)) {
                            if ($stmt->execute()) {
                                $rows = $stmt->fetchAll();
                                foreach ($rows as $row) {
                        ?>
                                <tr id="<?=$row["id"]?>">
                                    <td class="text-black-50"><?=$row["id"]?></td>
                                    <td class="text-black-50"><?=$row["last_name"]?></td>
                                    <td class="text-black-50"><?=$row["first_name"]?></td>
                                    <td class="text-black-50"><?=$row["position"]?></td>
                                    <td class="text-black-50"><?=$row["gender"]?></td>
                                    <td><img src="storage/<?=$row['profile_picture']?>" class="employee-modal-image" height="30" style="border-radius: 50%;" onError="this.onerror=null;this.src='images/defaultuser.png';"></td>
                                    <td class="text-black-50"><?=$row["contact_number"]?></td>
                                    <td class="text-black-50"><?=$row["email"]?></td>
                                    <td class="d-none"><?=$row["active_status"]?></td>
                                    <?php
                                        if($row['active_status']){
                                    ?>
                                    <td><div class="custom-control custom-switch">
                                        <input class="custom-control-input" type="checkbox" id="<?=$row['id']?>" value="<?=$row['active_status']?>" checked disabled>
                                        <label class="custom-control-label" for="<?=$row['id']?>"></label>
                                    </div></td>
                                    <?php
                                        }
                                    ?>

                                    <?php
                                        if(!$row['active_status']){
                                    ?>
                                    <td><div class="custom-control custom-switch">
                                        <input class="custom-control-input toggle" type="checkbox" id="<?=$row['email']?>" value="<?=$row['active_status']?>">
                                        <label class="custom-control-label" for="<?=$row['email']?>"></label>
                                    </div></td>
                                    <?php
                                        }
                                    ?>

                                    <td>
                                        <a href="#" class="btn btn-success btn-sm rounded-0 editBtn" type="button"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                        <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- IMAGE PART MODAL -->
<div class="modal fade" id="employee-image-modal" tabindex="-1" role="dialog" aria-labelledby="exampleImageLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body m-0 p-0">
                <img id="employee-image-view" style="width:100%;">
            </div>
        </div>
    </div>
</div>

<!-- Update Employee Modal -->
<div class="modal fade" id="update-employee-modal" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Update Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='$("#update-employee-modal").modal("hide");'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update-employee-form">
                    @csrf
                    @method('PUT')
                    <input hidden id="id">
                    <div class="mb-3">
                        <label for="last_name_up" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name='last_name' id="last_name_up" placeholder="Last Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="first_name_up" class="form-label">First Name</label>
                        <input type="text" class="form-control" name='first_name' id="first_name_up" placeholder="First Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="position_up" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position_up" name='position' required>
                    </div>
                    <div class="mb-3">
                        <label for="gender_up" class="form-label">Gender</label>
                            <select name="gender" id="gender_up" class="form-control">  
                                <option value="Male">Male</option>  
                                <option value="Female">Female</option>  
                            </select> 
                    </div>
                    <div class="mb-3">
                        <label for="contact_number_up" class="form-label">Contact number</label>
                        <input type="tel" class="form-control" minlength="11" maxlength="15" id="contact_number_up" name='contact_number' placeholder="#### - ### - ####" required>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name='email' placeholder="example@gmail.com" required>
                    </div> --}}
                    <div class="mb-3 employeeStatus">
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="update-employee-form-btn" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Add employee Modal --}}
<div class="modal fade" id="create-employee-modal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="create-employee-form" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name='last_name' id="last_name" placeholder="Last Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" name='first_name' id="first_name" placeholder="First Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name='position' required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select name="gender" id="gender" class="form-control">  
                            <option value="Male">Male</option>  
                            <option value="Female">Female</option>  
                        </select> 
                    </div>
                    <input type="hidden" name='profile_picture' id="profile_picture" value="images/defaultuser.png">  
                    <div class="mb-3">
                        <label for="contact_number" class="form-label">Contact number</label>
                        <input type="tel" class="form-control" minlength="11" maxlength="15" id="contact_number" name='contact_number' placeholder="#### - ### - ####" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name='email' placeholder="example@gmail.com" required>
                    </div>
                    <input type="hidden" name='active_status' id="active_status" value="1">   
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="create-employee-form-btn" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $("#employeeTable").dataTable({
        columnDefs: [
            {
                orderable: false,
                targets: 0,
                "defaultContent": "",
                 "targets": "_all"
            },
        ],
        columns: [
            { visible: true }, //col 1
            { visible: true }, //col 2
            { visible: true }, //col 3
            { visible: true }, //col 4
            { visible: true }, //col 5
            { visible: true }, //col 6
            { visible: true }, //col 7
            { visible: true }, //col 8
            null, //col 9
            { visible: true }, //col 10
            { visible: true }, //col 11
        ],
    });
    var url = "js/env-employee.js";
    $.getScript(url);
</script>
<script>
    $(".toggle").on("click", function (e) {
        console.log("what");
        $tr = $(this).closest("tr");
        var data = $tr
            .children("td")
            .map(function () {
                return $(this).text();
            })
            .get();
        let statValue = $("#" + data[0]).val();
        $("#" + data[0]).attr("checked", true);
        $("#" + data[0]).prop("disabled", true);
        if (statValue == 0) statValue = 1;
        $.ajax({
            url: "/update-employee-status/" + data[0] + "/" + statValue,
            type: "PUT",
            data: { statValue: statValue, id: data[0] },
            success: function (response) {
                successNotification("Account has been Activated!");
            },
            error: function (req, err) {
                dangerNotification("Error!");
            },
        });
    });
</script>
