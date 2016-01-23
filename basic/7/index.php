<?php
/*
*
* @package phpBB3 hackthissite  a.k.a htsmod
* @version $Id: basic5.php 1.2 2007/12/19 02:05:16 sean3z Exp $
* @copyright (c) HTS Mod - http://triggsolutions.com/forum/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/
define('IN_PHPBB', true);
$phpbb_root_path = '../../../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'missions/common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

page_header('Basic 7');
$template->set_filenames( array( 'body' => 'missions/basicpage.html' ) );

$username = $user->data['username'];
$passBasic7 = pass_basic7($username);

if ( isset($_GET['p']) ) { $result = '<font color="red"><b>Congratulations, you have successfully completed basic 6!</b></font>'; }

if ( isset($_POST['password']) ) {
	if ( $_POST['password'] == $passBasic7 ) { redirect( '../8/?p'); }
	else { $result = '<font color="red"><b>Sorry, but you have entered an incorrect password</b></font>'; }
}

$body = '<!-- START BASIC7 MISSION -->
		<b>Level 7</b></center><br />
		This time Network Security sam has saved the unencrypted level7 password in an obscurely named file saved in this very directory.
		<br /><br />
		In other unrelated news, Sam has set up a script that returns the output from the UNIX cal command. Here is the script:
		<br />Enter the year you wish to view and hit \'view\'.<br /><br />
<form action="cal.pl" method="post">
  <dl>
  <dd><input type="text" name="cal" /></dd>
  <input type="submit" class="button2" value="view" />
  </dl>
</form>
<br /><br />
<center><b>password:</b><br />
						 <form action="index.php" method="post">
						 <dl>
						 <dd><input type="password" name="password"><br /></dd>
						 <input type="submit" class="button2" value="submit">
						 </dl>
						 </form>
		<!-- END BASIC7 MISSION -->';
 
if ( isset($_GET['debug']) && $_GET['debug'] == $debugpass ) {
	$result = 'pass: <font color="red"><b>'. $passBasic7 .'</b></font> <a href="../8/?debug='. $debugpass .'">»</a>';
}

$template->assign_vars(array(
	'BODY'	=> $body,
	'RESULT' => '<div class="panel" id="faqlinks"><div class="inner"><span class="corners-top"><span></span></span><center>'. $result .'</center><span class="corners-bottom"><span></span></span></div></div>'
	)
);

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();

?>