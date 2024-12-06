<?php 
Class GradesView extends Grades{
    public function gradeID($assignment, $groupid, $givenByUser){
        $results = $this->selectGradeID($assignment, $groupid, $givenByUser);
        return $results;
    }
    public function getGroupByAssignment($assignmentType, $groupid,$givenByUser){
        $results = $this->selectGroupByAssignment($assignmentType, $groupid, $givenByUser);
        return $results;
    }
    public function getGradesbyGroup($studentid, $groupid, $givenByUser){
        $results = $this->selectGradesbyGroup($studentid, $groupid, $givenByUser);
        return $results;
    }
    public function getstudentgrade($studentid, $groupid, $givenByUser, $assignment){
        $results = $this->selectstudentgrade($studentid, $groupid, $givenByUser, $assignment);
        return $results;
    }

}