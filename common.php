<?php

$debugpass = 'supersecret';

function pass_basic1($username) {
  $pass = '';
  for ($i=0; $i < strlen($username); $i++) {
   $ch = substr($username, $i, 1);
   $er = ord($ch);
   $pass = $pass . chr($er + $i);
  }
  return $pass;
}

function pass_basic2($username) {
	return '';
}

function pass_basic3($username) {
     $pass = crypt(trim($username),base64_encode(CRYPT_STD_DES));
     return $pass;
}

function pass_basic4($username) {
	 $pass = base64_encode($username);
	 return $pass;
}

function pass_basic5($username) {
	 $pass = str_rot13($username);
	 return $pass;
}

function pass_basic6($username) {
	 $pass = 'cncevo';
	 return $pass;
}

function pass_basic7($username) {
	 $pass = md5($username);
	 return $pass;
}

function pass_basic8($username) {
	 $pass = 'oijh32o4io988123kJH';
	 return $pass;
}
?>