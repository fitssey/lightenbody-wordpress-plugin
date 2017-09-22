<div class="wrap">
    <h1>lightenbody&trade;</h1>
    <h2 class="nav-tab-wrapper">
        <a href="?page=lightenbody&tab=connection" class="nav-tab <?php echo 'connection' == $tab ? 'nav-tab-active' : ''; ?>">Connection</a>
        <a href="?page=lightenbody&tab=settings" class="nav-tab <?php echo 'settings' == $tab ? 'nav-tab-active' : ''; ?>">Settings</a>
        <a href="?page=lightenbody&tab=translations" class="nav-tab <?php echo 'translations' == $tab ? 'nav-tab-active' : ''; ?>">Translations</a>
        <a href="?page=lightenbody&tab=help" class="nav-tab <?php echo 'help' == $tab ? 'nav-tab-active' : ''; ?>">Help</a>
    </h2>
    <?php echo $view; ?>
</div>