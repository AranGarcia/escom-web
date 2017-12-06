$(document).ready(function(e){
    //Formulario del login
    $("#form_login").submit(function(e){
        e.preventDefault();

        // Solicitud
        $.ajax({
            method: "post",
            url: "../php/login_action.php",
            data: $("#form_login").serialize(),
            cache: false,
            // Repuesta con éxito
            success: function(resp){
                if(resp == 0){
                    window.location = "../php/alumno.php";
                }
                else{
                    alert("Usuario y/o Contraseña inválido.");
                }
            }
        });
    });
});