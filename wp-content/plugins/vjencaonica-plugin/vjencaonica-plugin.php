<?php
/*
 * Plugin Name: Vjencaonica Plugin
 * Version: 1.0
 * Description: vjencaonica custom plugin
 * Author: Ivan Situm
 * Text Domain: vjencaonica-plugin
 */

 
function activate_vjencaonica_plugin(){
    require_once plugin_dir_path(__FILE__).'includes/class-vjencaonicaplugin-activator.php';
    \Vjencaonica\VjencaonicaPlugin_Activator::activate();
}

function deactivate_vjencaonica_plugin(){
    require_once plugin_dir_path(__FILE__).'includes/class-vjencaonicaplugin-deactivator.php';
    \Vjencaonica\VjencaonicaPlugin_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_vjencaonica_plugin');
register_deactivation_hook(__FILE__, 'deactivate_vjencaonica_plugin');

require plugin_dir_path(__FILE__).'includes/class-vjencaonicaplugin.php';

function run_vjencaonica_plugin(){
    $plugin = new \Vjencaonica\VjencaonicaPlugin();
    $plugin->run();

}

run_vjencaonica_plugin();