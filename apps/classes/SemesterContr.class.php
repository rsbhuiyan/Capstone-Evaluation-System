<?php
Class SemesterContr extends Semester{
    public function insertSemester($semester_name, $startDate, $endDate){
        return $this->insertSem($semester_name, $startDate, $endDate);   
    }
}
?>