$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function dangerNotification(text) {
    $("#employee-danger").show();
    $("#employee-danger").html(text);
    $("#employee-danger").delay(4000).hide(1);
}

function successNotification(text) {
    $("#employee-success").show();
    $("#employee-success").html(text);
    $("#employee-success").delay(4000).hide(1);
}

function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#img_tmp").attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#update-employee-form-btn").on("click", function (e) {
    e.preventDefault;
    var id = $("#id").val();
    $.ajax({
        type: "PUT",
        url: "/update-employee/" + id,
        data: $("#update-employee-form").serialize(),
        success: function (response) {
            successNotification(response);
            $("#update-employee-modal").modal("hide");
            $("#update-employee-form")[0].reset();
        },
        error: () => dangerNotification("There was an error upon updating!"),
    });
});

$("#update-employee-image-form-btn").on("click", function (e) {
    e.preventDefault();
    var id = $("#id").val();
    var formData = new FormData($("#update-employee-image-form")[0]);
    $.ajax({
        type: "POST",
        url: "/update-employee-image/" + id,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            successNotification(response);
            $("#update-employee-image-modal").modal("hide");
            $("#update-employee-image-form")[0].reset();
        },
        error: () => dangerNotification("There was an error upon updating!"),
    });
});

$(".profile_picture").on("click", function () {
    console.log("hotdog");
});
