<?php

/**
 * Class Lightenbody_Public
 */
class Lightenbody_Public
{
	private $plugin_name;
	private $version;
	private $options;

	public function __construct($plugin_name, $version)
	{
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->options = get_option($this->plugin_name);
	}

	public function enqueue_styles()
	{
		wp_enqueue_style('magnific-popup', plugin_dir_url(__FILE__) . 'css/vendor/magnific-popup.css', array(), $this->version, 'all');
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/lightenbody-public.css', array(), $this->version, 'all');
	}

	public function enqueue_scripts()
	{
		wp_enqueue_script('magnific-popup', plugin_dir_url(__FILE__) . 'js/vendor/jquery.magnific-popup.min.js', array('jquery'), $this->version, false);
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/lightenbody-public.js', array('jquery'), $this->version, true);
	}

	public function register_shortcodes()
	{
		add_shortcode('lightenbody-schedule', array($this, 'get_lightenbody_schedule'));
	}

	public function get_lightenbody_schedule($shortCode)
	{
		require_once __DIR__ . '/../api/LightenbodyService.php';

		// retrieve options
		$options = get_option($this->plugin_name);

		$uuid = $options['uuid'];
		$apiGuid = $options['api_guid'];
		$apiKey = $options['api_key'];
		$apiSource = $options['api_source'];
		$scheduleDisplay = $options['schedule_display'];
		$weekDisplay = $options['week_display'];

		switch($weekDisplay)
		{
			// from today + 6 days
			default:
			case 0:
				$startDate = (new \DateTime())->format('Y-m-d');
				$endDate = (new \DateTime('+6 days'))->format('Y-m-d');
				break;
			// from Monday till Sunday
			case 1:
				$startDate = (new \DateTime('monday this week'))->format('Y-m-d');
				$endDate = (new \DateTime('sunday this week'))->format('Y-m-d');
				break;
		}

		// provide short code default parameters
		$atts = shortcode_atts(array(
			'locale'        => get_locale(),
			'start_date'    => $startDate,
			'end_date'      => $endDate,
			'display'       => $scheduleDisplay
		), $shortCode);

		$scheduleDisplay = $this->getScheduleDisplay($atts['display']);

		// core objects
		$lightenbodyService = new LightenbodyService($uuid, $apiGuid, $apiKey, $apiSource);

		// let's make a call
		$lightenbodyService
			->post('/schedule', array(
				'startDate' => $atts['start_date'],
				'endDate'   => $atts['end_date'],
				'view'      => $scheduleDisplay
			))
		;

		$responseCode = $lightenbodyService->getResponseCode();
		$response = $lightenbodyService->getResponse();
		$locale = $atts['locale'];
		$schedule = isset($response->schedule) ? $response->schedule : null;
		$hasMorningSchedule = isset($response->hasMorningSchedule) ? $response->hasMorningSchedule : false;
		$hasAfternoonSchedule = isset($response->hasAfternoonSchedule) ? $response->hasAfternoonSchedule : false;
		$hasEveningSchedule = isset($response->hasEveningSchedule) ? $response->hasEveningSchedule : false;
		$baseUrl = $lightenbodyService->getBaseUrl();

		if(200 === $responseCode)
		{
			switch($scheduleDisplay)
			{
				default:
				case	 0:
					$template = 'views/lightenbody-schedule-agenda-view.php';
					break;
				case 1:
					$template = 'views/lightenbody-schedule-calendar-view.php';
					break;
			}

			ob_start();
			require_once $template;
			$output = ob_get_contents();
			ob_end_clean();

			return $output;
		}

		return null;
	}

	private function getScheduleDisplay($value)
	{
		if('agenda' === $value) return 0;
		if('calendar' === $value) return 1;

		return $value;
	}
}
