$(document).ready(function () {
    const inputModal = $("#description_modal");

    /**
     * 1. INITIALIZE DATATABLE
     * Disabling 'ordering' ensures our 'prepend' logic works visually.
     */
    let table;
    if ($.fn.dataTable.isDataTable('#description-table')) {
        table = $('#description-table').DataTable();
    } else {
        table = $('#description-table').DataTable({
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
     * PREPARE MODAL CONTENT
     */
    function updateModalContent() {
        $(".errormsg").remove();
        $("input").removeClass("is-invalid");
        $("#name").val("");

        if (inputModal.data("editmode") == true) {
            $(".modal-title").text("Edit Description");
            isEdit = true;
        } else {
            $(".modal-title").text("Add New Description");
            isEdit = false;
        }
    }

    /**
     * CREATE BUTTON CLICK
     */
    $(document).on("click", "#create-btn", function () {
        inputModal.data("editmode", false);
        updateModalContent();
        inputModal.modal("show");
    });

    /**
     * EDIT BUTTON CLICK
     * Uses .attr() to fetch the most recent data from the DOM.
     */
    $(document).on("click", ".edit-btn", function () {
        inputModal.data("editmode", true);
        updateModalContent();

        let button = $(this);
        currentRow = button.closest('tr');

        editUrl = button.attr("data-url");
        $("#name").val(button.attr("data-name"));
        inputModal.modal("show");
    });

    /**
     * SAVE BUTTON AJAX
     */
    $(document).on("click", ".save-btn", function (e) {
        e.preventDefault();
        const btn = $(this);
        btn.attr("disabled", true);
        $(".indicator-label").hide();
        $(".indicator-progress").show();

        let type = isEdit ? "PATCH" : "POST";
        let url = isEdit ? editUrl : createUrl;

        let name = $("#name").val();
        let description_gp_id = $("#description_gp_id").val();

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                "Content-Type": "application/json",
            },
            url: url,
            type: type,
            data: JSON.stringify({ name, description_gp_id }),
            success: function (res) {
                if (isEdit) {
                    updateExistingRow(res.data);
                    showAlert('success', res.message ?? 'Updated successfully.');
                } else {
                    addNewRow(res.data);
                    showAlert('success', res.message ?? 'Added successfully.');
                }
                inputModal.modal("hide");
                resetBtnState(btn);
            },
            error: function (xhr) {
                resetBtnState(btn);
                $(".errormsg").remove();

                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    Object.keys(xhr.responseJSON.errors).forEach((key) => {
                        $(`#${key}`).addClass("is-invalid").after(`<label class="errormsg text-danger">${xhr.responseJSON.errors[key]}</label>`);
                    });
                }
            }
        });
    });

    function resetBtnState(btn) {
        btn.attr("disabled", false);
        $(".indicator-progress").hide();
        $(".indicator-label").show();
    }

    /**
     * UPDATE EXISTING ROW
     */
    function updateExistingRow(data) {
        // 1. Update visual UI
        currentRow.find('.name').text(data.name);

        // 2. Update attributes so next edit shows new value
        const editBtn = currentRow.find('.edit-btn');
        editBtn.attr("data-name", data.name);

        // 3. Update DataTable cache
        table.cell(currentRow, 1).data(data.name);

        // 4. Draw without sorting conflict and fix numbering
        table.draw(false);
        reIndexTable();
    }

    /**
     * ADD NEW ROW (PREPEND)
     */
    function addNewRow(data) {
        const template = document.querySelector('#row-template');
        const clone = template.content.cloneNode(true);
        const tr = clone.querySelector('tr');

        tr.id = data.description_id;
        tr.setAttribute('data-id', data.description_id);
        tr.querySelector('.name').textContent = data.name;

        const updateUrl = vars("edit_url").replace("__desc_id__", data.description_id);
        const deleteUrl = vars("delete_url").replace("__desc_id__", data.description_id);

        const editBtn = tr.querySelector('.edit-btn');
        editBtn.setAttribute('data-name', data.name);
        editBtn.setAttribute('data-url', updateUrl);

        const delBtn = tr.querySelector('.show-delete-modal');
        delBtn.setAttribute('data-url', deleteUrl);
        delBtn.setAttribute('data-id', data.description_id);

        // 1. Physical Prepend to HTML
        $('#description-table tbody').prepend(tr);

        // 2. Register row in DataTable (without immediate draw)
        table.row.add($(tr));

        // 3. Fix the serial numbers
        reIndexTable();
    }

    /**
     * RE-INDEX THE FIRST COLUMN (#)
     * Loops through visual rows and sets numbers 1, 2, 3...
     */
    function reIndexTable() {
        $('#description-table tbody tr').each(function (idx) {
            $(this).find('td:first').html(idx + 1);
        });
    }
});
