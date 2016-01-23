<?php
/**
* @package phpBB3 hackthissite a.k.a htsmod
* @version $Id: basic2.php 1.7 2007/12/19 01:08:32 Sean Wragg Exp $
* @copyright (c) HTS Mod - http://triggsolutions.com/forum/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
**/

define('IN_PHPBB', true);
$phpbb_root_path = '../../../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'missions/common.' . $phpEx);
//include($phpbb_root_path . 'includes/mods/functions_points.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

$userid = $user->data['user_id'];
$username = $user->data['username'];
$passBasic2 = pass_basic2($username);

page_header('Basic 2');
$template->set_filenames( array( 'body' => 'missions/basicpage.html' ) );

if ( isset($_GET['p']) ) { $result = '<font color="red"><b>Congratulations, you have successfully completed basic 1!</b></font>'; }

if ( isset($_POST['password']) ) {
	if ( $_POST['password'] == $passBasic2 ) { redirect( '../3/?p'); }
	else { $result = '<font color="red"><b>Sorry, but you have entered an incorrect password</b></font>'; }
}

$body = '<!-- START BASIC2 MISSION -->
	<dl><dd><strong>Level 2 [ 100 Points ]</strong></dd></dl>
					 <br />Network Security Sam set up a password protection script. <br />
					 He made it load the real password from an unencrypted text file and compare it to the password the user enters.<br />
					 However, he neglected to upload the password file...<br /><br />
					 <center><b>password:</b /><br />
					 <form action="index.php" method="post">
	<dl>
	<dd><input name="password" type="password" tabindex="1" id="title" size="25" value="" class="inputbox autowidth"></dd><br />
	<dd><input name="Submit" type="submit" id="Submit" class="button2" value="Submit"></dd>
	</dl>
	</form>
	</center>
	<!-- END BASIC2 MISSION -->';

if ( isset($_GET['debug']) && $_GET['debug'] == $debugpass ) {
	$result = 'pass: <font color="red"><b>'. $passBasic2 .'</b></font> <a href="../3/?debug='. $debugpass .'">»</a>';
}

$template->assign_vars(array(
	'BODY'	=> $body,
	'RESULT' => '<div class="panel" id="faqlinks"><div class="inner"><span class="corners-top"><span></span></span><center>'. $result .'</center><span class="corners-bottom"><span></span></span></div></div>'
	)
);

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();

?>
