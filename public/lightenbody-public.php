<?php

/**
 * Class Lightenbody_Public
 */
class Lightenbody_Public
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

        $uuid = get_lightenbody_option('uuid');
        $apiGuid = get_lightenbody_option('api_guid');
        $apiKey = get_lightenbody_option('api_key');
        $apiSource = get_lightenbody_option('api_source', 0);
        $scheduleDisplay = get_lightenbody_option('schedule_display', 0);
        $weekDisplay = get_lightenbody_option('week_display', 0);
        $showTeacher = get_lightenbody_option('show_teacher', 1);
        $showLevel = get_lightenbody_option('show_level', 1);
        $showLocation = get_lightenbody_option('show_location', 1);

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

        $scheduleDisplay = $this->parse_schedule_display($atts['display']);

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

    private function parse_schedule_display($value)
    {
        if('agenda' === $value) return 0;
        if('calendar' === $value) return 1;

        return $value;
    }
}
