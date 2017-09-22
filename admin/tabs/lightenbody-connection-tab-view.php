<div class="card">
    <h2><span class="dashicons dashicons-admin-generic"></span>&nbsp;Connection</h2>
    <form method="post" name="cleanup_options" action="options.php">

		<?php
		settings_fields($this->plugin_name);
		do_settings_sections($this->plugin_name);
		?>
        <input type="hidden" name="<?php echo $this->plugin_name; ?>[update]" value="connection">
        <label for="<?php echo $this->plugin_name; ?>-uuid">Your studio uuid</label>
        <input id="<?php echo $this->plugin_name; ?>-uuid" name="<?php echo $this->plugin_name; ?>[uuid]" type="text" value="<?php echo $uuid ?>">
        <br>
        <label for="<?php echo $this->plugin_name; ?>-api_source">Your API Source</label>
        <input id="<?php echo $this->plugin_name; ?>-api_source" name="<?php echo $this->plugin_name; ?>[api_source]" type="text" value="<?php echo $apiSource ?>">
        <br>
        <label for="<?php echo $this->plugin_name; ?>-api_guid">Your API Guid</label>
        <input id="<?php echo $this->plugin_name; ?>-api_guid" name="<?php echo $this->plugin_name; ?>[api_guid]" type="text" value="<?php echo $apiGuid ?>">
        <br>
        <label for="<?php echo $this->plugin_name; ?>-api_key">Your API Key</label>
        <input id="<?php echo $this->plugin_name; ?>-api_key" name="<?php echo $this->plugin_name; ?>[api_key]" type="text" value="<?php echo $apiKey ?>">
        <br>
        <br>
		<?php if($url): ?>
            <p>Url: <?php echo $url; ?></p>
		<?php endif; ?>
		<?php if(isset($error)): ?>
            <p>Error: <?php echo $error->getMessage(); ?></p>
		<?php else: ?>
            <p>Connection:&nbsp;
				<?php if(200 == $responseCode): ?>
                    OK (200)
				<?php elseif(404 == $responseCode): ?>
                    Not found (404)
				<?php elseif(403 == $responseCode): ?>
                    Not authenticated (403)
				<?php elseif(500 == $responseCode): ?>
                    Internal issues (500)
				<?php endif; ?>
            </p>
		<?php endif; ?>
		<?php submit_button('Save', 'primary', 'submit', true); ?>
    </form>
</div>
