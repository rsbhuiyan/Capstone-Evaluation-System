<?php
include 'includes/class.autoload.inc.php';
$groupid = $_POST['groupid'];
 $week = $_POST['week'];

$weeklyReportsView = new WeeklyReportsView();
$results = $weeklyReportsView->reportGroupByWeek($week);
if($results != null){
    echo json_encode($results);
}else if ($results == null){
    $groupTableView = new GroupTableView();
    $result = $groupTableView->selectGroupInfo($groupid);
    $groupName = $result[0]['groupName'];
    $weeknum = trim($week);
    echo '[{ "week": ' .$weeknum . ', "groupName": "' . $groupName . '"}]';
}
