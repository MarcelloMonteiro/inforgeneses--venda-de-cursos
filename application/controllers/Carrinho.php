<?php 

defined('BASEPATH') OR exit ('Ação nao permitida');

class Carrinho extends CI_Controller{

    public function __construct(){
        parent::__construct();

    }

    public function index(){

    }

    public function insert(){

        $produto_id = (int) $this->input->post('produto_id');

        $retorno = array();

        if(!$produto_id){
            $retorno['erro'] = 3;
            $retorno['mensagem'] = 'Informe a quantidade maior que zero';
            echo json_encode($retorno);
            exit();
        }else{
            if(!$produto = $this->core_model->get_by_id('produtos',array('produto_id' => $produto_id))){

                $retorno['erro'] = 3;   
                $retorno['mensagem'] = 'Não foi possivel encontrar o produto';
                echo json_encode($retorno);
            }

        }

        echo json_encode($retorno);
    }

}