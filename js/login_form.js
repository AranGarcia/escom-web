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
                /* 
                RESPUESTAS:
                0 : Usuario iniciado con éxito
                1 : Usuario bloqueado
                2 : Usuario/Contraseña incorrecto
                */
                if(resp == 0){
                    window.location = "http://localhost/alumno.php";
                }
                else if(resp == 1){
                    alert("Usuario bloqueado.");
                }
                else{
                    alert("Usuario y/o Contraseña incorrecto.");
                }
            }
        });
    });
});