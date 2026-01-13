<?php
// https://www.w3docs.com/snippets/php/simple-datepicker-like-calendar.html

$date = new DateTime();
$currentMonth = $date->format('m');
$currentYear = $date->format('Y');
$numDays = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
?>
<table>
  <tr>'
    <th>Sun</th>
    <th>Mon</th>
    <th>Tue</th>
    <th>Wed</th>
    <th>Thu</th>
    <th>Fri</th>
    <th>Sat</th>
  </tr>

<?php
$table = $GLOBALS['cTable'];
$sql = <<<SQLTXT
  SELECT
    `cat_id`,
    `cat_txt`
  FROM `$table`
SQLTXT;

$cat = array();
if( $database->num_rows( $sql ) > 0 ) {
  $results = $database->get_results( $sql );
  foreach( $results as $row ) {
    $cId    = $row["cat_id"];
    $cTxt   = $row["cat_txt"];
    $cat[$cId] = $cTxt;
  }
}

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

for ($i = 1; $i <= $numDays; $i++) {
  $dayOfWeek = date('w', strtotime("$currentYear-$currentMonth-$i"));
  if ($i == 1) {
    echo '<tr>';
    for ($j = 1; $j <= $dayOfWeek; $j++) {
      echo '<td></td>';
    }
  }
  echo "<td>$i</td>";
  if ($dayOfWeek == 6 || $i == $numDays) {
    echo '</tr>';
  }
}

?>

</table>