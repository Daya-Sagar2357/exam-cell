<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_started extends CI_Controller{
    public function view($page = 'home'){
        $temp_data['title'] = ucfirst($page);
        $this->load->view('templates/header', $temp_data);
        // $this->load->view('pages/'.$page, $data);
        $db_obj = $this->load->database();
        $this->load->model('starter');
        $data['h']=$this->starter->seating();
        $this->load->view('pages/allocate', $data);
        $this->load->view('templates/footer', $temp_data);
    }

    public function allocate($page = 'home'){
        $temp_data['title'] = ucfirst($page);
        $this->load->view('templates/header', $temp_data);
        $db_obj = $this->load->database();
        $this->load->model('starter');
        $data['h']=$this->starter->seating();
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
}