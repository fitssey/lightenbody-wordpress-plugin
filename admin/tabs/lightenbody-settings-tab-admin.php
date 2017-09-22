<?php

// grab all options
$options = get_option($this->plugin_name);

$scheduleDisplay = $options['schedule_display'] ?: 0;