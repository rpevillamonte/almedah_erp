$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function (e) {
    loadAll();
});

function loadAll() {
    $(".customerdata").load("/customertable", function () {
        customerUpdateModal();
        customerUpdate();
        customerCreate();
    });
}
function dangerNotification(text) {
    $("#customer-danger").show();
    $("#customer-danger").html(text);
    $("#customer-danger").delay(4000).hide(1);
}

function successNotification(text) {
    $("#customer-success").show();
    $("#customer-success").html(text);
    $("#customer-success").delay(4000).hide(1);
    loadAll();
}

// Fetches data and places it into update-customer-modal form
function customerUpdateModal() {
    $(".editBtn").on("click", function (e) {
        $("#update-customer-modal").modal("show");

        $tr = $(this).closest("tr");
        var data = $tr
            .children("td")
            .map(function () {
                return $(this).text();
            })
            .get();

        $("#id").val(data[0]);
        $("#customer_lname_up").val(data[1]);
        $("#customer_fname_up").val(data[2]);
        $("#branch_name_up").val(data[3]);
        $("#contact_number_up").val(data[4]);
        $("#address_up").val(data[5]);
        $("#company_name_up").val(data[7]);
    });
}

//Update customer Upon Submitting Modal Form
function customerUpdate() {
    $("#update-customer-form").on("submit", function (e) {
        e.preventDefault();
        var id = $("#id").val();
        $.ajax({
            type: "PUT",
            url: "/update-customer/" + id,
            data: $("#update-customer-form").serialize(),
            success: function (response) {
                successNotification("Customer SuccessFully Updated!");
                $("#update-customer-modal").modal("hide");
                $("#update-customer-form")[0].reset();
            },
            error: () =>
                dangerNotification("There was an error upon updating!"),
        });
    });
}

function customerCreate() {
    $("#create-customer-form-btn").on("click", function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/create-customer",
            data: $("#create-customer-form").serialize(),
            success: function (response) {
                successNotification("Customer SuccessFully Added!");
                $("#create-customer-form")[0].reset();
            },
            error: function () {
                dangerNotification(
                    "An existing account with the same Email exists!"
                );
            },
        });
    });
}
