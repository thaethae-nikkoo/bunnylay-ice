$(document).ready(function () {

    $(".account_type-select .single-select").select2({
        theme: "select-no-img",
        width: "100%",
        minimumResultsForSearch: 0,
        dropdownParent: $(".account_type-select"),
    });
    $(".role-select .single-select").select2({
        theme: "select-no-img",
        width: "100%",
        minimumResultsForSearch: Infinity,
        dropdownParent: $(".role-select"),
    });
});
