<?php

if(!defined('MEDIAWIKI')) {
    exit;
}

## The protocol and server name to use in fully-qualified URLs
if(getenv('MW_SERVER') == '') {
    throw new Exception('Missing environment variable MW_SERVER');
} else {
    $wgServer = getenv('MW_SERVER');
}

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
    ## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath           = ""; // default is "/w"
# where wiki pages are primarily read from
#$wgArticlePath          = "/wiki/$1";
#$wgUsePathInfo          = true; // Whether to use 'pretty' URLs.
# Allow changing display title of a page using {{DISPLAYTITLE:Crap}}
#$wgRestrictDisplayTitle = false;

## The URL path to static resources (images, scripts, etc.)
$wgResourceBasePath = $wgScriptPath;

## The URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
if(file_exists("$wgResourceBasePath/resources/assets/logo.png")) {
    $wgLogo = "$wgResourceBasePath/resources/assets/logo.png";
} else {
    $wgLogo = "$wgResourceBasePath/resources/assets/wiki.png";
}

if(file_exists("$wgResourceBasePath/resources/assets/favicon.ico")) {
    $wgFavicon = "$wgResourceBasePath/resources/assets/favicon.ico";
} else {
    $wgFavicon = '/favicon.ico';
}

if(file_exists("$wgResourceBasePath/resources/assets/apple-touch-icon.png")) {
    $wgAppleTouchIcon = "$wgResourceBasePath/resources/assets/apple-touch-icon.png";
} else {
    $wgAppleTouchIcon = '/apple-touch-icon.png';
}

# Path to the GNU diff3 utility. Used for conflict resolution.
    $wgDiff3 = "/usr/bin/diff3";

#$wgTmpDirectory = '/var/www/images/temp';

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publically accessible from the web.
$wgCacheDirectory   = "$IP/cache/data";
## Directory where cached pages will be saved
$wgFileCacheDirectory = "$IP/cache/html";