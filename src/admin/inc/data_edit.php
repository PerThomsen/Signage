<?php
  error_reporting(E_ALL);
  ini_set('display_errors','On');
  require_once("../../config/init.php");
  include_once '../../config/functions.php';
  sec_session_start();
//*
echo '<pre>';
print_r($_REQUEST);
print_r($_SESSION);
echo '</pre>';
//*/

if (isset($_REQUEST['y'])) {
	$dateTxtY = $_REQUEST['y'];
	$dateTxtM = $_REQUEST['m'];
	$dateTxtD = $_REQUEST['d'];
	$dateTxt  = $dateTxtY.'-'.$dateTxtM.'-'.$dateTxtD;
	$date = date_create($dateTxt);
	$thisDay = date_format($date,"d/m/Y");
	echo $thisDay;
	//echo "<br />";
	//echo date('d/m/Y', time());
}

$table = $GLOBALS['cTable'];
$sql = <<<SQLTXT
  SELECT
    `cat_txt`
  FROM `$table`
  WHERE `cat_id` = 1
SQLTXT;

$cat = '';
if( $database->num_rows( $sql ) > 0 ) {
  $results = $database->get_results( $sql );
  foreach( $results as $row ) {
    $cat = $row["cat_txt"];
  }
}
echo "<br />".$cat."<br />";

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


?>