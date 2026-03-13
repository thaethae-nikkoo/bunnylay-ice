/**
 * form submit from jquery
 * @param {*} action
 * @param {*} inputs
 * @param {*} attrs
 * @returns
 */
function add_form(action, inputs, attrs, clones) {
    inputs = inputs ? inputs : {};
    attrs = attrs ? attrs : {};

    var form = $("<form>")
        .attr("id", "_form" + random())
        .attr("method", "POST");
    action ? form.attr("action", action) : "";
    for (var attr in attrs) {
        if (attrs.hasOwnProperty(attr)) {
            form.attr(attr, attrs[attr]);
        }
    }
    if (token()) {
        form.append(
            jQuery("<input>", {
                type: "hidden",
                name: "_token",
                value: token(),
            })
        );
    }
    if (["delete", "put", "patch"].indexOf(inputs) >= 0) {
        form.append(
            jQuery("<input>", {
                type: "hidden",
                name: "_method",
                value: inputs,
            })
        );
    } else {
        for (var key in inputs) {
            if (inputs.hasOwnProperty(key)) {
                var values = inputs[key];
                if ($.isArray(values)) {
                    values.forEach(function (value, index) {
                        if ($.isArray(value)) {
                            value.forEach(function (
                                value_children,
                                index_children
                            ) {
                                form.append(
                                    jQuery("<input>", {
                                        type: "hidden",
                                        value: value_children,
                                        name:
                                            key +
                                            "[" +
                                            index +
                                            "][" +
                                            index_children +
                                            "]",
                                    })
                                );
                            });
                        } else {
                            form.append(
                                jQuery("<input>", {
                                    type: "hidden",
                                    value: value,
                                    name: key,
                                })
                            );
                        }
                    });
                } else {
                    form.append(
                        jQuery("<input>", {
                            type: "hidden",
                            value: values,
                            name: key,
                        })
                    );
                }
            }
        }
    }
    if (clones) {
        if ($.isArray(clones)) {
            clones.forEach(function (inputClone) {
                form.append(inputClone);
            });
        }
    }
    $("body").append(form);
    return form;
}

/**
 * generate csrf token
 * @returns string
 */
function token() {
    return $("input:hidden[name=_token]").val();
}

/**
 * get scope variable by key name
 * @param {string} name
 * @param {string} scope
 * @returns
 */
function vars(name, scope) {
    scope = scope ? scope : "vars";
    if (!$.cps_scopes || !$.cps_scopes[scope]) {
        throw "Undefined [" + name + "] in [" + scope + "] scope";
    }
    return $.cps_scopes[scope][name];
}

/**
 * get scope variable
 * @param {*} name
 * @returns
 */
function scope(name) {
    name = name ? name : "vars";
    if (!$.cps_scopes) {
        throw "Undefined [" + name + "] scope";
    }
    return $.cps_scopes[name];
}

/**
 * pass variable as bool
 * @param {*} val
 * @returns
 */
function parseBool(val) {
    if (val === "false") {
        return false;
    }
    return val ? true : false;
}

/**
 *
 * @param {*} max
 * @param {*} min
 * @returns
 */
function random(max, min) {
    min = min === undefined ? 0 : min;
    max = max === undefined ? 1000 : max;

    return Math.floor(Math.random() * (max - min) + min);
}

/**
 * change dropdown value by data array
 * @param {array} data
 * @param {string} selector
 */
function changeDropDownValue(data, selector) {
    var selector = document.getElementById(selector);

    // Clear existing options
    while (selector.options.length > 1) {
        selector.remove(1);
    }

    if (data) {
        for (const [value, key] of data) {
            var option = document.createElement("option");
            option.value = value;
            option.text = value;
            selector.append(new Option(value, value));
        }
    }
}

/**
 * store pathname and related data in sessionStorage
 * @param {string} key
 * @param {array} pathnames
 * @param {object} data
 */
function sessionStorageSetter(key, pathnames, data) {
    let sessionData = {
        pathnames: pathnames,
        data: data,
    };
    sessionStorage.setItem(key, JSON.stringify(sessionData));
}

/**
 * get pathnames and data from sessionStorage
 * @param {string} key
 * @returns
 */
function sessionStorageGetter(key) {
    let sessionData = sessionStorage.getItem(key);
    let exists = sessionData == null ? false : true;
    sessionData = JSON.parse(sessionData) ?? {};
    let pathnames = sessionData["pathnames"] ?? [];
    let data = sessionData["data"] ?? {};
    return [pathnames, data, exists];
}

/** get input name from error response */
function key2name(key) {
    var name;
    key.split(".").forEach(function (e, i) {
        if (i === 0) {
            name = e;
        } else {
            name += "[" + e + "]";
        }
    });
    return name;
}
// Format number with commas
function addCommas(num) {
    let number = parseFloat(num.toString().replace(/,/g, ""));
    return isNaN(number) ? "" : number.toLocaleString("en-US");
}

// Remove commas from a number string
function removeCommas(str) {
    return str.toString().replace(/,/g, "");
}

// Format number with commas
function addCommas(num) {
    let number = parseFloat(num.toString().replace(/,/g, ""));
    return isNaN(number) ? "" : number.toLocaleString("en-US");
}

// Remove commas from a string
function removeCommas(str) {
    if (str == null) return "";
    return str.toString().replace(/,/g, "");
}
//Search Toggle
$(".search-toggle").on("click", function () {
    $(".sec-filter").slideToggle(1000);
    $(".sec-filter").toggleClass("mb20");
    $(this).toggleClass("expend");
});

// Format on input
$(document).on("input", ".number-format", function () {
    let $this = $(this);
    let cursorPosition = this.selectionStart;

    let raw = removeCommas($this.val());
    $this.val(addCommas(raw));

    // Optional: try to preserve cursor position
    this.setSelectionRange(cursorPosition, cursorPosition);
});

// Remove commas on form submit
$("form").on("submit", function () {
    $(this)
        .find(".number-format")
        .each(function () {
            let $input = $(this);
            $input.val(removeCommas($input.val()));
        });
});

setTimeout(function () {
    $("#alert")
        .fadeTo(500, 0)
        .slideUp(250, function () {
            $(this).remove();
        });
}, 3000);
