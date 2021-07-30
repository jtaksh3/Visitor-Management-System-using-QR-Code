window.history.forward();
function noBack() {
    window.history.forward();
}

(function ($) {

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/user/isAuthorizedAdmin",
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
        success: function () {
            window.location.replace("./admin-dashboard.html");
        }
    });

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/user/isAuthorizedHost",
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
        success: function () {
            window.location.replace("./host-dashboard.html");
        }
    });

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/user/isAuthorizedVisitor",
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
        success: function () {
            window.location.replace("./visitor-dashboard.html");
        }
    });

})(jQuery);

$("#sign_up").click(function () {

    let countrySelect = document.getElementById("country");
    let country = countrySelect.options[countrySelect.selectedIndex].text;

    let stateSelect = document.getElementById("state");
    let state = stateSelect.options[stateSelect.selectedIndex].text;

    let citySelect = document.getElementById("city");
    let city = citySelect.options[citySelect.selectedIndex].text;

    var userData = {
        "user": {
            "email": $("#email").val(),
            "password": $("#password").val(),
            "role": "visitor",
            "user_additional_details": {
                "full_name": $("#full_name").val(),
                "designation": $("#designation").val(),
                "organization": $("#organization").val(),
                "phone_no": $("#phone").val(),
                "address": {
                    "address_line_1": $("#address_line_1").val(),
                    "address_line_2": $("#address_line_2").val(),
                    "address_line_3": $("#address_line_3").val(),
                    "city": city,
                    "state": state,
                    "country": country
                }
            }
        }
    }

    $.ajax({
        type: "POST",
        url: "http://localhost/vms/backend/public/user",
        data: JSON.stringify(userData),
        dataType: "json",
        beforeSend: function () {
            localStorage.clear();
        },
        success: function (response) {
            localStorage.setItem("temp_email", response.data.user.email);
            localStorage.setItem("temp_full_name", response.data.user.user_additional_details.full_name);
            localStorage.setItem("temp_designation", response.data.user.user_additional_details.designation);
            localStorage.setItem("temp_organization", response.data.user.user_additional_details.organization);
            localStorage.setItem("temp_phone_no", response.data.user.user_additional_details.phone_no);
            localStorage.setItem("temp_address_line_1", response.data.user.user_additional_details.address.address_line_1);
            localStorage.setItem("temp_address_line_2", response.data.user.user_additional_details.address.address_line_2);
            localStorage.setItem("temp_address_line_3", response.data.user.user_additional_details.address.address_line_3);
            localStorage.setItem("temp_country", response.data.user.user_additional_details.address.country);
            localStorage.setItem("temp_state", response.data.user.user_additional_details.address.state);
            localStorage.setItem("temp_city", response.data.user.user_additional_details.address.city);
            localStorage.setItem("temp_created_at", response.data.user.created_at);
            window.location.replace("./pages/user-details.html");
        },
        error: function (xHR) {
            if (xHR.status == 409)
                console.log(xHR.responseJSON.messages.error);

            if (xHR.status == 400)
                console.log(xHR.responseJSON.messages.message);

            else
                console.log(xHR.statusText);
        }
    });
});

$("#login").click(function () {

    var userData = {
        "login_credentials": {
            "email": $("#login_email").val(),
            "password": $("#login_password").val()
        }
    }

    $.ajax({
        type: "POST",
        url: "http://localhost/vms/backend/public/user/login",
        data: JSON.stringify(userData),
        dataType: "json",
        beforeSend: function () {
            localStorage.clear();
        },
        success: function (response) {

            localStorage.setItem("id", response.data.user.id);
            localStorage.setItem("email", response.data.user.email);
            localStorage.setItem("full_name", response.data.user.user_additional_details.full_name);
            localStorage.setItem("designation", response.data.user.user_additional_details.designation);
            localStorage.setItem("organization", response.data.user.user_additional_details.organization);
            localStorage.setItem("phone_no", response.data.user.user_additional_details.phone_no);
            localStorage.setItem("address_line_1", response.data.user.user_additional_details.address.address_line_1);
            localStorage.setItem("address_line_2", response.data.user.user_additional_details.address.address_line_2);
            localStorage.setItem("address_line_3", response.data.user.user_additional_details.address.address_line_3);
            localStorage.setItem("country", response.data.user.user_additional_details.address.country);
            localStorage.setItem("state", response.data.user.user_additional_details.address.state);
            localStorage.setItem("city", response.data.user.user_additional_details.address.city);
            localStorage.setItem("created_at", response.data.user.created_at);
            localStorage.setItem("token", response.data.user.token.token);

            if (response.data.user.role == "admin")
                window.location.replace("./admin-dashboard.html");

            else if (response.data.user.role == "visitor")
                window.location.replace("./visitor-dashboard.html");

            else if (response.data.user.role == "host")
                window.location.replace("./host-dashboard.html");
        },
        error: function (xHR) {
            if (xHR.status == 409)
                console.log(xHR.responseJSON.messages.error);

            if (xHR.status == 400)
                console.log(xHR.responseJSON.messages.message);
            else
                console.log(xHR.statusText);
        }
    });
});
