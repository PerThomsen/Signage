<?php

  $grp_file = $GLOBALS['cTable'];
  $selector = '';
  $query    = "SELECT cat_id, cat_txt FROM `$grp_file`;";
  $results  = $database->get_results( $query );

  if ( $database->num_rows( $query ) > 0 ) {
    foreach( $results as $row ) {
      $id  = $row['cat_id'];
      $txt = $row['cat_txt'];
      if ($id == $grpId) {
        $sel = ' selected';
      } else {
        $sel = ' ';        
      }
     
      echo "<option value='".$row['cat_id']."'$sel>".$row['cat_txt']."</option>\n";
    } 
  }

  
?>