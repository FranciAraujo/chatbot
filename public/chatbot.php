<?php
    include('../../../inc/includes.php');
?>

    function showChat() {
    // añadir al DOM un botón flotante
    // al pulsar el botón despliega un div que es el propio chat
    // el chat tiene un contenedor donde se ven las preguntas y respuestas
    // el chat tiene un formulario donde escribir las preguntas

  

    
    var button_zindex = 1000;
    var button_top = window.screen.height * 0.75;
    var button_right = window.screen.width * 0.05;

    var widget_zindex = button_zindex + 1;
    var widget_top = 340;
    var widget_right = 20;
    var widget_height = 500;

    var widget_chat_header = 50;
    var widget_chat_form = 50;
    var widget_chat = widget_height - widget_chat_header - widget_chat_form;

    var widget_button = '<button id="chatbot_btn" class="btn btn-primary"';
    widget_button += ' style="position:fixed; z-index: ' + button_zindex + ';';
    widget_button += ' top: ' + button_top + 'px; right: ' + button_right + 'px"';
    widget_button += ' data-bs-target="chatbot_container">';
    widget_button += 'Show chatbot</button>';

    var widget_form = `
        <input type="textarea" id="user-input" class="form-control" placeholder="<?php echo __('Write your message here...', 'chatbot') ?>">
        <div class="input-group-append">
            <input id="send-button" type="button" class="btn btn-primary" value="<?php echo __('Send') ?>">
        </div>
    `;

    var widget_chatbot = ` //LO QUE HE QUITADO DE AQUI: display: flex; justify-content: space-between; align-items: center; 
        <div id="chatbot_container" style="position:fixed; z-index:` + widget_zindex + `; top: ` + widget_top + `px; right:` + widget_right + `px; display: none; height: ` + widget_height + `px; width: 300px; border: 1px solid #ddd; background-color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            <div class="chat-header" style="height: ` + widget_chat_header + `px; background-color: #043765; color: white;  padding: 10px; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                <p>Chatbot<p> <!--quitar strong-->
                <button type="button" class="close" aria-label="Close" id="close_chatbot" style="background: none; border: none; font-size: 1.2rem; color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

           
                
            <div class="chat-box" id="chat-box" style="height: ` + widget_chat + `px; overflow-y: scroll; padding: 10px; border: 1px solid #ddd; background: #fff; word-break: break-all;" >
            
            <!--Apunta al css -->
            <link rel="stylesheet" type="text/css" href="<?php echo Plugin::getWebDir('chatbot') ?>/css/chatbot.css">

            </div>
            <div class="input-group p-2" style="height: ` + widget_chat_form + `px">
                ` + widget_form + `
            </div>
        </div>`;

    // Añadir botón y el chatbot en el DOM usando jQuery
    $('body').append(widget_button);
    $('body').append(widget_chatbot);

    $('#send-button').bind('click', () => {
        var userInput = $('#user-input').val();
        console.log(userInput);

        $.ajax({
            url: '<?php echo Plugin::getWebDir('chatbot') ?>/front/chatbot.form.php', // cambie la ruta por la ruta completa
            type: 'GET', //cambiado method por type.
            data: { question: userInput },
            success: function(data) {
                var chatBox = $('#chat-box');
                
                chatBox.append('<span class="chat-bubble chat-bubble-question badge px-4 py-1 text-wrap text-break word-break">' + userInput + '</span>');
                chatBox.append('<span class="chat-bubble chat-bubble-answer badge px-4 py-1 text-wrap text-break word-break bg-secondary">' + data + '</span>'); // cambiado data.respuesta por solo data
                


                chatBox.scrollTop(chatBox[0].scrollHeight);
                $('#user-input').val(''); // Limpiar el campo de entrada
            },
            error: function(xhr, status, error) {
                console.error('Error al comunicarse con el servidor:', error);
            }
        });
    });

    // Mostrar/Ocultar el chatbot al hacer clic en el botón
    $('#chatbot_btn').click(function() {
        $('#chatbot_container').toggle();
    });

    // Cerrar el chatbot cuando hace clic en la x
    $('#close_chatbot').click(function() {
        $('#chatbot_container').hide();
    });
}

if (window.location.href.match('front/central.php')) {
    showChat();
}



            
            