<?php

if ( !defined( 'MEDIAWIKI' ) ) { exit; } // Protect against web entry

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

if(ext_folder_exists('AbuseFilter')) {
    wfLoadExtension('AbuseFilter');
    $wgAbuseFilterIsCentral         = false;
    $wgAbuseFilterActions           = [
        'flag'             => true,
        'throttle'         => true,
        'warn'             => true,
        'disallow'         => true,
        'blockautopromote' => true,
        'block'            => true,
        'degroup'          => true,
        'rangeblock'       => false,
        'tag'              => true
    ];
    $wgAbuseFilterBlockDuration     = 'indefinite';
    $wgAbuseFilterAnonBlockDuration = '6 months';

    # filter groups
    $wgAbuseFilterValidGroups               = array('default', 'proofed');
    # Disable a filter if it matched more than 2 edits, constituting more than 5 % of the
        # actions which were checked against the filter's group in the "observed" period (at
    # most one day), unless the filter has been changed in the last 86400 seconds (one day)
    $wgAbuseFilterEmergencyDisableThreshold = array(
    'default' => 0.5,
    'proofed' => 1.0,
    );
    $wgAbuseFilterEmergencyDisableCount     = array(
    'default' => 10,
    'proofed' => 65535,
    );
    $wgAbuseFilterEmergencyDisableAge       = array(
    'default' => 86400,
    'proofed' => 86400,
    );
}


if(ext_folder_exists('AdminLinks')) {
    load_extension('AdminLinks');
}


if(ext_folder_exists('AntiSpoof')) {
    wfLoadExtension('AntiSpoof');
}


if(ext_folder_exists('ArticleFeedbackv5')) {
    wfLoadExtension('ArticleFeedbackv5');
}


if(ext_folder_exists('ArticlePlaceholder')) {
    wfLoadExtension('ArticlePlaceholder');
}


if(ext_folder_exists('ArticleProtection')) {
    load_extension('ArticleProtection');
}


if(ext_folder_exists('ArticleToCategory2')) {
    load_extension('ArticleToCategory2');
}


if(ext_folder_exists('AutoFillFormField')) {
    load_extension('AutoFillFormField');
}


if(ext_folder_exists('AutomaticBoardWelcome')) {
    wfLoadExtension('AutomaticBoardWelcome');
}


if(ext_folder_exists('Babel')) {
    wfLoadExtension('Babel');
}


if(ext_folder_exists('BatchUserRights')) {
    load_extension('BatchUserRights');
}


if(ext_folder_exists('BetaFeatures')) {
    wfLoadExtension('BetaFeatures');
}


if(ext_folder_exists('BlogPage')) {
    wfLoadExtension('BlogPage');
    $wgBlogPageDisplay['comments_of_day'] = false;
    $wgExtraNamespaces[500]               = "Blog";
    $wgExtraNamespaces[501]               = "Blog_talk";
}


if(ext_folder_exists('Cargo')) {
    wfLoadExtension('Cargo');
$wgCargoPageDataColumns[] = 'CARGO_STORE_CREATION_DATE';
$wgCargoPageDataColumns[] = 'CARGO_STORE_MODIFICATION_DATE';
$wgCargoPageDataColumns[] = 'CARGO_STORE_CREATOR';
$wgCargoPageDataColumns[] = 'CARGO_STORE_FULL_TEXT';
$wgCargoPageDataColumns[] = 'CARGO_STORE_CATEGORIES';
$wgCargoPageDataColumns[] = 'CARGO_STORE_NUM_REVISIONS';
}


if(ext_folder_exists('CategoryTagSorter')) {
    load_extension('CategoryTagSorter');
    $wgDefaultUserOptions['categorysortdisable'] = 1; // make it opt-in
}


if(ext_folder_exists('CategoryTree')) {
    wfLoadExtension('CategoryTree');
}


if(ext_folder_exists('CheckEmailAddress')) {
    load_extension('CheckEmailAddress');
}


