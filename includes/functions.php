<?php
error_reporting(E_ALL);

# -------------- GLOBALS --------------
$GLOBALS['errormsg'] = '';

# -------------- LOAD CONF ------------
function getConfig(){
	return parse_ini_file(ROOT_DIR.'conf/config.ini');
}

# ---------- AUTHENTICATION -----------

function &authLoader() {
	if( !isset( $_SESSION[ 'gtri' ] ) ) {
		$_SESSION[ 'gtri' ] = array();
	}
	return $_SESSION['gtri'];
}

function logIn($username, $password) {
	$puggyConf = getConfig();

	if ($username == "" or $password == "" ){
		redirectTo('login.php');
	}
	$user = new User($username);

	if (password_verify($password, $user->PasswordHash)) {
		$authSession =& authLoader();
		$authSession['gtri'] = $username;
		redirectTo(ROOT_DIR.'/');
	} else {
		redirectTo('login.php');
	}
}

function logOut() {
	$authSession =& authLoader();
	unset( $authSession['gtri']);
}

function isLoggedIn() {
	$authSession =& authLoader();
	return isset( $authSession['gtri'] );
}

function currentUser() {
	$authSession =& authLoader();
	return (isset($authSession['gtri']) ? $authSession['gtri'] : '');
}

# ----------- TOKEN SESSION -----------


function newSessionToken(){
	if(isset( $_SESSION['sessiontoken'])){
		destroySessionToken();
	}
	$_SESSION['sessiontoken'] = md5( uniqid() );
}

function destroySessionToken(){
	unset( $_SESSION['sessiontoken']);
}

function checkSessionToken($field_token, $session_token, $redirectUrl){
	if(!isset($field_token) && !isset($session_token) && $field_token !== $session_token){
		redirectTo(ROOT_DIR.$redirectUrl);
	}
}

# -------------- UTILS --------------

function currentPage() {
	return $_SERVER["PHP_SELF"];
}

function redirectTo($href){
		header( "Location: {$href}" );
	  exit;
}

function redirectError($errid){
	$_SESSION['err'] = array('date' => date("Y-m-d H:i:s"), 'message' => $errid);
	redirectTo('error.php');
}

?>
