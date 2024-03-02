$(document).ready(function(){
    $('#registroForm').submit(function(e){
        e.preventDefault(); // Prevenir el comportamiento por defecto del formulario
        
        // Obtener los datos del formulario
        var formData = $(this).serialize();
        
        // Enviar la solicitud AJAX
        $.ajax({
            type: 'POST',
            url: 'registrar.php',
            data: formData,
            success: function(response){
                $('#resultado').html(response); // Mostrar la respuesta del servidor en el div #resultado
            }
        });
    });
});
