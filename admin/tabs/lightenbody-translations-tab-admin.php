<?php

// grab all options
$options = get_option($this->plugin_name);

$timeTranslation = $options['time_translation'] ?: 'Time';
$classTranslation = $options['class_translation'] ?: 'Class';
$teacherTranslation = $options['teacher_translation'] ?: 'Teacher';
$levelTranslation = $options['level_translation'] ?: 'Level';
$locationTranslation = $options['location_translation'] ?: 'Location';
$noClassesTodayTranslation = $options['no_classes_today_translation'] ?: 'No classes today.';
$bookNowTranslation = $options['book_now_translation'] ?: 'Book now';
$classEndedTranslation = $options['class_ended_translation'] ?: 'Class ended';
$classCancelledTranslation = $options['class_cancelled_translation'] ?: 'Class cancelled';
$noPublicScheduleTranslation = $options['no_public_schedule_translation'] ?: 'No public schedule.';