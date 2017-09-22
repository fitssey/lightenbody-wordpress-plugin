<div class="card">
    <h2><span class="dashicons dashicons-admin-generic"></span>&nbsp;Settings</h2>
    <form method="post" name="cleanup_options" action="options.php">

		<?php
		settings_fields($this->plugin_name);
		do_settings_sections($this->plugin_name);
		?>
        <input type="hidden" name="<?php echo $this->plugin_name; ?>[update]" value="settings">
        <label for="<?php echo $this->plugin_name; ?>-schedule_display">Schedule display</label>
        <select id="<?php echo $this->plugin_name; ?>-schedule_display" name="<?php echo $this->plugin_name; ?>[schedule_display]">
            <option value="0" <?php if(0 == $scheduleDisplay): ?>selected<?php endif; ?>>Agenda</option>
            <option value="1" <?php if(1 == $scheduleDisplay): ?>selected<?php endif; ?>>Calendar</option>
        </select>
	    <br>
	    <label for="<?php echo $this->plugin_name; ?>-week_display">Week display</label>
	    <select id="<?php echo $this->plugin_name; ?>-week_display" name="<?php echo $this->plugin_name; ?>[week_display]">
		    <option value="0" <?php if(0 == $weekDisplay): ?>selected<?php endif; ?>>From today + 6 days</option>
		    <option value="1" <?php if(1 == $weekDisplay): ?>selected<?php endif; ?>>From Monday till Sunday</option>
	    </select>
	    <br>
	    <label for="<?php echo $this->plugin_name; ?>-show_teacher">Show teacher</label>
	    <input id="<?php echo $this->plugin_name; ?>-show_teacher" name="<?php echo $this->plugin_name; ?>[show_teacher]" type="checkbox" <?php if($showTeacher): ?>checked<?php endif; ?>>
	    <br>
	    <label for="<?php echo $this->plugin_name; ?>-show_level">Show level</label>
	    <input id="<?php echo $this->plugin_name; ?>-show_level" name="<?php echo $this->plugin_name; ?>[show_level]" type="checkbox" <?php if($showLevel): ?>checked<?php endif; ?>>
	    <br>
	    <label for="<?php echo $this->plugin_name; ?>-show_location">Show location</label>
	    <input id="<?php echo $this->plugin_name; ?>-show_location" name="<?php echo $this->plugin_name; ?>[show_location]" type="checkbox" <?php if($showLocation): ?>checked<?php endif; ?>>

	    <br>
        <br>
		<?php submit_button('Save', 'primary', 'submit', true); ?>
    </form>
</div>
