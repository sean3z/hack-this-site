<?php
/*
*
* @package phpBB3 hackthissite  a.k.a htsmod
* @version $Id: basic2.php 1.2 2007/12/19 02:05:16 sean3z Exp $
* @copyright (c) HTS Mod - http://triggsolutions.com/forum/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/
define('IN_PHPBB', true);
$phpbb_root_path = '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'missions/common.' . $phpEx);
//include($phpbb_root_path . 'includes/mods/functions_points.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

$date = date("l, F j, Y, g:i a");
$username = get_username_string('full', $user->data['user_id'], $user->data['username'], $user->data['user_colour']);
$userid = $user->data['user_id'];

$intScore = ( ( isset($_GET['vote']) ) ? $_GET['vote'] : 0 );

if (!isset($_POST['initiate']))
{
if (isset($_GET['id'])) {
if ($intScore > 5 AND $_GET['id'] == 0)
{
	page_header('Realistic 2');
		$template->set_filenames(array(
		'body' => 'missions/basicpage.html',
	));
	add_points($userid,200);
			$result = "
			<div class=\"panel\" id=\"faqlinks\">
		<div class=\"inner\"><span class=\"corners-top\"><span></span></span> 
	<center><font color=\"red\"><b>Congradulations, you have sucessfully completed Realstic 1!</b></font></center> 
			<span class=\"corners-bottom\"><span></span></span></div>
		</div>
	";
	
	$body = "
	<h3>Realistic 2 || 400 Points</h3>
	<b>From</b>: DestroyFascism <br />
		<b>To</b>: {$username} <br />
	<b>Date</b>: {$date} <br />
	<b>Message</b>: I have been informed that you have quite admirable hacking skills. Well, this racist hate group is using their website to organize a mass gathering of ignorant racist bastards. We cannot allow such bigoted aggression to happen. If you can gain access to their administrator page and post messages to their main page, we would be eternally grateful.<br />
	<br /><form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">
	<dl>
	<input type=\"hidden\" name=\"initiate\" value=\"yes\">
	<dd><input name=\"submit\" type=\"submit\" id=\"submit\" class=\"button2\" value=\"initiate\"></dd>
	</dl>
</form>
	";
}
else { 
page_header('Realistic 1');
	$template->set_filenames(array(
		'body' => 'missions/basicpage.html',
	));
	$result = "
			<div class=\"panel\" id=\"faqlinks\">
		<div class=\"inner\"><span class=\"corners-top\"><span></span></span> 
	<center><font color=\"red\"><b>Please retry, Realistic 1 not completed!</b></font></center> 
			<span class=\"corners-bottom\"><span></span></span></div>
		</div>
	";
		$body = "
	<h3>Realistic 1 || 200 Points</h3>
	<b>From</b>: HeavyMetalRyan <br />
	<b>To</b>: {$username} <br />
	<b>Date</b>: {$date} <br />
<b>Message</b>: Hey man, I need a big favor from you. Remember that website I showed you once before? Uncle Arnold's Band Review Page? Well, a long time ago I made a $500 bet with a friend that my band would be at the top of the list by the end of the year. Well, as you already know, two of my band members have died in a horrendous car accident... but this asshole still insists that the bet is on!
I know you're good with computers and stuff, so I was wondering, is there any way for you to hack this website and make my band on the top of the list? My band is Raging Inferno. Thanks a lot, man!<br />
<br />
<form action=\"realistic1.php\" method=\"post\">
	<dl>
	<input type=\"hidden\" name=\"initiate\" value=\"yes\">
	<dd><input name=\"submit\" type=\"submit\" id=\"submit\" class=\"button2\" value=\"initiate\"></dd>
	</dl>
</form>
	";
}
}
else {
	page_header('Realistic 2');
	$template->set_filenames(array(
		'body' => 'missions/basicpage.html',
	));
		$body = "
	<h3>Realistic 2 || 400 Points</h3>
	<b>From</b>: DestroyFascism <br />
		<b>To</b>: {$username} <br />
	<b>Date</b>: {$date} <br />
	<b>Message</b>: I have been informed that you have quite admirable hacking skills. Well, this racist hate group is using their website to organize a mass gathering of ignorant racist bastards. We cannot allow such bigoted aggression to happen. If you can gain access to their administrator page and post messages to their main page, we would be eternally grateful.<br />
	<br /><form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">
	<dl>
	<input type=\"hidden\" name=\"initiate\" value=\"yes\">
	<dd><input name=\"submit\" type=\"submit\" id=\"submit\" class=\"button2\" value=\"initiate\"></dd>
	</dl>
</form>";
}
}
else
{
	page_header('Realistic 2');
	$template->set_filenames(array(
		'body' => 'missions/realisticpage.html',
	));
	
	$body = "still working on this come back later";
}

$template->assign_vars(array(
	'RESULT' => $result,
	'BODY' => $body)
);

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();

?>
