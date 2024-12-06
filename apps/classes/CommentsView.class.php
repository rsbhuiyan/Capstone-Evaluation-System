<?php 
Class CommentsView extends Comments{
    public function getStatusCount($gta){
        $results = $this->getStatus($gta);
        return $results;
    }
}