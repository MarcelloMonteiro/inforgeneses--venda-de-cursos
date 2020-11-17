<?php 

defined('BASEPATH') OR exit ('Ação nao permitido');

class Carrinho_compra{

    public function __construct(){
        if(!isset($_SESSION['carrinho'])){

            $_SESSION['carrinho'] = [];
    
        }
    }

    public function insert($produto_id = NULL){
        if($produto_id){
            if(isset($_SESSION['carrinho'][$produto_id])){
                $_SESSION['carrinho'][$produto_id];
            }else{
                $_SESSION['carrinho'][$produto_id];
            }
        }
    }

    public function delete($produto_id = NULL){
        unset($_SESSION['carrinho']['$produto_id']);
    }

    public function clean(){
        unset($_SESSION['carrinho']);
    }

    public function get_all(){
        $CI = & get_instance();
        $CI->load->model('carrinho_model');

        $retorno = array();
        $indice = 0;

        foreach($_SESSION['carrinho'] as $produto_id){
            $query = $CI->carrinho_model->get_by_id($produto_id);
            $retorno[$indice]['produto_id'] = $query->produto_id;
            $retorno[$indice]['produto_nome'] = $query->produto_nome;
            $retorno[$indice]['produto_valor'] = $query->produto_valor;
            $retorno[$indice]['produto_foto'] = $query->foto_caminho;
            $retorno[$indice]['produto_meta_link'] = $query->produto_meta_link;

            $indice++;
        }

        return $retorno;
    }

    public function get_total(){
        $carrinho =$this->get_all();
        $valor_total_carrinho = 0;

        foreach ($carrinho as $indice => $produto){
            $valor_total_carrinho += $produto['subtotal'];
        }

        return number_format($valor_total_carrinho, 2);
    }

    public function get_total_itens(){

        $total_itens = count($this->get_all());

        return $total_itens;

    }



}