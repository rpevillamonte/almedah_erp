$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function () {
    $(".modal-image").on("click", function () {
        $("#employee-image-modal").modal("show");
        $("#employee-image-view").attr("src", this.src);
    });
    loadFunctions();
    employeeCreate();
});

function loadFunctions() {
    employeeUpdateModal();
    employeeUpdate();
    toggleActiveStatus();
}

function dangerNotification(text) {
    $("#employee-danger").show();
    $("#employee-danger").html(text);
    $("#employee-danger").delay(4000).hide(1);
}

function successNotification(text) {
    $("#employee-success").show();
    $("#employee-success").html(text);
    $("#employee-success").delay(4000).hide(1);
    loadFunctions();
}

// toggle active status of an employee
function toggleActiveStatus() {
    $(".toggle").on("click", function (e) {
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
}

// Fetches data and places it into update-employee-modal form
function employeeUpdateModal() {
    $(".editBtn").on("click", function (e) {
        $("#update-employee-modal").modal("show");
        $tr = $(this).closest("tr");
        var data = $tr
            .children("td")
            .map(function () {
                return $(this).text();
            })
            .get();
        $("#id").val(data[0]);
        $("#last_name_up").val(data[1]);
        $("#first_name_up").val(data[2]);
        $("#position_up").val(data[3]);
        $("#gender_up").val(data[4]);
        $("#contact_number_up").val(data[6]);
        // $("#active_status_up").val(data[8]);
        // const status = $("#active_status").val();
        // console.log(status);
        // if (status == 1) {
        //     $(".employeeStatus").html(
        //         '<div class="form-check form-switch"><input class="form-check-input toggle" id="active_status_up" name="active_status" type="checkbox" value="0"><label for="active_status_up" class="pl-3">Deactivate Account</label></div>'
        //     );
        // }
    });
}

//Update Employee Upon Submitting Modal Form
function employeeUpdate() {
    $("#update-employee-form").on("submit", function (e) {
        e.preventDefault();
        var id = $("#id").val();
        $.ajax({
            type: "PUT",
            url: "/update-employee/" + id,
            data: $("#update-employee-form").serialize(),
            success: function (response) {
                successNotification("Employee SuccessFully Updated!");
                $("#update-employee-modal").modal("hide");
                $("#update-employee-form")[0].reset();
            },
            error: () =>
                dangerNotification("There was an error upon updating!"),
        });
    });
}

function employeeCreate() {
    $("#create-employee-form-btn").on("click", function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/create-employee",
            data: $("#create-employee-form").serialize(),
            success: function (r) {
                const dataTable = $("#employeeTable").DataTable();
                dataTable.row
                    .add([
                        r["id"],
                        r["last_name"],
                        r["first_name"],
                        r["position"],
                        r["gender"],
                        r["profile_picture"],
                        r["contact_number"],
                        r["email"],
                        r["active_status"]
                            ? '<div class="custom-control custom-switch"><input class="custom-control-input" type="checkbox" id="r["id"]" value="r["active_status"]" checked disabled><label class="custom-control-label" for="r["id"]"></label></div>'
                            : '<div class="custom-control custom-switch"><input class="custom-control-input toggle" type="checkbox" id="r["id"]" value="r["active_status"]"><label class="custom-control-label" for="r["id"]"></label></div>',
                        "blank",
                        '<a href="#" class="btn btn-success btn-sm rounded-0 editBtn" type="button"><i class="fa fa-edit"></i></a>',
                    ])
                    .draw(false);
                successNotification("Employee SuccessFully Added!");
                $("#create-employee-form")[0].reset();
            },
            error: function () {
                dangerNotification(
                    "An existing account with the same Email exists!"
                );
            },
        });
    });
}
