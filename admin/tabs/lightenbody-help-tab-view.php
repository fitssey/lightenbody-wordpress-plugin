<div class="card">
    <h2><span class="dashicons dashicons-admin-generic"></span>&nbsp;Help</h2>
    <div>lightenbody&trade; plugin version: 2.3.1</div>
    <div>PHP version: <?php echo phpversion(); ?></div>
    <a href="http://lightenbody.com/support" target="_blank">http://lightenbody.com/support</a>
    <h2><span class="dashicons dashicons-admin-generic"></span>&nbsp;WordPress shortcode API</h2>

    <div>Attribute: <code>locale</code></div>
    <span style="font-size: 12px;">Override default locale settings. Defaults to WordPress locale settings.</span><br>
    <ul style="list-style: square; margin-left: 25px;">
        <li>en_EN</li>
        <li>pl_PL</li>
    </ul>
    <span><em>Example:</em></span><br>
    <code>[lightenbody-schedule locale="pl_PL"]</code>

    <br><br><hr><br>
    <div>Attribute: <code>display</code></div>
    <span style="font-size: 12px;">Determines schedule template. Default template view is agenda.</span>
    <ul style="list-style: square; margin-left: 25px;">
        <li>agendaView</li>
        <li>calendarView</li>
    </ul>
    <span><em>Example:</em></span><br>
    <code>[lightenbody-schedule display="agendaView"]</code>
    <br><br><hr><br>

    <div>Attribute: <code>start-date</code> (format Y-m-d)</div>
    <span style="font-size: 12px;">Override default start date of the schedule.</span><br><br>
    <span><em>Example:</em></span><br>
    <code>[lightenbody-schedule start-date="2022-04-01"]</code>

    <br><br><hr><br>
    <div>Attribute: <code>end-date</code> (format Y-m-d)</div>
    <span style="font-size: 12px;">Override default end date of the schedule.</span><br><br>
    <span><em>Example:</em></span><br>
    <code>[lightenbody-schedule end-date="2022-04-06"]</code>

    <br><br><hr><br>
    <div>Attribute: <code>filter-class-services</code> (guid1,guid2...)</div>
    <span style="font-size: 12px;">Filters classes by given class services.</span><br><br>
    <span><em>Example:</em></span><br>
    <code>[lightenbody-schedule filter-class-services="385358E6-94E1-46B6-BED1-5309BDEDED4F,597E0B71-26CD-4217-B453-3E3CBECE2330"]</code>

    <br><br><hr><br>
    <div>Attribute: <code>filter-members</code> (guid1,guid2...)</div>
    <span style="font-size: 12px;">Filters classes by given members.</span><br><br>
    <span><em>Example:</em></span><br>
    <code>[lightenbody-schedule filter-members="120E1FDB-3A06-4FC2-A424-2F7CF8A7D914"]</code>

    <br><br><hr><br>
    <div>Attribute: <code>filter-locations</code> (guid1,guid2...)</div>
    <span style="font-size: 12px;">Filters classes by given locations.</span><br><br>
    <span><em>Example:</em></span><br>
    <code>[lightenbody-schedule filter-locations="B2BA6C4C-283A-4590-91B4-603F15376592"]</code>
</div>
