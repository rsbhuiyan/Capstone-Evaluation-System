<?php
class SectionView extends Section
{
    public function getSecinSem($semesterid)
    {
        $results = $this->getSectioninSem($semesterid);
        return $results;
    }
    public function profSecNameAndId($userid)
    {
        $results = $this->profSelectSecIdName($userid);
        return $results;
    }
    public function selectSecinSem($userid, $semesterid)
    {
        $results = $this->sectionsInSemProf($userid, $semesterid);
        return $results;
    }
    //Gets section data for the dropdown box in the "ADD GTA" form
    public function selectSection($semesterid, $userid)
    {
        $results = $this->selectSec($semesterid, $userid);
        return $results;
    }
    public function selectSectionID($sectionid)
    {
        $results = $this->selectSecID($sectionid);
        return $results;
    }
    public function checkSectionExists($section_name, $selectSemester){
        $results = $this->checkSection($section_name, $selectSemester);
        return $results;
    }

}
?>