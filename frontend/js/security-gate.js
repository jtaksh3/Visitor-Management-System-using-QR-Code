$("#upload_btn").click(function () {
    var form_data = new FormData();
    form_data.append("file", document.getElementById('image').files[0]);

    $.ajax({
        type: "POST",
        url: "https://api.qrserver.com/v1/read-qr-code/",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            var arr = response[0].symbol[0].data;
            const myArr = arr.split('.');

            token = myArr[0];
            visitor_id = myArr[1];
            host_id = myArr[2];

            window.open('http://localhost/vms/frontend/pages/visiting-card.html?token='+token+'&visitor_id='+visitor_id+'&host_id=' +host_id, '_blank');
        }
    });
});

window.history.forward();
function noBack() {
    window.history.forward();
}

