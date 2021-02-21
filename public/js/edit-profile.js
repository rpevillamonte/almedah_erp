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

$("#update-profile-form").on("submit", function (e) {
    console.log("clicked");
    e.preventDefault;
    var id = $("#id").val();
    $.ajax({
        type: "PUT",
        url: "/update-employee/" + id,
        data: $("#update-profile-form").serialize(),
        success: function (response) {
            $("#profile-load").html(
                `
                <h3 class="media-heading text-dark mb-2">` +
                    response["last_name"] +
                    " " +
                    response["first_name"] +
                    `</h3>
                <p class="my-1"><span class="font-weight-bold">User ID: </span>` +
                    response["id"] +
                    `</p>
                <p class="my-1"><span class="font-weight-bold">Position: </span>` +
                    response["position"] +
                    ` </p>
                <p class="my-1"><span class="font-weight-bold">Email Address: </span>` +
                    response["email"] +
                    ` </p>
                <p class="my-1"><span class="font-weight-bold">Contact Number: </span>` +
                    response["contact_number"] +
                    ` </p>
                <p class="mt-1"><span class="font-weight-bold">Joined Almedah: </span>` +
                    response["created_at"] +
                    `</p>
                `
            );
            successNotification("Profile successfully updated!");
            $("#update-employee-modal").modal("toggle");
            $("#update-profile-form")[0].reset();
            window.stop();
        },
        error: () => dangerNotification("There was an error upon updating!"),
    });
});

$("#update-employee-image-form").on("submit", function (e) {
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
            successNotification("Profile successfully updated!");
            $("#update-employee-image-modal").modal("toggle");
            $("#update-employee-image-form")[0].reset();
            window.location.reload();
        },
        error: () => dangerNotification("There was an error upon updating!"),
    });
});
