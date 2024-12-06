<?php
Class Semester extends DBH{
    protected function insertSem($semester_name, $startDate, $endDate){
        $sql = "INSERT INTO semester (semester_name, startDate, endDate) VALUES ( ?, STR_TO_DATE(?, '%m/%d/%Y'), STR_TO_DATE(?, '%m/%d/%Y'));";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$semester_name, $startDate, $endDate]);
        return $result;
    }
    protected function selectSemIdName(){
        $row1 = null;
        $sql ="SELECT semesterid, semester_name FROM semester WHERE endDate > CURRENT_DATE();";
        $query = $this->connect()->prepare($sql);
        $query->execute();
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
        }
        return $row1;
    }
    protected function selectSemesterbyId($semesterid){
        $row1 = null;
        $sql ="SELECT * from semester where semesterid = ?;";
        $query = $this->connect()->prepare($sql);
        $query->execute([$semesterid]);
        if ($query ->rowCount() > 0){
            $row1 = $query->fetch();
        }
        return $row1;
    }
    protected function getFiveSemesters(){
        $row1 = null;
        $sql ="SELECT semesterid, semester_name from semester where startDate <= CURRENT_DATE() ORDER BY startdate DESC LIMIT 5;";
        $query = $this->connect()->prepare($sql);
        $query->execute();
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
        }
        return $row1;
    }
    
    protected function selectCurrentSemester(){
        $row1 = null;
        $sql ="SELECT semesterid, semester_name FROM semester WHERE endDate > CURRENT_DATE() and startDate < CURRENT_DATE();";
        $query = $this->connect()->prepare($sql);
        $query->execute();
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
        }
        return $row1;
    }
    protected function selectStartEndDate(){
        $row1 = null;
        $sql ="SELECT startDate, endDate FROM semester WHERE endDate > CURRENT_DATE() and startDate < CURRENT_DATE();";
        $query = $this->connect()->prepare($sql);
        $query->execute();
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
        }
        return $row1;
    }
    protected function selectSem(){
        $row1 = null;
        $sql ="SELECT * FROM semester;";
        $query = $this->connect()->prepare($sql);
        $query->execute();
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
        }
        return $row1;
    }
    protected function checkSemester($semester_name){
        $row1 = null;
        $sql ="SELECT * FROM semester where semester_name = ?;";
        $query = $this->connect()->prepare($sql);
        $query->execute([$semester_name]);
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
        }
        return $row1;
    }
}
?>