<?php

defined('BASEPATH') or exit('Ação nao permitida');

class Produtos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('restrita/login');
        }
    }
    public function index()
    {

        $data = array(

            'titulo' => 'Cursos cadastrados',

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

            'produtos' => $this->produtos_model->get_all(),
        );
        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/produtos/index');
        $this->load->view('restrita/layout/footer');
    }

    public function core($produto_id = NULL)
    {

        $produto_id = (int) $produto_id;

        if (!$produto_id) {
            //cadastrando...
        } else {

            if (!$produto = $this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))) {

                $this->session->set_flashdata('erro', 'Esse curso não foi encontrado');
                redirect('restrita/produtos');
            } else {
                //editando...
            /**[produto_codigo] => 12345678
    [produto_nome] => Curso CodeIgniter
    [produto_valor] => 29.00
    [produto_categoria_id] => 4
    [produto_marca_id] => 1
    [produto_ativo] => 1
    [produto_destaque] => 1
    [produto_descricao] => Curso CodeIgniter Curso CodeIgniter Curso CodeIgniter
    [produto_id] => 1 */
                //validações

                $this->form_validation->set_rules('produto_nome', 'Nome do curso', 'trim|required|min_length[3]|max_length[40]|callback_valida_nome_produto');
                $this->form_validation->set_rules('produto_valor', 'Valor do curso', 'trim|required');
                $this->form_validation->set_rules('produto_categoria_id', 'Categoria do curso', 'trim|required');
                $this->form_validation->set_rules('produto_marca_id', 'Escola do curso', 'trim|required');
                $this->form_validation->set_rules('produto_descricao', 'Descrição do curso', 'trim|required');


                if ($this->form_validation->run()) {

                    $data = elements(
                        array(
                            'produto_nome',
                            'produto_valor',
                            'produto_categoria_id',
                            'produto_marca_id',
                            'produto_descricao',
                        ), $this->input->post()
                    );

                    //removendo virgula
                    $data['produto_valor'] = str_replace(',','',$data['produto_valor']);

                    //criando metalink
                    $data['produto_meta_link'] = url_amigavel($data['produto_nome']);

                    $data = html_escape($data);

                    $this->core_model->update('produtos', $data, array('produto_id'=> $produto_id));

                    redirect('restrita/produtos');

                } else {


                    $data = array(

                        'titulo' => 'Editar curso',
                        'styles' => array(
                            'jquery-upload-file/css/uploadfile.css',
                        ),

                        'scripts' => array(
                            'sweetalert2/sweetalert2.all.min.js',
                            'jquery-upload-file/js/jquery.uploadfile.min.js',
                            'jquery-upload-file/js/produtos.js',
                            'mask/jquery.mask.min.js',
                            'mask/custom.js'
                        ),
                        'produto' => $produto,
                        'fotos_produto' => $this->core_model->get_all('produtos_fotos', array('foto_produto_id' => $produto_id)),
                        'produtos' => $this->core_model->get_all('categorias', array('categoria_ativa' => 1)),
                        'marcas' => $this->core_model->get_all('marcas', array('marca_ativa' => 1)),
                    );



                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/produtos/core');
                    $this->load->view('restrita/layout/footer');
                }
            }
        }
    }

    public function valida_nome_produto($produto_nome){
    
        $produto_id = (int) $this->input->post('produto_id');
        
        if (!$produto_id){
            //cadastrando

            if ($this->core_model->get_by_id('produtos', array('produto_nome'=> $produto_nome))){
                $this->form_validation->set_message('valida_nome_produto','Essa curso ja existe');
                return false;
            }else{
                return true;
            }

        }else{
            //Editando

            if ($this->core_model->get_by_id('produtos', array('produto_nome'=> $produto_nome, 'produto_id !=' => $produto_id))){
                $this->form_validation->set_message('valida_nome_produto','Esse curso ja existe');
                return false;
            }else{
                return true;
            }
    }
    }

    public function upload()
    {

        $config['upload_path'] = './uploads/cursos';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 2048;
        $config['max_width'] = 1000;
        $config['max_height'] = 1000;
        $config['encrypt_name'] = TRUE;
        $config['max_filename'] = 200;
        $config['file_ext_tolower'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto_produto')) {

            $data = array(

                'uploaded_data' => $this->upload->data(),
                'mensagem' => 'Imagem enviada com sucesso',
                'foto_caminho' => $this->upload->data('file_name'),
                'erro' => 0,
            );

            //resize image configuração

            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/cursos' . $this->upload->data('file_name');
            $config['new-image'] = './uploads/cursos/small' . $this->upload->data('file_name');
            $config['width'] = 300;
            $config['height'] = 300;

            //chama a biblioteca
            $this->load->library('image_lib', $config);

            //faz o resize
            //$this->image_lib->resize();

            if (!$this->image_lib->resize()) {
                $data['erro'] = $this->image_lib->display_errors();
            }
        } else {

            $data = array(
                'mensagem' => $this->upload->display_errors(),
                'erro' => 5,
            );
        }
        echo json_encode($data);
    }
}
