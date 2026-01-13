<?php
// https://www.w3docs.com/snippets/php/simple-datepicker-like-calendar.html

$date = new DateTime();
$currentMonth = $date->format('m');
$currentYear = $date->format('Y');
$numDays = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

echo '<table>'
;echo '<tr>';
echo '<th>Sun</th>';
echo '<th>Mon</th>';
echo '<th>Tue</th>';
echo '<th>Wed</th>';
echo '<th>Thu</th>';
echo '<th>Fri</th>';
echo '<th>Sat</th>';
echo '</tr>';

for ($i = 1; $i <= $numDays; $i++) {
  $dayOfWeek = date('w', strtotime("$currentYear-$currentMonth-$i"));
  if ($i == 1) {
    echo '<tr>';
    for ($j = 1; $j <= $dayOfWeek; $j++) {
      echo '<td></td>';
    }
  }
  echo '<td>' . $i . '</td>';
  if ($dayOfWeek == 6 || $i == $numDays) {
    echo '</tr>';
  }
}

echo '</table>';
?>