<?php

include 'includes/class.autoload.inc.php';

if (isset($_POST["groupgradeEval"])) {

    $groupsName = isset($_POST["groupsName"]) ? $_POST["groupsName"] : "";
    $groupid = isset($_POST["groupid"]) ? $_POST["groupid"] : "";
    $documentGrade = isset($_POST["documentGrade"]) ? $_POST["documentGrade"] : "";
    $groupNotes = isset($_POST["groupNotes"]) ? $_POST["groupNotes"] : "";
    $Consistency = isset($_POST["Consistency"]) ? $_POST["Consistency"] : "";
    $consistencyNotes = isset($_POST["consistencyNotes"]) ? $_POST["consistencyNotes"] : "";
    $Grammar = isset($_POST["Grammar"]) ? $_POST["Grammar"] : "";
    $grammarNotes = isset($_POST["grammarNotes"]) ? $_POST["grammarNotes"] : "";
    $edited = isset($_POST["edited"]) ? $_POST["edited"] : "";
    $topicsCorrect = isset($_POST["topicsCorrect"]) ? $_POST["topicsCorrect"] : "";
    $topicsNotes = isset($_POST["topicsNotes"]) ? $_POST["topicsNotes"] : "";
    $assignmentType = isset($_POST["assignmentType"]) ? $_POST["assignmentType"] : "";
    $givenByUser = isset($_POST["givenByUser"]) ? $_POST["givenByUser"] : "";

    if (($assignmentType == "Prototype 1") || ($assignmentType == "Prototype 2") || ($assignmentType == "Prototype 3") || ($assignmentType == "Final Presentation")) {
        $haveClient = $_POST['haveClient'];
        $clientSatisfied = $_POST['clientSatisfied'];
        $clientNotes = $_POST['clientNotes'];
        $functionality = $_POST['functionality'];
        $functionalityNotes = isset($_POST["functionalityNotes"]) ? $_POST["functionalityNotes"] : "";
        $groupStatus = $_POST['groupStatus'];
        $statusNotes = isset($_POST["statusNotes"]) ? $_POST["statusNotes"] : "";
    }
    $studentsView = new StudentsView();
    $query2 = $studentsView->studentGroup($groupid);
    if ($query2 != null) {
        foreach ($query2 as $key => $value) {
            $studentid = $_POST["student" . $value['studentid']];
            $presentationgrade = $_POST[$value['studentid'] . "grade"];
            $studentNotes = $_POST[$value['studentid'] . "notes"];
            echo "Student: " . $studentid . "<br>";
            echo "Presentation gtade for " . $value['name'] . ": " . $presentationgrade . "<br>";
            echo "notes : " . $studentNotes . "<br>";
        }
    }

    echo "GroupName: " . $groupsName . "<br>";
    echo "documentGrade: " . $documentGrade . "<br>";
    echo "GroupNotes: " . $groupNotes . "<br>";
    echo "Consistency: " . $Consistency . "<br>";
    echo "Grammar: " . $Grammar . "<br>";
    echo "topicsCorrect: " . $topicsCorrect . "<br>";
    echo "Edited: " . $edited . "<br>";
    echo "assignmentType:" . $assignmentType . "<br>";
    echo "Given By User: " . $givenByUser . "<br>";
    if (($assignmentType == "Prototype 1") || ($assignmentType == "Prototype 2") || ($assignmentType == "Prototype 3") || ($assignmentType == "Final Presentation")) {
        echo "Has Client: " . $haveClient . "<br>";
        echo "client Satisfied:" . $clientSatisfied . "<br>";
        echo "client notes: " . $clientNotes . "<br>";
        echo "functionality " . $functionality . "<br>";
    }

    $gradesContr = new GradesContr();

    if ($gradesContr->insertGroupGrade($assignmentType, $documentGrade, $Consistency, $consistencyNotes, $Grammar, $grammarNotes, $functionality, $functionalityNotes, $groupStatus, $statusNotes, $topicsCorrect, $topicsNotes, $edited, $groupNotes, $haveClient, $clientSatisfied, $clientNotes, $givenByUser, $groupid)) {
        $gradesView = new GradesView();
        $results = $gradesView->gradeID($assignmentType, $groupid, $givenByUser);
        $studentsView = new StudentsView();
        $query2 = $studentsView->studentGroup($groupid);
        if ($query2 != null) {
            foreach ($query2 as $key => $value) {
                $studentid = $_POST["student" . $value['studentid']];
                $presentationgrade = $_POST[$value['studentid'] . "grade"];
                $studentNotes = $_POST[$value['studentid'] . "notes"];
                $studentGithub = $_POST[$value['studentid'] . "github"];
                $gradesContr->updateInsertStuGrade($results[0]["gradeGroupid"], $studentid, $presentationgrade, $studentNotes, $studentGithub);
            }
        }
        header("Location: professorDashboard.php?update=success&gd=" . $groupid);
    } else {
        header("Location: professorDashboard.php?update=error");
    }
}

