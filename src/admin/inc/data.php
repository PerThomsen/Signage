<?php
// https://www.w3docs.com/snippets/php/simple-datepicker-like-calendar.html

$date = new DateTime();
$currentMonth = $date->format('m');
$currentYear = $date->format('Y');
$numDays = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
$filnavn = 'inc/data_edit.php';
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
    `due_date`
  FROM `$table`
  WHERE `category_id` = 1
  AND EXTRACT(month FROM (due_date)) = $currentMonth
SQLTXT;

$month   = array();
if( $database->num_rows( $sql ) > 0 ) {
  $results = $database->get_results( $sql );
  foreach( $results as $row ) {
    $due   = $row["due_date"];
    $days[] = date("d", strtotime($due));
  }
}

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
 
  if (in_array($i, $days)) {
    $cal_data .= "<td><a href='$filnavn?d=$i&m=$currentMonth&y=$currentYear'><strong>$i</strong></a></td>";
  } else {
    $cal_data .= "<td><a href='$filnavn?d=$i&m=$currentMonth&y=$currentYear'>$i</a></td>";
  }

  if ($dayOfWeek == 6 || $i == $numDays) {
    $cal_data .=  '</tr>';
  }
}
echo $cal_data;
?>

</table>