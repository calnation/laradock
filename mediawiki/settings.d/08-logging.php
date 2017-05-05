<?php

if(!defined('MEDIAWIKI')) {
    exit;
} // Protect against web entry

$_log_dir        = "/var/log/mediawiki";
$wmgDate = date('m-d-Y');
$wgDebugLogFile = "$_log_dir/debug-{$wgDBname}-{$wmgDate}.log";
$wgDBerrorLog     = "$_log_dir/debuglogs/database.log";
$wgRateLimitLog     = "$_log_dir/debuglogs/ratelimit.log";
$wgDebugLogGroups = array(
	   'DBPerformance' => "$_log_dir/debuglogs/dbperformance.log",
 	  'CirrusSearch' => "$_log_dir/debuglogs/CirrusSearch.log",
    '404'         => "$_log_dir/debuglogs/404.log",
    'api'         => "$_log_dir/debuglogs/api.log",
    'opcache'         => "$_log_dir/debuglogs/opcache.log",
    'captcha'     => "$_log_dir/debuglogs/captcha.log",
    'CentralAuth' => "$_log_dir/debuglogs/CentralAuth.log",
    'collection'  => "$_log_dir/debuglogs/collection.log",
    'error'       => "$_log_dir/debuglogs/php-error.log",
    'exception'   => "$_log_dir/debuglogs/exception.log",
    'exec'        => "$_log_dir/debuglogs/exec.log",
    'Math'        => "$_log_dir/debuglogs/Math.log",
    'OAuth'       => "$_log_dir/debuglogs/OAuth.log",
    'redis'       => "$_log_dir/debuglogs/redis.log",
    'resourceloader' => "$_log_dir/debuglogs/resourceloader.log",
    'spf-tmp'     => "$_log_dir/debuglogs/spf-tmp.log",
    'thumbnail'   => "$_log_dir/debuglogs/thumbnail.log",
);
$wgScribuntoEngineConf['luastandalone']['errorFile'] = "$_log_dir/debuglogs/luastandalone.log";

## Debug
if(getenv('MW_ENABLE_DEBUG') == '1' || getenv('MW_ENABLE_DEBUG') == 'true' || $wgCommandLineMode) {
    error_reporting(-1);
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    # Super ANNOYING
    $wgDebugComments        = true;
    $wgShowExceptionDetails = true;
    $wgShowSQLErrors        = true;
    $wgDebugDumpSql         = true;
    $wgShowDBErrorBacktrace = true;
    $wgDebugToolbar         = true;
    $wgDevelopmentWarnings  = true;
    $wgShowDebug            = true;
    $wgCachePages           = false;
    $wgStyleVersion         = mt_rand(1, 1000);
    //if ( $module->hasFailed ) {
    //    wfDebugLog( 'myextension', "Something is not right, module {$module->name} failed." );
    //}
    # XDebug
    //ini_set('xdebug.remote_enable', 1);
    //ini_set('xdebug.remote_host', 'localhost');
    //ini_set('xdebug.remote_port', 9001);
}

# $wgReadOnly = 'Database migration in progress. We`ll be back in a few minutes.';
