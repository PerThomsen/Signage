<?php
  error_reporting(E_ALL);
  ini_set('display_errors','On');
  require_once("../../config/init.php");
  include_once '../../config/functions.php';
  sec_session_start();

if (isset($_SESSION['login_string'])) {
  
//*
  echo '<pre>';
  print_r($_REQUEST);
  print_r($_SESSION);
  echo '</pre>';
//*/

  if (isset($_REQUEST['cat'])) {
    $cat      = $_REQUEST['cat'];
  	$dateTxtY = $_REQUEST['y'];
  	$dateTxtM = $_REQUEST['m'];
  	$dateTxtD = $_REQUEST['d'];
  	$dateTxt  = $dateTxtY.'-'.$dateTxtM.'-'.$dateTxtD;
  	$date = date_create($dateTxt);
  	$thisDay = date_format($date,"d/m/Y");
  	echo $thisDay;
  	//echo "<br />";
  	//echo date('d/m/Y', time());
  

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
  echo "<br />".$catTxt."<br />";

$table = $GLOBALS['dTable'];
$sql = <<<SQLTXT
  SELECT 
    `id`, 
    `creation_time`, 
    `due_date`, 
    `category_id`, 
    `headertxt`, 
    `body_text` 
  FROM `$table`
  WHERE `category_id` = 1
SQLTXT;

}
?>