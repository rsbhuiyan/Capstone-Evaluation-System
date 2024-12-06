<?php 
Class CommentsContr extends Comments{
    public function insertComment($commentText, $givenByUser, $givenToUser, $status,  $studentid){
        $results = $this->insertNewComment($commentText, $givenByUser, $givenToUser, $status,  $studentid);
        return $results;
    } 
    public function updateCommentStatus($commentid){
        $results = $this->updateStatus($commentid);
        return $results;
    } 
}