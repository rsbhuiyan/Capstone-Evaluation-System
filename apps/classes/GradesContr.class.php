<?php 
Class GradesContr extends Grades{
    public function insertGroupGrade($assignment, $documentGrade, $consistency, $consistencyNotes, $grammar, $grammarNotes, $functionality, $functionalityNotes, $groupStatus, $statusNotes, $topicsCorrect, $topicsNotes, $resubmitDocument, $notes, $hasClient, $clientSatisfied, $clientNotes, $givenByUser, $groupid){
        $results = $this->insertGradeForGroup($assignment, $documentGrade, $consistency, $consistencyNotes, $grammar, $grammarNotes, $functionality, $functionalityNotes, $groupStatus, $statusNotes, $topicsCorrect, $topicsNotes, $resubmitDocument, $notes, $hasClient, $clientSatisfied, $clientNotes, $givenByUser, $groupid);
        return $results;
    } 
    public function updateInsertStuGrade($gradeGroupid, $studentid, $presentationGrade, $notes, $github){
        return $this->updateInsertGrade($gradeGroupid, $studentid, $presentationGrade, $notes, $github);   
    }
    
}