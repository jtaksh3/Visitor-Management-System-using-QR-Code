(function ($) {

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/user/isAuthorizedAdmin",
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
        error: function () {
            window.location.replace("./index.html");
        }
    });

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/user?role=host",
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
        success: function (response) {
            $("#hosts_count").text(response.data.users.length);
        },
        error: function () {
            $("#hosts_count").text(0);
        }
    });

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/user?role=visitor",
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
        success: function (response) {
            $("#visitors_count").text(response.data.users.length);
        },
        error: function () {
            $("#visitors_count").text(0);
        }
    });

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/slot?status=pending",
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
        success: function (response) {
            $("#pending_requests_count").text(response.data.slots.length);
        },
        error: function (response) {
            $("#pending_requests_count").text(0);
        }
    });

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/slot?status=approved",
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
        success: function (response) {
            $("#approved_requests_count").text(response.data.slots.length);
        },
        error: function (response) {
            $("#approved_requests_count").text(0);
        }
    });

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/slot?status=all",
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
        success: function (response) {
            let i = 0;
            while (i < response.data.slots.length) {
                let tr = document.createElement("TR");
                let td1 = document.createElement("TD");
                let td2 = document.createElement("TD");
                let td3 = document.createElement("TD");
                let td4 = document.createElement("TD");
                let btn1 = document.createElement("BUTTON");
                btn1.style.color = "blue";
                btn1.classList.add("btn");
                btn1.appendChild(document.createTextNode(response.data.slots[i].visitor_id));
                btn1.onclick = function() { getUserDetails(this.textContent); };
                td1.appendChild(btn1);
                let btn2 = document.createElement("BUTTON");
                btn2.style.color = "blue";
                btn2.classList.add("btn");
                btn2.classList.add("user_id_btn");
                btn2.appendChild(document.createTextNode(response.data.slots[i].host_id));
                btn2.onclick = function() { getUserDetails(this.textContent); };
                td2.appendChild(btn2);
                td3.appendChild(document.createTextNode(response.data.slots[i].meeting_at));
                let label = document.createElement("LABEL");
                label.classList.add("badge");
                if (response.data.slots[i].status == 'pending')
                    label.classList.add("badge-info");
                else if (response.data.slots[i].status == 'approved')
                    label.classList.add("badge-success");
                else
                    label.classList.add("badge-danger");
                label.appendChild(document.createTextNode(response.data.slots[i].status));
                td4.appendChild(label);
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                document.getElementById("requests_table").appendChild(tr);
                i++;
            }
        },
        error: function () {
            document.getElementById("requests_table").textContent = "No Records Found!";
        }
    });

})(jQuery);

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
            window.open("/pages/show-info.html");
        }
    });
};
