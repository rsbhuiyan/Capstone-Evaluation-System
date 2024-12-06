<?php 
Class GtaAssignment extends Dbh{
   protected function gtaAssign($sectionid, $userid){
        $sql = "INSERT INTO gtaAssignment (sectionid, gta) VALUES ( ?, ?);";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$sectionid, $userid]);
        return $result;
    }

    protected function removeGtaGroup($groupid, $userid){
        $sql = "UPDATE gtaAssignment SET groupid = NULL WHERE gta = ? AND groupid = ?;";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$groupid, $userid]);
        return $result;
    }

    protected function editGtaGroup($groupid, $sectionid, $gtas){

        //       $sql = "DELETE FROM gtaassignment WHERE groupid = ?;";
        
        //       $sql .= "insert into gtaAssignment(groupid, sectionid, gta) values(?, ?, ?);";
        
                $sql = "update gtaAssignment set sectionid = ?, gta = ? where groupid = ?";
        
                $stmt = $this->connect()->prepare($sql);
        
        //       $stmt->execute([$groupid, $groupid, $sectionid, $gtas]);
        
                $stmt->execute([$sectionid, $gtas, $groupid]);
        
               return $stmt->rowCount(); // Returns the number of affected rows
    }
    protected function selectGTAbyGroup($groupid){
        $row1 = null;
        $sql ="SELECT u.firstname, u.lastname, u.userid, u.email from users u
        join gtaAssignment ga on ga.gta = u.userid 
        join groupTable gt on gt.groupid = ga.groupid 
        where ga.groupid = ?;";
        $query = $this->connect()->prepare($sql);
        $query->execute([$groupid]);
        if ($query ->rowCount() > 0){
            $row1 = $query->fetch();
        }
        return $row1;
    }
    protected function selectGtaSection($userid){
        $sql ="select DISTINCT sectionid from gtaAssignment where gta = '$userid';";
        $query = $this->connect()->prepare($sql);
        $query->execute();
        if ($query ->rowCount() > 0){
            $row1 = $query->fetch();
            return $row1;
        }
        return null;
    } 

    protected function assignGtaToGroup($section, $userid, $group){
        $sql = "INSERT INTO gtaAssignment (sectionid, gta, groupid) VALUES (?, ?, ?);";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$section, $userid, $group]);
        return $result;
    }

    protected function gtaUnassign($gtaGroup){
        $sql = "DELETE FROM gtaassignment WHERE groupid = ?;";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$gtaGroup]);
        return $result;
    }
}