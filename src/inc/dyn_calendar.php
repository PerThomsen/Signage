<?php

$thisDay = date("Y-m-d");

$grpId = 1;
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
    $tidspunkt = date_format($date, 'H:i');
    
    // Remove unwanted chars
    $headerTxt = preg_replace("/[^a-zA-Z0-9\s]+/", "", rtrim($headerTxt));

    // BodyTst for test BodyTxt for viewing
    $bodyTst   = preg_replace("/[^a-zA-Z0-9\s]+/", "", rtrim($bodyTxt));
    $bodyTst   = rtrim(ltrim($bodyTst,"p"),"p");

    // Show Body text if present
    echo "<h3>";
    echo ($headerTxt<>"No data"?$headerTxt:'')."<br />";
    echo "</h3>";
    if ($bodyTst != "No data") {
	    echo "<p>"; 
	    echo $bodyTxt;
	    echo "</p>";   	
    }    
  }

?>
