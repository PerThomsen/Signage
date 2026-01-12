<?php
  error_reporting(E_ALL);
  ini_set('display_errors','On');

  $cFirma   = "Monacor International";
  $GLOBALS['mTable'] = 'split_admins';
  $GLOBALS['aTable'] = 'split_login_attempts';
  //Find path
  $sti_til_fil = str_replace(basename(__DIR__),'', dirname(__FILE__));
  require_once($sti_til_fil."/config/class.db.php");

  include_once $sti_til_fil.'/config/psl-config.php';

  include_once $sti_til_fil.'/config/functions.php';

  //$database = new DB();
  $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);


?>