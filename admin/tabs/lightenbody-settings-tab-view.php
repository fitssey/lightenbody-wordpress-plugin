<div class="card">
    <h2><span class="dashicons dashicons-admin-generic"></span>&nbsp;Settings</h2>
    <form method="post" name="cleanup_options" action="options.php">

		<?php
		settings_fields($this->plugin_name);
		do_settings_sections($this->plugin_name);
		?>

        <label for="<?php echo $this->plugin_name; ?>-schedule_display">Schedule display</label>
        <select id="<?php echo $this->plugin_name; ?>-schedule_display" name="<?php echo $this->plugin_name; ?>[schedule_display]">
            <option value="0" <?php if(0 == $scheduleDisplay): ?>selected<?php endif; ?>>Agenda</option>
            <option value="1" <?php if(1 == $scheduleDisplay): ?>selected<?php endif; ?>>Calendar</option>
        </select>
        <br>
        <br>
		<?php submit_button('Save', 'primary', 'submit', true); ?>
    </form>
</div>