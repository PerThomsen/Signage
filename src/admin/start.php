<?php
  error_reporting(E_ALL);
  ini_set('display_errors','On');
  require_once("../config/init.php");
  include_once '../config/functions.php';
  sec_session_start();
  $grpTxtHdr = 'Vælg emne';

/*
  echo '<pre>';
  print_r($_REQUEST);
  print_r($_SESSION);
  echo '</pre>';
/*/

  if (!isset($_SESSION['login_string'])) {
    header("Location: index.php");
  }

  if (isset($_REQUEST['cat'])) {
    $grpId    = $_REQUEST['cat'];
  } else {
    $grpId = 1;
  }
  $grp_file = $GLOBALS['cTable'];
  $selector = '';
  $query    = "SELECT cat_txt FROM `$grp_file` WHERE cat_id = $grpId;";
  $results  = $database->get_results( $query );

  if ( $database->num_rows( $query ) > 0 ) {
    list( $grpTxtHdr) = $database->get_row( $query );
  }

  $title    = "Monacor Split";
  $pageName = "Backend - Edit";
  $cFirma   = "Monacor International";

  include "inc/html_top.php";

  include "inc/start_mid.php";

  include "inc/html_bottom.php";

?>