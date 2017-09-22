<div class="card">
    <h2><span class="dashicons dashicons-admin-generic"></span>&nbsp;Translations</h2>
    <form method="post" name="cleanup_options" action="options.php">

		<?php
		settings_fields($this->plugin_name);
		do_settings_sections($this->plugin_name);
		?>
        <input type="hidden" name="<?php echo $this->plugin_name; ?>[option_tab]" value="translations">

        <?php foreach($translations as $key => $default): ?>
            <label for="<?php echo sprintf('%s-%s', $this->plugin_name, $key); ?>"><?php echo $default; ?></label>
            <input id="<?php echo sprintf('%s-%s', $this->plugin_name, $key); ?>" name="<?php echo sprintf('%s[%s]', $this->plugin_name, $key); ?>" type="text" value="<?php echo get_lightenbody_option($key, $default) ?>">
            <br>
        <?php endforeach; ?>
        <br>
        <br>
		<?php submit_button('Save', 'primary', 'submit', true); ?>
    </form>
</div>
