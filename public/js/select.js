$(document).ready(function () {
    $(".item_id-select .single-select").select2({
        theme: "select-no-img",
        width: "100%",
        minimumResultsForSearch: Infinity,
        dropdownParent: $(".item_id-select"),
    });
    $(".item_id_search-select .single-select").select2({
        theme: "bootstrap-5",
        width: "100%",
        allowClear: false,
        minimumResultsForSearch: Infinity,
        dropdownAutoWidth: true,
    });
    $(".duty_payment_status-select .single-select").select2({
        theme: "select-no-img",
        width: "100%",
        minimumResultsForSearch: Infinity,
        dropdownParent: $(".duty_payment_status-select"),
    });
    $(".truck_fee_payment_status-select .single-select").select2({
        theme: "select-no-img",
        width: "100%",
        minimumResultsForSearch: Infinity,
        dropdownParent: $(".truck_fee_payment_status-select"),
    });
    $(".role-select .single-select").select2({
        theme: "select-no-img",
        width: "100%",
        minimumResultsForSearch: Infinity,
        dropdownParent: $(".role-select"),
    });
});