if(ext_folder_exists('CheckUser')) {
    wfLoadExtension('CheckUser');
    $wgCheckUserForceSummary                      = true;
    $wgGroupPermissions['sysop']['checkuser']     = true;
    $wgGroupPermissions['sysop']['checkuser-log'] = true;
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


//if(ext_folder_exists('CleanChanges')) {
    wfLoadExtension('CleanChanges');
//    $wgCCTrailerFilter                = true;
//    $wgCCUserFilter                   = false;
//    $wgDefaultUserOptions['usenewrc'] = 1;
//}


if(ext_folder_exists('Collection')) {
    load_extension('Collection');
    $wgCollectionPODPartners = array();
    $wgCollectionFormatToServeURL['rdf2latex'] = 'http://ocg:17080';
    // Sidebar cache doesn't play nice with this
    $wgEnableSidebarCache = false;
    $wgCollectionFormats = array(
    'rdf2latex' => 'PDF',
    );
    $wgLicenseURL = "http://creativecommons.org/licenses/by-sa/4.0/";
    $wgCollectionPortletFormats = array( 'rdf2latex' );
}


if(ext_folder_exists('Comments')) {
    wfLoadExtension('Comments');
    unset($wgGroupPermissions["commentadmin"]);
    $wgGroupPermissions["sysop"]["commentadmin"] = true;
    $wgCommentsInRecentChanges                   = true;
    $wgCommentsSortDescending                    = true;
}


if(ext_folder_exists('CommonsMetadata')) {
    wfLoadExtension('CommonsMetadata');
}


if(ext_folder_exists('ConfirmAccount')) {
    load_extension('ConfirmAccount');
    // num of words in biography required for new user to signup
    $wgConfirmAccountRequestFormItems['Biography']['minWords'] = 10;
    $wgMakeUserPageFromBio = false;
    $wgAutoWelcomeNewUsers = false;
    $wgConfirmAccountRequestFormItems = array(
    'UserName'        => array( 'enabled' => true ),
    'RealName'        => array( 'enabled' => false ),
    'Biography'       => array( 'enabled' => false, 'minWords' => 10 ),
    'AreasOfInterest' => array( 'enabled' => true ),
    'CV'              => array( 'enabled' => false ),
    'Notes'           => array( 'enabled' => true ),
    'Links'           => array( 'enabled' => true ),
    'TermsOfService'  => array( 'enabled' => true ),
    );
    if(getenv('MW_EMERGENCY_CONTACT') != '') {
        $wgConfirmAccountContact = getenv('MW_EMERGENCY_CONTACT');
    }
    $wgGroupPermissions['bureaucrat']['confirmaccount-notify'] = true;

    // add a "Request account" login link
    $wgHooks['PersonalUrls'][] = 'onPersonalUrls';
    function onPersonalUrls( array &$personal_urls, Title $title, SkinTemplate $skin  ) {
        // Add a link to Special:RequestAccount if a link exists for login
        if ( isset( $personal_urls['login'] ) || isset( $personal_urls['anonlogin'] ) ) {
            $personal_urls['createaccount'] = array(
            'text' => wfMessage( 'requestaccount' )->text(),
            'href' => SpecialPage::getTitleFor( 'RequestAccount' )->getFullURL()
            );
        }
        return true;
    }
}


if(ext_folder_exists('ConfirmEdit')) {
    wfLoadExtension('ConfirmEdit');
}


if(ext_folder_exists('ContentTranslation')) {
    wfLoadExtension('ContentTranslation');
}


if(ext_folder_exists('CirrusSearch')) {
    wfLoadExtension('CirrusSearch');
    #$wgCirrusSearchServers = array( 'elasticsearch' );
    #$wgSearchType = 'CirrusSearch';
}


if(ext_folder_exists('Configure')) {
    load_extension('Configure');
}


if(ext_folder_exists('CreateRedirect')) {
    load_extension('CreateRedirect');
}


if(ext_folder_exists('CSS')) {
    load_extension('CSS');
}


//if( ext_folder_exists('CustomNavBlocks')) {
//    load_extension('CustomNavBlocks');
//    $wgCustomNavBlocksEnable = true;
//}


if(ext_folder_exists('CustomParser')) {
    load_extension('CustomParser');
}


if(ext_folder_exists('DeleteOwn')) {
    load_extension('DeleteOwn');
}


if(ext_folder_exists('DidYouKnow')) {
    load_extension('DidYouKnow');
}


if(ext_folder_exists('Disambiguator')) {
    wfLoadExtension('Disambiguator');
}


if(ext_folder_exists('DismissableSiteNotice')) {
    wfLoadExtension('DismissableSiteNotice');
}


if(ext_folder_exists('Duplicator')) {
    require_once "/var/www/extensions/Duplicator/Duplicator.php";
}


if(ext_folder_exists('DynamicPageList')) {
    wfLoadExtension('DynamicPageList');
}


if(ext_folder_exists('Echo')) {
    load_extension('Echo');
    wfLoadExtension('Echo');
    $wgEchoDefaultNotificationTypes=array(
    'all' => array(
    'web' => true,
    'email' => true,
    )
    );
}


if(ext_folder_exists('EditSimilar')) {
    load_extension('EditSimilar');
}


if(ext_folder_exists('Elastica')) {
    wfLoadExtension('Elastica');
}


if(ext_folder_exists('EmbedVideo')) {
    wfLoadExtension('EmbedVideo');
}


if(ext_folder_exists('EventLogging')) {
    wfLoadExtension('EventLogging');
}


if(ext_folder_exists('Flow')) {
    load_extension('Flow');
    $wgGroupPermissions['bureaucrat']['flow-create-board'] = true;
    $wgFlowEditorList                                      = $wmgFlowEditorList;

    $wgNamespaceContentModels = [
    'NS_TALK'           => CONTENT_MODEL_FLOW_BOARD,
    'NS_USER_TALK'      => CONTENT_MODEL_FLOW_BOARD,
    'NS_PROJECT_TALK'   => CONTENT_MODEL_FLOW_BOARD,
    'NS_FILE_TALK'      => CONTENT_MODEL_FLOW_BOARD,
    'NS_MEDIAWIKI_TALK' => CONTENT_MODEL_FLOW_BOARD,
    'NS_TEMPLATE_TALK'  => CONTENT_MODEL_FLOW_BOARD,
    'NS_HELP_TALK'      => CONTENT_MODEL_FLOW_BOARD,
    'NS_CATEGORY_TALK'  => CONTENT_MODEL_FLOW_BOARD,
    'NS_DRAFT_TALK'     => CONTENT_MODEL_FLOW_BOARD,
    'NS_OPINION_TALK'   => CONTENT_MODEL_FLOW_BOARD,
    'NS_TIMELINE_TALK'  => CONTENT_MODEL_FLOW_BOARD,
    'NS_HISTORICAL_TIMELINE_TALK'  => CONTENT_MODEL_FLOW_BOARD,
    ] + $wgNamespaceContentModels;
    $wgFlowEditorList         = array('visualeditor', 'wikitext');
}


if(ext_folder_exists('FlaggedRevs')) {
    load_extension('FlaggedRevs');
    $wgFlaggedRevsStatsAge   = false;
    $wgSimpleFlaggedRevsUI   = false;
    $wgFlaggedRevsLowProfile = true;
    $wgFlaggedRevsWhitelist  = array('Etusivu');
}


if(ext_folder_exists('Gadgets')) {
    wfLoadExtension('Gadgets');
}


if(ext_folder_exists('GoToShell')) {
    load_extension('GoToShell');
}


//if(ext_folder_exists('GlobalBlocking')) {
//    wfLoadExtension('GlobalBlocking');
//}


if(ext_folder_exists('googleAnalytics')) {
    load_extension('googleAnalytics');
    $wgGoogleAnalyticsIgnoreSysops = false;
    $wgGoogleAnalyticsIgnoreBots   = false;
    $wgGoogleAnalyticsAddASAC      = false;
}


if(ext_folder_exists('Graph')) {
    wfLoadExtension('Graph');
}


if(ext_folder_exists('GuidedTour')) {
    wfLoadExtension('GuidedTour');
}


//if(ext_folder_exists('HideEmptySections')) {
//    load_extension('HideEmptySections');
//}


if(ext_folder_exists('HTMLTags')) {
    load_extension('HTMLTags');
    $wgHTMLTagsAttributes["iframe"] = array("src", "width", "height", "style", "scrolling");
    $wgHTMLTagsAttributes["form"]   = array("action", "method");
    $wgHTMLTagsAttributes["input"]  = array("type", "name", "value", "src", "border", "alt");
    $wgHTMLTagsAttributes["img"]    = array("alt", "border", "src", "width", "height");
}


if(ext_folder_exists('ImageMap')) {
    wfLoadExtension('ImageMap');
}


if(ext_folder_exists('InputBox')) {
    wfLoadExtension('InputBox');
}


if(ext_folder_exists('Interwiki')) {
    wfLoadExtension('Interwiki');
    $wgGroupPermissions['sysop']['interwiki'] = true;
}


if(ext_folder_exists('LabeledSectionTransclusion')) {
    wfLoadExtension('LabeledSectionTransclusion');
}


if(ext_folder_exists('LinkTitles')) {
    wfLoadExtension('LinkTitles');
}


if(ext_folder_exists('LocalisationUpdate')) {
    wfLoadExtension('LocalisationUpdate');
    global $IP;
    $IP = '/var/www/';
    $wgLocalisationUpdateDirectory = "$IP/cache";
}


if(ext_folder_exists('LookupUser')) {
    wfLoadExtension('LookupUser');
}


if(ext_folder_exists('Maintenance')) {
    wfLoadExtension('Maintenance');
}


if(ext_folder_exists('Maps')) {
    $egMapsDefaultService        = 'openlayers';
    $egMapsDisableSmwIntegration = true;
}


if(ext_folder_exists('MassEditRegex')) {
    load_extension('MassEditRegex');
    $wgGroupPermissions['sysop']['masseditregex'] = true;
}


if(ext_folder_exists('MassMessage')) {
    wfLoadExtension('MassMessage');
    $wgMassMessageAccountUsername = 'ManagementMessenger';
    $wgNamespacesToConvert        = array('NS_USER' => 'NS_USER_TALK');
}


if(ext_folder_exists('Metrica')) {
    wfLoadExtension('Metrica');
}


if(ext_folder_exists('Moderation')) {
    wfLoadExtension('Moderation');
    $wgModerationEnable                                      = true;
    //$wgModerationTimeToOverrideRejection =
    $wgGroupPermissions['sysop']['moderation']               = true; # Allow sysops to use Special:Moderation
    $wgGroupPermissions['sysop']['skip-moderation']          = true; # Allow sysops to skip moderation
    $wgGroupPermissions['bot']['skip-moderation']            = true; # Allow bots to skip moderation
    $wgGroupPermissions['checkuser']['moderation-checkuser'] = false; # Don't let checkusers see IPs on Special:Moderation

    $wgAddGroups['sysop'][]    = 'automoderated'; # Allow sysops to assign "automoderated" flag
    $wgRemoveGroups['sysop'][] = 'automoderated'; # Allow sysops to remove "automoderated" flag

    $wgLogRestrictions["newusers"] = 'moderation';
}


if(ext_folder_exists('MobileFrontend')) {
    wfLoadExtension('MobileFrontend');
    $wgMFAutodetectMobileView = true;
    $wgMFVaryOnUA             = true;
}


if(ext_folder_exists('MsCalendar')) {
    wfLoadExtension('MsCalendar');
}


if(ext_folder_exists('MultimediaViewer')) {
    wfLoadExtension('MultimediaViewer');
    $wgMediaViewerEnableByDefault = true;
}


if(ext_folder_exists('MyVariables')) {
    load_extension('MyVariables');
}


if(ext_folder_exists('NewestPages')) {
    wfLoadExtension('NewestPages');
}


if(ext_folder_exists('NewSignupPage')) {
    wfLoadExtension('NewSignupPage');
}

if(ext_folder_exists( 'Newsletter' )) {
    wfLoadExtension( 'Newsletter' );
    $wgGroupPermissions['confirmed']['newsletter-create'] = true;
}


if(ext_folder_exists('NewUserMessage')) {
    wfLoadExtension('NewUserMessage');
}


if(ext_folder_exists('NewUsersList')) {
    wfLoadExtension('NewUsersList');
}


if(ext_folder_exists('NiceCategoryList2')) {
    load_extension('NiceCategoryList2');
}


if(ext_folder_exists('NoBogusUserpages')) {
    wfLoadExtension('NoBogusUserpages');
}


if(ext_folder_exists('Numbertext')) {
    load_extension('Numbertext');
}


if(ext_folder_exists('NumerAlpha')) {
    load_extension('NumerAlpha');
}


if(ext_folder_exists('Nuke')) {
    wfLoadExtension('Nuke');
}


if(ext_folder_exists('OATHAuth')) {
    wfLoadExtension('OATHAuth');
}


if(ext_folder_exists('PageForms')) {
    wfLoadExtension('PageForms');
}


if(ext_folder_exists('PageImages')) {
    wfLoadExtension('PageImages');
}


if(ext_folder_exists('PageNotice')) {
    load_extension('PageNotice');
}



if(ext_folder_exists('ParserFunctions')) {
    load_extension('ParserFunctions');
    wfLoadExtension('ParserFunctions');
    $wgAllowSlowParserFunctions = false; // Enables the magic words, e.g. {{PAGESINNAMESPACE}}
    $wgPFStringLengthLimit      = 10000;
    $wgPFEnableStringFunctions  = true;
}


if(ext_folder_exists('PdfHandler')) {
    wfLoadExtension('PdfHandler');
    $wgPdfProcessor = '/usr/local/bin/gs';
    $wgPdfPostProcessor = $wgImageMagickConvertCommand;
    $wgPdfInfo = '/usr/bin/pdfinfo';
    $wgPdftoText = '/usr/bin/pdftotext';
}


if(ext_folder_exists('Poem')) {
    wfLoadExtension('Poem');
}


if(ext_folder_exists('Popups')) {
    wfLoadExtension('Popups');
}


if(ext_folder_exists('ProofreadPage')) {
    load_extension('ProofreadPage');
    $wgExtraNamespaces['NS_PROOFREAD_PAGE'] = 'Page';
    $wgExtraNamespaces['NS_PROOFREAD_PAGE_TALK'] = 'Page_talk';
    $wgExtraNamespaces['NS_PROOFREAD_INDEX'] = 'Index';
    $wgExtraNamespaces['NS_PROOFREAD_INDEX_TALK'] = 'Index_talk';
    $wgProofreadPageNamespaceIds = array(
    'index' => 'NS_PROOFREAD_INDEX',
    'page' => 'NS_PROOFREAD_PAGE'
    );
}


if(ext_folder_exists('ProtectSite')) {
    wfLoadExtension('ProtectSite');
}


if(ext_folder_exists('RandomSelection')) {
    load_extension('RandomSelection');
}


if(ext_folder_exists('RefreshSpecial')) {
    wfLoadExtension('RefreshSpecial');
}


if(ext_folder_exists('RelatedArticles')) {
    wfLoadExtension('RelatedArticles');
    $wgRelatedArticlesLoggingSamplingRate = '0.01';
    $wgRelatedArticlesShowReadMore        = true;
    $wgRelatedArticlesShowInFooter        = false;
    $wgRelatedArticlesShowInSidebar       = true;
    //$wgRelatedArticlesUseCirrusSearch     = true;
}


if(ext_folder_exists('RelatedSites')) {
    wfLoadExtension('RelatedSites');
    $wgRelatedSitesPrefixes = array('wikipedia', 'wikitionary', 'wikinews');
}


if(ext_folder_exists('Renameuser')) {
    wfLoadExtension('Renameuser');
}


if(ext_folder_exists('ReplaceText')) {
    wfLoadExtension('ReplaceText');
}


if(ext_folder_exists('SandboxLink')) {
    wfLoadExtension('SandboxLink');
}


if(ext_folder_exists('Scribunto')) {
    require_once "/var/www/extensions/Scribunto/Scribunto.php";
    $wgScribuntoDefaultEngine = 'luastandalone';
    //$wgScribuntoUseGeSHi = true;
//$wgScribuntoEngineConf['luastandalone']['luaPath'] = '/usr/bin/lua';
//$wgScribuntoEngineConf['luastandalone']['luaPath'] = "$IP/extensions/Scribunto/engines/LuaStandalone/binaries/lua5_1_5_linux_64_generic/lua";
}


if(ext_folder_exists('SecurePoll')) {
    load_extension('SecurePoll');
    $wgGroupPermissions['sysop']['securepoll-create-poll'] = true;
}


if(ext_folder_exists('SemanticMediaWiki')) {
    enableSemantics('wiki.avoimempi.fi');
    ext_folder_exists('SemanticForms');
    if(ext_folder_exists('Maps')) {
    load_extension('Maps');
    wfLoadExtension('Maps');
        ext_folder_exists('SemanticMaps');
    }
}


if(ext_folder_exists('ShortUrl')) {
    wfLoadExtension('ShortUrl');
// TODO: use $wgServerName
    $wgShortUrlTemplate = "$wgServer/r/$1";
}


if(ext_folder_exists('Shariff')) {
    load_extension('Shariff');
}


if(ext_folder_exists('SimpleTooltip')) {
    load_extension('SimpleTooltip');
}


if(ext_folder_exists('SkinPerNamespace')) {
    load_extension('SkinPerNamespace');
}


if(ext_folder_exists('SkinPerPage')) {
    wfLoadExtension('SkinPerPage');
}


if(ext_folder_exists('SocialProfile')) {
    load_extension('SocialProfile');
}



if(ext_folder_exists('SpamBlacklist')) {
    wfLoadExtension('SpamBlacklist');

    $wgBlacklistSettings["email"]["files"] = array("https://meta.wikimedia.org/w/index.php?title=Spam_blacklist&action=raw&sb_ver=1");
    $wgLogSpamBlacklistHits = true;
    $wgSpamRegex = '/'.# The "/" is the opening wrapper
    's-e-x|zoofilia|sexyongpin|grusskarte|geburtstagskarten|animalsex|'.
    'sex-with|dogsex|adultchat|adultlive|camsex|sexcam|livesex|sexchat|'.
    'chatsex|onlinesex|adultporn|adultvideo|adultweb.|hardcoresex|hardcoreporn|'.
    'teenporn|xxxporn|lesbiansex|livegirl|livenude|livesex|livevideo|camgirl|'.
    'spycam|voyeursex|casino-online|online-casino|kontaktlinsen|cheapest-phone|'.
    'laser-eye|eye-laser|fuelcellmarket|lasikclinic|cragrats|parishilton|'.
    'paris-hilton|paris-tape|2large|fuel-dispenser|fueling-dispenser|huojia|'.
    'jinxinghj|telematicsone|telematiksone|a-mortgage|diamondabrasives|'.
    'reuterbrook|sex-plugin|sex-zone|lazy-stars|eblja|liuhecai|'.
    'buy-viagra|-cialis|-levitra|boy-and-girl-kissing|'.# These match spammy words
    "dirare\.com|".# This matches dirare.com a spammer's domain name
    "overflow\s*:\s*auto|".# This matches against overflow:auto (regardless of whitespace on either side of the colon)
    "height\s*:\s*[0-4]px|".# This matches against height:0px (most CSS hidden spam) (regardless of whitespace on either side of the colon)
    "==<center>\[|".# This matches some recent spam related to starsearchtool.com and friends
    "\<\s*a\s*href|".# This blocks all href links entirely, forcing wiki syntax
    "display\s*:\s*none".# This matches against display:none (regardless of whitespace on either side of the colon)
    '/i';                     # The "/" ends the regular expression and the "i" switch which follows makes the test case-insensitive
    # The "\s" matches whitespace
    # The "*" is a repeater (zero or more times)
    # The "\s*" means to look for 0 or more amount of whitespace

}


if(ext_folder_exists('SpamRegex')) {
    wfLoadExtension('SpamRegex');
}


if(ext_folder_exists('SubpageFun')) {
    load_extension('SubpageFun');
}


if(ext_folder_exists('SwiftMailer')) {
    wfLoadExtension('SwiftMailer');
    $wgSMTPAuthenticationMethod = 'tls'; // This can be ssl too, according to the need
}


if(ext_folder_exists('SyntaxHighlight_GeSHi')) {
    wfLoadExtension('SyntaxHighlight_GeSHi');
}


if(ext_folder_exists('TemplateData')) {
    wfLoadExtension('TemplateData');
    $wgTemplateDataGUI = true;
}


if(ext_folder_exists('TemplateSandbox')) {
    wfLoadExtension('TemplateSandbox');
}


if(ext_folder_exists('TextExtracts')) {
    wfLoadExtension('TextExtracts');
}


if(ext_folder_exists('TimedMediaHandler')) {
    load_extension('TimedMediaHandler');
    $wgFFmpeg2theoraLocation = '/usr/bin/ffmpeg2theora';
}


if(ext_folder_exists('Thanks')) {
    wfLoadExtension('Thanks');
    $wgThanksSendToBots           = false; // Enable Thank interface for bot edits
    $wgThanksLogging              = true;
    $wgThanksConfirmationRequired = false;
}


if(ext_folder_exists('Theme')) {
    wfLoadExtension('Theme');
}


if(ext_folder_exists('TitleBlacklist')) {
    wfLoadExtension('TitleBlacklist');
}


if(ext_folder_exists('Translate')) {
    load_extension('Translate');
    $wgGroupPermissions['autoconfirmed'] = array_merge($wgGroupPermissions['autoconfirmed'], [
    'translate' => true,
    'translate-groupreview'           => true,
    'translate-import'       => true,
    'translate-messagereview'        => true,
    ]);
    $wgGroupPermissions['sysop'] = array_merge($wgGroupPermissions['sysop'], [
    'pagetranslation' => true,
    'translate-import'       => true,
    'translate-manage'        => true,
    ]);
    $wgGroupPermissions['user']['translate']                           = true;
    $wgGroupPermissions['user']['translate-messagereview'] = true;

    $wgGroupPermissions['translate-proofr']['translate-messagereview'] = false;
    $wgAddGroups['translate-proofr'] = false;

    $wgTranslateDocumentationLanguageCode = 'qqq';
    $wgExtraLanguageNames['qqq']          = 'Message documentation'; // No linguistic content. Used for documenting messages
        # unset this unused group already
    unset($wgGroupPermissions['translate-proofr']);
    $wgTranslateTranslationServices['Microsoft'] = array(
    'url' => 'http://api.microsofttranslator.com/V2/Http.svc/Translate',
    'key' => null,
    'timeout' => 3,
    'type' => 'microsoft'
    );
    $wgTranslateLanguageFallbacks = array(
    'en' => array('es'),
    'es' => array('en')
    );
    //   require_once( "/srv/mediawiki/config/TranslateConfigHack.php" );
}


if(ext_folder_exists('TwitterCards')) {
    load_extension('TwitterCards');
}


if(ext_folder_exists('UniversalLanguageSelector')) {
    wfLoadExtension('UniversalLanguageSelector');
    # location and form of language selector, either:
    #  - 'personal': as a link near username (or log in link) in personal toolbar (default)
        #  - 'interlanguage': as an icon near header of the list of interlanguage links in sidebar
        $wgULSPosition              = 'interlanguage';
    $wgULSAnonCanChangeLanguage = true; // Allow anonymous users to change language with cookie
        $wgULSGeoService            = false; // Suggest languages based on country user is visiting from
}


if(ext_folder_exists('UserGroups')) {
    load_extension('UserGroups');
}


if(ext_folder_exists('UserMerge')) {
    wfLoadExtension('UserMerge');
    $wgGroupPermissions['bureaucrat']['usermerge'] = true;
    $wgGroupPermissions['sysop']['usermerge']      = true;
    $wgUserMergeProtectedGroups                    = array();
}


if(ext_folder_exists('UsersWatchList')) {
    load_extension('UsersWatchList');
}


if(ext_folder_exists('UploadWizard')) {
    load_extension('UploadWizard');
    $wgUploadWizardConfig['tutorial']['skip'] = true;
    $wgUploadWizardConfig['enableLicensePreference'] = false;
    $wgUploadWizardConfig['licensing']['defaultType'] = 'choice';
    $wgUploadWizardConfig['licensing']['ownWorkDefault'] = 'choice';
}


if(ext_folder_exists('VandalBrake2')) {
    load_extension('VandalBrake2');
}


if(ext_folder_exists('VisualEditor')) {
    wfLoadExtension('VisualEditor');

    $_server = (getenv('SERVER_NAME') != '') ? getenv('SERVER_NAME') : 'localhost';
    $_domain = (getenv('APP_URL') != '') ? getenv('APP_URL') : 'localhost';
    $wgDefaultUserOptions['visualeditor-enable']                 = 1;
    $wgDefaultUserOptions['visualeditor-editor']                 = "visualeditor";
    $wgVirtualRestConfig = array(
    'modules' => array(
    'parsoid' => array(
    'url' => 'http://parsoid:8000', // Use port 8142 if you use the Debian package
    'domain' => isset($_server) ? $_server : 'localhost',
    'forwardCookies' => true,
    'prefix'         => $wgDBname
    ),
    'restbase' => array(
    'url' => 'http://restbase:7231',
    'domain' => isset($_server) ? $_server : 'localhost',
    'forwardCookies' => false,
    'parsoidCompat' => false,
    )
    ),
    'global' => array(
    'timeout' => 360,
    'HTTPProxy' => null
    )
    );
    $wgMathFullRestbaseURL = '//restbase.'.$_domain.'/'.(isset($_server) ? $_server : 'localhost').'/';
    $wgVisualEditorRestbaseURL = '//restbase.'.$_domain.'/'.(isset($_server) ? $_server : 'localhost').'/';
    $wgVisualEditorFullRestbaseURL = '//restbase.'.$_domain.'/'.(isset($_server) ? $_server : 'localhost').'/';

    $wgSessionsInObjectCache                                     = true;
    $wgDefaultUserOptions['visualeditor-enable-experimental']    = 1;
    //   $wgHiddenPrefs[]                                             = 'visualeditor-enable'; // Prevents users from disabling VE
    $wgVisualEditorAvailableNamespaces                           = [
    'NS_MAIN'                => true,
    'NS_USER'                => true,
    'NS_DRAFT'               => true,
    'NS_HELP'                => true,
    'NS_HISTORICAL_TIMELINE' => true,
    'NS_OPINION'             => true,
    'NS_TIMELINE'            => true,
    'NS_PORTAL'              => true,
    ];
    $wgVisualEditorAutoAccountEnable                             = true;
    $wgVisualEditorEnableTocWidget                               = true;
    //   $wgVisualEditor = ;
    $wgMessagesDirs['VisualEditor'] = array(
    __DIR__ . '/i18n',
    __DIR__ . '/modules/ve-core/i18n',
    __DIR__ . '/modules/qunit/localisation',
    __DIR__ . '/modules/oojs-ui/messages',
    );
}


if(ext_folder_exists('VoteNY')) {
    wfLoadExtension('VoteNY');
}


if(ext_folder_exists('Widgets')) {
    load_extension('Widgets');
}


if(ext_folder_exists('Wikibase')) {
    $wgEnableWikibaseRepo = true;
}


if(ext_folder_exists('WikiCategoryTagCloud')) {
    wfLoadExtension('WikiCategoryTagCloud');
}


if(ext_folder_exists('WikidataPageBanner')) {
    wfLoadExtension('WikidataPageBanner');
}


if(ext_folder_exists('WikiEditor')) {
    wfLoadExtension('WikiEditor');
    $wgDefaultUserOptions['usebetatoolbar']     = 1; // Enable enhanced editing toolbar
    $wgDefaultUserOptions['usebetatoolbar-cgd'] = 1;
    # Displays the Preview and Changes tabs
    $wgDefaultUserOptions['wikieditor-preview'] = 1;
    # Displays the Publish and Cancel buttons on the top right side
    #$wgDefaultUserOptions['wikieditor-publish'] = 1;
}


if(ext_folder_exists('WikiLove')) {
    wfLoadExtension('WikiLove');
    $wgDefaultUserOptions['wikilove-enabled'] = 1;
}


if(ext_folder_exists('WikipediaExtracts')) {
    wfLoadExtension('WikipediaExtracts');
}


if(ext_folder_exists('WikiSEO')) {
    wfLoadExtension('WikiSEO');
}

load_extensions($extensions);
