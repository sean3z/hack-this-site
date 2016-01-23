<?php
/**
* @package phpBB3 hackthissite a.k.a htsmod
* @version $Id: basic1.php 1.2 2007/12/19 02:05:16 Sean Wragg Exp $
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
$passBasic1 = pass_basic1($username);

page_header('Basic 1');
$template->set_filenames( array( 'body' => 'missions/basicpage.html' ) );

if ( isset($_POST['password']) ) {
	if ( $_POST['password'] == $passBasic1 ) { redirect( '../2/?p'); }
	else { $result = '<font color="red"><b>Sorry, but you have entered an incorrect password</b></font>'; }
}

$body = '<!-- START BASIC1 MISSION -->
	<dl><dd><strong>Level 1 ( the idiot test ) [ 50 Points ]</strong></dd></dl>
	<br />
	This level is what we call "The Idiot Test". If you can\'t complete it, don\'t give up on learning all you can. Enter the password and you can continue. <br /><br />
    <!-- the first few levels are extremely easy, the password is: '. $passBasic1 .' --><br /><center><b>password:</b><br />
	<form action="index.php" method="post">
	<dl>
	<dd><input name="password" type="password" tabindex="1" id="title" size="25" value="" class="inputbox autowidth"></dd><br />
	<dd><input name="Submit" type="submit" id="Submit" class="button2" value="Submit"></dd>
	</dl>
	</form>
	</center>
	<!-- END BASIC1 MISSION -->';

if ( isset($_GET['debug']) && $_GET['debug'] == $debugpass ) {
	$result = 'pass: <font color="red"><b>'. $passBasic1 .'</b></font> <a href="../2/?debug='. $debugpass .'">»</a>';
}
		
$template->assign_vars(array(
	'BODY'	=> $body,
	'RESULT' => '<div class="panel" id="faqlinks"><div class="inner"><span class="corners-top"><span></span></span><center>'. $result .'</center><span class="corners-bottom"><span></span></span></div></div>'
	)
);
		
make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();
?>
