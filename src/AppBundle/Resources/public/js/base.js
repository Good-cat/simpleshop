function ajax() { //Ajax отправка формы
    var msg = $("#call_me_form").serialize();
    $.ajax({
        type: "POST",
        url: "/app_dev.php/callme",
        data: msg,
        success: function(data) {
            $("#results").html(data);
        },
        error:  function(xhr, str){
            alert("Возникла ошибка!");
        }
    });
}
