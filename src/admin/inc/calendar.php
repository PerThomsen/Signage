<?php
// https://www.w3docs.com/snippets/php/simple-datepicker-like-calendar.html

if (isset($_SESSION['login_string'])) {
  $filnavn  = 'data_edit.php';
  $startfil = 'start.php';

  if (isset($_REQUEST['m'])) {
    $currentMonth = $_REQUEST['m'];
    $currentYear  = $_REQUEST['y'];

  } else {
    $date = new DateTime();
    $currentMonth = $date->format('m');
    $currentYear = $date->format('Y');  
  }
  $numDays = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

$table = $GLOBALS['xTable'];
$sql = <<<SQLTXT
  SELECT 
    `name`
  FROM `$table`
  WHERE `id` = $currentMonth
SQLTXT;
  if( $database->num_rows( $sql ) > 0 ) {
    list( $name ) = $database->get_row( $sql );
    //$results = $database->get_row( $sql );

  }
} else {
  header('Location: login.php');
}
?>
<div class="col-sm-4">
  <div class="row">
    <h2><?php echo $name; ?></h2>
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

$days  = array();
$month = array();
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
    $cal_data .= "<td><a href='$filnavn?d=$i&m=$currentMonth&y=$currentYear&cat=1&new=0'><strong>$i</strong></a></td>";
  } else {
    $cal_data .= "<td><a href='$filnavn?d=$i&m=$currentMonth&y=$currentYear&cat=1&new=1'>$i</a></td>";
  }

  if ($dayOfWeek == 6 || $i == $numDays) {
    $cal_data .=  '</tr>';
  }
}
echo $cal_data;
$nextMonth = $currentMonth + 1;
$nextYear  = $currentYear;
if ($nextMonth > 12) {
  $nextYear++;
  $nextMonth = 1;
}

$prewMonth = $currentMonth -1;
$prewYear  = $currentYear;
if ($prewMonth < 1) {
  $prewYear--;
  $prewMonth = 12;
}
?>
    </table>
  </div>
<?php
  $navPrew = "&#8592;&nbsp;<a href='$startfil?m=$prewMonth&y=$prewYear&cat=1'>Prew</a>";
  $navNext = "<a href='$startfil?m=$nextMonth&y=$nextYear&cat=1'>Next</a>&nbsp;&#8594;";
?>
  <div class="row">
    <div class="col-sm-3 text-left">
      <?php echo $navPrew; ?>
    </div>  
    <div class="col-sm-6">
      &nbsp;
    </div>
    <div class="col-sm-3 text-right">
      <?php echo $navNext; ?>
    </div>
  </div>
</div>
