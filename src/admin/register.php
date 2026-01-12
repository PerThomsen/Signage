<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
require_once("../config/init.php");
include_once $sti_til_fil.'/config/register.inc.php';

sec_session_start();

if(login_check($mysqli) == true) {
 
$table = $GLOBALS['mTable'];
$sql = <<<SQLTXT
  SELECT
    `username`,
    `email`
  FROM `$table`
SQLTXT;

$filNavn  = basename($_SERVER["SCRIPT_FILENAME"]);
$usrListeTxt = '';

if( $database->num_rows( $sql ) > 0 ) {
  $usrListeTxt .= "<tbody>";

  $results = $database->get_results( $sql );
  foreach( $results as $row ) {
	  $usr	  = $row["username"];
	  $ml 	  = $row["email"];
    $usrListeTxt .= "<tr>";
    $usrListeTxt .= "<td>$usr</td>";
    $usrListeTxt .= "<td>$ml</td>";
    $usrListeTxt .= "</tr>";
  }
  $usrListeTxt .= "</tbody>";  
} 

  $filNavn  = basename($_SERVER["SCRIPT_FILENAME"]);
  $title    = "Secure Login";
  $pageName = "Register user";
  $cFirma   = "Monacor International";

  include "../inc/html_top.php";

  include "../inc/register_mid.php";

  include "../inc/html_bottom.php";
} else { 
  echo "<p>You are not authorized to access this page, please login.</p>";
  header("Refresh: 2; url=index.php");
}
?>  