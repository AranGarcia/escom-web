$(document).ready(function(e){
    $("").submit(function(e){
        e.preventDefault();

        $.ajax({
            method : "post",
            url : "../php/upload_img.php",
            data : $("").serialize(),
            cache : false,

            success : function(resp){

            }
        });
    });
})