if (isset($_POST["groupgradeEvalGTA"])) {

    $groupsName = isset($_POST["groupsName"]) ? $_POST["groupsName"] : "";
    $groupid = isset($_POST["groupid"]) ? $_POST["groupid"] : "";
    $documentGrade = isset($_POST["documentGrade"]) ? $_POST["documentGrade"] : "";
    $groupNotes = isset($_POST["groupNotes"]) ? $_POST["groupNotes"] : "";
    $Consistency = isset($_POST["Consistency"]) ? $_POST["Consistency"] : "";
    $consistencyNotes = isset($_POST["consistencyNotes"]) ? $_POST["consistencyNotes"] : "";
    $Grammar = isset($_POST["Grammar"]) ? $_POST["Grammar"] : "";
    $grammarNotes = isset($_POST["grammarNotes"]) ? $_POST["grammarNotes"] : "";
    $edited = isset($_POST["edited"]) ? $_POST["edited"] : "";
    $topicsCorrect = isset($_POST["topicsCorrect"]) ? $_POST["topicsCorrect"] : "";
    $topicsNotes = isset($_POST["topicsNotes"]) ? $_POST["topicsNotes"] : "";
    $assignmentType = isset($_POST["assignmentType"]) ? $_POST["assignmentType"] : "";
    $givenByUser = isset($_POST["givenByUser"]) ? $_POST["givenByUser"] : "";

    if (($assignmentType == "Prototype 1") || ($assignmentType == "Prototype 2") || ($assignmentType == "Prototype 3") || ($assignmentType == "Final Presentation")) {
        $haveClient = $_POST['haveClient'];
        $clientSatisfied = $_POST['clientSatisfied'];
        $clientNotes = $_POST['clientNotes'];
        $functionality = $_POST['functionality'];
        $functionalityNotes = isset($_POST["functionalityNotes"]) ? $_POST["functionalityNotes"] : "";
        $groupStatus = $_POST['groupStatus'];
        $statusNotes = isset($_POST["statusNotes"]) ? $_POST["statusNotes"] : "";
    }
    $studentsView = new StudentsView();
    $query2 = $studentsView->studentGroup($groupid);
    if ($query2 != null) {
        foreach ($query2 as $key => $value) {
            $studentid = $_POST["student" . $value['studentid']];
            $presentationgrade = $_POST[$value['studentid'] . "grade"];
            $studentNotes = $_POST[$value['studentid'] . "notes"];
            echo "Student: " . $studentid . "<br>";
            echo "Presentation gtade for " . $value['name'] . ": " . $presentationgrade . "<br>";
            echo "notes : " . $studentNotes . "<br>";
        }
    }
    echo "GroupName: " . $groupid . "<br>";
    echo "documentGrade: " . $documentGrade . "<br>";
    echo "GroupNotes: " . $groupNotes . "<br>";
    echo "Consistency: " . $Consistency . "<br>";
    echo "Grammar: " . $Grammar . "<br>";
    echo "topicsCorrect: " . $topicsCorrect . "<br>";
    echo "Edited: " . $edited . "<br>";
    echo "assignmentType:" . $assignmentType . "<br>";
    echo "Given By User: " . $givenByUser . "<br>";
    if (($assignmentType == "Prototype 1") || ($assignmentType == "Prototype 2") || ($assignmentType == "Prototype 3") || ($assignmentType == "Final Presentation")) {
        echo "Has Client: " . $haveClient . "<br>";
        echo "client Satisfied:" . $clientSatisfied . "<br>";
        echo "client notes: " . $clientNotes . "<br>";
        echo "functionality " . $functionality . "<br>";
    }

    $gradesContr = new GradesContr();

    if ($gradesContr->insertGroupGrade($assignmentType, $documentGrade, $Consistency, $consistencyNotes, $Grammar, $grammarNotes, $functionality, $functionalityNotes, $groupStatus, $statusNotes, $topicsCorrect, $topicsNotes, $edited, $groupNotes, $haveClient, $clientSatisfied, $clientNotes, $givenByUser, $groupid)) {
        $gradesView = new GradesView();
        $results = $gradesView->gradeID($assignmentType, $groupid, $givenByUser);
        $studentsView = new StudentsView();
        $query2 = $studentsView->studentGroup($groupid);
        if ($query2 != null) {
            foreach ($query2 as $key => $value) {
                $studentid = $_POST["student" . $value['studentid']];
                $presentationgrade = $_POST[$value['studentid'] . "grade"];
                $studentNotes = $_POST[$value['studentid'] . "notes"];
                $studentGithub = $_POST[$value['studentid'] . "github"];
                $gradesContr->updateInsertStuGrade($results[0]["gradeGroupid"], $studentid, $presentationgrade, $studentNotes, $studentGithub);
            }
        }
        header("Location: gtaGroupPage.php?id=" . $groupid . "&update=success");
    } else {
        header("Location: gtaGroupPage.php?id=" . $groupid . "&update=error");
    }
}

