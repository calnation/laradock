<?php

if(!defined('MEDIAWIKI')) {
    exit;
} // Protect against web entry

$wgEmailAuthentication = true;

if(getenv('MW_ENABLE_SMTP') == '1' || getenv('MW_SMTP_AUTH') == 'true') {
    $wgEnableEmail     = true;
    $wgEnableUserEmail = false; // enable user-to-user email
    //$wgSMTP            = array(
    # Should we use SMTP authentication (true or false)
    //'auth'     => ((getenv('MW_SMTP_AUTH') == '1' || getenv('MW_SMTP_AUTH') == 'true') ? '1' : '0'),
    //'host'     => getenv('MW_SMTP_HOST'), // could also be an IP address. Where the SMTP server is located
    //'IDHost'   => getenv('MW_SMTP_IDHOST'), // Generally this will be the domain name of your website (aka mywiki.org)
    //'port'     => getenv('MW_SMTP_PORT'), // Port to use when connecting to the SMTP server
    //'username' => getenv('MW_SMTP_USERNAME'), // Username to use for SMTP authentication (if being used)
    //'password' => getenv('MW_SMTP_PASSWORD') // Password to use for SMTP authentication (if being used)
    //);
}

# avoid bouncing of user-to-user emails (FS#26737)
$wgUserEmailUseReplyTo = false;

if(file_exists("$IP/settings.d/mail-from-address.php")) {
    require_once "$IP/settings.d/mail-from-address.php";
} else {
    $wgEmergencyContact = getenv('MW_EMERGENCY_CONTACT');
    # E-Mail sender for password forgot mails
    if(getenv('MW_PASSWORD_SENDER') != '') {
        $wgPasswordSender = getenv('MW_PASSWORD_SENDER');
    }
}

$wgPasswordSenderName = getenv('MW_META_NAMESPACE');

$wgUserEmailConfirmationTokenExpiry = 2 * 24 * 60 * 60; // (2 days)


###########################################################
## Shared memory settings
$wgMainCacheType = CACHE_NONE;
$wgMemCachedServers = [];
