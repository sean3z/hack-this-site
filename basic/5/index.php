<?php
/**
* @package phpBB3 hackthissite a.k.a htsmod
* @version $Id: basic5.php 1.1 2007/12/20 08:15:12 Sean Wragg Exp $
* @copyright (c) HTS Mod - http://triggsolutions.com/forum/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
**/

define('IN_PHPBB', true);
$phpbb_root_path = '../../../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'missions/common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

$username = $user->data['username'];
$passBasic5 = pass_basic5($username);

page_header('Basic 5');
$template->set_filenames( array( 'body' => 'missions/basicpage.html' ) );

if ( isset($_GET['p']) ) { $result = '<font color="red"><b>Congratulations, you have successfully completed basic 4!</b></font>'; }

if ( isset($_POST['password']) ) {
	if ( $_POST['password'] == $passBasic5 ) { redirect( '../6/?p'); }
	else { $result = '<font color="red"><b>Sorry, but you have entered an incorrect password</b></font>'; }
}

$body = '<!-- START BASIC5 MISSION -->
		<dl><dd><strong>Level 5</strong></dd></dl><br />
		Sam has gotten wise to all the people who wrote their own forms to get the password. <br />
		Rather then actually learn the password, he decided to make his email program a little more secure.<br /><br />
		<center>
		<dl>
		<form action="level5.php" method="post">
        <dd><input type="hidden" name="to" value="webmaster@'. $_SERVER['HTTP_HOST'] .'"></dd>
		<dd><input type="submit" class="button2" value="Send password to Sam"></center><br /><br /></dd>
		</dl>
		</form>
		<dl>
		<form action="index.php" method="post">
        <dd><center><b>password</b>:<br /><input name="password" type="password" tabindex="1" id="title" size="25" value="" class="inputbox autowidth"></dd><br />
        <dd><input name="Submit" type="submit" id="Submit" class="button2" value="Submit"></dd></center>
		</dl></form>
		</center>
		 <!-- EMD BASIC5 MISSION -->';


if ( isset($_GET['debug']) && $_GET['debug'] == $debugpass ) {
	$result = 'pass: <font color="red"><b>'. $passBasic5 .'</b></font> <a href="../6/?debug='. $debugpass .'">»</a>';
}

$template->assign_vars(array(
	'BODY'	=> $body,
	'RESULT' => '<div class="panel" id="faqlinks"><div class="inner"><span class="corners-top"><span></span></span><center>'. $result .'</center><span class="corners-bottom"><span></span></span></div></div>'
	)
);

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();

?>