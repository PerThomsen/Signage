<?php
  error_reporting(E_ALL);
  ini_set('display_errors','On');
  require_once("../config/init.php");
  include_once '../config/functions.php';
  sec_session_start();

/*
  echo '<pre>';
  print_r($_REQUEST);
  print_r($_SESSION);
  echo '</pre>';
*/

  if (!isset($_SESSION['login_string'])) {
    header("Location: index.php");
  }

    
  $title    = "Monacor Split";
  $pageName = "Backend - Edit";
  $cFirma   = "Monacor International";

  include "inc/html_top.php";

  include "inc/start_mid.php";

  include "inc/html_bottom.php";

?>