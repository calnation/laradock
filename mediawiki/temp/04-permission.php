<?php

if(!defined('MEDIAWIKI')) {
    exit;
} // Protect against web entry
# https://www.mediawiki.org/wiki/Manual:User_rights

function arrayGet($array, $key, $default = [])
{
    return isset($array[$key]) ? $array[$key] : [];
}

$wgGroupPermissions['emailconfirmed'] = arrayGet($wgGroupPermissions, 'emailconfirmed');
$wgGroupPermissions['oversight'] = arrayGet($wgGroupPermissions, 'oversight');
$wgGroupPermissions['autopatrolled'] = arrayGet($wgGroupPermissions, 'autopatrolled');
$wgGroupPermissions['patrollers'] = arrayGet($wgGroupPermissions, 'patrollers');
$wgGroupPermissions['rollbacker'] = arrayGet($wgGroupPermissions, 'rollbacker');

$wgGroupPermissions['*'] = array_merge($wgGroupPermissions['*'],
array(
'abusefilter-log'        => true,
'abusefilter-log-detail' => true,
'abusefilter-view'       => true,
'autocreateaccount'      => false,
'createaccount'          => false,
'createpage'             => false,
'edit'                   => false,
'lookupuser'             => false,
'minoredit'              => false,
'move'                   => false,
'move-categorypages'     => false,
'move-rootuserpages'     => false,
'move-subpages'          => false,
'movefile'               => false,
'read'                   => true,
'reupload'               => false,
'reupload-shared'        => false,
'sendemail'              => false,
'skipcaptcha'            => false,
'upload'                 => false,
'writeapi'               => false,
));


$wgGroupPermissions['user'] = array_merge($wgGroupPermissions['user'], $wgGroupPermissions['*'],
array(
'applychangetags'               => true,
'changetags'                    => true,
'collectionsaveascommunitypage' => true,
'collectionsaveasuserpage'      => true,
'createtalk'                    => true,
'edit'                          => false,
'minoredit'                     => false,
'purge'                         => true,
));

# remove newusers log from RecentChanges
$wgLogRestrictions["newusers"] = 'moderation';


$wgGroupPermissions['emailconfirmed'] = array_merge($wgGroupPermissions['emailconfirmed'],
$wgGroupPermissions['user'],
array(
'edit'        => true,
'minoredit'   => true,
'skipcaptcha' => false,
));


$wgGroupPermissions['autoconfirmed'] = array_merge($wgGroupPermissions['autoconfirmed'],
$wgGroupPermissions['emailconfirmed'],
array(
'editsemiprotected'  => false,
'official-talk-edit' => true,
'reupload'           => true,
'reupload-own'       => true,
'skipcaptcha'        => true,
'upload'             => true,
));


$wgGroupPermissions['autopatrolled'] = array_merge($wgGroupPermissions['autopatrolled'],
$wgGroupPermissions['autoconfirmed'],
array(
'abusefilter-hidden-log'   => true,
'abusefilter-hide-log'     => true,
'autopatrol'               => true,
'createpage'               => true,
'lookupuser'               => true,
'move'                     => true,
'move-subpages'            => true,
'movefile'                 => true,
'mwoauthproposeconsumer'   => true,
'mwoauthupdateownconsumer' => true,
'reupload-shared'          => true,
'skip-moderation'          => true,
'writeapi'                 => true,
));


$wgGroupPermissions['oversight'] = array_merge($wgGroupPermissions['oversight'],
$wgGroupPermissions['autopatrolled'],
array(
'block'             => true,
'browsearchive'     => true,
'delete'            => true,
'deletedhistory'    => true,
'deletedtext'       => true,
'hideuser'          => true,
'nominornewtalk'    => true,
'official-edit'     => true,
'patrol'            => true,
'protect'           => true,
'editsemiprotected' => true,
'rollback'          => true,
'suppressionlog'    => true,
'suppressredirect'  => true,
'viewsuppressed'    => true,
'suppressrevision'  => true,
'unwatchedpages'    => true,
'patrolmarks'       => true,
'pagelang'          => true,
));


# Remove the rollbacker group & move its rights to patrollers
$wgGroupPermissions['patrollers'] = array_merge($wgGroupPermissions['patrollers'],
$wgGroupPermissions['rollbacker']);
unset($wgGroupPermissions['rollbacker']);
unset($wgRevokePermissions['rollbacker']);
unset($wgAddGroups['rollbacker']);
unset($wgRemoveGroups['rollbacker']);
unset($wgGroupsAddToSelf['rollbacker']);
unset($wgGroupsRemoveFromSelf['rollbacker']);


$wgGroupPermissions['patrollers'] = array(
);


$wgGroupPermissions['sysop'] = array_merge($wgGroupPermissions['oversight'],
$wgGroupPermissions['sysop'],
array(
'abusefilter-modify'            => true,
'abusefilter-modify-restricted' => true,
'abusefilter-private'           => true,
'abusefilter-revert'            => true,
'deletelogentry'                => true,
'deleterevision'                => true,
'editusercssjs'                 => true,
'interwiki'                     => true,
'moderation'                    => true,
'nuke'                          => true,
'patrolmarks'                   => true,
'unblockself'                   => false,
));

# Allow sysops to assign "automoderated" flag
$wgAddGroups['sysop'][] = array('automoderated', 'bot', 'patroller');


$wgGroupPermissions['bureaucrat'] = array_merge($wgGroupPermissions['sysop'],
$wgGroupPermissions['bureaucrat'],
array(
'renameuser'           => true,
'usermerge'            => true,
'userrights'           => true,
'deletelogentry'       => true,
'deleterevision'       => true,
'suppressrevision'     => true,
'viewsuppressed'       => true,
'hideuser'             => true,
'editor-in-chief'      => true,
'moderation-checkuser' => true,
'unblockself'          => true,
'siteadmin'            => true,
'editcontentmodel'     => true,
));


$wgGroupPermissions['bot'] = array_merge($wgGroupPermissions['bot'],
array(
'noratelimit'     => true,
'skip-moderation' => true,
'skipcaptcha'     => true,
));



$wgRemoveGroups = array(
'bureaucrat' => array(
'bot',
'sysop',
),
'sysop'      => array(
'autopatrolled',
'confirmed',
'rollbacker',
'staff',
),
);

# defining a set of user groups which should not be shown
$wgImplicitGroups = array('*', 'user', 'autoconfirmed', 'emailconfirmed', 'sysop', 'bureaucrat', 'bot');

# list of user permissions/rights that can be selected for each restriction type on the "page protection"
    $wgRestrictionLevels = array(
'',
'editsemiprotected',
'editprotected',
'editor-in-chief');

# give the "editor-in-chief" permission to users in "bureaucrat" group (so they can apply this protection level to pages)
$wgGroupPermissions['editor-in-chief']['bureaucrat'] = true;

$wgRestrictionTypes[] = 'delete';

# Robot policy
$wgDefaultRobotPolicy = 'index,follow';
