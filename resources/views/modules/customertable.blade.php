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

<table id="customerTable" class="table table-striped table-bordered hover" style="width:100%">
    <thead>
        <tr>
            <td>Customer ID</td>
            <td>Last Name</td>
            <td>First Name</td>
            <td>Branch</td>
            <td>Contact Number</td>
            <td>Address</td>
            <td>Email</td>
            <td>Company Name</td>
            <td>Image</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM man_customers";
        if ($stmt = $pdo->prepare($sql)) {
            if ($stmt->execute()) {
                $rows = $stmt->fetchAll();
                foreach ($rows as $row) {
        ?>
                <tr>
                    <td class="text-black-50"><?=$row["id"]?></td>
                    <td class="text-black-50"><?=$row["customer_fname"]?></td>
                    <td class="text-black-50"><?=$row["customer_lname"]?></td>
                    <td class="text-black-50"><?=$row["branch_name"]?></td>
                    <td class="text-black-50"><?=$row["contact_number"]?></td>
                    <td class="text-black-50"><?=$row["address"]?></td>
                    <td class="text-black-50"><?=$row["email_address"]?></td>
                    <td><?=$row["company_name"]?></td>
                    <td><img src="<?=$row['profile_picture']?>" class="modal-image" height="30" onError="this.onerror=null;this.src='images/defaultuser.png';"></td>
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
        $('#customerTable').dataTable({
            columnDefs: [{
                orderable: false,
                targets: 0
            }],
            order: [
                [1, 'asc']
            ]
        });
    });
    $(".modal-image").on("click", function () {
        $("#customer-image-modal").modal("show");
        $("#customer-image-view").attr('src', this.src);
    });
</script>
