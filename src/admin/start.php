<?php
  error_reporting(E_ALL);
  ini_set('display_errors','On');
  require_once("../config/init.php");
  include_once '../config/functions.php';
  sec_session_start();


  if (!isset($_SESSION['login_string'])) {
    header("Location: index.php");
  }

    
  $title    = "Monacor media data";
  $pageName = "Media database";
  $cFirma   = "Monacor Danmark A/S";

  include "../inc/html_top.php";

  include "inc/start_mid.php";

  include "../inc/html_bottom.php";

?>