<?php 
Class GtaAssignmentContr extends GtaAssignment{
    public function insertassignGta($sectionid, $userid){
        return $this->gtaAssign($sectionid, $userid);   
    }
    public function removeGroupGta($groupid, $userid){
        return $this->removeGtaGroup($groupid, $userid);   
    }
    public function groupEditGta($groupid, $sectionid, $gtas){
        return $this->editGtaGroup($groupid, $sectionid, $gtas);   
    }

    public function assignGta($section, $userid, $group){
        return $this->assignGtaToGroup($section, $userid, $group);   
    }

    public function unassignGta($gtaGroup){
        return $this->gtaUnassign($gtaGroup);   
    }
    
}