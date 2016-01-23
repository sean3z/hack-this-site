<?php
define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
//include($phpbb_root_path . 'includes/mods/functions_points.' . $phpEx);


// Start session management
$user->session_begin();
$auth->acl($user->data);
//$user->add_lang('mods/points');
$user->setup();

$user_id = $user->data['user_id'];
//$points = get_points($user_id);
$points = 0;
$username = get_username_string('full', $user->data['user_id'], $user->data['username'], $user->data['user_colour']);

page_header('Challenges');

$template->set_filenames(array(
    'body' => 'missions/challenges.html',
));

$template->assign_vars(array(
	'USERNAME' => $username,
	'POINTS' => $points,
	'B1_COMPLETE' => $b1,
	'B2_COMPLETE' => $b2,
	'B3_COMPLETE' => $b3,
	'B4_COMPLETE' => $b4,
	'B5_COMPLETE' => $b5,
	'B6_COMPLETE' => $b6,
	'R1_COMPLETE' => $r1,
	'R2_COMPLETE' => $r2)
);

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();
?>
