<?php
/*
*
* @package phpBB3 hackthissite  a.k.a htsmod
* @version $Id: basic6.php 1.2 2007/12/20 09:59:36 sean3z Exp $
* @copyright (c) HTS Mod - http://triggsolutions.com/forum/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/
define('IN_PHPBB', true);
$phpbb_root_path = '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'missions/common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

$username = $user->data['username'];
$passbasic7 = pass_basic7($username);
$passbasic8 = pass_basic8($username);

$template->set_filenames(array(
    'body' => 'missions/basicpage.html',
));

if (isset($_POST['password']))
	{
		if ($_POST['password'] == $passbasic7)
	{
			page_header('Basic 8');
					$result = "
		<div class=\"panel\" id=\"faqlinks\">
		<div class=\"inner\"><span class=\"corners-top\"><span></span></span> 
		<center><font color=\"red\"><b>Congratulations, you have successfully completed basic 7!</b></font></center> 
		<span class=\"corners-bottom\"><span></span></span></div>
		</div>
		";
		$body = "this challenge is still under construction please check back later<br /><br /><p align=\"right\">[ <a href=\"http://triggsolutions.com/forum/challenges.php\">return</a> ]";
	}
		else
	{
			page_header('Basic 7');
				$result = "
		<div class=\"panel\" id=\"faqlinks\">
		<div class=\"inner\"><span class=\"corners-top\"><span></span></span> 
		<center><font color=\"red\"><b>Sorry, but you have entered an incorrect password</b></font></center> 
		<span class=\"corners-bottom\"><span></span></span></div>
		</div>
		";
			$body =	"<b>Level 7</b></center><br />
		This time Network Security sam has saved the unencrypted level7 password in an obscurely named file saved in this very directory.
		<br /><br />
		In other unrelated news, Sam has set up a script that returns the output from the UNIX cal command. Here is the script:
		<br />Enter the year you wish to view and hit 'view'.<br /><br />
<form action=\"basic7/cal.pl\" method=\"post\">
  <dl>
  <dd><input type=\"text\" name=\"cal\" /></dd>
  <input type=\"submit\" class=\"button2\" value=\"view\" />
  </dl>
</form>
<br /><br />
<center><b>password:</b><br />
						 <form action=\"$PHP_SELF\"  method=\"post\">
						 <dl>
						 <dd><input type=\"password\" name=\"password\"><br /></dd>
						 <input type=\"submit\" class=\"button2\" value=\"submit\">
						 </dl>
						 </form>
						 ";
	}
}
else { 
page_header('Basic 8');
$body = "this challenge is still under construction please check back later<br /><br /><p align=\"right\">[ <a href=\"http://triggsolutions.com/forum/challenges.php\">return</a> ]";
}

if (isset($_GET['debug'])) {
if ($_GET['debug'] == $debugpass) {
$result =  "<div class=\"panel\" id=\"faqlinks\">
		<div class=\"inner\"><span class=\"corners-top\"><span></span></span> 
		<center>pass: <font color=\"red\"><b>{$passbasic8}</b></font></center> 
		<span class=\"corners-bottom\"><span></span></span></div>
		</div>";
}
}

	$template->assign_vars(array(
	'RESULT' => $result,
	'BODY' => $body)
);

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();

?>