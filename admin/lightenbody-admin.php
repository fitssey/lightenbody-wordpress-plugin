<?php

/**
 * Class Lightenbody_Admin
 */
class Lightenbody_Admin
{
	private $plugin_name;
	private $version;

	public function __construct($plugin_name, $version)
    {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	public function enqueue_styles()
    {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/lightenbody-admin.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts()
    {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lightenbody-admin.js', array( 'jquery' ), $this->version, false );
	}

	public function add_plugin_admin_menu()
    {
		add_options_page('lightenbody / Settings', 'lightenbody', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'));
	}

	public function add_action_links($links)
    {
		$settings_link = array(
			'<a href="' . admin_url('options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
		);
		return array_merge(  $settings_link, $links );
	}

	public function display_plugin_setup_page()
    {
		require_once __DIR__ . '/../api/LightenbodyService.php';

		// grab all options
		$options = get_option($this->plugin_name);

		$uuid = $options['uuid'];
		$apiGuid = $options['api_guid'];
		$apiKey = $options['api_key'];
		$apiSource = $options['api_source'];

		$lightenbodyService = new LightenbodyService($uuid, $apiGuid, $apiKey, $apiSource);

        try
        {
            $result = $lightenbodyService
                ->get('/test')
            ;

            $url = $lightenbodyService->getApiUrl();
            $responseCode = $lightenbodyService->getResponseCode();
        }
        catch(\Exception $error)
        {

        }

		require_once 'views/lightenbody-admin-view.php';
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
