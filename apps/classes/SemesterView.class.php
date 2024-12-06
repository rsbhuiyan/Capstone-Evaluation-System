<?php
Class SemesterView extends Semester{
    public function semNameAndId(){
        $results = $this->selectSemIdName();
        return $results;
    }
    public function currentSemester(){
        $results = $this->selectCurrentSemester();
        return $results;
    }
    public function getSemesterbyId($semesterid){
        $results = $this->selectSemesterbyId($semesterid);
        return $results;
    }

    public function startandEndDate(){
        $results = $this->selectStartEndDate();
        return $results;
    }
    public function selectSemester(){
        $results = $this->selectSem();
        return $results;
    }
    public function checkSemesterExists($semester_name){
        $results = $this->checkSemester($semester_name);
        return $results;
    }
    public function selectFiveSemesters(){
        $results = $this->getFiveSemesters();
        return $results;
    }
}
?>