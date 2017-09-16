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
            'start_date'    => (new \DateTime())->format('Y-m-d'),
            'end_date'      => (new \DateTime('+6 days'))->format('Y-m-d')
        ), $atts);

        $lightenbodyService = new LightenbodyService($uuid, $apiGuid, $apiKey, $apiSource);

        $result = $lightenbodyService
            ->post('/schedule', array(
                'startDate' => $atts['start_date'],
                'endDate'   => $atts['end_date'],
            ))
        ;

        $responseCode = $lightenbodyService->getResponseCode();

        if(200 === $responseCode)
        {
            $locale = $atts['locale'];
            $schedule = $result->schedule;
            $baseUrl = $lightenbodyService->getBaseUrl();
            ob_start();
            require_once 'views/lightenbody-public-view.php';
            $output = ob_get_contents();;
            ob_end_clean();

            return $output;
        }

        return 'Can\'t get the schedule. Please review your settings in Admin.';
    }
}