if (isset($_POST["finalGrade"])) {

    $groupsName = isset($_POST["groupsName"]) ? $_POST["groupsName"] : "";
    echo "Groupsname: " . $groupsName ."<br>";
    $groupid = isset($_POST["groupid"]) ? $_POST["groupid"] : "";
    echo "groupid: " . $groupid ."<br>";
    // $documentGrade = isset($_POST["documentGrade"]) ? $_POST["documentGrade"] : "";
    echo "documentgrade: " . $documentGrade ."<br>";
    $groupNotes = isset($_POST["groupNotes"]) ? $_POST["groupNotes"] : "";
    echo "groupNotes: " . $groupNotes ."<br>";
    $Consistency = isset($_POST["Consistency"]) ? $_POST["Consistency"] : "";
    $Grammar = isset($_POST["Grammar"]) ? $_POST["Grammar"] : "";
    $edited = isset($_POST["edited"]) ? $_POST["edited"] : "";
    $topicsCorrect = isset($_POST["topicsCorrect"]) ? $_POST["topicsCorrect"] : "";
    $assignmentType = isset($_POST["assignmentType"]) ? $_POST["assignmentType"] : "";
    $givenByUser = isset($_POST["givenByUser"]) ? $_POST["givenByUser"] : "";
    $studentid = isset($_POST["studentid"]) ? $_POST["studentid"] : "";
    $presentationgrade = isset($_POST["presentationgrade"]) ? $_POST["presentationgrade"] : "";
    $studentnotes = isset($_POST["studentnotes"]) ? $_POST["studentnotes"] : "";
    $github = isset($_POST["github"]) ? $_POST["github"] : "";

    $documentGrade = $_POST[$studentid  . "grade"];
    echo "documentgrade: " . $documentGrade ."<br>";

    $studentnotes = $_POST[$studentid  . "notes"];
    echo "studentnotes: " . $studentnotes ."<br>";
    $gradesContr = new GradesContr();

    if ($gradesContr->insertGroupGrade($assignmentType, $documentGrade, $Consistency, $consistencyNotes, $Grammar, $grammarNotes, $functionality, $functionalityNotes, $groupStatus, $statusNotes, $topicsCorrect, $topicsNotes, $edited, $groupNotes, $haveClient, $clientSatisfied, $clientNotes, $givenByUser, $groupid)) {
        $gradesView = new GradesView();
        $results = $gradesView->gradeID($assignmentType, $groupid, $givenByUser);
        $gradesContr->updateInsertStuGrade($results[0]["gradeGroupid"], $studentid, $documentGrade, $studentnotes, $studentGithub);

        header("Location: finalGrade.php?update=success");
    } else {
        header("Location: finalGrade.php?update=error");
    }
}
if (isset($_POST["midtermGrade"])) {

    $groupsName = isset($_POST["groupsName"]) ? $_POST["groupsName"] : "";
    echo "Groupsname: " . $groupsName ."<br>";
    $groupid = isset($_POST["groupid"]) ? $_POST["groupid"] : "";
    echo "groupid: " . $groupid ."<br>";
    $documentGrade = isset($_POST["documentGrade"]) ? $_POST["documentGrade"] : "";
    echo "documentgrade: " . $documentGrade ."<br>";
    $groupNotes = isset($_POST["groupNotes"]) ? $_POST["groupNotes"] : "";
    echo "groupNotes: " . $groupNotes ."<br>";
    $Consistency = isset($_POST["Consistency"]) ? $_POST["Consistency"] : "";
    $Grammar = isset($_POST["Grammar"]) ? $_POST["Grammar"] : "";
    $edited = isset($_POST["edited"]) ? $_POST["edited"] : "";
    $topicsCorrect = isset($_POST["topicsCorrect"]) ? $_POST["topicsCorrect"] : "";
    $assignmentType = isset($_POST["assignmentType"]) ? $_POST["assignmentType"] : "";
    $givenByUser = isset($_POST["givenByUser"]) ? $_POST["givenByUser"] : "";
    $studentid = isset($_POST["studentid"]) ? $_POST["studentid"] : "";
    $presentationgrade = isset($_POST["presentationgrade"]) ? $_POST["presentationgrade"] : "";
    $studentnotes = isset($_POST["studentnotes"]) ? $_POST["studentnotes"] : "";
    $github = isset($_POST["github"]) ? $_POST["github"] : "";

    $documentGrade = $_POST[$studentid  . "grade"];
    echo "documentgrade: " . $documentGrade ."<br>";

    $studentnotes = $_POST[$studentid  . "notes"];
    echo "studentnotes: " . $studentnotes ."<br>";
    $gradesContr = new GradesContr();

    if ($gradesContr->insertGroupGrade($assignmentType, $documentGrade, $Consistency, $consistencyNotes, $Grammar, $grammarNotes, $functionality, $functionalityNotes, $groupStatus, $statusNotes, $topicsCorrect, $topicsNotes, $edited, $groupNotes, $haveClient, $clientSatisfied, $clientNotes, $givenByUser, $groupid)) {
        $gradesView = new GradesView();
        $results = $gradesView->gradeID($assignmentType, $groupid, $givenByUser);
        $gradesContr->updateInsertStuGrade($results[0]["gradeGroupid"], $studentid, $documentGrade, $studentnotes, $studentGithub);

        header("Location: midterm.php?update=success");
    } else {
        header("Location: midterm.php?update=error");
    }
}