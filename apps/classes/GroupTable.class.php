<?php 
Class GroupTable extends Dbh{
    protected function selectGroupinSec($sectionid){
        $row1 = null;
        $sql ="SELECT groupid, groupName FROM groupTable where sectionid = ?;";
        $query = $this->connect()->prepare($sql);
        $query->execute([$sectionid]);
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
        }
        return $row1;
    }
    protected function selectGroupById($groupid){
        $row1 = null;
        $sql ="SELECT groupName FROM groupTable where groupid = ?;";
        $query = $this->connect()->prepare($sql);
        $query->execute([$groupid]);
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
        }
        return $row1;
    }
    protected function getGroupName(){
        $sql ="SELECT groupid, groupName, sectionid FROM groupTable;";
        $query = $this->connect()->prepare($sql);
        $query->execute();
        if ($query ->rowCount() > 0){
            return $query->fetchAll();
        }
    }

    protected function checkGroup($name){
        $sql ="SELECT groupName FROM groupTable WHERE groupName = ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$name]);
        if ($query ->rowCount() > 0){
            return true;
        }
        return false;
    }
    protected function gtaGroups($gtaId, $semesterid){
        $row1 = null;
        $sql ="SELECT g.groupid, groupName from groupTable g join gtaassignment ga on g.groupid = ga.groupid join section sc on sc.sectionid = ga.sectionid join semester se on se.semesterid = sc.semesterid where ga.gta = ? and se.semesterid = ?;";
        $query = $this->connect()->prepare($sql);
        $query->execute([$gtaId, $semesterid]);
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
        }
        return $row1;
    }
    protected function gtaGroup($groupid){
        $row1 = null;
        $sql ="SELECT gt.groupName, st.* from groupTable gt join students st on st.groupid = gt.groupid where gt.groupid =?;";
        $query = $this->connect()->prepare($sql);
        $query->execute([$groupid]);
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
        }
        return $row1;
    }
    protected function insertIntoGroup($name, $section){
        $sql = "INSERT INTO groupTable (groupName, sectionid) VALUES (?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$name, $section]);
        return $result;
    }
    protected function selectGroups($semesterid){

        $sql ="SELECT groupid, groupName, firstname, lastname, GROUP_CONCAT(name), userid, GROUP_CONCAT(studentid), gta, sectionid FROM groupview WHERE sectionid IN (SELECT sectionid FROM section WHERE semesterid = ?) GROUP BY groupid, groupName, firstname, lastname, gta;
        ";
        $query = $this->connect()->prepare($sql);
        $query->execute([$semesterid]);

        if ($query ->rowCount() > 0){

            $row1 = $query->fetchAll();

            return $row1;

        }

       

    }
    protected function editGroupName($groupid, $groupName)
    {
        $sql = "UPDATE groupview SET groupName = ? WHERE groupid = ?;";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$groupName, $groupid]);
        return $result;
    }
    protected function editGroupStudent($studentids, $names)
    {
        $sql = "UPDATE groupview SET name = ? WHERE studentid = ?;        ";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$names,$studentids]);
        return $result;
    }
    protected function selectSpecificGroup($groupName, $semesterid){

        $sql ="SELECT groupid, groupName, firstname, lastname, GROUP_CONCAT(name), userid, GROUP_CONCAT(studentid), gta, sectionid FROM groupview where sectionid IN (SELECT sectionid FROM section WHERE semesterid = ?) and groupName LIKE ? GROUP BY groupid, groupName, firstname, lastname, gta;
        ";

        $query = $this->connect()->prepare($sql);

        $query->execute([$semesterid,"%" . $groupName . "%"]);


        if ($query ->rowCount() > 0){

            $row1 = $query->fetchAll();
            return $row1;
        }

        else{

            $sql ="SELECT groupid, groupName, firstname, lastname, GROUP_CONCAT(name), userid, GROUP_CONCAT(studentid), gta, sectionid FROM groupview WHERE sectionid IN (SELECT sectionid FROM section WHERE semesterid = ?) GROUP BY groupid, groupName, firstname, lastname, gta;
            ";
            $query = $this->connect()->prepare($sql);
            $query->execute([$semesterid]);
            if ($query ->rowCount() > 0){
                $row1 = $query->fetchAll();
                return $row1;
            }
        }
        
    }

    protected function getGroupSectionid($groupid){
        $sql ="SELECT sectionid FROM groupTable WHERE groupid = '$groupid';";
        $query = $this->connect()->prepare($sql);
        $query->execute();
        if ($query ->rowCount() > 0){
            $row1 = $query->fetch();
            return $row1;
        }
        return null;
    } 


    protected function selectGroup($groupid){
        $row1 = null;
        $sql ="SELECT * FROM groupTable where groupid = ?;";
        $query = $this->connect()->prepare($sql);
        $query->execute([$groupid]);
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
        }
        return $row1;
    }

    protected function studentsGroupsOpen($section){
        $sql ="SELECT groupid, groupName FROM groupTable WHERE groupid NOT IN (SELECT groupid FROM gtaAssignment WHERE groupid IS NOT NULL AND sectionid = ?) AND sectionid = ?;";
        $query = $this->connect()->prepare($sql);
        $query->execute([$section, $section]);
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
            return $row1;
        }
        else {
            return "There are no students in this section.";
        }
    }

    protected function selectGroupsGtas($userid){
        $sql =" SELECT groupTable.groupid, groupTable.groupName FROM gtaAssignment INNER JOIN groupTable ON gtaAssignment.groupid = groupTable.groupid WHERE gtaAssignment.gta = ?;";
        $query = $this->connect()->prepare($sql);
        $query->execute([$userid]);
        if ($query ->rowCount() > 0){
            $row1 = $query->fetchAll();
            return $row1;
        }
        else {
            return "No Groups chosen.";
        }
    }
}
