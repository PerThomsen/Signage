<?php
  error_reporting(E_ALL);
  ini_set('display_errors','On');
  require_once("config/init.php");
  //include_once '../config/connect.php';
  include_once 'config/functions.php';
  sec_session_start();

  //include 'inc/session_unset.php';

/*
echo "<pre>";
echo print_r($_REQUEST);
echo print_r($_SESSION);
echo "</pre>";
//*/  
  

  if (!isset($_SESSION['login_string'])) {
    header("Location: index.php");
  }





  //------------To-do list END -------------
    
  $title    = "Monacor media data";
  $pageName = "Media database";
  $cFirma   = "Monacor Danmark A/S";

  include "inc/html_top.php";

  include "inc/start_mid.php";

  include "inc/html_bottom.php";

?>