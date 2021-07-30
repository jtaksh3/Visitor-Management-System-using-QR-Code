window.history.forward();
function noBack() {
    window.history.forward();
}

var token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7InVzZXJfZW1haWwiOiJqdGFra2phc2hnZmtqaHNna2phc2gzQGdtYWlsLmNvbSIsImFwaV90b2tlbiI6Il9iR2daSUlJRzB1ek9lV09qS2lBb2FkZTBwdHI0WjRzcHJsUTdPX0NVYUpSbHg0T01lNFFpd0FJQnZ3azdJcnJReE0ifSwiZXhwIjoxNjI3NjU5NTkwfQ.xTb5m7p1_iI6WChfxMPvkk89aRM8mNXBQWc9NWPprZ0";

(function ($) {

    $.ajax({
        type: "GET",
        url: "https://www.universal-tutorial.com/api/countries/",
        dataType: "json",
        headers: { "Authorization": "Bearer " + token },
        success: function (data) {
            let i = 0;
            while (i < data.length) {
                let opt = document.createElement("option");
                opt.setAttribute("value", data[0].country_short_name);
                let t = document.createTextNode(data[i].country_name);
                opt.appendChild(t);
                document.getElementById("country").appendChild(opt);
                i++;
            }
        }
    });

})(jQuery);

function showState() {

    let countrySelect = document.getElementById("country");
    let country = countrySelect.options[countrySelect.selectedIndex].text;

    $.ajax({
        type: "GET",
        url: "https://www.universal-tutorial.com/api/states/" + country,
        dataType: "json",
        headers: { "Authorization": "Bearer " + token },
        beforeSend: function () {
            $('#state')
                .find('option')
                .remove()
                .end()
                .append('<option selected="selected" disabled="disabled">State</option>');
            $('#city')
                .find('option')
                .remove()
                .end()
                .append('<option selected="selected" disabled="disabled">City</option>');
        },
        success: function (data) {
            let i = 0;
            while (i < data.length) {
                let opt = document.createElement("option");
                opt.setAttribute("value", data[i].state_name);
                let t = document.createTextNode(data[i].state_name);
                opt.appendChild(t);
                document.getElementById("state").appendChild(opt);
                i++;
            }
        }
    });
}

function showCity() {

    let stateSelect = document.getElementById("state");
    let state = stateSelect.options[stateSelect.selectedIndex].text;

    $.ajax({
        type: "GET",
        url: "https://www.universal-tutorial.com/api/cities/" + state,
        dataType: "json",
        headers: { "Authorization": "Bearer " + token },
        beforeSend: function () {
            $('#city')
                .find('option')
                .remove()
                .end()
                .append('<option selected="selected" disabled="disabled">City</option>');
        },
        success: function (data) {
            let i = 0;
            while (i < data.length) {
                let opt = document.createElement("option");
                opt.setAttribute("value", data[i].city_name);
                let t = document.createTextNode(data[i].city_name);
                opt.appendChild(t);
                document.getElementById("city").appendChild(opt);
                i++;
            }
        }
    });
}


function validateEmail(input) {

    let email_constraint = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (!email_constraint.test(input.value)) {
        $('#email').css('border', '1px solid');
        $('#email').css('border-color', 'red');
    }
    else {
        $('#email').css('border', 'none');
    }
}

function camelCase(input) {
    str = input.value;
    str = str.split(" ");

    for (let i = 0, x = str.length; i < x; i++)
        str[i] = str[i][0].toUpperCase() + str[i].substr(1).toLowerCase();

    return str.join(" ");
}

function validateName(input) {

    if (input.value.trim().length) {
        input.value = camelCase(input);
        $('#full_name').css('border', 'none');
    }
    else {
        $('#full_name').css('border', '1px solid');
        $('#full_name').css('border-color', 'red');
    }
}

function validatePassword(input) {
    if (input.value.trim().length >= 6 && input.value.trim().length <= 14) {
        $('#password').css('border', 'none');
    }
    else {
        $('#password').css('border', '1px solid');
        $('#password').css('border-color', 'red');
    }
}

function matchPassword(input) {

    if (input.value == $('#password').val()) {
        $('#c_password').css('border', 'none');
    }
    else {
        $('#c_password').css('border', '1px solid');
        $('#c_password').css('border-color', 'red');
    }

}

function validateDesignation(input) {

    if (input.value.trim().length) {
        input.value = camelCase(input);
        $('#designation').css('border', 'none');
    }
    else {
        $('#designation').css('border', '1px solid');
        $('#designation').css('border-color', 'red');
    }
}

function validateOrganization(input) {

    if (input.value.trim().length) {
        input.value = camelCase(input);
        $('#organization').css('border', 'none');
    }
    else {
        $('#organization').css('border', '1px solid');
        $('#organization').css('border-color', 'red');
    }
}

function validatePhone(input) {

    let phone_constraint = /^[6-9]\d{9}$/;
    if (phone_constraint.test(input.value)) {
        $('#phone').css('border', 'none');
    }
    else {
        $('#phone').css('border', '1px solid');
        $('#phone').css('border-color', 'red');
    }

}

function validateAddressLine1(input) {

    if (input.value.trim().length) {
        input.value = camelCase(input);
        $('#address_line_1').css('border', 'none');
    }
    else {
        $('#address_line_1').css('border', '1px solid');
        $('#address_line_1').css('border-color', 'red');
    }
}

