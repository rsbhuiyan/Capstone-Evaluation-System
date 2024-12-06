<?php
include 'includes/class.autoload.inc.php';

if (isset($_POST["add-week"])) {
    $selectStatus = $_POST['selectStatus'];
    $selectSubmitted = $_POST['selectSubmitted'];
    $studentid = $_POST['studentid'];
    $week = $_POST['week'];
    $evaluation = $_POST['evaluation'];
    $groupid = $_POST['groupid'];

    $weeklyReportsContr = new WeeklyReportsContr();

    if($weeklyReportsContr->updatestudentReport($selectSubmitted, $selectStatus, $week, $studentid))
    {
        $weeklyReportsView = new WeeklyReportsView();
        $results = $weeklyReportsView->weekID($week, $studentid);
        $weeklyReportsContr->updateInsertEval($evaluation, $results[0]["weekid"]);
       header("Location: weeklyReports.php?update=success&gd=". $groupid);
    }
    else
    {
        header("Location: weeklyReports.php?update=error");
    }

    
}
if (isset($_POST["groupeval"])) {
    
    $week = $_POST['weeknum'];
    $evaluationforgroup = $_POST['evaluationforgroup'];
    $groupid = $_POST['groupid'];

    $weeklyReportsContr = new WeeklyReportsContr();

    if($weeklyReportsContr->insertgroupReport($groupid, $week))
    {
        $weeklyReportsView = new WeeklyReportsView();
        $results = $weeklyReportsView->weekID($week, -1);
        $weeklyReportsContr->updateInsertEval($evaluationforgroup, $results[0]["weekid"]);
       header("Location: weeklyReports.php?update=success&gd=". $groupid);
    }
    else
    {
        header("Location: weeklyReports.php?update=error");
    }

    
}
?>