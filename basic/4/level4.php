<?php
/*
*
* @package phpBB3 hackthissite  a.k.a htsmod
* @version $Id: basic4.php 1.2 2008/02/11 12:19:29 sean3z Exp $
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
$passBasic4 = pass_basic4($username);

page_header('Basic 4');
$template->set_filenames( array( 'body' => 'missions/basicpage.html' ) );

$email = 'webmaster@'. $_SERVER['HTTP_HOST'];
	
//javascript:alert( document.forms[1].to.value = "webmaster@example.org" )

if ( isset($_POST['to']) && $_POST['to'] != $email ) { $body = 'Here is the password: <font color="red"><b>'. $passBasic4 .'</b></font><br />'; }
else { $body = 'Password reminder successfully sent to:<br /><b>'. $email .'</b><br />'; }
	
$template->assign_vars(array(
	'BODY' => $body)
);

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();


?>

