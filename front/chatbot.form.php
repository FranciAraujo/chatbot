<?php

/**
 * Chatbot
 */

include('../../../inc/includes.php');

$plugin = new Plugin();
if (!$plugin->isInstalled('chatbot') || !$plugin->isActivated('chatbot')) {
    Html::displayNotFoundError();
}

if (isset($_GET['question'])) {
    $question = $_GET['question'];
    $answer = PluginChatbotChat::getAnswer($question);
    echo $answer;
    exit;
}
