<?php
include 'includes/class.autoload.inc.php';
$groupid = $_POST['groupid'];
$assignmentType = $_POST['assignmentType'];
$givenByUser = $_POST['givenByUser'];
$studentid = $_POST['studentid'];
$gradesView = new GradesView();
$results = $gradesView->getstudentgrade($studentid, $groupid, $givenByUser, $assignmentType);
if($results != null){
    echo json_encode($results);
}else if ($results == null){
    echo '[{"groupid":' .$groupid . ', "studentid":' .$studentid .', "assignment":"' . $assignmentType . '", "givenByUser":' . $givenByUser . '}]';
}
