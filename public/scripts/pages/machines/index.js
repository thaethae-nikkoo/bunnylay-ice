$(document).ready(function () {
    const modal = new bootstrap.Modal(document.getElementById("machine_modal"));
    const form = $("#machine_form");
    $("#create_machine_btn").on("click", function () {
        let createUrl = vars("create_url");
        $("#modal_title").text("Create Machine");
        form[0].reset();
        $("#form_method").val("POST");
        form.attr("action", createUrl);
        $(".invalid-feedback").text("");
        $(".form-control, .form-select").removeClass("is-invalid");
        $("#photo_preview").hide();
        $("#remove_photo").val("0");
        modal.show();
    });

    $(document).on("click", ".edit-machine-btn", function () {
        const id = $(this).data("id");
        let editUrl = vars("edit_url").replace("__machine_id__", id);
        const updateUrl = vars("update_url").replace("__machine_id__", id);

        $.get(editUrl, function (data) {
            $("#modal_title").text("Edit Machine");
            $("#form_method").val("PATCH");
            form.attr("action", updateUrl);

            $("#machine_name").val(data.machine_name);
            $("#code").val(data.code);
            $("#product_type").val(data.product_type);
            $("#capacity_mode").val(data.capacity_mode);
            $("#capacity_value").val(data.capacity_value);
            $("#location").val(data.location);
            $("#remark").val(data.remark);

            $("#remove_photo").val("0");
            if (data.photo_path) {
                let photoUrl = vars("asset");
                if (!photoUrl.endsWith("/")) photoUrl += "/";
                photoUrl += "storage/" + data.photo_path;

                $("#photo_preview img").attr("src", photoUrl);
                $("#photo_preview").show();
            } else {
                $("#photo_preview img").attr("src", "");
                $("#photo_preview").hide();
            }

            $(".invalid-feedback").text("");
            $(".form-control, .form-select").removeClass("is-invalid");
            modal.show();
        });
    });

    // Photo preview for file input
    $("#photo").on("change", function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $("#photo_preview img").attr("src", e.target.result);
                $("#photo_preview").show();
                $("#remove_photo").val("0");
            };
            reader.readAsDataURL(file);
        }
    });

    // Remove photo logic
    $("#remove_photo_btn").on("click", function () {
        $("#photo").val(""); // Clear file input
        $("#photo_preview img").attr("src", "");
        $("#photo_preview").hide();
        $("#remove_photo").val("1"); // Mark as removed
    });
});
