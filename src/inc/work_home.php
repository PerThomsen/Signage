<?php

$thisDay = date("Y-m-d");

$grpId = 3;
$table = $GLOBALS['dTable'];
$sql = <<<SQLTXT
  SELECT 
    `id`,
    `due_date`,
    `headertxt`, 
    `body_text`
  FROM `$table`
  WHERE `category_id` = $grpId
  AND DATE(`due_date`) = DATE("$thisDay")
SQLTXT;

  if ( $database->num_rows( $sql ) > 0 ) {
    list( $datId, $due_date, $headerTxt, $bodyTxt ) = $database->get_row( $sql );

    $date      = date_create($due_date);
    $dayNice   = date_format($date,"d-m-Y");

    echo "Vi arbejder hjemme i dag d. ".$dayNice;
  }

?>