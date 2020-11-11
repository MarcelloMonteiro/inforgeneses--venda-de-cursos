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

        public function core($usuario_id = NULL){

            if(!$usuario_id){

                //cadastrar usuario

            }else{

                if(!$usuario = $this->ion_auth->user($usuario_id)->row()){
                    
                    $this->session->set_flashdata('erro','Usúario não foi encontrado');
                    redirect('restrita/usuarios');

                }else{


                    $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_lenght[4]|max_lenght[45]');
                    $this->form_validation->set_rules('last_name', 'Nome', 'trim|required|min_lenght[4]|max_lenght[45]');
                    $this->form_validation->set_rules('email', 'E-mail', 'trim|required|min_lenght[4]|max_lenght[100]|valid_email|callback_valida_emal');

                    if ($this->form_validation->run()){
                        echo '<pre>';
                        print_r($this->input->post());
                        exit();
                    } else {

                        $data = array(
                            'titulo' => 'Editar usuarios',
                            'usuario' =>$usuario,
    
                            'perfil' => $this->ion_auth->get_users_groups($usuario_id)->row(),
                            'grupos' => $this->ion_auth->groups()->result(),
                        );
    
    
                        $this->load->view('restrita/layout/header', $data);
                        $this->load->view('restrita/usuarios/core');
                        $this->load->view('restrita/layout/footer');
                    }
                    



                }

            }

        }
    

}