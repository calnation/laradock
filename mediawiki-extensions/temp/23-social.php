<?php

if(!defined('MEDIAWIKI')) {
    exit;
} // Protect against web entry
// Requires copying of two directories: https://www.mediawiki.org/wiki/Extension:SocialProfile#Directories
// Should be this, but change $nameofwiki at the end:
// sudo -u www-data cp -R /srv/mediawiki/w/extensions/SocialProfile/avatars /srv/mediawiki/w/extensions/SocialProfile/awards /mnt/mediawiki-static/$nameofwiki/


if(load_extension('SocialProfile')) {
    $wgUserStatsPointValues['edit']                    = 5; // Points awarded on a mainspace edit
    $wgUserStatsPointValues['vote']                    = 1; // Points awarded for voting for an article
    $wgUserStatsPointValues['comment']                 = 1; // Points awarded for leaving a comment
    $wgUserStatsPointValues['comment_plus']            = 2; // Points awarded if your comment gets a thumbs up
    $wgUserStatsPointValues['comment_ignored']         = 0; // Points awarded if another user ignores your comments
    $wgUserStatsPointValues['referral_complete']       = 0; // Points awarded for recruiting a new user
    $wgUserStatsPointValues['friend']                  = 1; // Points awarded for adding a friend
    $wgUserStatsPointValues['foe']                     = 0; // Points awarded for adding a foe
    $wgUserStatsPointValues['gift_rec']                = 10; // Points awarded for receiving a gift
    $wgUserStatsPointValues['gift_sent']               = 0; // Points awarded for giving a gift
    $wgUserStatsPointValues['points_winner_weekly']    = 20; // Points awarded for having the most points for a week
    $wgUserStatsPointValues['points_winner_monthly']   = 50; // Points awarded for having the most points for a month
    $wgUserStatsPointValues['user_image']              = 5; // Points awarded for adding your first avatar
    $wgUserStatsPointValues['poll_vote']               = 0; // Points awarded for taking a poll
    $wgUserStatsPointValues['quiz_points']             = 0; // Points awarded for answering a quiz question
    $wgUserStatsPointValues['quiz_created']            = 0; // Points awarded for creating a quiz question
    $wgNamespacesForEditPoints                         = array(0, 112, 114, 118, 120); // Array of namespaces that can earn you points.
    # The actual user level definitions -- key is simple: 'Level name' => points needed
    $wgUserLevels                                      = array(
    'Newcomer'                 => 0,
    'Beginner'                 => 500,
    'Novice'                   => 1000,
    'Amateur'                  => 1500,
    'Thinking With Bricks'     => 2000,
    'Bricktastic'              => 2500,
    'Building Bigger'          => 5000,
    'Brick Master'             => 7500,
    'Master Builder'           => 10000,
    'LEGO Wizard'              => 12500,
    'Outstanding Brickipedian' => 15000,
    'Honorable Brickipedian'   => 20000,
    'Legendary Brickipedian'   => 25000,
    );
    $wgUserProfileDisplay['stats']                     = true;
    $wgGroupPermissions['sysop']['editothersprofiles'] = true;
    unset($wgGroupPermissions['staff']);
    # require a user to have five edits before accessing Special:UpdateProfile
    $wgUserProfileThresholds                           = array('edits' => 10);
}