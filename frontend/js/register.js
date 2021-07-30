(function ($) {

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/user/isAuthorizedAdmin",
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
        error: function () {
            window.location.replace("../index.html");
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
            "role": "host",
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
            location.reload();
            window.open("./show-info.html");
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

