<?php 
Class Grades extends Dbh{
    protected function insertGradeForGroup($assignment, $documentGrade, $consistency, $consistencyNotes, $grammar, $grammarNotes, $functionality, $functionalityNotes, $groupStatus, $statusNotes, $topicsCorrect, $topicsNotes, $resubmitDocument, $notes, $hasClient, $clientSatisfied, $clientNotes, $givenByUser, $groupid){
        $sql = "SELECT count(*) FROM gradeGroup WHERE assignment = ? and groupid = ? and givenByUser = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$assignment, $groupid, $givenByUser]);
        $row = $query->fetch();
        $count = $row["count(*)"];
        if($count ==0){
        $sql = "INSERT INTO gradeGroup(assignment, dateSubmitted, documentGrade, consistency, consistencyNotes, grammar, grammarNotes, functionality, functionalityNotes, groupStatus, statusNotes,topicsCorrectness, topicsNotes, resubmitDocument, groupNotes, hasClient, clientSatisfied, clientNotes, givenByUser, groupid) VALUES ( ?, CURRENT_DATE(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$assignment, $documentGrade, $consistency, $consistencyNotes, $grammar, $grammarNotes, $functionality, $functionalityNotes, $groupStatus, $statusNotes, $topicsCorrect, $topicsNotes, $resubmitDocument, $notes, $hasClient, $clientSatisfied, $clientNotes, $givenByUser, $groupid]);
        return $result;
        }else{
            $sql = "UPDATE gradeGroup SET documentGrade = ?, consistency = ?, consistencyNotes = ?, grammar = ?, grammarNotes = ?, functionality = ?, functionalityNotes = ?, groupStatus = ?, statusNotes = ?, topicsCorrectness = ?, topicsNotes = ?, resubmitDocument = ?, groupNotes = ?, hasClient = ?, clientSatisfied= ?, clientNotes = ?  where assignment = ? and givenByUser= ? and groupid = ?";
            $stmt = $this->connect()->prepare($sql);
            $result = $stmt->execute([$documentGrade, $consistency, $consistencyNotes, $grammar, $grammarNotes, $functionality, $functionalityNotes, $groupStatus, $statusNotes, $topicsCorrect, $topicsNotes, $resubmitDocument, $notes, $hasClient, $clientSatisfied, $clientNotes, $assignment, $givenByUser, $groupid]);
            return $result;
        }
    }
    protected function selectGradeID($assignment, $groupid, $givenByUser){
        $row1 = null;
        $sql ="SELECT gradeGroupid from gradeGroup where assignment = ? AND groupid = ? AND givenByUser = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$assignment, $groupid, $givenByUser]);
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
        }
        return $row1;
    }
    protected function selectGradesbyGroup($studentid, $groupid, $givenByUser){
        $row1 = null;
        $sql ="SELECT gg.*, sg.*, gt.groupName from gradegroup gg
        join studentgrade sg on gg.gradeGroupid = sg.gradeGroupid
        join groupTable gt on gt.groupid = gg.groupid
        where studentid =? AND gg.groupid =? AND gg.givenByUser =?;";
        $query = $this->connect()->prepare($sql);
        $query->execute([$studentid, $groupid, $givenByUser]);
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
        }
        return $row1;
    }
    protected function selectstudentgrade($studentid, $groupid, $givenByUser, $assignment){
        $row1 = null;
        $sql ="SELECT gg.*, sg.*, gt.groupName from gradegroup gg
        join studentgrade sg on gg.gradeGroupid = sg.gradeGroupid
        join groupTable gt on gt.groupid = gg.groupid
        where studentid =? AND gg.groupid =? AND gg.givenByUser =? AND gg.assignment = ?;";
        $query = $this->connect()->prepare($sql);
        $query->execute([$studentid, $groupid, $givenByUser, $assignment]);
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
        }
        return $row1;
    }
    protected function updateInsertGrade($gradeGroupid, $studentid, $presentationGrade, $notes, $github){
        $sql = "SELECT count(*) FROM studentgrade WHERE gradeGroupid = ? and studentid = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$gradeGroupid, $studentid]);
        $row = $query->fetch();
        $count = $row["count(*)"];
      
        if ($count == 0) {
            $sql = "INSERT INTO studentgrade (studentid, presentationGrade, notes, githubActivity, gradeGroupid) VALUES (?, ?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $result = $stmt->execute([$studentid, $presentationGrade, $notes, $github, $gradeGroupid]);
        } else {
            $sql = "UPDATE studentgrade SET presentationGrade = ?, notes = ?, githubActivity = ? WHERE gradeGroupid = ? AND studentid = ? ;";
            $stmt = $this->connect()->prepare($sql);
            $result = $stmt->execute([$presentationGrade, $notes, $github, $gradeGroupid, $studentid]);
        }
        return $result;
    }
    protected function selectGroupByAssignment($assignmentType, $groupid, $givenByUser){
        $row1 = null;
        $sql ="SELECT gg.*, sg.*, gt.groupName from gradegroup gg
        join studentgrade sg on gg.gradeGroupid = sg.gradeGroupid
        join groupTable gt on gt.groupid = gg.groupid
        where gg.assignment = ? AND gg.groupid = ? AND gg.givenByUser = ?;";
        $query = $this->connect()->prepare($sql);
        $query->execute([$assignmentType, $groupid, $givenByUser]);
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
        }
        return $row1; 
    }
}