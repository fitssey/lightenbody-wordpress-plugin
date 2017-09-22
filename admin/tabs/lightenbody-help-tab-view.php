<div class="card">
    <h2><span class="dashicons dashicons-admin-generic"></span>&nbsp;Help</h2>
    <div>lightenbody&trade; plugin version: 2.2.2</div>
    <div>PHP version: <?php echo phpversion(); ?></div>
    <a href="http://lightenbody.com/support" target="_blank">http://lightenbody.com/support</a>
    <h2><span class="dashicons dashicons-admin-generic"></span>&nbsp;WordPress shortcode API</h2>

    <div>Attribute: <code>locale</code></div>
    <span style="font-size: 10px;">Override default locale settings. Defaults to WordPress locale settings.</span><br>
    <span><em>Example:</em></span>
    <code>[lightenbody-schedule locale="pl_PL"]</code>

    <br><br><hr><br>
    <div>Attribute: <code>display</code></div>
    <span style="font-size: 10px;">Determines schedule template. Default template is agenda.</span>
    <ul style="list-style: square; margin-left: 25px;">
        <li>agenda</li>
        <li>calendar</li>
    </ul>
    <span><em>Example:</em></span>
    <code>[lightenbody-schedule display="agenda"]</code>
    <br><br><hr><br>

    <div>Attribute: <code>start_date</code></div>
    <span style="font-size: 10px;">Override default start date of the schedule.</span><br>
    <span><em>Example:</em></span>
    <code>[lightenbody-schedule start_date="2017-01-01"]</code>

    <br><br><hr><br>
    <div>Attribute: <code>end_date</code></div>
    <span style="font-size: 10px;">Override default end date of the schedule.</span><br>
    <span><em>Example:</em></span>
    <code>[lightenbody-schedule end_date="2017-01-6"]</code>
</div>
