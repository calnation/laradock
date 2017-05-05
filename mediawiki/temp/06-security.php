<?php

if(!defined('MEDIAWIKI')) {
    exit;
} // Protect against web entry


# == Anti-spam
# ====================================================
/**
* Number of accounts each IP address may create per specified period(s).
*
* @par Example:
* @code
* $wgAccountCreationThrottle = [
*  # no more than 100 per month
*  [
*   'count' => 100,
*   'seconds' => 30*86400,
*  ],
*  # no more than 10 per day
*  [
*   'count' => 10,
*   'seconds' => 86400,
*  ],
* ];
* @endcode
*
* @warning Requires $wgMainCacheType to be enabled
*/
$wgAccountCreationThrottle = [ [
'count'   => 3,
'seconds' => 30 * 86400,
]];
# No. of seconds an account is required to age before it's in 'autoconfirmed' group
$wgAutoConfirmAge          = 86400 * 7; // 7 days
# require at least 20 normal edits before granting the 'writeapi' right
$wgAutoConfirmCount        = 20;

## disable anonymous editing
# Users must confirm their email address before they can edit
$wgEmailConfirmToEdit = true;
$wgDisableAnonTalk    = true;

# disable user account creation via API
$wgAPIModules['createaccount'] = 'ApiDisabled';
