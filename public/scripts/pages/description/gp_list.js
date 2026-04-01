$(document).ready(function () {
    const inputModal = $("#description_gp_modal");

    /**
     * 1. INITIALIZE DATATABLE
     * 'ordering: false' is crucial to keep our manual prepend order.
     */
    let table = $('#gp-datatable').DataTable({
        "ordering": false,
        "pageLength": 25,
        "retrieve": true
    });

    let editUrl, createUrl = vars("create_url"), isEdit = false, currentRow;

    function showAlert(type, message) {
        const icon = type === 'success' ? 'bx-check-circle' : 'bx-error-circle';
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                <i class='bx ${icon} me-2'></i>
                <span>${message}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        $('#alert-container').html(alertHtml);
        setTimeout(() => { $('.alert').alert('close'); }, 5000);
    }

    $(document).on("click", "#create-btn", function () {
        isEdit = false;
        $(".modal-title").text("Add Description Group");
        resetForm();
        inputModal.modal("show");
    });

    $(document).on("click", ".edit-btn", function () {
        isEdit = true;
        $(".modal-title").text("Edit Description Group");
        resetForm();
        let button = $(this);
        currentRow = button.closest('tr'); // Capture the reference to the row
        editUrl = button.attr("data-url");
        $("#gp_name").val(button.attr("data-gp_name"));
        let type = button.attr("data-description_type");
        $(".description_type[value='" + type + "']").prop("checked", true);
        inputModal.modal("show");
    });

    function resetForm() {
        $(".errormsg").remove();
        $("#gp_name").val("").removeClass("is-invalid");
        $("input[name='description_type']").prop("checked", false);
    }

    $(document).on("click", ".save-btn", function (e) {
        e.preventDefault();
        const btn = $(this);
        btn.attr("disabled", true);

        let url = isEdit ? editUrl : createUrl;
        let type = isEdit ? "PATCH" : "POST";
        let formData = {
            gp_name: $("#gp_name").val(),
            description_type: $("input[name='description_type']:checked").val()
        };

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                "Content-Type": "application/json"
            },
            url: url, type: type, data: JSON.stringify(formData),
            success: function (res) {
                if (isEdit) {
                    updateExistingRow(res.data);
                    showAlert('success', 'Updated successfully.');
                } else {
                    addNewRow(res.data);
                    showAlert('success', 'Inserted successfully.');
                }
                inputModal.modal("hide");
            },
            error: function (xhr) {
                $(".errormsg").remove();
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(key => {
                        $(`#${key}`).addClass("is-invalid").after(`<label class="errormsg text-danger">${errors[key]}</label>`);
                    });
                } else { showAlert('danger', 'Something went wrong.'); }
            },
            complete: function () { btn.attr("disabled", false); }
        });
    });

    /**
     * ADD NEW ROW
     * Adds the row to the internal table object and prepends it to the DOM.
     */
    function addNewRow(data) {
        const template = document.querySelector('#row-template');
        const clone = template.content.cloneNode(true);
        const tr = clone.querySelector('tr');

        tr.setAttribute('data-id', data.description_gp_id);
        tr.id = data.description_gp_id;

        const detailUrl = vars("detail_url").replace("__resourceId__", data.description_gp_id);
        const updateUrl = vars("edit_url").replace("__resourceId__", data.description_gp_id);
        const deleteUrl = vars("delete_url").replace("__resourceId__", data.description_gp_id);

        tr.querySelector('.gp-name').textContent = data.gp_name;
        tr.querySelector('.description-type-text').textContent = data.description_type_text;
        tr.querySelector('.detail-link').href = detailUrl;

        const editBtn = tr.querySelector('.edit-btn');
        editBtn.setAttribute('data-gp_name', data.gp_name);
        editBtn.setAttribute('data-description_type', data.description_type);
        editBtn.setAttribute('data-url', updateUrl);

        const delBtn = tr.querySelector('.show-delete-modal');
        delBtn.setAttribute('data-url', deleteUrl);
        delBtn.setAttribute('data-id', data.description_gp_id);

        // Add to DataTable and immediately move to the top of the <tbody>
        let newRowNode = table.row.add($(tr)).node();
        $(newRowNode).prependTo('#gp-datatable tbody');

        reIndexTable();
    }

    /**
     * UPDATE EXISTING ROW
     * Updates HTML values directly and invalidates row cache.
     */
    function updateExistingRow(data) {
        // 1. Update visual text in the current row
        currentRow.find('.gp-name').text(data.gp_name);
        currentRow.find('.description-type-text').text(data.description_type_text);

        // 2. Update button data-attributes for future edits
        const editBtn = currentRow.find('.edit-btn');
        editBtn.attr("data-gp_name", data.gp_name);
        editBtn.attr("data-description_type", data.description_type);

        /**
         * 3. Sync internal search cache.
         * invalidate() refreshes the search index from the updated DOM.
         */
        table.row(currentRow).invalidate();
        reIndexTable();
    }

    /**
     * RE-INDEX THE FIRST COLUMN (#)
     * Loops through visible rows in the DOM to set row numbers.
     */
    function reIndexTable() {
        $('#gp-datatable tbody tr').each(function (idx) {
            $(this).find('td:first').html(idx + 1);
        });
    }
});
