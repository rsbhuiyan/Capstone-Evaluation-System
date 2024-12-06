<?php 
Class Comments extends Dbh{
    protected function insertNewComment($commentText, $givenByUser, $givenToUser, $status,  $studentid){
        $sql = "INSERT INTO comments (commentText, dateSubmitted, givenByUser, givenToUser, status, studentid) VALUES ( ?, CURRENT_TIME(), ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$commentText,  $givenByUser, $givenToUser, $status, $studentid]);
        return $result;
    }
    protected function updateStatus($commentid){
        $sql = "UPDATE comments SET status = 0 WHERE commentid = ?;";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$commentid]);
        return $result;
    }
    protected function getStatus($gta){
        $row1 = null;
        $sql ="SELECT COUNT(*) from comments where status =1 and givenToUser = ?;";
        $query = $this->connect()->prepare($sql);
        $query->execute([$gta]);
        if ($query ->rowCount() > 0){
            $row1 = $query->fetch();
        }
        return $row1; 
    }
}