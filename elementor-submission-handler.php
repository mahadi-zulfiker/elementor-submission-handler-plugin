<?php
/** 
 * Plugin Name: Elementor Submission Handler
 * Description: Handles Elementor form submissions, stores data in a custom table, and manages approval for frontend display.
 * Version: 1.0
 * Author: Amitav Roy Chowdhury
 */
if (!defined('ABSPATH')) {
    exit;
}
if (!defined('WP_DEBUG')) {
    define('WP_DEBUG', false);
}

if (WP_DEBUG === false) {
    @ini_set('display_errors', 0);
    @ini_set('log_errors', 0);
}


define('ESH_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ESH_PLUGIN_URI', plugin_dir_url(__FILE__));

require_once ESH_PLUGIN_DIR . 'includes/class-esh-db.php';
require_once ESH_PLUGIN_DIR . 'includes/class-esh-admin.php';
require_once ESH_PLUGIN_DIR . 'includes/class-esh-frontend.php';
require_once ESH_PLUGIN_DIR . 'includes/class-esh-form-handler.php';

function esh_init_plugin()
{
    new ESH_Admin();
    new ESH_Frontend();
    new ESH_Form_Handler();
}
add_action('plugins_loaded', 'esh_init_plugin');

register_activation_hook(__FILE__, ['ESH_DB', 'create_table']);
register_uninstall_hook(__FILE__, 'esh_uninstall_plugin');

function esh_uninstall_plugin()
{
    ESH_DB::delete_table();
}

?>