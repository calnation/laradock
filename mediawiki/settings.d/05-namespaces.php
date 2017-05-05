<?php

if(!defined('MEDIAWIKI')) {
    exit;
} // Protect against web entry

# upwards from 3000 to avoid conflicts

### Namespace: Opinion

define('NS_OPINION', 1694);
$wgExtraNamespaces['NS_OPINION']                        = 'FreeCalifornia_Wiki_Opinions';
$wgNamespaceProtection['NS_OPINION']                    = array('edit_opinions');
$wgGroupPermissions['*']['edit_opinions']             = false;
$wgGroupPermissions['user']['edit_opinions']          = false;
$wgGroupPermissions['autoconfirmed']['edit_opinions'] = false;
$wgGroupPermissions['staff']['edit_opinions']         = true;
$wgGroupPermissions['sysop']['edit_opinions']         = true;


$wgAddGroups['sysop'][]                               = 'staff';
$wgContentNamespaces[]                                = array(0, 200, 1694); // Content Namespaces

define('NS_OPINION_TALK', 1695);
$wgExtraNamespaces['NS_OPINION_TALK']     = 'FreeCalifornia_Wiki_Opinions_talk';
$wgNamespaceProtection['NS_OPINION_TALK'] = array('edit_opinions');

### Namespace: Timeline..

define('NS_TIMELINE', 1696);
$wgExtraNamespaces[NS_TIMELINE] = 'Timeline';

define('NS_TIMELINE_TALK', 1697);
$wgExtraNamespaces['NS_TIMELINE_TALK'] = 'Timeline_talk';

define('NS_HISTORICAL_TIMELINE', 1702);
$wgExtraNamespaces['NS_TIMELINE'] = 'Historical_Timeline';

define('NS_HISTORICAL_TIMELINE_TALK', 1703);
$wgExtraNamespaces['NS_TIMELINE_TALK'] = 'Historical_Timeline_talk';


### Namespace: Draft
define('NS_DRAFT', 1700);
$wgExtraNamespaces['NS_DRAFT'] = 'Draft';

define('NS_DRAFT_TALK', 1701);
$wgExtraNamespaces['NS_DRAFT_TALK'] = 'Draft_talk';

### Namespace: Campaign
define('NS_CAMPAIGN', 3001);
$wgExtraNamespaces['NS_CAMPAIGN'] = 'Campaign';

## Subpages Support
$wgNamespacesWithSubpages = array_merge($wgNamespacesWithSubpages, array(
'NS_MAIN'                => true,
'NS_USER'                => true,
'NS_HELP'                => true,
'NS_TIMELINE'            => true,
'NS_HISTORICAL_TIMELINE' => true,
'NS_CAMPAIGN'            => true,
'NS_DRAFT'               => true
));


## Namespace aliases
$wgNamespaceAliases       = array_merge($wgNamespaceAliases, array(
'P'   => 'NS_PROJECT',
'FCW' => 'NS_PROJECT',
));

# == Namespaces permissions
# ====================================================
$wgNamespaceProtection = array_merge($wgNamespaceProtection, array(
'NS_FREECALIFORNIA_WIKI'      => array('official-edit'),
'NS_FREECALIFORNIA_WIKI_TALK' => array('official-talk-edit'),
'NS_CATEGORY'                 => array('official-edit'),
'NS_CATEGORY_TALK'            => array('official-talk-edit')
));

# Search fixes
$wgNamespacesToBeSearchedDefault = array(
'NS_MAIN'           => true,
'NS_TALK'           => false,
'NS_USER'           => false,
'NS_USER_TALK'      => false,
'NS_PROJECT'        => false,
'NS_PROJECT_TALK'   => false,
'NS_FILE'           => false,
'NS_FILE_TALK'      => false,
'NS_MEDIAWIKI'      => false,
'NS_MEDIAWIKI_TALK' => false,
'NS_TEMPLATE'       => false,
'NS_TEMPLATE_TALK'  => false,
'NS_HELP'           => false,
'NS_HELP_TALK'      => false,
'NS_CATEGORY'       => false,
'NS_CATEGORY_TALK'  => false,
'NS_CAMPAIGN'       => false,
'NS_NEWS'           => true
);
