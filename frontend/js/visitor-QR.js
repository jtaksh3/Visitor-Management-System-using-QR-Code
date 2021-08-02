(function ($) {

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/user/isAuthorizedVisitor",
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
        error: function () {
            window.location.replace("../index.html");
        }
    });]

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/slot?id=" + localStorage.getItem("id") + "&status=approved",
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
        success: function (response) {
            let i = 0;
            while (i < response.data.slots.length) {
                let div1 = document.createElement("DIV");
                let div2 = document.createElement("DIV");
                let div3 = document.createElement("DIV");
                div1.classList.add("col-md-3");
                div1.classList.add("grid-margin");
                div1.classList.add("stretch-card");
                div2.classList.add("card");
                div3.classList.add("card-body");
                let p = document.createElement("P");
                p.classList.add("card-title");
                p.classList.add("text-md-center");
                p.classList.add("text-xl-left");
                let btn = document.createElement("BUTTON");
                btn.style.color = "blue";
                btn.classList.add("btn");
                btn.classList.add("user_id_btn");
                btn.appendChild(document.createTextNode(response.data.slots[i].host_id));
                btn.onclick = function () { getUserDetails(this.textContent); };
                p.appendChild(btn);
                p.appendChild(document.createTextNode(response.data.slots[i].meeting_at));
                div3.appendChild(p);
                let img = document.createElement("IMG");
                img.src = "https://api.qrserver.com/v1/create-qr-code/?data=ccf478745dbfaa97e9523bf22d5dd7f1."+localStorage.getItem("id")+"."+response.data.slots[i].host_id+"&size=100x100";
                div3.appendChild(img);
                div2.appendChild(div3);
                div1.appendChild(div2);
                document.getElementById("qr_row").appendChild(div1);
                i++;
            }
        },
        error: function () {
            document.getElementById("qr_row").textContent = "No Records Found!";
        }
    });

})(jQuery);

function getUserDetails(input) {
    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/user/" + input,
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
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
            window.open("./show-info.html");
        }
    });
};

window.history.forward();
function noBack() {
    window.history.forward();
}

