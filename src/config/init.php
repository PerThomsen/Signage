<?php
  error_reporting(E_ALL);
  ini_set('display_errors','On');

  $cFirma   = "Monacor International";
  $GLOBALS['mTable'] = 'split_admins';
  $GLOBALS['aTable'] = 'split_login_attempts';
  $GLOBALS['dTable'] = 'split_data';  
  $GLOBALS['cTable'] = 'split_category'; 
  $GLOBALS['xTable'] = 'split_month';  

  //Find path
  $sti_til_fil = str_replace(basename(__DIR__),'', dirname(__FILE__));
  require_once($sti_til_fil."/config/class.db.php");

  include_once $sti_til_fil.'/config/psl-config.php';

  include_once $sti_til_fil.'/config/functions.php';

  //$database = new DB();
  $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

  define( 'DB_HOST', HOST ); // set database host
  define( 'DB_USER', USER ); // set database user
  define( 'DB_PASS', PASSWORD ); // set database password
  define( 'DB_NAME', DATABASE ); // set database name
  define( 'DISPLAY_DEBUG', true ); //display db errors?

  //Initiate the class
  $database = new DB();


?>