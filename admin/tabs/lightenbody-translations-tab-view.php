<div class="card">
    <h2><span class="dashicons dashicons-admin-generic"></span>&nbsp;Translations</h2>
    <form method="post" name="cleanup_options" action="options.php">

		<?php
		settings_fields($this->plugin_name);
		do_settings_sections($this->plugin_name);
		?>

        <label for="<?php echo $this->plugin_name; ?>-time_translation">Time</label>
        <input id="<?php echo $this->plugin_name; ?>-time_translation" name="<?php echo $this->plugin_name; ?>[time_translation]" type="text" value="<?php echo $timeTranslation ?>">
        <br>
        <label for="<?php echo $this->plugin_name; ?>-class_translation">Class</label>
        <input id="<?php echo $this->plugin_name; ?>-class_translation" name="<?php echo $this->plugin_name; ?>[class_translation]" type="text" value="<?php echo $classTranslation ?>">
        <br>
        <label for="<?php echo $this->plugin_name; ?>-teacher_translation">Teacher</label>
        <input id="<?php echo $this->plugin_name; ?>-teacher_translation" name="<?php echo $this->plugin_name; ?>[teacher_translation]" type="text" value="<?php echo $teacherTranslation ?>">
        <br>
        <label for="<?php echo $this->plugin_name; ?>-level_translation">Level</label>
        <input id="<?php echo $this->plugin_name; ?>-level_translation" name="<?php echo $this->plugin_name; ?>[level_translation]" type="text" value="<?php echo $levelTranslation ?>">
        <br>
        <label for="<?php echo $this->plugin_name; ?>-location_translation">Location</label>
        <input id="<?php echo $this->plugin_name; ?>-location_translation" name="<?php echo $this->plugin_name; ?>[location_translation]" type="text" value="<?php echo $locationTranslation ?>">
        <br>
        <label for="<?php echo $this->plugin_name; ?>-no_classes_today_translation">No classes today</label>
        <input id="<?php echo $this->plugin_name; ?>-no_classes_today_translation" name="<?php echo $this->plugin_name; ?>[no_classes_today_translation]" type="text" value="<?php echo $noClassesTodayTranslation ?>">
        <br>
        <label for="<?php echo $this->plugin_name; ?>-no_public_schedule_translation">No public schedule</label>
        <input id="<?php echo $this->plugin_name; ?>-no_public_schedule_translation" name="<?php echo $this->plugin_name; ?>[no_public_schedule_translation]" type="text" value="<?php echo $noPublicScheduleTranslation ?>">
        <br>
        <label for="<?php echo $this->plugin_name; ?>-book_now_translation">Book now</label>
        <input id="<?php echo $this->plugin_name; ?>-book_now_translation" name="<?php echo $this->plugin_name; ?>[book_now_translation]" type="text" value="<?php echo $bookNowTranslation ?>">
        <br>
        <label for="<?php echo $this->plugin_name; ?>-class_ended_translation">Class ended</label>
        <input id="<?php echo $this->plugin_name; ?>-class_ended_translation" name="<?php echo $this->plugin_name; ?>[class_ended_translation]" type="text" value="<?php echo $classEndedTranslation ?>">
        <br>
        <label for="<?php echo $this->plugin_name; ?>-class_cancelled_translation">Class cancelled</label>
        <input id="<?php echo $this->plugin_name; ?>-class_cancelled_translation" name="<?php echo $this->plugin_name; ?>[class_cancelled_translation]" type="text" value="<?php echo $classCancelledTranslation ?>">
        <br>
        <br>
		<?php submit_button('Save', 'primary', 'submit', true); ?>
    </form>
</div>