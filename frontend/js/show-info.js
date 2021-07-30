(function ($) {

    $("#table_email").html(localStorage.getItem("temp_email"));
    $("#table_full_name").html(localStorage.getItem("temp_full_name"));
    $("#table_designation").html(localStorage.getItem("temp_designation"));
    $("#table_organization").html(localStorage.getItem("temp_organization"));
    $("#table_phone").html(localStorage.getItem("temp_phone_no"));
    $("#table_address_line_1").html(localStorage.getItem("temp_address_line_1"));
    $("#table_address_line_2").html(localStorage.getItem("temp_address_line_2"));
    $("#table_address_line_3").html(localStorage.getItem("temp_address_line_3"));
    $("#table_country").html(localStorage.getItem("temp_country"));
    $("#table_state").html(localStorage.getItem("temp_state"));
    $("#table_city").html(localStorage.getItem("temp_city"));
    $("#table_created_at").html(localStorage.getItem("temp_created_at"));

    setTimeout(function () { window.close(); }, 5000);

})(jQuery);

window.history.forward();
function noBack() {
    window.history.forward();
}
