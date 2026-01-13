<?php
// https://www.w3docs.com/snippets/php/simple-datepicker-like-calendar.html

$date = new DateTime();
$currentMonth = $date->format('m');
$currentYear = $date->format('Y');
$numDays = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
?>
<table>
  <tr>
    <th>Sun</th>
    <th>Mon</th>
    <th>Tue</th>
    <th>Wed</th>
    <th>Thu</th>
    <th>Fri</th>
    <th>Sat</th>
  </tr>

<?php

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
  AND EXTRACT(month FROM (due_date)) = $currentMonth
SQLTXT;

$month   = array();
if( $database->num_rows( $sql ) > 0 ) {
  $results = $database->get_results( $sql );
  foreach( $results as $row ) {
    $id    = $row["id"];
    $due   = $row["due_date"];
    /*
    $month[] = array($id, array(
      
      "due" => $due, 
      "cat" => $cat,
      "hdr" => $hdr,
      "bdy" => $bdy,
      "day" => date("d", strtotime($due)),
      "mth" => date("m", strtotime($due)),
      "yr"  => date("Y", strtotime($due))
    ));
    */
    $month[] = date("d", strtotime($due));

    //echo $month[$id]["day"].'<br />';
  }
  
 
}
//*
echo '<pre>';
print_r($month);
echo '</pre>';
//*/

//echo $month[0]["day"]."<br />";
//echo $month[1]["day"]."<br />";
$cal_data = '';
for ($i = 1; $i <= $numDays; $i++) {
  $dayOfWeek = date('w', strtotime("$currentYear-$currentMonth-$i"));
  if ($i == 1) {
    $cal_data .= '<tr>';
    //echo '<tr>';
    for ($j = 1; $j <= $dayOfWeek; $j++) {
      $cal_data .=  '<td></td>';
    }
  }
 
  $length = count($month);
  for ($k = 0; $k < $length; $k++) { 
    if (isset($month[$k]["day"]) && $month[$k]["day"] == $i) {
      //$dato = '<strong>'.$i.'</strong>';
      $cal_data .= "<td><a href='inc/date_edit.php?d=$i&m=$currentMonth&y=$currentYear'><strong>'.$i.'</strong></a></td>";
    } else {
      //$dato = $i;
      $cal_data .= "<td><a href='inc/date_edit.php?d=$i&m=$currentMonth&y=$currentYear'>'.$i.'</a></td>";
    }
  } 
  
  //echo "<td><a href='inc/date_edit.php?d=$i&m=$currentMonth&y=$currentYear'>$dato</a></td>";
  if ($dayOfWeek == 6 || $i == $numDays) {
    $cal_data .=  '</tr>';
  }
}
echo $cal_data;
?>

</table>