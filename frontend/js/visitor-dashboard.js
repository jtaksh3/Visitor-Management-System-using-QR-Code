(function ($) {

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/user/isAuthorizedVisitor",
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
                btn.appendChild(document.createTextNode(response.data.slots[i].host_id));
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
                document.getElementById("requests_table").appendChild(tr);
                i++;
            }
        },
        error: function () {
            document.getElementById("requests_table").textContent = "No Records Found!";
        }
    });

    $.ajax({
        type: "GET",
        url: "http://localhost/vms/backend/public/user/?role=host",
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
                td1.appendChild(document.createTextNode(i + 1));
                let btn1 = document.createElement("BUTTON");
                btn1.style.color = "blue";
                btn1.classList.add("btn");
                btn1.appendChild(document.createTextNode(response.data.users[i].user_additional_details.full_name));
                btn1.id = response.data.users[i].id;
                btn1.onclick = function () { getUserDetails(this.id); };
                td2.appendChild(btn1);
                td3.appendChild(document.createTextNode(response.data.users[i].user_additional_details.designation));
                btn2 = document.createElement("BUTTON");
                btn2.id = response.data.users[i].id;
                btn2.classList.add("btn");
                btn2.classList.add("btn--radius-2");
                btn2.classList.add("btn--blue");
                btn2.appendChild(document.createTextNode("Book"));
                btn2.onclick = function () { bookSlot(this.id); };
                td4.appendChild(btn2);
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                document.getElementById("hosts_table").appendChild(tr);
                i++;
            }
        },
        error: function () {
            document.getElementById("hosts_table").textContent = "No Records Found!";
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

function bookSlot(input) {

    let timeSelect = document.getElementById("time");
    let time = timeSelect.options[timeSelect.selectedIndex].text;

    var dateVal = $("#date").val();
    var datearray = dateVal.split("/");
    dateVal = datearray[2] + "/" + datearray[1] + "/" + datearray[0];
    
    let dateTime = dateVal + " " + time + ":00";

    var slotData = {
        "slot": {
            "visitor_id": localStorage.getItem("id"),
            "host_id": input,
            "meeting_at": dateTime
        }
    }

    $.ajax({
        type: "POST",
        url: "http://localhost/vms/backend/public/slot",
        data: JSON.stringify(slotData),
        dataType: "json",
        headers: { "Authorization": localStorage.getItem("token") },
        success: function (response) {
            location.reload();
        }
    });

}
