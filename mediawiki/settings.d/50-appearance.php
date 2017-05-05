<?php

if(!defined('MEDIAWIKI')) {
   exit;
} // Protect against web entry

# == Skin
# ====================================================

# Enabled skins.
wfLoadSkin('Vector');
wfLoadSkin('VectorV2');

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'vector', 'monobook':
   $wgDefaultSkin =  ((getenv('MW_DEFAULT_SKIN') != '')
                    ? getenv('MW_DEFAULT_SKIN')
                    : 'VectorV2');

# Remove links in the footer, as well as the MediaWiki logo
//unset( $wgFooterIcons['poweredby'] );
//$wgHooks['SkinTemplateOutputPageBeforeExec'][] = 'removeFooterLinks';
//function removeFooterLinks( $sk, &$tpl ) {
//    $tpl->data['footerlinks']['places'] = [];
//    return true;
//}


# == Behavior
# ====================================================

$wgExternalLinkTarget   = '_blank'; // Open links in a new window/tab?

# allow users to create their own User styles
$wgAllowUserCss = true;
$wgAllowUserJs  = true;

# ===  Default user preferences
# @see https://www.mediawiki.org/wiki/Manual:$wgDefaultUserOptions
# UPO: User Preference Option, so it can be changed
# We set the defaults for "minordefault" and "forceeditsummary"
$wgDefaultUserOptions['minordefault']     = 1;
$wgDefaultUserOptions['forceeditsummary'] = 0;
# hiding the user preferences with $wgHiddenPrefs results in everybody using
# the defaults, regardless of the users' earlier preference.
//$wgHiddenPrefs[] = "minordefault";
//$wgHiddenPrefs[] = "forceeditsummary";

$wgUseEnotif = true;
$wgEnotifMinorEdits=true;
$wgEnotifUserTalk      = true; # UPO
$wgEnotifWatchlist     = true; # UPO

if(!file_exists('/srv/mediawiki/w/cache/l10n/l10n_cache-en.cdb')) {
   $wgLocalisationCacheConf['manualRecache'] = false;
}
