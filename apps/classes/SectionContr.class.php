<?php
    Class SectionContr extends Section{
        public function insertSection($section_name, $selectSemester, $selectProf){
            return $this->insertSec($section_name, $selectSemester, $selectProf);   
        }
    }
?>