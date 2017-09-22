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
		return array_merge($settings_link, $links);
	}

	public function display_plugin_setup_page()
	{
		require_once __DIR__ . '/../api/LightenbodyService.php';

		$tab = $_GET['tab'];
		$allowedTabs = array('connection', 'settings', 'translations', 'help');

		if(!in_array($tab, $allowedTabs)) $tab = $allowedTabs[0];

		@require_once __DIR__ . "/tabs/lightenbody-$tab-tab-admin.php";
		ob_start();
		@require_once __DIR__ . "/tabs/lightenbody-$tab-tab-view.php";
		$view = ob_get_clean();

		require_once 'views/lightenbody-admin-view.php';
	}

	public function settings_update()
	{
		register_setting($this->plugin_name, $this->plugin_name, function($input) {
			$options = get_option($this->plugin_name);

			if(isset($input['uuid'])) $options['uuid'] = $input['uuid'];
			if(isset($input['api_guid'])) $options['api_guid'] = $input['api_guid'];
			if(isset($input['api_key'])) $options['api_key'] = $input['api_key'];
			if(isset($input['api_source'])) $options['api_source'] = $input['api_source'];

			if(isset($input['schedule_display'])) $options['schedule_display'] = $input['schedule_display'];

			if(isset($input['time_translation'])) $options['time_translation'] = $input['time_translation'];
			if(isset($input['class_translation'])) $options['class_translation'] = $input['class_translation'];
			if(isset($input['teacher_translation'])) $options['teacher_translation'] = $input['teacher_translation'];
			if(isset($input['level_translation'])) $options['level_translation'] = $input['level_translation'];
			if(isset($input['location_translation'])) $options['location_translation'] = $input['location_translation'];
			if(isset($input['no_classes_today_translation'])) $options['no_classes_today_translation'] = $input['no_classes_today_translation'];
			if(isset($input['book_now_translation'])) $options['book_now_translation'] = $input['book_now_translation'];
			if(isset($input['class_ended_translation'])) $options['class_ended_translation'] = $input['class_ended_translation'];
			if(isset($input['class_cancelled_translation'])) $options['class_cancelled_translation'] = $input['class_cancelled_translation'];
			if(isset($input['no_public_schedule_translation'])) $options['no_public_schedule_translation'] = $input['no_public_schedule_translation'];

			return $options;
		});
	}
}
