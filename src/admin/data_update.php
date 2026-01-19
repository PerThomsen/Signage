<?php

error_reporting(E_ALL);
ini_set('display_errors','On');
require_once("../config/init.php");
include_once '../config/functions.php';
sec_session_start();
$table = $GLOBALS['dTable'];
$returnPage = 'start.php';

/*
echo '<pre>';
print_r($_REQUEST);
print_r($_SESSION);
echo '</pre>';
/*/

if (!isset($_SESSION['login_string'])) {
header("Location: index.php");
}

if (isset($_REQUEST['datId'])) {
	$datId = $_REQUEST['datId'];
	if (isset($_REQUEST['headerTxt'])) {
		$catId     = $_REQUEST['catId'];
		$headerTxt = $_REQUEST['headerTxt'];
		$bodyTxt   = (isset($_REQUEST['bodyTxt'])?$_REQUEST['bodyTxt']:'');
		$new       = $_REQUEST['new'];
		$dateTxt   = $_REQUEST['date'];
	}

	if (isset($_REQUEST['delete']) && ($_REQUEST['delete'] == 1)) {
		// Delet entry

		$delete = array(
		'id' => $datId
		);

		$deleted = $database->delete( $table, $delete, 1 );
		if( $deleted ) {
		  echo '<p>Successfully deleted from the database.</p>';
		  header("Refresh: 2; URL=".$returnPage);
		} else {
		  echo '<p style="color:Tomato;>Error on deleting data</p>';
		  header("Refresh: 5; URL=".$returnPage);
		}

	} elseif ($new == '1') {

	    // Insert new data
      	$date = date_create($dateTxt);
  		$thisDay = date_format($date,"Y-m-d");

	    $indata = array(
			//'datId'     => $datId,
		    'category_id' => $catId,
		    'headertxt'   => $headerTxt,
		    'body_text'   => $bodyTxt,
		    'due_date'    => $thisDay
	    );

	    $add_query = $database->insert( $table, $indata );
	    if( !$add_query ){
	      echo '<p style="color:Tomato;>Fejl ved indsættelse af data</p>';
        } else {
        	echo '<p>Data saved</p>';
        	header("Refresh: 2; URL=".$returnPage);
        }

	} else {
		// Update data

		$update = array(
		    'headertxt' => $headerTxt,
		    'body_text' => $bodyTxt
		);
		$where_clause = array(
			'id' => $datId
		);
		
		$updated = $database->update( $table, $update, $where_clause, 1 );
		
		if( $updated ) {
			echo '<p>Data successfully updated </p>';
			header("Refresh: 2; URL=".$returnPage);
	    }
	    
    }

}

?>