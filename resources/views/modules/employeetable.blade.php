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
            <td>Active Status</td>
            <td class="d-none"></td>
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
                <tr>
                    <td class="text-black-50"><?=$row["id"]?></td>
                    <td class="text-black-50"><?=$row["last_name"]?></td>
                    <td class="text-black-50"><?=$row["first_name"]?></td>
                    <td class="text-black-50"><?=$row["position"]?></td>
                    <td class="text-black-50"><?=$row["gender"]?></td>
                    {{-- <td class="text-black-50 text-center"><a href='#' onclick="$('#image-view').attr('src', 'storage/<?=$row['profile_picture']?>')" data-toggle="modal" data-target="#exampleImage"></a></td> --}}
                    <td><img src="<?=$row['profile_picture']?>" class="modal-image" height="30" style="border-radius: 50%;" onError="this.onerror=null;this.src='images/defaultuser.png';"></td>
                    <td class="text-black-50"><?=$row["contact_number"]?></td>
                    <td class="text-black-50"><?=$row["email"]?></td>
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
                        <input class="custom-control-input toggle" type="checkbox" id="<?=$row['id']?>" value="<?=$row['active_status']?>">
                        <label class="custom-control-label" for="<?=$row['id']?>"></label>
                    </div></td>
                    <?php
                        }
                    ?>
                    <td class="d-none"><?=$row["active_status"]?></td>
                    <td class="">
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

<script>
    $(document).ready(function() {
        $('#employeeTable').dataTable({
            columnDefs: [{
                orderable: false,
                targets: 0
            }],
            order: [
                [1, 'asc']
            ]
        });
        $(".modal-image").on("click", function () {
        $("#employee-image-modal").modal("show");
        $("#employee-image-view").attr('src', this.src);
        });
    });
</script>
