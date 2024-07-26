<?php

/**
 * plugin_chatbot_install
 *
 * @return bool
 */
function plugin_chatbot_install(): bool
{
   $migration = new Migration(PLUGIN_CHATBOT_VERSION);

   // Parse inc directory
   foreach (glob(__DIR__ . '/inc/*') as $filepath) {
      // Load *.class.php files and get the class name
      if (preg_match("/inc.(.+)\.class.php/", $filepath, $matches)) {
         $classname = 'PluginChatbot' . ucfirst($matches[1]);
         include_once($filepath);
         // If the install method exists, load it
         if (method_exists($classname, 'install')) {
            $classname::install($migration);
         }
      }
   }

   // Execute the whole migration
   $migration->executeMigration();

   return true;
}

/**
 * plugin_chatbot_uninstall
 *
 * @return bool
 */
function plugin_chatbot_uninstall(): bool
{
   $migration = new Migration(PLUGIN_CHATBOT_VERSION);

   // Parse inc directory
   foreach (glob(__DIR__ . '/inc/*') as $filepath) {
      // Load *.class.php files and get the class name
      if (preg_match("/inc.(.+)\.class.php/", $filepath, $matches)) {
         $classname = 'PluginChatbot' . ucfirst($matches[1]);
         include_once($filepath);
         // If the install method exists, load it
         if (method_exists($classname, 'uninstall')) {
            $classname::uninstall($migration);
         }
      }
   }

   // Execute the whole migration
   $migration->executeMigration();

   return true;
}
