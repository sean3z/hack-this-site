<?php
/*
*
* @package phpBB3 hackthissite a.k.a htsmod
* @version $Id: realistic1.php 1.2 2008/01/17 09:18:27 sean3z Exp $
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

page_header('Realistic 1');

$date = date('l, F j, Y, g:i a');
$username = get_username_string('full', $user->data['user_id'], $user->data['username'], $user->data['user_colour']);

if ( isset($_GET['id']) ) {
	$intScore = (int) isset($_GET['vote']) ? $_GET['vote'] : 0;
}

if ( isset($_POST['initiate']) ) {
		$template->set_filenames( array( 'body' => 'missions/realisticpage.html' ) );
		$body = '
		<title>uncle arnold\'s local band review!</title>
		<body text="brown">

		<table width=500 cellspacing=0 cellpadding=0 border=0 align="center"><tr><td>
		<font color="brown" face="arial" size=4><b>Welcome to Uncle Arnold\'s Local Band Review Page!</b></font><hr color="black"><font color="brown" face="arial">These are some bands that play in the chicago suburban area. Please contribute your own ratings as well.<br><br><br>

		<b><a href="http://www.a77a.net/imposingrepublic/">Imposing Republic</a></b><br>Imposing Republic is a rock band that incorporates a bit of everything that is good. Good music and good lyrics make this band awesome.<br><i>The average rating of this band is 23.107846155906. How would you rate it?</i>
		<form action="index.php">
		<input type="hidden" name="PHPSESSID" value="abcaeadfc31a5c43b2534bf995c0553f" />
		<input type="hidden" name="id" value="5"><select name="vote"><option value=1>1<option value=2>2<option value=3>3<option value=4>4<option value=5>5</select> <input type="submit" value="vote!">
		</form>

		<br><b><a href="http://www.threespinsfive.com">Three Spins Five</a></b><br>A merry mix of brass instruments, bongos, a turn table, and various other sounds and composed in such a unique and melodic way. Tip top, I give it a A.<br><i>The average rating of this band is 4.794992435452. How would you rate it?</i>
		<form action="index.php">
		<input type="hidden" name="PHPSESSID" value="abcaeadfc31a5c43b2534bf995c0553f" />
		<input type="hidden" name="id" value="3"><select name="vote"><option value=1>1<option value=2>2<option value=3>3<option value=4>4<option value=5>5</select> <input type="submit" value="vote!">
		</form>

		<br><b><a href="http://www.flagofnothing.com">The Flag of Nothing</a></b><br>A young punk band consisting of idealistic but underdeveloped theories about how money should be distributed within our country. It is good to see that they are trying to mix a message with their music, but the tunes suck. I give it a C<br><i>The average rating of this band is 3.6064935510428. How would you rate it?</i>
		<form action="index.php">
		<input type="hidden" name="PHPSESSID" value="abcaeadfc31a5c43b2534bf995c0553f" />
		<input type="hidden" name="id" value="1"><select name="vote"><option value=1>1<option value=2>2<option value=3>3<option value=4>4<option value=5>5</select> <input type="submit" value="vote!">
		</form>

		<br><b><a href="http://www.ape.com">Killing Mr. A.P.E.</a></b><br>A hip hop group of five people who recently moved in from the city and wants to "be representin\'" in the suburban areas. The music is can barely be considered music at all but they seem to have a way of livening the crowds. I give it a D.<br><i>The average rating of this band is 2.6534181307877. How would you rate it?</i>
		<form action="index.php">
		<input type="hidden" name="PHPSESSID" value="abcaeadfc31a5c43b2534bf995c0553f" />
		<input type="hidden" name="id" value="2"><select name="vote"><option value=1>1<option value=2>2<option value=3>3<option value=4>4<option value=5>5</select> <input type="submit" value="vote!">
		</form>

		<br><b><a href="http://www.raginginferno.com">Raging Inferno</a></b><br>This is a self-proclaimed "hardcore" metal band pretty much covering older slayer songs and nintendo game with added high-pitched screaming. I give these guys an F.<br><i>The average rating of this band is 2.3141751857359. How would you rate it?</i>
		<form action="index.php">
		<input type="hidden" name="PHPSESSID" value="abcaeadfc31a5c43b2534bf995c0553f" />
		<input type="hidden" name="id" value="0"><select name="vote"><option value=1>1<option value=2>2<option value=3>3<option value=4>4<option value=5>5</select> <input type="submit" value="vote!">
		</form>

		<br></td></tr></table></body>
		';
}
else {
	$template->set_filenames(array(
		'body' => 'missions/basicpage.html',
	));
	$body = "
	<h3>Realistic 1 [ 200 Points ]</h3>
	<b>From</b>: HeavyMetalRyan <br />
	<b>To</b>: {$username} <br />
	<b>Date</b>: {$date} <br />
<b>Message</b>: Hey man, I need a big favor from you. Remember that website I showed you once before? Uncle Arnold's Band Review Page? Well, a long time ago I made a $500 bet with a friend that my band would be at the top of the list by the end of the year. Well, as you already know, two of my band members have died in a horrendous car accident... but this asshole still insists that the bet is on!
I know you're good with computers and stuff, so I was wondering, is there any way for you to hack this website and make my band on the top of the list? My band is Raging Inferno. Thanks a lot, man!<br />
<br />
<form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">
	<dl>
	<input type=\"hidden\" name=\"initiate\" value=\"yes\">
	<dd><input name=\"submit\" type=\"submit\" id=\"submit\" class=\"button2\" value=\"initiate\"></dd>
	</dl>
</form>
	";
}

$template->assign_vars(array(
	'RESULT' => $result,
	'BODY' => $body)
);

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();

?>



