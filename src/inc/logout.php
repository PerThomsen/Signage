<?php
include_once 'functions.php';
//include_once 'includes/functions.php';
sec_session_start();
 
if (isset($_SESSION['languagePrefx'])){
  $langPre = $_SESSION['languagePrefx'];
}
// Unset all session values 
$_SESSION = array();
 
// get session parameters 
$params = session_get_cookie_params();
 
// Delete the actual cookie. 
setcookie(session_name(),
        '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]);
 
// Destroy session 
session_destroy();
if (($langPre == 'dk') || ($langPre == 'no')){
  header('Location: ../index.htm');
} else {
  header('Location: ../login.php');
}
?>