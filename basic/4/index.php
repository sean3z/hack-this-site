<?php
/**
* @package phpBB3 hackthissite a.k.a htsmod
* @version $Id: basic4.php 1.1 2007/12/20 08:15:12 Sean Wragg Exp $
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
$passBasic4 = pass_basic4($username);

page_header('Basic 4');
$template->set_filenames( array( 'body' => 'missions/basicpage.html' ) );

if ( isset($_GET['p']) ) { $result = '<font color="red"><b>Congratulations, you have successfully completed basic 3!</b></font>'; }

if ( isset($_POST['password']) ) {
	if ( $_POST['password'] == $passBasic4 ) { redirect( '../5/?p'); }
	else { $result = '<font color="red"><b>Sorry, but you have entered an incorrect password</b></font>'; }
}

$body = '<!-- START BASIC4 MISSION -->
	    <dl><dd><strong>Level 4</strong></dd></dl><br />
		This time Sam hardcoded the password into the script. <br />
		However, the password is long and complex, and Sam is often forgetful. So he wrote a script that would email his password to him automatically in case he forgot. Here is the script:<br /><br /><center>
		<dl>
		<form action="level4.php" method="post">
        <dd><input type="hidden" name="to" value="webmaster@'. $_SERVER['HTTP_HOST'] .'"></dd>
		<dd><input type="submit" class="button2" value="Send password to Sam"></center><br /><br /></dd>
		</dl>
		</form>
		<dl>
		<form action="index.php" method="post">
        <dd><center><b>password</b>:<br /><input name="password" type="password" tabindex="1" id="title" size="25" value="" class="inputbox autowidth"></dd><br />
        <dd><input name="Submit" type="submit" id="Submit" class="button2" value="Submit"></dd></center>
		</dl></form>
		<!-- END BASIC4 MISSION -->';

if ( isset($_GET['debug']) && $_GET['debug'] == $debugpass ) {
	$result = 'pass: <font color="red"><b>'. $passBasic4 .'</b></font> <a href="../5/?debug='. $debugpass .'">»</a>';
}

$template->assign_vars(array(
	'BODY'	=> $body,
	'RESULT' => '<div class="panel" id="faqlinks"><div class="inner"><span class="corners-top"><span></span></span><center>'. $result .'</center><span class="corners-bottom"><span></span></span></div></div>'
	)
);

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();