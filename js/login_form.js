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
                0 : Alumno iniciado con éxito
                1 : Usuario bloqueado
                2 : Usuario/Contraseña incorrecto
                3 : Admin iniciado con éxito
                */
                if(resp == 0){
                    window.location = "http://localhost/alumno.php";
                }
                else if(resp == 1){
                    alert("Usuario bloqueado.");
                }
                else if(resp == 3){
                    window.location = "http://localhost/adminE.php";
                }
                else{
                    alert("Usuario y/o Contraseña incorrecto.");
                }
            }
        });
    });
});