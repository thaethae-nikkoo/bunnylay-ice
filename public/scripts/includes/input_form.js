$(function () {
    var errors = scope("errors");
    var selectElements = vars("select_elements");
    var radioElements = vars("radio_elements");
    /** print error messages to their respective input element */
    for (var key in errors) {
        var name = key2name(key);
        var error = errors[key][0];
        var input = $(
            "[name='" + name + "']:not([type='hidden'], [type=radio])"
        );
        var input_id = input.attr("id");
        input.addClass("error");
        input.addClass("is-invalid");
        if (selectElements.includes(name)) {
            $("." + name + "-select-element")
                .find(".selection")
                .append(
                    '<label class="errormsg select-element-error"' +
                        ' for="' +
                        name +
                        '" ' +
                        " >" +
                        error +
                        "</label>"
                );
            $("." + name + "-select-element")
                .find(".form-check")
                .append(
                    '<label class="errormsg select-element-error"' +
                        ' for="' +
                        name +
                        '" ' +
                        " >" +
                        error +
                        "</label>"
                );
            $("." + name + "-error-element").append(
                '<label class="errormsg"' +
                    ' for="' +
                    name +
                    '" ' +
                    " >" +
                    error +
                    "</label>"
            );
        } else if (radioElements.includes(name)) {
            $("." + name + "-radio-group")
                .find(".radio-check")
                .append(
                    '<label class="errormsg select-element-error"' +
                        ' for="' +
                        name +
                        '" ' +
                        " >" +
                        error +
                        "</label>"
                );
        } else {
            input
                .parent()
                .append(
                    '<label class="errormsg" id="_error_' +
                        random() +
                        "_" +
                        input_id +
                        '" for="' +
                        input_id +
                        '" ' +
                        " >" +
                        error +
                        "</label>"
                );
        }
    }
});
