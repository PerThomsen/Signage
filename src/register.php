<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
require_once("config/init.php");
include_once 'inc/functions.php';
include_once 'inc/register.inc.php';
include_once 'inc/selectCountryCode.inc.php';
sec_session_start();

$mysqli = new mysqli('localhost', 'monacor', 'mona5800', 'media');
if(login_check($mysqli) == true) {
  if (isset($_SESSION['editMenu']) && ($_SESSION['editMenu'] == '1')) {  		
    $menuEdit = 1;
  } else {
    $menuEdit = 0;
  } 
  if (isset($_SESSION['admin']) && ($_SESSION['admin'] == '1')) {
    $admShow = 1;
  } else {
    $admShow = 0;
  }

$usrListeTxt = "";
$sql = <<<SQLTXT
  SELECT
    `username`,
    `email`,
    `languageId`,
    `changeLanguage`,
    `admin`,
    `editMenu`,
    `editArtikel`
  FROM `1_members`
SQLTXT;

if( $database->num_rows( $sql ) > 0 ) {
  $usrListeTxt .= "<tbody>";

  $results = $database->get_results( $sql );
  foreach( $results as $row ) {
	  $usr	  = $row["username"];
	  $ml 	  = $row["email"];
	  $lng	  = $row["languageId"];
	  $cl 	  = $row["changeLanguage"];
	  $adm 	  = $row["admin"];
	  $mnu 	  = $row["editMenu"];
	  $art 	  = $row["editArtikel"];
    $usrListeTxt .= "<tr>";
    $usrListeTxt .= "<td>$usr</td>";
    $usrListeTxt .= "<td>$ml</td>";
    $usrListeTxt .= "<td>$lng</td>";
    $usrListeTxt .= "<td>$cl</td>";
    $usrListeTxt .= "<td>$adm</td>";
    $usrListeTxt .= "<td>$mnu</td>";
    $usrListeTxt .= "<td>$art</td>";
    $usrListeTxt .= "</tr>";
  }
  $usrListeTxt .= "</tbody>";  
} 

  $filNavn  = basename($_SERVER["SCRIPT_FILENAME"]);
  $title    = "Secure Login";
  $pageName = "Register user";
  $cFirma   = "Monacor Danmark A/S";
  $topmenu  = 'admin';

  include "inc/html_top.php";

  include "inc/register_mid.php";

  include "inc/html_bottom.php";
} else { 
  echo "<p>You are not authorized to access this page, please login.</p>";
  header("Refresh: 2; url=index.php");
}
?>  