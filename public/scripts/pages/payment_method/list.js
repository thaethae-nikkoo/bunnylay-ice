$(document).ready(function () {
    const inputModal = $("#payment_method_modal");
    let editUrl;
    let createUrl = vars("create_url");
    let isEdit = inputModal.data("editmode");
    let asset = vars("asset");
    $(".indicator-progress").hide();
    $(".indicator-label").show();

    function updateModalContent() {
        $(".errormsg").remove();
        $("#method_name").val("");
        $("input").removeClass("is-invalid");
        var inputModalBtn = $(".save-btn");
        if (inputModal.data("editmode") == true) {
            $(".modal-title").text("ငွေပေးချေရန်နည်းလမ်း ပြင်ဆင်ရန်");
            inputModalBtn.addClass("btn-edit");
            isEdit = true;
        } else {
            $(".modal-title").text("ငွေပေးချေရန်နည်းလမ်း ထည့်သွင်းရန်");
            inputModalBtn.addClass("btn-create");
            isEdit = false;
        }
    }

    $(document).on("click", "#create-btn", function () {
        inputModal.data("editmode", false);
        updateModalContent();
        inputModal.modal("show");
    });

    $(document).on("click", ".save-btn", function (e) {
        e.preventDefault(); // Prevent default form submission
        let type = isEdit ? "PATCH" : "POST";
        let url = isEdit ? editUrl : createUrl;
        $(".indicator-label").hide();
        $(".indicator-progress").show();
        $(".save-btn").attr("disabled", true);
        createOrUpdateData(url, type);
    });

    $(document).on("click", ".edit-btn", function () {
        inputModal.data("editmode", true);
        updateModalContent();
        let button = $(this);

        // Fetch the latest data from the button's data attributes
        let oldMethodName = button.data("method_name");
        let oldAccountType = button.data("account_type");
        let oldAccountName = button.data("account_name");
        let oldAccountNo = button.data("account_no");
        editUrl = button.data("url");
        $("#method_name").val(oldMethodName);
        $("#account_type").val(oldAccountType).trigger("change");
        $("#account_name").val(oldAccountName);
        $("#account_no").val(oldAccountNo);

        inputModal.modal("show");
    });

    function updateRow(data) {
        const row = $(
            `.payment_method-table tr[data-id='${data.payment_method_id}']`,
        );
        row.find(".method_name").text(data.method_name);
        row.find(".account_type").text(data.account_type);
        row.find(".logo img").attr(
            "src",
            data.logo_path ? asset + data.logo_path : "",
        );
        row.find(".account_name").text(data.account_name);
        row.find(".account_no").text(data.account_no);
        row.find(".circle").attr("fill", data.status_color);

        // Update edit button attributes
        const editButton = row.find(".edit-btn");
        editButton.data("method_name", data.method_name);
        editButton.data("account_type", data.account_type);
        editButton.data("account_name", data.account_name);
        editButton.data("account_no", data.account_no);
        editButton.data("status", data.status);
        editButton.data(
            "url",
            vars("edit_url").replace(
                "__payment_method_id__",
                data.payment_method_id,
            ),
        );
    }

    function createOrUpdateData(url, type) {
        var method_name = $("#method_name").val();
        var account_type = $("#account_type").val();
        var account_name = $("#account_name").val();
        var account_no = $("#account_no").val();
        $(".errormsg").remove();
        $("input").removeClass("is-invalid");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                "Content-Type": "application/json",
            },
            url: url,
            type: type,
            data: JSON.stringify({
                method_name: method_name,
                account_type: account_type,
                account_name: account_name,
                account_no: account_no,
            }),
            success: function (data) {
                if (type === "PATCH") {
                    updateRow(data.data);
                } else {
                    // Prepare the new category row to prepend to the table
                    if (data.data) {
                        editUrl = vars("edit_url").replace(
                            "__payment_method_id__",
                            data.data.payment_method_id,
                        );
                        changeStatusUrl = vars("change_status_url").replace(
                            "__payment_method_id__",
                            data.data.payment_method_id,
                        );
                        deleteUrl = vars("delete_url").replace(
                            "__payment_method_id__",
                            data.data.payment_method_id,
                        );
                        var newRow = $("#cloneTarget").clone();
                        newRow.removeAttr("hidden");
                        newRow.attr("data-id", data.data.payment_method_id);
                        newRow
                            .find(".payment_method-id")
                            .text(data.data.payment_method_id);
                        newRow.find(".method_name").text(data.data.method_name);
                        newRow
                            .find(".account_type")
                            .text(data.data.account_type);
                        newRow
                            .find(".logo img")
                            .attr(
                                "src",
                                data.data.logo_path
                                    ? asset + data.data.logo_path
                                    : "",
                            );
                        newRow
                            .find(".account_name")
                            .text(data.data.account_name);
                        newRow.find(".account_no").text(data.data.account_no);
                        newRow
                            .find(".circle")
                            .attr("fill", data.data.status_color);
                        newRow.find(".edit-btn").attr({
                            "data-method_name": data.data.method_name,
                            "data-id": data.data.payment_method_id,
                            "data-account_type": data.data.account_type,
                            "data-account_name": data.data.account_name,
                            "data-account_no": data.data.account_no,
                            "data-status": data.data.status,
                            "data-url": editUrl,
                        });
                        newRow.find(".show-delete-modal").attr({
                            "data-id": data.data.payment_method_id,
                            "data-url": deleteUrl,
                        });
                        newRow.find(".show-status-modal").attr({
                            "data-id": data.data.payment_method_id,
                            "data-url": changeStatusUrl,
                        });
                        $(".table tbody").prepend(newRow);
                        // Re-index all rows
                        $(".table tbody tr:visible").each(function (index) {
                            $(this)
                                .find("td:eq(0)")
                                .text(index + 1);
                        });
                    }
                }

                // Close modal and reset form
                inputModal.modal("hide");
                $(".save-btn").prop("disabled", false);
                $(".indicator-progress").hide();
                $(".indicator-label").show();
                $(".no-data").addClass("hidden");

                var successAlert =
                    '<div id="successAlert" class="alert alert-success alert-dismissible" role="alert">' +
                    '<i class="bx bx-check-circle"></i>' +
                    "<span>" +
                    data.message +
                    "</span>" +
                    "</div>";

                $("#alert-container").html(successAlert);
                setTimeout(function () {
                    $("#successAlert")
                        .fadeTo(500, 0)
                        .slideUp(250, function () {
                            $(this).remove();
                        });
                }, 3000);
            },
            error: function (data) {
                $(".save-btn").prop("disabled", false);
                $(".indicator-progress").hide();
                $(".indicator-label").show();
                if (data.responseJSON.errors) {
                    Object.keys(data.responseJSON.errors).forEach((element) => {
                        $("#" + element)
                            .next(".errormsg")
                            .remove();
                        $("#" + element).addClass("is-invalid");
                        $(
                            '<label class="errormsg">' +
                                data.responseJSON.errors[element] +
                                "</label>",
                        ).insertAfter("#" + element);
                    });
                }
            },
        });
    }

    inputModal.on("hidden.bs.modal", function () {
        $("#method_name").val("");
        $("#account_type").val("").trigger("change");
        $("#account_name").val("");
        $("#account_no").val("");
        $(".errormsg").remove();
        $("input").removeClass("is-invalid");
    });
});
