<?php
// https://www.w3docs.com/snippets/php/simple-datepicker-like-calendar.html

if (isset($_SESSION['login_string'])) {
  $filnavn  = 'data_edit.php';
  $startfil = 'start.php';

  if (isset($_REQUEST['m'])) {
    $currentMonth = $_REQUEST['m'];
    $currentYear  = $_REQUEST['y'];
  } elseif (isset($_SESSION['m'])) {
    $currentYear  = $_SESSION['y'];
    $currentMonth = $_SESSION['m'];
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
<div class="col-sm-12">
  <div class="row">
    <h2><?php echo $name; ?></h2>
    <table >
      <tr clas='calendar'>
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
  WHERE `category_id` = $grpId
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
    $cal_data .= "<tr>";
    //echo '<tr>';
    for ($j = 1; $j <= $dayOfWeek; $j++) {
      $cal_data .=  '<td></td>';
    }
  }
 
  if (in_array($i, $days)) {
    $cal_data .= "<td><a class='tbl_no_line' href='$filnavn?d=$i&m=$currentMonth&y=$currentYear&cat=$grpId&new=0'><strong>$i</strong></a></td>";
  } else {
    $cal_data .= "<td><a class='tbl_no_line' href='$filnavn?d=$i&m=$currentMonth&y=$currentYear&cat=$grpId&new=1'>$i</a></td>";
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
  //$navPrew = "<a class='tbl_no_line' href='$startfil?m=$prewMonth&y=$prewYear&cat=1'>&#8592;&nbsp;Prew</a>";
  //$navNext = "<a class='tbl_no_line' href='$startfil?m=$nextMonth&y=$nextYear&cat=1'>Next&nbsp;&#8594;</a>";
  $navPrew = "$startfil?m=$prewMonth&y=$prewYear&cat=1";
  $navNext = "$startfil?m=$nextMonth&y=$nextYear&cat=1";
?>
  <div class="row">
   <div class="col-sm-2 text-left">
    &nbsp;
  </div>
   <div class="col-sm-2 text-left">
       <a href="<?php echo $navPrew; ?>" class="btn btn-primary" role="button">&#8592;&nbsp;Prew</a>
     </div>
    <div class="col-sm-6 text-left">
       &nbsp;
     </div>
    <div class="col-sm-2 text-left">
       <a href="<?php echo $navNext; ?>" class="btn btn-primary" role="button">Next&nbsp;&#8594;</a>
    </div>  
</div>
