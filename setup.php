<?php

use Glpi\Plugin\Hooks;

define('PLUGIN_CHATBOT_VERSION', '0.1.0');
// Minimal GLPI version, inclusive
define("PLUGIN_CHATBOT_MIN_GLPI", "10.0.10");
// Maximum GLPI version, exclusive
define("PLUGIN_CHATBOT_MAX_GLPI", "10.1.0");

/**
 * plugin_version_chatbot
 *
 * @return array
 */
function plugin_version_chatbot(): array
{
   return [
      'name'           => 'Chatbot',
      'version'        => PLUGIN_CHATBOT_VERSION,
      'author'         => '<a href="https://tic.gal">TICgal</a>',
      'homepage'       => 'https://tic.gal/en/project/actualtime-plugin-glpi/',
      'license'        => 'AGPLv3+',
      'requirements'   => [
         'glpi'   => [
            'min' => PLUGIN_CHATBOT_MIN_GLPI,
            'max' => PLUGIN_CHATBOT_MAX_GLPI,
         ]
      ]
   ];
}

/**
 * plugin_init_chatbot
 *
 * @return void
 */
function plugin_init_chatbot(): void {
   global $PLUGIN_HOOKS;

   $PLUGIN_HOOKS[Hooks::CSRF_COMPLIANT]['chatbot'] = true;

   // Cambiar la ruta al archivo PHP
   $PLUGIN_HOOKS[Hooks::ADD_JAVASCRIPT]['chatbot'] = 'public/chatbot.php';
}