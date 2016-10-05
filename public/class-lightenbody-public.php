<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://lightenbody.pl
 * @since      1.0.0
 *
 * @package    Lightenbody
 * @subpackage Lightenbody/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Lightenbody
 * @subpackage Lightenbody/public
 * @author     lightenbody <info@lightenbody.com>
 */
class Lightenbody_Public {

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

	private $options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->options = get_option($this->plugin_name);

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style('magnific-popup', plugin_dir_url(__FILE__) . 'css/vendor/magnific-popup.css', array(), $this->version, 'all');
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/lightenbody-public.css', array(), $this->version, 'all');

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script('magnific-popup', plugin_dir_url(__FILE__) . 'js/vendor/jquery.magnific-popup.min.js', array('jquery'), $this->version, false);
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/lightenbody-public.js', array('jquery'), $this->version, true);
	}

	public function register_shortcodes()
	{
		add_shortcode('lightenbody-schedule', array($this, 'get_lightenbody_schedule'));
	}

	/**
	 * @param array $atts
	 * @return string
	 */
	public function get_lightenbody_schedule($atts)
	{
		require_once __DIR__ . '/../api/LightenbodyService.php';

		// core objects
		$options = get_option($this->plugin_name);

		$uuid = $options['uuid'];
		$apiGuid = $options['api_guid'];
		$apiKey = $options['api_key'];
		$apiSource = $options['api_source'];

        // provide short code default parameters
        $atts = shortcode_atts(array(
            'locale'        => get_locale(),
            'start_date'    => new \DateTime(),
            'end_date'      => new \DateTime('+6 days')
        ), $atts);

		$lightenbodyService = new LightenbodyService($uuid, $apiGuid, $apiKey, $apiSource);
		$result = $lightenbodyService
			->setIsDebug(WP_DEBUG)
			->getSchedule($atts['start_date'], $atts['end_date'])
		;
		$responseCode = $lightenbodyService->getResponseCode();

		if(200 === $responseCode)
		{
			$locale = $atts['locale'];
			$schedule = $result->schedule;
			$host = $lightenbodyService->getHost();

			ob_start();
			require_once 'partials/lightenbody-public-display.php';
			$output = ob_get_contents();;
			ob_end_clean();

			return $output;
		}

		return 'Can\'t get the schedule. Please review your settings in Admin.';
	}
}
