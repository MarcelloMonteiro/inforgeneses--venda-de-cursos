<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		
		$sistema = info_header_footer();

		$data = array(
			'titulo' => 'Seja muito bem vindo(a) à '.$sistema->sistema_nome_fantasia,
			'produtos_destaques' => $this->loja_model->get_produtos_destaques($sistema->sistema_produtos_destaques),
		);

		$this->load->view('web/layout/header', $data);
		$this->load->view('web/loja');
		$this->load->view('web/layout/footer');
	}
}
