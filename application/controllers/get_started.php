<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_started extends CI_Controller{
    public function view($page = 'home'){
        $temp_data['title'] = ucfirst($page);
        $this->load->view('templates/header', $temp_data);
        // $this->load->view('pages/'.$page, $data);
        $db_obj = $this->load->database();
        //seating allocation code is in starter model mentioned below
        $this->load->model('starter');
        $data['h']=$this->starter->seating();

        //change by greeshma //doesn't work
        // $staffObject['staff']=$this->starter->dutyAllocation();

        //pages/allocate is the home page
        $this->load->view('pages/allocate', $data);
        $this->load->view('templates/footer', $temp_data);
    }
    public function allocate($page = 'home'){
        $temp_data['title'] = ucfirst($page);
        $this->load->view('templates/header', $temp_data);
        $db_obj = $this->load->database();
        $this->load->model('starter');
        $data['h']=$this->starter->seating();
        //pages/seating contains drag and drop edit UI code
        $this->load->view('pages/seating', $data);
        $this->load->view('templates/footer', $temp_data);
    }

    public function edit($page = 'home'){
        $temp_data['title'] = ucfirst($page);
        $this->load->view('templates/header', $temp_data);
        $this->load->view('pages/edit');
        $this->load->view('templates/footer', $temp_data);

    }

    public function templates($page = 'home'){
        //Add templates view in pages/view_template
        $temp_data['title'] = ucfirst($page);
        $this->load->view('templates/header', $temp_data);
        $this->load->view('pages/view_template');
        $this->load->view('templates/footer', $temp_data);
    }


    //Not sure if anything beyond this point works :/
      public function seatingarrangement($page = 'home'){
        $this->load->model('starter');
        $data['g']=$this->starter->data();
        $data['h']=$this->starter->seating();
        $this->load->view('pages/seatingarrangement',$data);
    }
     public function SeatingPlan($page = 'home'){
         $this->load->model('starter');
        $data['h']=$this->starter->seating();
         $this->load->view('pages/SeatingPlan',$data);
    
    }
    public function invigilationduty($page = 'home'){
         $this->load->model('starter');
        $data['h']=$this->starter->dutyAllocation();
         $this->load->view('pages/invigilationduty',$data);
    
    }

}