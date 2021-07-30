(function ($) {

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/user/isAuthorizedHost",
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
        error: function () {
            window.location.replace("../index.html");
        }
    });

    $("#email").html(localStorage.getItem("email"));
    $("#full_name").html(localStorage.getItem("full_name"));
    $("#designation").html(localStorage.getItem("designation"));
    $("#organization").html(localStorage.getItem("organization"));
    $("#phone").html(localStorage.getItem("phone_no"));
    $("#address_line_1").html(localStorage.getItem("address_line_1"));
    $("#address_line_2").html(localStorage.getItem("address_line_2"));
    $("#address_line_3").html(localStorage.getItem("address_line_3"));
    $("#country").html(localStorage.getItem("country"));
    $("#state").html(localStorage.getItem("state"));
    $("#city").html(localStorage.getItem("city"));
    $("#created_at").html(localStorage.getItem("created_at"));

    setTimeout(function () { window.close(); }, 5000);

})(jQuery);

window.history.forward();
function noBack() {
    window.history.forward();
}
