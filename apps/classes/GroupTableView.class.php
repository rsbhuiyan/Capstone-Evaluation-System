<?php 
Class GroupTableView extends GroupTable{
    public function groupinSec($sectionid){
        $results = $this->selectGroupinSec($sectionid);
        return $results;
    }
    public function groupById($groupid){
        $results = $this->selectGroupById($groupid);
        return $results;
    }
    public function groupName(){
        $results = $this->getGroupName();
        return $results;
    } 
    public function checkIfGroupExists($name){
        $results = $this->checkGroup($name);
        return $results;
    } 
    public function selectgtaGroups($gtaId, $semesterid){
        $results = $this->gtaGroups($gtaId, $semesterid);
        return $results;
    } 
    public function getgtaGroup($groupid){
        $results = $this->gtaGroup($groupid);
        return $results;
    } 

    public function groupInfo($semesterid){
        $results = $this->selectGroups($semesterid);
        return $results;
    }
    public function specificGroupInfo($groupName, $semesterid){
        $results = $this->selectSpecificGroup($groupName, $semesterid);
        return $results;
    }
    public function selectGroupInfo($groupid){
        $results = $this->selectGroup($groupid);
        return $results;
    }

    public function getGroupSection($groupid){
        $results = $this->getGroupSectionid($groupid);
        return $results;
    }

    public function selectOpenGroups($section){
        $results = $this->studentsGroupsOpen($section);
        return $results;
    }
    public function selectGtasGroups($userid){
        $results = $this->selectGroupsGtas($userid);
        return $results;
    }

}