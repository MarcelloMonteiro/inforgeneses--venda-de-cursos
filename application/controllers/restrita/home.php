<?php

defined('BASEPATH') OR exit('Ação Não permitida');

class Home extends CI_Controller{


    public function __construct(){
        parent::__construct();

        //sessão

        if (!$this->ion_auth->logged_in())
        {
          redirect('restrita/login');
        }
        
    }
    public function index(){

        $this->load->view('restrita/layout/header');
        $this->load->view('restrita/home/index');
        $this->load->view('restrita/layout/footer');

    }
}
