<?php
  require_once("../config/init.php");
  //include_once ("inc/functions.php");

sec_session_start();
 

if (login_check($mysqli) == true) {
    $logged = 'in';
    //header("Location: start.php");
} else {
    $logged = 'out';
}
//echo $logged;


  $title    = "Monacor Login Page";
  $pageName = "Login";
  $topmenu  = '';
  $admShow  = '';
  $menuEdit = '';

  include "../inc/html_top.php";
  

  include "../inc/login_mid.php";

  include "../inc/html_bottom.php";

?>
