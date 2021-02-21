$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function () {
    $(".employee-modal-image").on("click", function () {
        $("#employee-image-modal").modal("toggle");
        $("#employee-image-view").attr("src", this.src);
    });
    loadFunctions();
});

function loadFunctions() {
    employeeUpdateModal();
    employeeUpdate();
    toggleActiveStatus();
    employeeCreate();
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
    employeeUpdateModal();
    toggleActiveStatus();
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
        if (statValue == 0) {
            $("#" + data[0]).attr("checked", true);
            statValue = 1;
        } else {
            $("#" + data[0]).attr("checked", true);
            statValue = 0;
        }
        $.ajax({
            url: "/update-employee-status/" + data[0] + "/" + statValue,
            type: "PUT",
            data: { statValue: statValue, id: data[0] },
            success: function (response) {
                successNotification("Account has been Activated!");
                $("#" + data[0]).attr("checked", false);
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
        let data = $tr
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
        $("#active_status_up").val(data[8]);
        const status = data[8];
        console.log(status);
        if (status == 1) {
            $(".employeeStatus").html(
                '<div class="form-check form-switch"><input class="form-check-input" id="active_status_up" name="active_status" type="checkbox" value="0"><label for="active_status_up" class="pl-3">Deactivate Account</label></div>'
            );
        }
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
            success: function (r) {
                console.log(r);
                const dataTable = $("#employeeTable").DataTable();
                dataTable
                    .row($("#" + id))
                    .remove()
                    .draw();
                dataTable.row
                    .add([
                        "<span class='text-black-50'>" + r["id"] + "</span>",
                        "<span class='text-black-50'>" +
                            r["last_name"] +
                            "</span>",
                        "<span class='text-black-50'>" +
                            r["first_name"] +
                            "</span>",
                        "<span class='text-black-50'>" +
                            r["position"] +
                            "</span>",
                        "<span class='text-black-50'>" +
                            r["gender"] +
                            "</span>",
                        "<img src='storage/" +
                            r["profile_picture"] +
                            "' class='modal-image' height='30' style='border-radius: 50%;' onError=this.onerror=null;this.src='images/defaultuser.png'>",
                        "<span class='text-black-50'>" +
                            r["contact_number"] +
                            "</span>",
                        "<span class='text-black-50'>" + r["email"] + "</span>",
                        r["active_status"] == "1"
                            ? `<div class="custom-control custom-switch"><input class="custom-control-input" type="checkbox" id="` +
                              r["id"] +
                              `" value="` +
                              r["active_status"] +
                              `"checked disabled><label class="custom-control-label" for="` +
                              r["id"] +
                              `"></label></div>`
                            : `<div class="custom-control custom-switch"><input class="custom-control-input toggle" type="checkbox" id="` +
                              r["id"] +
                              `" value="` +
                              r["active_status"] +
                              `"><label class="custom-control-label" for="` +
                              r["id"] +
                              `"></label></div>`,
                        '<a href="#" class="btn btn-success btn-sm rounded-0 editBtn" type="button"><i class="fa fa-edit"></i></a>',
                    ])
                    .node().id = id;
                dataTable.draw();
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
    $("#create-employee-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/create-employee",
            data: $("#create-employee-form").serialize(),
            success: function (r) {
                var id = r["id"];
                const dataTable = $("#employeeTable").DataTable();
                dataTable.row
                    .add([
                        "<span class='text-black-50'>" + r["id"] + "</span>",
                        "<span class='text-black-50'>" +
                            r["last_name"] +
                            "</span>",
                        "<span class='text-black-50'>" +
                            r["first_name"] +
                            "</span>",
                        "<span class='text-black-50'>" +
                            r["position"] +
                            "</span>",
                        "<span class='text-black-50'>" +
                            r["gender"] +
                            "</span>",
                        "<img src='storage/" +
                            r["profile_picture"] +
                            "' class='modal-image' height='30' style='border-radius: 50%;' onError=this.onerror=null;this.src='images/defaultuser.png'>",
                        "<span class='text-black-50'>" +
                            r["contact_number"] +
                            "</span>",
                        "<span class='text-black-50'>" + r["email"] + "</span>",
                        r["active_status"]
                            ? '<div class="custom-control custom-switch"><input class="custom-control-input" type="checkbox" id="r["id"]" value="r["active_status"]" checked disabled><label class="custom-control-label" for="r["id"]"></label></div>'
                            : '<div class="custom-control custom-switch"><input class="custom-control-input toggle" type="checkbox" id="r["id"]" value="r["active_status"]"><label class="custom-control-label" for="r["id"]"></label></div>',
                        '<a href="#" class="btn btn-success btn-sm rounded-0 editBtn" type="button"><i class="fa fa-edit"></i></a>',
                    ])
                    .node().id = id;
                dataTable.draw();
                successNotification("Employee SuccessFully Added!");
                $("#create-employee-modal").modal("toggle");
                $("#create-employee-form")[0].reset();
            },
            error: function () {
                dangerNotification(
                    "There was an error upon creating an employee!"
                );
            },
        });
    });
}
