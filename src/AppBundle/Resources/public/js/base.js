$(document).ready(function(){
        $('body').on('submit', 'form[name=call_me_form]', function(){
            $.ajax({
                type: "POST",
                url: "/callme",
                data: $(this).serialize(),
                success: function(data) {
                    $("#callme_results").html(data);
                },
                error:  function(xhr, str){
                    alert("Возникла ошибка!");
                }
            });
        });
    }
);

