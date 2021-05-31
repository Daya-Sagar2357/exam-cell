<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_started extends CI_Controller{
    public function view($page = 'home'){
        // if(!file_exists(APPPATH.'views/pages/'.$page.'.php'))
        // {
        //     show_404();
        // }
        $temp_data['title'] = ucfirst($page);
        $this->load->view('templates/header', $temp_data);
        // $this->load->view('pages/'.$page, $data);
        $db_obj = $this->load->database();
        $this->load->model('starter');
        $data['h']=$this->starter->show_data();
        $this->load->view('pages/allocate');
        // $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $temp_data);
        echo "<br>";
    }

    public function allocate(){
        echo "inside function allocate";
    }
}