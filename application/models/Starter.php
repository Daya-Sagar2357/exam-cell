<?php

    class Starter extends CI_Model{

        function show_data(){
            $this->load->database();
            $temp_query = $this->db->get('semester_masterlist');
            // echo $temp_query->num_rows();
            // return $temp_query;

            $query = $this->db->query("SELECT * FROM semester_masterlist");  
             
            
            $array_name = $query->result();

//$array_name[0]->ID
            print_r($array_name[0]->ID);
        }
    }