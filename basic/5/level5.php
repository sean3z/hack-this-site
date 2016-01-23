<?php
/*
*
* @package phpBB3 hackthissite  a.k.a htsmod
* @version $Id: basic3.php 1.2 2007/12/19 02:05:16 sean3z Exp $
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

$username = $user->data['username'];
$passBasic5 = pass_basic5($username);

page_header('Basic 5');
$template->set_filenames( array( 'body' => 'missions/basicpage.html' ) );

$_POST['to'] = addslashes($_POST['to']);
$email = 'webmaster@'. $_SERVER['HTTP_HOST'];
$incorrect = 'Password reminder successfully sent to:<br /><b>'. $email .'</b><br />';
//javascript:alert( document.forms[1].to.value = "webmaster@example.org" )

if ( isset($_POST['to']) && $_POST['to'] != $email ) { 
	if ( preg_match("%(http://)?(www\.)?triggsolutions\.com(/)?%i", $_SERVER['HTTP_REFERER']) ) {
		$body = 'Here is the password: <font color="red"><b>'. $passBasic5 .'</b></font><br />';
	} else { $body = $incorrect; }
}
else { $body = $incorrect; }

		
$template->assign_vars(array(
	'BODY' => $body)
);

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();


?>
