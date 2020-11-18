<?php

defined('BASEPATH') OR exit('Ação Não Permitida');

class Login extends CI_Controller{

    public function index(){

        $data = array(
            'titulo' => 'Login',
        );

        $this->load->view('web/layout/header', $data);
        $this->load->view('web/login');
        $this->load->view('web/layout/footer');
    }

    public function auth(){
        $identity = $this->input->post('email');
        $password = $this->input->post('password');
        $remember = ($this->input->post('remember'? TRUE : FALSE));
        

        if($this->ion_auth->login($identity, $password, $remember)){
            if($this->ion_auth->is_admin()){
                redirect('restrita');
            }else{
                redirect('/');
            }
            
        }else{
            $this->session->set_flashdata('erro','Por favor verifique suas credencias de acesso!');
            redirect('login');
        }
    }

    public function logout(){
        $this->ion_auth->logout();
        redirect('/');
    }

}