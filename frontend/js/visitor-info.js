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

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/user?role=visitor",
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
        success: function (response) {
            let i = 0;
            while (i < response.data.users.length) {
                let tr = document.createElement("TR");
                let td1 = document.createElement("TD");
                let td2 = document.createElement("TD");
                let td3 = document.createElement("TD");
                let td4 = document.createElement("TD");
                let td5 = document.createElement("TD");

                td1.appendChild(document.createTextNode(i+1));
                let btn = document.createElement("BUTTON");
                btn.style.color = "blue";
                btn.classList.add("btn");
                btn.appendChild(document.createTextNode(response.data.users[i].email));
                btn.id = response.data.users[i].id;
                btn.onclick = function() { getUserDetails(this.id); };
                td2.appendChild(btn);
                td3.appendChild(document.createTextNode(response.data.users[i].user_additional_details.full_name));
                td4.appendChild(document.createTextNode(response.data.users[i].user_additional_details.designation));
                td5.appendChild(document.createTextNode(response.data.users[i].user_additional_details.organization));
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                document.getElementById("visitors_table").appendChild(tr);
                i++;
            }
        },
        error: function () {
            document.getElementById("visitors_table").textContent = "No Records Found!";
        }
    });

})(jQuery);

window.history.forward();
function noBack() {
    window.history.forward();
}

function getUserDetails(input) {
    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/user/"+input,
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
