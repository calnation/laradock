<?php

if(!defined('MEDIAWIKI')) {
    exit;
} // Protect against web entry

# == DB
# ====================================================

$wgDBtype =  ((getenv('MW_DB_TYPE') != '')
? getenv('MW_DB_TYPE')
: 'mysql');

$wgDBserver = ((getenv('MW_DB_SERVER') != '')
? getenv('MW_DB_SERVER')
: '');

$wgDBuser = ((getenv('MW_DB_USER') != '')
? getenv('MW_DB_USER')
: 'wikiuser');

$wgDBpassword = ((getenv('MW_DB_PASSWORD') != '')
? getenv('MW_DB_PASSWORD')
: 'password');

# MySQL specific settings
if(getenv('MW_DB_TYPE') == 'mysql') {
    // Cache sessions in database
    $wgSessionCacheType = CACHE_DB;
    if(getenv('MW_DB_PREFIX') != '') {
    }
    $wgDBprefix = ((getenv('MW_DB_PREFIX') != '')
    ? getenv('MW_DB_PREFIX')
    : '');
    $wgDBTableOptions = ((getenv('MW_DB_TABLE_OPTIONS') != '')
    ? getenv('MW_DB_TABLE_OPTIONS')
    : 'ENGINE=InnoDB, DEFAULT CHARSET=binary');
    
    # Experimental charset support for MySQL 5.0.
        $wgDBmysql5 = false;
    if(getenv('MW_MYSQL_CHARSET_KEY') == '1' || getenv('MW_MYSQL_CHARSET_KEY') == 'true') {
        $wgDBmysql5 = true;
    }
}

# SQLite specific settings
$wgSQLiteDataDir = "/var/www/data";
if(getenv('MW_DB_TYPE') == 'sqlite') {
    $wgDBuser = "";
    $wgDBpassword = "";
    $wgObjectCaches[CACHE_DB] = [
    'class'    => 'SqlBagOStuff',
    'loggroup' => 'SQLBagOStuff',
    'server'   => [
    'type'        => 'sqlite',
    'dbname'      => 'wikicache',
    'tablePrefix' => '',
    'dbDirectory' => $wgSQLiteDataDir,
    'flags'       => 0
    ]
    ];
}

## Shared Database

if(getenv('MW_SHARED_DB') != '') {
    $wgSharedDB = getenv('MW_SHARED_DB');
    $wgDBadminuser = getenv('MW_DB_USER'); // For shared DB
    $wgSharedTables = array();
    //$wgSharedTables[] = 'user';
    //$wgSharedTables[] = 'user_properties';
    //$wgSharedTables[] = 'user_groups';
    //$wgSharedTables[] = 'bot_passwords';
}


# == Languages
# ====================================================

# Site language code, should be one of the list in ./languages/data/Names.php

$wgLanguageCode = ((getenv('MW_LANGUAGE_CODE') != '')
? getenv('MW_LANGUAGE_CODE')
: 'en');

# Officially supported languages
$wgSupportedLanguages = array('en', 'es');

$tempDBname = ((getenv('MW_DB_NAME') != '')
? getenv('MW_DB_NAME')
: 'wikidb');

$wgDBname       = $tempDBname;

# to handle database per language
//switch($wiki_lang) {
//   case 'en':
//      $wgLanguageCode = $wiki_lang;
//      $wgDBname       = $tempDBname;
//   case 'es':
//      $wgLanguageCode = $wiki_lang;
//      $wgDBname       = $wiki_lang . $tempDBname;
//      break;
//   case 'pool':
//   default:
//      header('Location: //www.' . $_domain . '/');
//      exit(0);
//      break;
//}