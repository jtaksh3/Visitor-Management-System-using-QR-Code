(function ($) {

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/user/isAuthorizedHost",
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
        error: function () {
            window.location.replace("./index.html");
        }
    });

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/slot?id=" + localStorage.getItem("id") + "&status=all",
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
                td1.appendChild(document.createTextNode(i + 1));
                let btn = document.createElement("BUTTON");
                btn.style.color = "blue";
                btn.classList.add("btn");
                btn.classList.add("user_id_btn");
                btn.appendChild(document.createTextNode(response.data.slots[i].visitor_id));
                btn.onclick = function () { getUserDetails(this.textContent); };
                td2.appendChild(btn);
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
                document.getElementById("all_requests_table").appendChild(tr);
                i++;
            }
        },
        error: function () {
            document.getElementById("all_requests_table").textContent = "No Records Found!";
        }
    });

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/slot?id=" + localStorage.getItem("id") + "&status=approved",
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
                td1.appendChild(document.createTextNode(i + 1));
                let btn = document.createElement("BUTTON");
                btn.style.color = "blue";
                btn.classList.add("btn");
                btn.classList.add("user_id_btn");
                btn.appendChild(document.createTextNode(response.data.slots[i].visitor_id));
                btn.onclick = function () { getUserDetails(this.textContent); };
                td2.appendChild(btn);
                td3.appendChild(document.createTextNode(response.data.slots[i].meeting_at));
                let label = document.createElement("LABEL");
                label.classList.add("badge");
                label.classList.add("badge-success");
                label.appendChild(document.createTextNode(response.data.slots[i].status));
                td4.appendChild(label);
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                document.getElementById("approved_requests_table").appendChild(tr);
                i++;
            }
        },
        error: function () {
            document.getElementById("approved_requests_table").textContent = "No Records Found!";
        }
    });

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/slot?id=" + localStorage.getItem("id") + "&status=pending",
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
                let td5 = document.createElement("TD");
                td1.appendChild(document.createTextNode(i + 1));
                let btn = document.createElement("BUTTON");
                btn.style.color = "blue";
                btn.classList.add("btn");
                btn.appendChild(document.createTextNode(response.data.slots[i].visitor_id));
                btn.onclick = function () { getUserDetails(this.textContent); };
                td2.appendChild(btn);
                td3.appendChild(document.createTextNode(response.data.slots[i].meeting_at));
                btn2 = document.createElement("BUTTON");
                btn2.id = response.data.slots[i].id;
                btn2.classList.add("btn");
                btn2.classList.add("btn--radius-2");
                btn2.classList.add("btn--blue");
                btn2.appendChild(document.createTextNode("Approve"));
                btn2.onclick = function () { statusSlot(this.id, "approved"); };
                td4.appendChild(btn2);
                btn3 = document.createElement("BUTTON");
                btn3.id = response.data.slots[i].id;
                btn3.classList.add("btn");
                btn3.classList.add("btn--radius-2");
                btn3.classList.add("btn--red");
                btn3.appendChild(document.createTextNode("Disapprove"));
                btn3.onclick = function () { statusSlot(this.id, "disapproved"); };
                td5.appendChild(btn3);
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                document.getElementById("pending_requests_table").appendChild(tr);
                i++;
            }
        },
        error: function () {
            document.getElementById("pending_requests_table").textContent = "No Records Found!";
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
            window.open("./pages/show-info.html");
        }
    });
};

function statusSlot(input1, input2) {

    var slotData = {
        "slot": {
            "status": input2
        }
    }

    $.ajax({
        type: "PUT",
        url: "http://localhost/vms/backend/public/slot/"+input1,
        data: JSON.stringify(slotData),
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
        success: function (response) {
            location.reload();
        }
    });

}
