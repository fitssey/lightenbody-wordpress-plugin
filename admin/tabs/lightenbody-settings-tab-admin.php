<?php

// grab all options
$options = get_option($this->plugin_name);

$scheduleDisplay = $options['schedule_display'] ?: 0;
$weekDisplay = $options['week_display'] ?: 0;
$showTeacher = is_null($options['show_teacher']) ? true : $options['show_teacher'];
$showLevel = is_null($options['show_level']) ? true : $options['show_level'];
$showLocation = is_null($options['show_location']) ? true : $options['show_location'];

