

<?php
include "../../../inc/includes.php"; ?>

    function showChat() {
    
    
    
    

  

    
    var button_zindex = 1000;
    var button_top = window.screen.height * 0.75;
    var button_right = window.screen.width * 0.05;

    var widget_zindex = button_zindex + 1;
    var widget_top = 340;
    var widget_right = 20;
    var widget_height = 500;

    var widget_chat_header = 50;

    var widget_button = '<button id="chatbot_btn" class="btn btn-primary"';
    widget_button += ' style="position:fixed; z-index: ' + button_zindex + ';';
    widget_button += ' top: ' + button_top + 'px; right: ' + button_right + 'px"';
    widget_button += ' data-bs-target="chatbot_container">';
    widget_button += 'Show chatbot</button>';

    var widget_form = `
        <textarea id="user-input" class="form-control" placeholder="<?php echo __(
            "Write your message here...",
            "chatbot"
        ); ?>"></textarea>
        <div class="input-group-append">
            <input id="send-button" type="button" class="btn btn-primary" value="<?php echo __(
                "Send"
            ); ?>">
        </div>
    `;

    var widget_chatbot = `    
        <div id="chatbot_container" style="position:fixed; z-index:` + widget_zindex + `; top: ` + widget_top + `px; right:` + widget_right + `px; display: none; height: ` + widget_height + `px; width: 300px; border: 1px solid #ddd; background-color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            <div class="chat-header" style="height: ` + widget_chat_header + `px; background-color: #043765; color: white;  padding: 10px; border-top-left-radius: 10px; border-top-right-radius: 10px;"> 
                <p>Chatbot<p> 
                <button type="button" class="close" aria-label="Close" id="close_chatbot" style="background: none; border: none; font-size: 1.2rem; color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

           
                
            <div class="chat-box" id="chat-box" style="overflow-y: scroll; padding: 10px; border: 1px solid #ddd; background: #fff; word-break: break-all;" >
            
            
            <link rel="stylesheet" type="text/css" href="<?php echo Plugin::getWebDir(
                "chatbot"
            ); ?>/css/chatbot.css">

            </div>
            <div class="input-group p-2">
                ` + widget_form + `
            </div>
        </div>`;

    
    $('body').append(widget_button);
    $('body').append(widget_chatbot);

    $('#send-button').bind('click', () => {
        var userInput = $('#user-input').val();
        console.log(userInput);

        $.ajax({
            url: '<?php echo Plugin::getWebDir(
                "chatbot"
            ); ?>/front/chatbot.form.php', 
            type: 'GET', 
            data: { question: userInput },
            success: function(data) {
                var chatBox = $('#chat-box');
                
                chatBox.append('<span class="chat-bubble chat-bubble-question badge px-4 py-1 text-wrap text-break word-break">' + userInput + '</span>');
                chatBox.append('<span class="chat-bubble chat-bubble-answer badge px-4 py-1 text-wrap text-break word-break bg-secondary">' + data + '</span>'); 
                


                chatBox.scrollTop(chatBox[0].scrollHeight);
                $('#user-input').val(''); 
            },
            error: function(xhr, status, error) {
                console.error('Error al comunicarse con el servidor:', error);
            }
        });
    });

    
    $('#chatbot_btn').click(function() {
        $('#chatbot_container').toggle();
    });

    
    $('#close_chatbot').click(function() {
        $('#chatbot_container').hide();
    });
}

if (window.location.href.match('front/central.php')) {
    showChat();
}
  