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


        }else{
            if(!$produto = $this->core_model->get_by_id('produtos',array('produto_id' => $produto_id))){

                $retorno['erro'] = 3;   
                $retorno['mensagem'] = 'Não foi possivel encontrar o produto';

            }else{
                $this->carrinho_compra->insert($produto_id);
                $retorno['erro'] = 0;   
                $retorno['mensagem'] = 'Produto adicionado com sucesso';

            }

        }

        echo json_encode($retorno);
    }

}