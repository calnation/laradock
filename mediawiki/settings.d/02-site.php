<?php

if(!defined('MEDIAWIKI')) {
    exit;
} // Protect against web entry

if(getenv('MW_SITENAME') != '') {
    $wgSitename = getenv('MW_SITENAME');
}

if(getenv('MW_META_NAMESPACE') != '') {
    $wgMetaNamespace = getenv('MW_META_NAMESPACE');
}

if(getenv('TZ') != '') {
    $wgLocaltimezone = getenv('TZ');
}
date_default_timezone_set( $wgLocaltimezone );


# Periodically send a pingback to https://www.mediawiki.org/ with basic data
# about this MediaWiki instance. The Wikimedia Foundation shares this data
# with MediaWiki developers to help guide future development efforts.
$wgPingback = false;


# == Keys
# ====================================================

if(getenv('MW_SECRET_KEY') != '') {
    $wgSecretKey = getenv('MW_SECRET_KEY');
}

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
if(getenv('MW_UPGRADE_KEY') != '') {
    $wgUpgradeKey = getenv('MW_UPGRADE_KEY');
}


# == Copyrights
# ====================================================
## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl  = "https://creativecommons.org/licenses/by-sa/4.0/";
$wgRightsText = "Creative Commons Attribution-ShareAlike";
$wgRightsIcon = "$wgResourceBasePath/resources/assets/licenses/cc-by-sa.png";


# Changing this will log out all existing sessions.
$wgAuthenticationTokenVersion = "1";

#$wgEnableScaryTranscluding = true;
