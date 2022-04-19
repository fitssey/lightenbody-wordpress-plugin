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

        $tab = isset($_GET['tab']) ? $_GET['tab'] : 'connection';
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
            $options = !is_array(get_option($this->plugin_name)) ? array() : get_option($this->plugin_name);

            switch($input['option_tab'])
            {
                case 'connection':
                    $options['uuid'] = $input['uuid'];
                    $options['api_guid'] = $input['api_guid'];
                    $options['api_key'] = $input['api_key'];
                    $options['api_source'] = $input['api_source'];
                    break;
                case 'settings':
                    $options['schedule_display'] = $input['schedule_display'];
                    $options['week_display'] = $input['week_display'];
                    $options['show_teacher'] = isset($input['show_teacher']) ? true : false;
                    $options['show_level'] = isset($input['show_level']) ? true : false;
                    $options['show_location'] = isset($input['show_location']) ? true : false;
                    $options['show_teacher_nickname'] = isset($input['show_teacher_nickname']) ? true : false;
                    $options['delegate_booking_to'] = $input['delegate_booking_to'];
                    break;
                case 'translations':
                    $options['trans_time'] = $input['trans_time'];
                    $options['trans_class'] = $input['trans_class'];
                    $options['trans_teacher'] = $input['trans_teacher'];
                    $options['trans_level'] = $input['trans_level'];
                    $options['trans_location'] = $input['trans_location'];
                    $options['trans_no_classes_today'] = $input['trans_no_classes_today'];
                    $options['trans_book_now'] = $input['trans_book_now'];
                    $options['trans_class_completed'] = $input['trans_class_completed'];
                    $options['trans_class_cancelled'] = $input['trans_class_cancelled'];
                    $options['trans_no_public_schedule'] = $input['trans_no_public_schedule'];
                    $options['trans_morning'] = $input['trans_morning'];
                    $options['trans_afternoon'] = $input['trans_afternoon'];
                    $options['trans_evening'] = $input['trans_evening'];
                    break;
            }

            return $options;
        });
    }
}
