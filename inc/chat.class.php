<?php

/*
*/

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access directly to this file");
}

class PluginChatbotChat extends CommonDBTM
{
    /**
     * getAnswer
     *
     * @param  mixed $question
     * @return string
     */
    public static function getAnswer($question): string
    {
        $answers = [
            'This is an answer.',
            'Today is a good day.',
            'I am a chatbot.',
            'I will dominate the world.',
        ];
        // random 0 to array size - 1
        $random = rand(0, count($answers) - 1);
        return $answers[$random];
    }
}
