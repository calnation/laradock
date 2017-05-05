<?php

if(!defined('MEDIAWIKI')) {
    exit;
} // Protect against web entry

if(load_extension('ConfirmEdit')) {
    # Send IP address of current user to Google, set true if you hate humanity
        $wgReCaptchaSendRemoteIP = false;
    $ceAllowConfirmedEmail   = true;
    $wgCaptchaTriggers       = array(
    'edit'          => true,
    'create'        => true,
    'createtalk'    => true,
    'addurl'        => true,
    'createaccount' => true,
    'badlogin'      => true,
    ) + $wgCaptchaTriggers;
    
    
    // Load QuestyCaptcha plugin
    wfLoadExtension('ConfirmEdit/QuestyCaptcha');
    
    // Set QuestyCaptcha as the active captcha
    $wgCaptchaClass = 'QuestyCaptcha';
    
    $arr = [
    "If someone asked 'How are you today?,' the most common answer is.. (Hint: Starts with 'g')" => "good",
    "What is this wiki's name?" => "$wgSitename",
    'Please write the magic secret, "freedom", here:' => 'freedom',
    'What is this called? <img src="https://upload.wikimedia.org/wikipedia/commons/4/4d/Cat_March_2010-1.jpg" alt="" title="" />' => 'cat',
    "What's a color you see on this page?" => array('red', 'blue', 'white', 'black', 'gray', 'grey'),
    "What does 'Cal' stand for?" => "California",
    "In which city does the Governer of California work?" => "Sacramento"
    ];
    
    foreach($arr as $key => $value) {
        $wgCaptchaQuestions[] = array('question' => $key, 'answer' => $value);
    }
    
    $qcg          = array(
    'n'   => array(
    'zero', 'one', 'two', 'three', 'four',
    'five', 'six', 'seven', 'eight', 'nine',
    ),
    'min' => array(mt_rand(0, 9), mt_rand(0, 9)),
    'max' => array(mt_rand(0, 9), mt_rand(0, 9)),
    );
    $qcg['min'][] = min($qcg['min'][0], $qcg['min'][1]);
    $qcg['max'][] = max($qcg['max'][0], $qcg['max'][1]);
    
    $wgCaptchaQuestions[] = array(
    'question' => "Which is smaller, {$qcg['n'][$qcg['min'][0]]} or {$qcg['n'][$qcg['min'][1]]}?",
    'answer'   => $qcg['n'][$qcg['min'][2]],
    );
    $wgCaptchaQuestions[] = array(
    'question' => "Which is larger, {$qcg['n'][$qcg['max'][0]]} or {$qcg['n'][$qcg['max'][1]]}?",
    'answer'   => $qcg['n'][$qcg['max'][2]],
    );
}