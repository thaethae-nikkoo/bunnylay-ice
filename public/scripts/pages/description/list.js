$(document).ready(function () {
    const inputModal = $("#description_modal");

    // 1. INITIALIZE DATATABLE
    // ordering: false is required to prevent DataTables from overriding our prepend
    let table = $('#description-table').DataTable({
        "ordering": false,
        "pageLength": 25,
        "retrieve": true
    });

    let editUrl, createUrl = vars("create_url"), isEdit = false, currentRow;

    // --- Helper: Reset Button State ---
    function resetBtnState(btn) {
        btn.attr("disabled", false);
        $(".indicator-progress").hide();
        $(".indicator-label").show();
    }

    // --- Helper: Show Alert ---
    function showAlert(type, message) {
        const icon = type === 'success' ? 'bx-check-circle' : 'bx-error-circle';
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                <i class='bx ${icon} me-2'></i>
                <span>${message}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
        $('#alert-container').html(alertHtml);
        setTimeout(() => { $('.alert').alert('close'); }, 5000);
    }

    // --- Modal Logic ---
    $(document).on("click", "#create-btn", function () {
        isEdit = false;
        $(".modal-title").text("Add New Description");
        $("#name").val("").removeClass("is-invalid");
        $(".errormsg").remove();
        inputModal.modal("show");
    });

    $(document).on("click", ".edit-btn", function () {
        isEdit = true;
        $(".modal-title").text("Edit Description");
        $(".errormsg").remove();
        $("input").removeClass("is-invalid");

        let button = $(this);
        currentRow = button.closest('tr');
        editUrl = button.attr("data-url");
        $("#name").val(button.attr("data-name"));
        inputModal.modal("show");
    });

    // --- Save Logic ---
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
                } else {
                    addNewRow(res.data);
                }
                inputModal.modal("hide");
                showAlert('success', res.message ?? 'Success');
                resetBtnState(btn);
            },
            error: function (xhr) {
                resetBtnState(btn);
                $(".errormsg").remove();
                if (xhr.responseJSON?.errors) {
                    Object.keys(xhr.responseJSON.errors).forEach((key) => {
                        $(`#${key}`).addClass("is-invalid").after(`<label class="errormsg text-danger">${xhr.responseJSON.errors[key]}</label>`);
                    });
                }
            }
        });
    });

    /**
     * ADD NEW ROW
     */
    function addNewRow(data) {
        const template = document.querySelector('#row-template');
        const clone = template.content.cloneNode(true);
        const tr = clone.querySelector('tr');

        // Map data to template
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

        // 1. Add to DataTables internal memory first
        let newRow = table.row.add($(tr)).draw(false);

        // 2. Physically move the newly created row to the top of the HTML
        $(newRow.node()).prependTo('#description-table tbody');

        reIndexTable();
    }

    /**
     * UPDATE EXISTING ROW
     * We update the HTML and sync the cache without re-ordering.
     */
    function updateExistingRow(data) {
        // 1. Update the visual UI
        currentRow.find('.name').text(data.name);

        // 2. Update button attributes for the next edit
        currentRow.find('.edit-btn').attr("data-name", data.name);

        // 3. Update DataTables internal cache for this row only
        // .invalidate() syncs the search engine with the new HTML.
        table.row(currentRow).invalidate();

        reIndexTable();
    }

    /**
     * RE-INDEX THE FIRST COLUMN (#)
     */
    function reIndexTable() {
        $('#description-table tbody tr').each(function (idx) {
            $(this).find('td:first').html(idx + 1);
        });
    }
});
