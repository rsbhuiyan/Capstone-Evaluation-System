<?php 
Class GtaAssignmentView extends GtaAssignment{
    public function getGTAbyGroup($groupid){
        $results = $this->selectGTAbyGroup($groupid);
        return $results;
    }
    public function selectSectionGta($userid){
        $results = $this->selectGtaSection($userid);
        return $results;
    }
    
}