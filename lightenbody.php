<?php

/**
 * @wordpress-plugin
 * Plugin Name:       lightenbody&trade;
 * Plugin URI:        http://lightenbody.com
 * Description:       This plugin connects with lightenbody's api and enables you to display the schedule.
 * Version:           2.2.2
 * Author:            lightenbody
 * Author URI:        http://lightenbody.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       lightenbody
 */

// If this file is called directly, abort.
if (!defined('WPINC')) die;

function get_lightenbody_option($key, $default = null)
{
    $options = get_option('lightenbody');

    return isset($options[$key]) ? $options[$key] : $default;
}

function activate_lightenbody()
{
	require_once plugin_dir_path( __FILE__ ) . 'includes/lightenbody-activator.php';
	Lightenbody_Activator::activate();
}

function deactivate_lightenbody()
{
	require_once plugin_dir_path( __FILE__ ) . 'includes/lightenbody-deactivator.php';
	Lightenbody_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_lightenbody');
register_deactivation_hook(__FILE__, 'deactivate_lightenbody');

require plugin_dir_path(__FILE__ ) . 'includes/lightenbody.php';

function bootstrap()
{
	$plugin = new Lightenbody();
	$plugin->bootstrap();
}

bootstrap();
