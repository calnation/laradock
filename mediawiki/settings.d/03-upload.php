<?php

if(!defined('MEDIAWIKI')) {
    exit;
} // Protect against web entry

# == Uploading
# ====================================================

## server to use to upload if it is not the current server
## If set, this string is added to the start of $wgUploadPath to form a complete upload URL.
    $wgUploadBaseUrl =  ((getenv('MW_UPLOAD_BASE_URL') != '')
                       ? getenv('MW_UPLOAD_BASE_URL')
                       : '');

# relative path to the upload directory
$wgUploadPath        = "{$wgScriptPath}/images";
# file system path of the upload directory
$wgUploadDirectory   = "{$IP}/images";
$wgUploadSizeWarning = false; # Warn if uploaded files are larger than this

## To enable image uploads, make sure the 'images' directory is writable, then set this to true:
$wgEnableUploads = false;
if(getenv('MW_ENABLE_UPLOADS') == 'true' || getenv('MW_ENABLE_UPLOADS') == '1') {
    $wgEnableUploads = true;
}
$wgAllowCopyUploads             = true; // Allow uploads from URLs to those with upload_by_url permission
$wgCopyUploadsFromSpecialUpload = true; // adds Special interface to above

if(getenv('MW_MAX_UPLOAD_SIZE') != '') {
    ## IMPORTANT: `upload_max_filesize` and `post_max_size`, whichever one of
    ## these php.ini variables is smallest will be the real limiter.
    ##
    ## Since MediaWiki's config takes upload size in bytes and PHP
    ## in 100M format, lets use PHPs format and convert that here.
    ##
    $maxUploadSize = getenv('MW_MAX_UPLOAD_SIZE');
    if(strlen($maxUploadSize) >= 2) {
        $maxUploadSizeUnit  = substr($maxUploadSize, -1, 1);
        $maxUploadSizeValue = (integer) substr($maxUploadSize, 0, -1);
        switch(strtoupper($maxUploadSizeUnit)) {
            case 'G':
                $maxUploadSizeFactor = 1024 * 1024 * 1024;
                break;
            case 'M':
                $maxUploadSizeFactor = 1024 * 1024;
                break;
            case 'K':
                $maxUploadSizeFactor = 1024;
                break;
            case 'B':
                default:
                    $maxUploadSizeFactor = 0;
                    break;
        }
        $wgMaxUploadSize = $maxUploadSizeValue * $maxUploadSizeFactor;
        unset($maxUploadSizeUnit, $maxUploadSizeValue, $maxUploadSizeFactor);
    }
}

## If you want to use image uploads under safe mode,
## create the directories images/archive, images/thumb and
## images/temp, and make them all writable. Then uncomment
## this, if it's not already uncommented:
    //$wgHashedUploadDirectory = false;


# == Files & Media
# ====================================================
# InstantCommons allows wiki to use images from https://commons.wikimedia.org
$wgUseInstantCommons = true;

## Thumbnailing (ImageMagick)
$wgUseImageMagick            = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "C.UTF-8";

$wgSVGConverters['ImageMagick']  = '$path/convert -background transparent -thumbnail $widthx$height\! $input PNG:$output';

$wgFileExtensions = array(
'bmp',
'bmp.png',
'doc',
'docx',
'gif',
'ico',
'jpeg',
'jpg',
'key',
'mpp',
'numbers',
'odg',
'odp',
'ods',
'odt',
'ogg',
'pages',
'pdf',
'png',
'ppt',
'pptx',
'ps',
'rtf',
'svg',
'tiff',
'xls',
'xlsx'
);
