<?php


class MasterListEntry {
    public $ID;
    public $RegisterNumber;
    public $StudentName;
    public $RegisteredInstitution;
    public $BranchName;
    public $ExamDefinition;
    public $Slot;
    public $Course;
    public $ExamDate;
    public $ExamTime;
    public $Session;

    function __construct($ID, $RegisterNumber, $StudentName, $RegisteredInstitution, $BranchName, $ExamDefinition,  $Slot,  $Course,  $ExamDate, $ExamTime, $Session) {
       $this->ID = $ID;
       $this->RegisterNumber = $RegisterNumber;
       $this->StudentName = $StudentName;
       $this->RegisteredInstitution = $RegisteredInstitution;
       $this->BranchName = $BranchName;
       $this->ExamDefinition = $ExamDefinition;
       $this->Slot = $Slot;
       $this->Course = $Course;
       $this->ExamDate = $ExamDate;
       $this->ExamTime = $ExamTime;
       $this->Session = $Session;

    }
    function get_ID() {
       return $this->ID;
    }
    function get_RegisterNumber() {
       return $this->RegisterNumber;
    }
    function get_StudentName() {
       return $this->StudentName;
    }
    function get_RegisteredInstitution() {
       return $this->RegisteredInstitution;
    }
    function get_BranchName() {
       return $this->BranchName;
    }
    function get_ExamDefinition() {
       return $this->ExamDefinition;
    }
    function get_Slot() {
       return $this->Slot;
    }
    function get_Course() {
       return $this->Course;
    }
    function get_ExamDate() {
       return $this->ExamDate;
    }
    function get_ExamTime() {
       return $this->ExamTime;
    }
    function get_Session() {
       return $this->Session;
    }

 }


    class Starter extends CI_Model{

        function show_data(){
            $this->load->database();
            $temp_query = $this->db->get('semester_masterlist');
            // echo $temp_query->num_rows();
            // return $temp_query;

            $query = $this->db->query("SELECT * FROM semester_masterlist");  
             
            
            $array_name = $query->result();

//$array_name[0]->ID
            
        }
    }