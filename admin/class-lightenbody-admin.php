<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://lightenbody.pl
 * @since      1.0.0
 *
 * @package    Lightenbody
 * @subpackage Lightenbody/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Lightenbody
 * @subpackage Lightenbody/admin
 * @author     lightenbody <info@lightenbody.com>
 */
class Lightenbody_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Lightenbody_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Lightenbody_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/lightenbody-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Lightenbody_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Lightenbody_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lightenbody-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function add_plugin_admin_menu() {

		add_options_page('lightenbody / Settings', 'lightenbody', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'));
	}

	public function add_action_links( $links ) {
		$settings_link = array(
			'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
		);
		return array_merge(  $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function display_plugin_setup_page() {

		require_once __DIR__ . '/../api/LightenbodyService.php';

		//Grab all options
		$options = get_option($this->plugin_name);

		$uuid = $options['uuid'];
		$apiGuid = $options['api_guid'];
		$apiKey = $options['api_key'];
		$apiSource = $options['api_source'];

		$lightenbodyService = new LightenbodyService($uuid, $apiGuid, $apiKey, $apiSource);
		$result = $lightenbodyService
			->setIsDebug(WP_DEBUG)
			->testConnection();
		$responseCode = $lightenbodyService->getResponseCode();

		require_once 'partials/lightenbody-admin-display.php';
	}

	public function validate($input) {
		$valid = array();

		$valid['uuid'] = $input['uuid'];
		$valid['api_guid'] = $input['api_guid'];
		$valid['api_key'] = $input['api_key'];
		$valid['api_source'] = $input['api_source'];

		return $valid;
	}

	public function options_update() {
		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}
}
