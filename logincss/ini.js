$(document).on("ready",function(){
    login();    
})

var login = function(){
    $("#frm_login").on("submit",function(e){
        e.preventDefault();
        var frm = $(this).serialize();
        $("#load").addClass('block-loading');

        $.ajax({
            method:"POST",
            url: "./controllers/authentication.php",
            data: frm
        }).done(function(r){
            var resp = JSON.parse(r);
            $("#load").removeClass('block-loading');
            $("#pass").val("");
            if (resp.message != null) {
                    if (resp.message.length > 0) {
                        msj_show(resp.message);
                    }
                }

            if (resp.href != null) {
                    if (resp.href == 'self') window.location.reload(true);
                    else location.href = resp.href;
                }

        });
    });
}

var msj_show = function(info){
     $('#load').append('<div id="alertdiv" class="alert-danger"><a class="close" data-dismiss="alert"></a><span style="color: #F75831;">'+ info +'</span></div>')
    setTimeout(function() { 
      $("#alertdiv").remove();
    }, 5000);
    $("#pass").focus();
}


jQuery.fn.reset = function () {
    $("input:password,input:file,input:text,textarea", $(this)).val('');
    $("input:checkbox:checked", $(this)).click();
    $("select", $(this)).val(0);
};