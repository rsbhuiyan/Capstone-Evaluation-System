<?php
include 'includes/class.autoload.inc.php';
$groupid = $_POST['groupid'];
$assignmentType = $_POST['assignmentType'];
$givenByUser = $_POST['givenByUser'];
$gradesView = new GradesView();
$results = $gradesView->getGroupByAssignment($assignmentType, $groupid, $givenByUser);
if($results != null){
    echo json_encode($results);
}else if ($results == null){
    echo '[{ "groupid": ' .$groupid . ', "assignment": "' . $assignmentType . '", "givenByUser": ' . $givenByUser . '}]';
}
