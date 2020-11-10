<?php

defined('BASEPATH') OR exit('Ação Não Permitida');

class Usuarios extends CI_Controller{

    public function __construct(){
        parent::__construct();

        //Sessão valida
    }

    public function index(){
    
        $data = array(

            'titulo' => 'Usuarios cadastrados',

            'styles' => array(
                'bundles/datatables/datatables.min.css',
                'bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',

            ),

            'scripts' => array(
                'bundles/datatables/datatables.min.js',
                'bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                'bundles/jquery-ui/jquery-ui.min.js',
                'js/page/datatables.js'
            ),

            'usuarios'=> $this->ion_auth->users()->result(), 
        );
        
        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/usuarios/index');
        $this->load->view('restrita/layout/footer');

    }

}