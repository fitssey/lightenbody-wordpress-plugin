<div class="card">
    <h2><span class="dashicons dashicons-admin-generic"></span>&nbsp;Settings</h2>
    <form method="post" name="cleanup_options" action="options.php">

		<?php
		settings_fields($this->plugin_name);
		do_settings_sections($this->plugin_name);
		?>
        <input type="hidden" name="<?php echo $this->plugin_name; ?>[option_tab]" value="settings">
        <label for="<?php echo $this->plugin_name; ?>-schedule_display">Schedule display</label>
        <select id="<?php echo $this->plugin_name; ?>-schedule_display" name="<?php echo $this->plugin_name; ?>[schedule_display]">
            <option value="agendaView" <?php if('agendaView' == get_lightenbody_option('schedule_display')): ?>selected<?php endif; ?>>Agenda</option>
            <option value="calendarView" <?php if('calendarView' == get_lightenbody_option('schedule_display')): ?>selected<?php endif; ?>>Calendar</option>
        </select>
	    <br>
	    <label for="<?php echo $this->plugin_name; ?>-week_display">Week display</label>
	    <select id="<?php echo $this->plugin_name; ?>-week_display" name="<?php echo $this->plugin_name; ?>[week_display]">
		    <option value="0" <?php if(0 == get_lightenbody_option('week_display')): ?>selected<?php endif; ?>>From today + 6 days</option>
		    <option value="1" <?php if(1 == get_lightenbody_option('week_display')): ?>selected<?php endif; ?>>From Monday till Sunday</option>
	    </select>
	    <br>
	    <label for="<?php echo $this->plugin_name; ?>-show_teacher">Show teacher</label>
	    <input id="<?php echo $this->plugin_name; ?>-show_teacher" name="<?php echo $this->plugin_name; ?>[show_teacher]" type="checkbox" <?php if(get_lightenbody_option('show_teacher', 1)): ?>checked<?php endif; ?>>
	    <br>
	    <label for="<?php echo $this->plugin_name; ?>-show_level">Show level</label>
	    <input id="<?php echo $this->plugin_name; ?>-show_level" name="<?php echo $this->plugin_name; ?>[show_level]" type="checkbox" <?php if(get_lightenbody_option('show_level', 1)): ?>checked<?php endif; ?>>
	    <br>
	    <label for="<?php echo $this->plugin_name; ?>-show_location">Show location</label>
	    <input id="<?php echo $this->plugin_name; ?>-show_location" name="<?php echo $this->plugin_name; ?>[show_location]" type="checkbox" <?php if(get_lightenbody_option('show_location', 1)): ?>checked<?php endif; ?>>
        <br>
        <label for="<?php echo $this->plugin_name; ?>-show_location">Show teacher's nickname</label>
        <input id="<?php echo $this->plugin_name; ?>-show_location" name="<?php echo $this->plugin_name; ?>[show_teacher_nickname]" type="checkbox" <?php if(get_lightenbody_option('show_teacher_nickname', 0)): ?>checked<?php endif; ?>>
        <br>
        <p>Delegate booking to:</p>
        <label for="<?php echo $this->plugin_name; ?>-popup">Popup</label>
        <input id="<?php echo $this->plugin_name; ?>-popup" name="<?php echo $this->plugin_name; ?>[delegate_booking_to]" type="radio" value="popup" <?php if('popup' == get_lightenbody_option('delegate_booking_to', 'popup')): ?>checked<?php endif; ?>>

        <label for="<?php echo $this->plugin_name; ?>-window">New window</label>
        <input id="<?php echo $this->plugin_name; ?>-window" name="<?php echo $this->plugin_name; ?>[delegate_booking_to]" type="radio" value="window" <?php if('window' == get_lightenbody_option('delegate_booking_to')): ?>checked<?php endif; ?>>

	    <br>
        <br>
		<?php submit_button('Save', 'primary', 'submit', true); ?>
    </form>
</div>
