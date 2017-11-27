$(document).ready(function(e){
    $("#loader").hide();
    $("#form_login").submit(function(e){
        e.preventDefault();
        $("#loader").show();
        
        // Solicitud
        $.ajax({
            method: "post",
            url: "login_action.php",
            data: $("#form_login").serialize(),
            cache: false,
            // Repuesta con éxito
            success: function(resp){
                $("#loader").hide();
                console.log(resp);
                console.log(resp == 1);
                if(resp == 1){
                    window.location = "php/ok.php";
                }
                else{
                    alert("Usuario y/o Contraseña inválido.");
                }
            }
        });
    });
});