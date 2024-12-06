<?php
include 'includes/class.autoload.inc.php';

 $studentid = $_POST['studentid'];
 $week = $_POST['week'];

$weeklyReportsView = new WeeklyReportsView();
$results = $weeklyReportsView->reportByWeekId($week, $studentid);
if($results != null){
    echo json_encode($results);
}else if ($results == null){
    $studentsView = new StudentsView();
    $result = $studentsView->selectstudentName($studentid);
    $name = $result['name'];
    $weeknum = trim($week);
    echo '[{ "week": ' .$weeknum . ', "name": "' . $name . '"}]';
}
