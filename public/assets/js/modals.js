$(document).ready(function () {
    const $modals = $("dialog");
    const $deleteModal = $("#delete_confirm");
    const $changeStatusModal = $("#change_status_confirm");
    const $closeButtons = $(".closeModal");
    const $closeBtnCross = $(".btn-close");

    function closeModalOnOutsideClick(modal) {
        modal.on("click", function (e) {
            const modalDimensions = modal[0].getBoundingClientRect();
            if (
                e.clientX < modalDimensions.left ||
                e.clientX > modalDimensions.right ||
                e.clientY < modalDimensions.top ||
                e.clientY > modalDimensions.bottom
            ) {
                modal[0].close();
            }
        });
    }

    $(document).on("click", ".show-delete-modal", function (e) {
        e.preventDefault();
        var targetId = $(this).data("id");
        var resourceName = $(this).data("resource-name");
        var url = this.getAttribute("data-url");
        var act = $(this).data("action");

        const form = $deleteModal.find("#kt_stepper_form");
        form.attr("action", url);

        $deleteModal
            .find('input[name="id"]')
            .attr("name", resourceName)
            .val(targetId);
        $deleteModal.find('input[name="act"]').attr("name", "action").val(act);

        let message = "";
        switch (act) {
            case "ban":
                message = "Admin ကို ban ပါမည်။ ဆက်လက် လုပ်ဆောင်ပါမည်လား ?";
                break;
            case "delete":
                message =
                    "Admin ကို အပြီးအပိုင် ဖျက်ပစ်ပါမည်။ ဆက်လက် လုပ်ဆောင်ပါမည်လား ?";
                break;
            case "restore":
                message =
                    "Admin ကိုပြန်လည်ခွင့်ပြုပါမည်။ ဆက်လက်လုပ်ဆောင်ပါမည်လား ?";
                break;
            default:
                message =
                    "ဤလုပ်ဆောင်ချက်ကို ပြန်ပြင်၍မရပါ။ ဆက်လက် လုပ်ဆောင်ပါမည်လား ?";
        }
        $deleteModal.find("#delete-alert-text").text(message);
        closeModalOnOutsideClick($deleteModal);
    });

    $(document).on("click", ".show-status-modal", function (e) {
        e.preventDefault();
        var targetId = $(this).data("id");
        var resourceName = $(this).data("resource-name");
        var url = this.getAttribute("data-url");
        const form = $changeStatusModal.find("#kt_stepper_form");
        form.attr("action", url);

        $changeStatusModal
            .find('input[name="id"]')
            .attr("name", resourceName)
            .val(targetId);

        // $changeStatusModal[0].showModal();
        closeModalOnOutsideClick($changeStatusModal);
    });

    $closeButtons.on("click", function (e) {
        e.preventDefault();
        $modals.each(function () {
            this.close();
        });
    });
    $closeBtnCross.on("click", function (e) {
        e.preventDefault();
        $modals.each(function () {
            this.close();
        });
    });
});
