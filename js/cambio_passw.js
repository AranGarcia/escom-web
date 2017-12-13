$(document).ready(function(e){
    $("#form_cambiar_contrasena").submit(function(e){
        e.preventDefault();

        // Solicitud
        $.ajax({
            method: "post",
            url: "../php/cambio_passw.php",
            data: $("#form_cambiar_contrasena").serialize(),
            cache: false,
            // Repuesta con éxito
            success: function(resp){
                if(resp == true){
                    alert("Contrasena cambiada.");
                }
                else{
                    alert("No se pudo cambiar la contrasena.");
                }
            }
        });
    });
});