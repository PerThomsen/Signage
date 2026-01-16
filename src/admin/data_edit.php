<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
require_once("../config/init.php");
include_once '../config/functions.php';
sec_session_start();

if (isset($_SESSION['login_string'])) {
  $updateFile = 'data_update.php';
  $datId      = 0;

/*
  echo '<pre>';
  print_r($_REQUEST);
  print_r($_SESSION);
  echo '</pre>';
/*/

  if (isset($_REQUEST['cat'])) {
    $cat = $_REQUEST['cat'];
  	$dateTxtY = $_REQUEST['y'];
  	$dateTxtM = $_REQUEST['m'];
  	$dateTxtD = $_REQUEST['d'];
    $dateNew  = $_REQUEST['new'];

    $_SESSION['y']   = $dateTxtY;
    $_SESSION['m']   = $dateTxtM;
    $_SESSION['d']   = $dateTxtD;
    $_SESSION['new'] = $dateNew;
    $_SESSION['cat'] =  $cat;

  	$dateTxt  = $dateTxtY.'-'.$dateTxtM.'-'.$dateTxtD;
  	$date = date_create($dateTxt);
  	$thisDay = date_format($date,"Y-m-d");

$table = $GLOBALS['cTable'];
$sql = <<<SQLTXT
  SELECT
    `cat_txt`
  FROM `$table`
  WHERE `cat_id` = $cat
SQLTXT;
}

  if( $database->num_rows( $sql ) > 0 ) {
    $results = $database->get_results( $sql );
    foreach( $results as $row ) {
      $catTxt = $row["cat_txt"];
    }
  }
  

$table = $GLOBALS['dTable'];
$sql = <<<SQLTXT
  SELECT 
    `id`, 
    `headertxt`, 
    `body_text` 
  FROM `$table`
  WHERE `category_id` = $cat
  AND DATE(`due_date`) = DATE("$thisDay")
SQLTXT;

  if ( $database->num_rows( $sql ) > 0 ) {
    list( $datId, $headerTxt, $bodyTxt ) = $database->get_row( $sql );
  } else {
    $headerTxt = 'No data';
    $bodyTxt   = 'No data';
  }

}

  $title    = "Monacor data";
  $pageName = "Backend - Edit";
  $cFirma   = "Monacor International";

  include "inc/html_top.php";

  include "inc/date_edit_mid.php";


?>