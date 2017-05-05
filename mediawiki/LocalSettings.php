<?php
# Protect against web entry
if (!defined('MEDIAWIKI')) {
    exit;
}

# Load settings from settings.d folder
foreach (array_merge(glob(__DIR__ . "/settings.d/*.php")) as $conffile) {
    include_once $conffile;
}

foreach (array_merge(glob(__DIR__ . "/ext_settings.d/*.php")) as $conffile) {
    include_once $conffile;
}
