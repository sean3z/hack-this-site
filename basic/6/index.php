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
$passBasic6 = pass_basic6($username);

page_header('Basic 6');
$template->set_filenames( array( 'body' => 'missions/basicpage.html' ) );

if ( isset($_GET['p']) ) { $result = '<font color="red"><b>Congratulations, you have successfully completed basic 5!</b></font>'; }

if ( isset($_POST['password']) ) {
	if ( $_POST['password'] == $passBasic6 ) { redirect( '../7/?p'); }
	else { $result = '<font color="red"><b>Sorry, but you have entered an incorrect password</b></font>'; }
}

if ( isset($_POST['text']) ) {
	for ( $i = 0; $i < strlen($_POST['text']); $i++ ) {
		$ch = substr($_POST['text'], $i, 1);
		$ret = $ret . chr(ord($ch) + $i);
	}
	$result = 'Your encrypted string is: <font color="red"><b>'. $ret .'</b></font>';
}

$body = '<!-- START BASIC6 MISSION -->
	<dl><dd><strong>Level 6</strong></dd></dl><br />
	Network Security Sam has encrypted his password. The encryption system is publically available and can be accessed with this form:<br /><br />
	<center>Please enter a string to have it encrypted.
	
	<form action="index.php" method="post">
	<dl>
	<dd><input type="text" name="text" tabindex="1" size="25" value="" class="inputbox autowidth"></dd>
	<br /><dd><input type="submit" class="button2" value="encrypt"></dd>
	</dl>
	</form>	
	
	<br />You have recovered his encrypted password. It is: <b>coehzt</b>
	<br />Decrypt the password and enter it below to advance to the next level.<br>
	<br><b>password:</b><br />
	
	<form action="index.php" method="post">
	<dl>
	<dd><input type="password" name="password" id="title" size="25" value="" class="inputbox autowidth"><br /></dd>
	<br /><dd><input type="submit" class="button2" value="submit"></dd>
	</dl></form>
	</center>
	<!-- EMD BASIC6 MISSION -->';

if ( isset($_GET['debug']) && $_GET['debug'] == $debugpass ) {
	$result = 'pass: <font color="red"><b>'. $passBasic6 .'</b></font> <a href="../7/?debug='. $debugpass .'">»</a>';
}

$template->assign_vars(array(
	'BODY'	=> $body,
	'RESULT' => '<div class="panel" id="faqlinks"><div class="inner"><span class="corners-top"><span></span></span><center>'. $result .'</center><span class="corners-bottom"><span></span></span></div></div>'
	)
);

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();

?>