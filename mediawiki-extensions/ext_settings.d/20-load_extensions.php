<?php

if(!defined('MEDIAWIKI')) {
   exit;
} // Protect against web entry

/**
 * Load specified $extension
 *
 * @param $extension extension to be loaded (Just extension name, $IP/extensions/$extension/$extension.php will be loaded if file_exists)
 * @return returns true if successful, otherwise false
 */
function load_extension($extension) {
   global $IP;
   $IP = '/var/www/';
   $xt   = basename($extension);
   $file = "$IP/extensions/$xt/$xt.php";

   if(file_exists($file)) {
      return require_once($file);
   }
   return false;
}

/**
 * Load all extensions specified in array
 *
 *  @param $extension_array list of extension names to be loaded
 * @return returns true if successful, otherwise false
 */
function load_extensions($extension_array) {
   $results = array();

   if(is_array($extension_array)) {
      for($i = 0; $i < count($extension_array); $i++) {
         if(is_array($extension_array[$i])) {
            $results[] = load_extensions($extension_array[$i]);
         } else {
            $results[] = load_extension($extension_array[$i]);
         }
      }
   } else {
      $extensions = explode(',', $extension_array);
      $results[]  = load_extensions($extensions);
   }

   if(count(array_unique($results)) == 1) {
      return current($results);
   }
   return false;
}

/**
 * see if extension folder exists
 *
 *  @param $_folder
 * @return
 */
function ext_folder_exists($_folder) {
    global $IP;
    $IP = '/var/www/';
    $_path = "$IP/extensions/$_folder";
    return file_exists($_path);
}


# Used in some extension settings
if(getenv('SERVER_NAME') != '') {
    $_server = getenv('SERVER_NAME');
} else {
    $_server = 'mediawiki';
}

##########################################



if(ext_folder_exists('AdminLinks')) {
    load_extension('AdminLinks');
}


if(ext_folder_exists('Cite')) {
    wfLoadExtension('Cite');
    $wgCiteEnablePopups = true;
}


if(ext_folder_exists('CiteThisPage')) {
    wfLoadExtension('CiteThisPage');
}


if(ext_folder_exists('cldr')) {
    wfLoadExtension('cldr');
}


if(ext_folder_exists('Duplicator')) {
    require_once "/var/www/extensions/Duplicator/Duplicator.php";
}


if(ext_folder_exists('MobileFrontend')) {
    wfLoadExtension('MobileFrontend');
    $wgMFAutodetectMobileView = true;
    $wgMFVaryOnUA             = true;
}



if(ext_folder_exists('ParserFunctions')) {
    load_extension('ParserFunctions');
    wfLoadExtension('ParserFunctions');
    $wgAllowSlowParserFunctions = false; // Enables the magic words, e.g. {{PAGESINNAMESPACE}}
    $wgPFStringLengthLimit      = 10000;
    $wgPFEnableStringFunctions  = true;
}



if(ext_folder_exists('Scribunto')) {
    require_once "/var/www/extensions/Scribunto/Scribunto.php";
    $wgScribuntoDefaultEngine = 'luastandalone';
    //$wgScribuntoUseGeSHi = true;
//$wgScribuntoEngineConf['luastandalone']['luaPath'] = '/usr/bin/lua';
//$wgScribuntoEngineConf['luastandalone']['luaPath'] = "$IP/extensions/Scribunto/engines/LuaStandalone/binaries/lua5_1_5_linux_64_generic/lua";
}


if(ext_folder_exists('TemplateData')) {
    wfLoadExtension('TemplateData');
    $wgTemplateDataGUI = true;
}
