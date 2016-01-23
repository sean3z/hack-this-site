<?php
/**
* @package phpBB3 hackthissite a.k.a htsmod
* @version $Id: basic3.php 1.1 2007/12/20 08:15:12 Sean Wragg Exp $
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
$passBasic3 = pass_basic3($username);

page_header('Basic 3');
$template->set_filenames( array( 'body' => 'missions/basicpage.html' ) );

if ( isset($_GET['p']) ) { $result = '<font color="red"><b>Congratulations, you have successfully completed basic 2!</b></font>'; }

if ( isset($_POST['password']) ) {
	if ( $_POST['password'] == $passBasic3 ) { redirect( '../4/?p'); }
	else { $result = '<font color="red"><b>Sorry, but you have entered an incorrect password</b></font>'; }
}

$body = '<!-- START BASIC3 MISSION -->
	<dl><dd><strong>Level 3</strong></dd></dl><br />
	This time Network Security Sam remembered to upload the password file, but there were deeper problems than that.<br /><br />
	<center>
		<b>password:</b><br />		
		<form action="index.php" method="post">
			<dl>
			<input type="hidden" name="file" value="password.php">
				<dd><input name="password" type="password" tabindex="1" id="title" size="25" value="" class="inputbox autowidth"></dd><br />
				<dd><input name="Submit" type="submit" id="Submit" class="button2" value="Submit"></dd>
			</dl>
		</form>
	</center>
	<!-- END BASIC3 MISSION -->';

if ( isset($_GET['debug']) && $_GET['debug'] == $debugpass ) {
	$result = 'pass: <font color="red"><b>'. $passBasic3 .'</b></font> <a href="../4/?debug='. $debugpass .'">»</a>';
}

$template->assign_vars(array(
	'BODY'	=> $body,
	'RESULT' => '<div class="panel" id="faqlinks"><div class="inner"><span class="corners-top"><span></span></span><center>'. $result .'</center><span class="corners-bottom"><span></span></span></div></div>'
	)
);


make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();

