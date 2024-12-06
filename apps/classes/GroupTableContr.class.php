<?php 
Class GroupTableContr extends GroupTable{
    public function insertGroup($name, $section){
        return $this->insertIntoGroup($name, $section);   
    }
    public function groupEditName($groupid, $groupName){
        return $this->editGroupName($groupid, $groupName);
    }
    public function groupEditStudent($studentids, $names){
        return $this->editGroupStudent($studentids, $names);
    }
}
    
