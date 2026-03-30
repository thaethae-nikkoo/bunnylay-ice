$(document).ready(function () {
    const inputModal = $("#description_gp_modal");

    /**
     * 1. INITIALIZE DATATABLE
     * We check if it exists first to avoid the "Cannot reinitialise" warning.
     * 'ordering: false' is used to ensure our manual 'prepend' order stays at the top.
     */
    let table;
    if ($.fn.dataTable.isDataTable('#gp-datatable')) {
        table = $('#gp-datatable').DataTable();
    } else {
        table = $('#gp-datatable').DataTable({
            "ordering": false,
            "pageLength": 25,
            "retrieve": true
        });
    }

    let editUrl;
    let createUrl = vars("create_url");
    let isEdit = false;
    let currentRow;

    /**
     * SHOW ALERT MESSAGE
     * Displays a dismissible Bootstrap alert in the '#alert-container'.
     */
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

    /**
     * OPEN MODAL FOR NEW ENTRY
     */
    $(document).on("click", "#create-btn", function () {
        isEdit = false;
        $(".modal-title").text("Add Description Group");
        resetForm();
        inputModal.modal("show");
    });

    /**
     * OPEN MODAL FOR EDITING
     * Uses .attr() instead of .data() to ensure we get the latest updated values
     * from the DOM instead of the jQuery cache.
     */
    $(document).on("click", ".edit-btn", function () {
        isEdit = true;
        $(".modal-title").text("Edit Description Group");
        resetForm();

        let button = $(this);
        currentRow = button.closest('tr');

        editUrl = button.attr("data-url");
        $("#gp_name").val(button.attr("data-gp_name"));

        let type = button.attr("data-description_type");
        $(".description_type[value='" + type + "']").prop("checked", true);

        inputModal.modal("show");
    });

    /**
     * RESET FORM VALIDATION & INPUTS
     */
    function resetForm() {
        $(".errormsg").remove();
        $("#gp_name").val("").removeClass("is-invalid");
        $("input[name='description_type']").prop("checked", false);
    }

    /**
     * SAVE BUTTON AJAX HANDLER (Create & Update)
     */
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
            url: url,
            type: type,
            data: JSON.stringify(formData),
            success: function (res) {
                if (isEdit) {
                    updateExistingRow(res.data);
                    showAlert('success', res.message || 'Updated successfully.');
                } else {
                    addNewRow(res.data);
                    showAlert('success', res.message || 'Inserted successfully.');
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
                } else {
                    showAlert('danger', 'Something went wrong.');
                }
            },
            complete: function () { btn.attr("disabled", false); }
        });
    });

    /**
     * UPDATE EXISTING ROW IN DOM & DATATABLE
     * Ensures attributes are updated so the next Edit click shows new data.
     */
    function updateExistingRow(data) {
        // 1. Update visible UI text
        currentRow.find('.gp-name').text(data.gp_name);
        currentRow.find('.description-type-text').text(data.description_type_text);

        // 2. Update button attributes
        const editBtn = currentRow.find('.edit-btn');
        editBtn.attr("data-gp_name", data.gp_name);
        editBtn.attr("data-description_type", data.description_type);

        // 3. Sync with DataTable internal cache so search remains accurate
        table.cell(currentRow, 1).data(data.gp_name);
        table.cell(currentRow, 2).data(data.description_type_text);

        // 4. Redraw without losing current page or sorting
        table.draw(false);
        reIndexTable();
    }

    /**
     * PREPEND NEW ROW TO TABLE
     * Clones a <template> and inserts it at the very top of the <tbody>.
     */
    function addNewRow(data) {
        const template = document.querySelector('#row-template');
        const clone = template.content.cloneNode(true);
        const tr = clone.querySelector('tr');

        // Set IDs and Data Attributes
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

        // 1. Physically prepend to the HTML table
        $('#gp-datatable tbody').prepend(tr);

        // 2. Add the row to DataTable object without a full redraw
        table.row.add($(tr));

        // 3. Re-calculate the # column indices (1, 2, 3...)
        reIndexTable();
    }

    /**
     * RE-INDEX THE FIRST COLUMN (#)
     * Loops through each row currently in the DOM to set sequential numbering.
     */
    function reIndexTable() {
        $('#gp-datatable tbody tr').each(function (idx) {
            $(this).find('td:first').html(idx + 1);
        });
    }
});
