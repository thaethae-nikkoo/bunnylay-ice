$(document).ready(function () {
    let payment_date = $("#payment_date");
    let export_date = $("#export_date");
    let leave_time = $("#leave_time");
    let departure_time = $("#departure_time");

    flatpickr("#purchase_date", {
        dateFormat: "d/m/Y",
        allowInput: true,
    });

    flatpickr("#from_date", {
        dateFormat: "d/m/Y",
        allowInput: true,
    });

    flatpickr("#to_date", {
        dateFormat: "d/m/Y",
        allowInput: true,
    });

    flatpickr("#payment_date", {
        dateFormat: "d/m/Y",
        defaultDate: payment_date.val(),
        allowInput: true,
    });

    flatpickr("#export_date", {
        dateFormat: "d/m/Y",
        defaultDate: export_date.val(),
        allowInput: true,
    });

    flatpickr("#sale_date", {
        dateFormat: "d/m/Y",
        allowInput: true,
    });

    flatpickr("#leave_time", {
        dateFormat: "d/m/Y H:i",
        enableTime: true,
        defaultDate: leave_time.val(),
        allowInput: true,
    });

    flatpickr("#departure_time", {
        dateFormat: "d/m/Y H:i",
        enableTime: true,
        defaultDate: departure_time.val(),
        allowInput: true,
    });
});
