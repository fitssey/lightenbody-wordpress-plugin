<div class="wrap">
    <h1>lightenbody</h1>
    <div class="card">
        <h2>Settings</h2>
        <form method="post" name="cleanup_options" action="options.php">

            <?php
                settings_fields($this->plugin_name);
                do_settings_sections($this->plugin_name);
            ?>

            <label for="<?php echo $this->plugin_name; ?>-uuid">Your studio uuid</label>
            <input id="<?php echo $this->plugin_name; ?>-uuid" name="<?php echo $this->plugin_name; ?>[uuid]" type="text" value="<?php echo $uuid ?>">
            <br>
            <label for="<?php echo $this->plugin_name; ?>-api_guid">Your API Guid</label>
            <input id="<?php echo $this->plugin_name; ?>-api_guid" name="<?php echo $this->plugin_name; ?>[api_guid]" type="text" value="<?php echo $apiGuid ?>">
            <br>
            <label for="<?php echo $this->plugin_name; ?>-api_key">Your API Key</label>
            <input id="<?php echo $this->plugin_name; ?>-api_key" name="<?php echo $this->plugin_name; ?>[api_key]" type="text" value="<?php echo $apiKey ?>">
            <br>
            <label for="<?php echo $this->plugin_name; ?>-api_source">Your API Source</label>
            <input id="<?php echo $this->plugin_name; ?>-api_source" name="<?php echo $this->plugin_name; ?>[api_source]" type="text" value="<?php echo $apiSource ?>">
            <br>
            <p>Test connection: <?php echo $responseCode == 200 ? 'OK' : 'Authentication error'; ?></p>

            <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>
        </form>
    </div>
</div>