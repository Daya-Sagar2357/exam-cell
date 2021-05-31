<?php

    class Starter extends CI_Model{

        function show_data(){
            $this->load->database();
            $temp_query = $this->db->get('semester_masterlist');
            // echo $temp_query->num_rows();
            return $temp_query;
        }
    }