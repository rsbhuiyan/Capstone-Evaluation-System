<?php
    Class Section extends Dbh{
        protected function insertSec($section_name, $selectSemester, $selectProf){
            $sql = "INSERT INTO section (section_name, semesterid, professor) VALUES (?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $result = $stmt->execute([$section_name, $selectSemester, $selectProf]);
            return $result;
        }
        protected function getSectioninSem($semesterid){
            $sql = "SELECT section_name, sectionid from section sc join  semester se on se.semesterid = sc.semesterid where se.semesterid = ?";
            $query = $this->connect()->prepare($sql);
            $query->execute([$semesterid]);
            if ($query ->rowCount() > 0){
             return $query->fetchAll();
            }
        
        }
        protected function profSelectSecIdName($userid){
            $row1 = null;
            $sql ="SELECT sectionid, section_name FROM section WHERE professor = '$userid';";
            $query = $this->connect()->prepare($sql);
            $query->execute();
            if ($query ->rowCount() > 0){
                $row1 = $query->fetchAll();
            }
            return $row1;
        }
        protected function sectionsInSemProf($userid, $semesterid){
            $row1 = null;
            $sql ="SELECT sectionid, section_name FROM section where professor = ? AND semesterid = ?";
            $query = $this->connect()->prepare($sql);
            $query->execute([$userid, $semesterid]);
            if ($query ->rowCount() > 0){
                $row1 = $query->fetchAll();
            }
            return $row1;
        }

        protected function selectSec($semesterid, $userid){
            $row1 = null;
            $sql = "SELECT sc.* FROM section sc join semester se on se.semesterid = sc.semesterid where se.semesterid = ? and sc.professor = ?;";
            $query = $this->connect()->prepare($sql);
            $query->execute([$semesterid, $userid]);
            if ($query ->rowCount() > 0){
                $row1 = $query->fetchAll();
            }
            return $row1;
        }

    protected function selectSecID($sectionid){
        $row1 = null;
        $sql = "SELECT sectionid FROM section";
        $query = $this->connect()->prepare($sql);
        $query->execute([$sectionid]);
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
        }
        return $row1;
    }
    protected function checkSection($section_name ,$selectSemester){
        $row1 = null;
        $sql ="SELECT * FROM section where section_name = ? AND semesterid = ?;";
        $query = $this->connect()->prepare($sql);
        $query->execute([$section_name, $selectSemester]);
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
        }
        return $row1;
    }
}
?>