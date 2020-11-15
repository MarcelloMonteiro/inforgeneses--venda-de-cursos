<?php $this->load->view('restrita/layout/navbar'); ?>
<?php $this->load->view('restrita/layout/sidebar'); ?>

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <!-- add content here -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4><?php echo $titulo; ?></h4>
            </div>

            <?php

            $atributos = array(
              'name' => 'form_core',

            );

            if (isset($produto)) {
              $produto_id = $produto->produto_id;
            } else {
              $produto_id = '';
            }

            ?>

            <?php echo form_open('restrita/produtos/core/' . $produto_id, $atributos); ?>

            <div class="card-body">

              <?php if (isset($produto)) : ?>

                <div class="form-row">
                  <div class="col-md-12">
                    <label>Meta link do curso</label>
                    <p class="text-info"><?php echo $produto->produto_meta_link; ?></p>
                  </div>
                </div>

              <?php endif; ?>

              <div class="form-row">

                <div class="form-group col-md-3">
                  <label>Código do curso</label>
                  <input type="text" name="produto_codigo" class="form-control border-0" value="<?php echo (isset($produto) ? $produto->produto_codigo : set_value('produto_codigo')); ?>" readonly="">
                  <?php echo form_error('produto_codigo', '<div class="text-danger">', '</div>') ?>
                </div>

                <div class="form-group col-md-6">
                  <label>Nome do curso</label>
                  <input type="text" name="produto_nome" class="form-control" value="<?php echo (isset($produto) ? $produto->produto_nome : set_value('produto_nome')); ?>">
                  <?php echo form_error('produto_nome', '<div class="text-danger">', '</div>') ?>
                </div>


                <div class="form-group col-md-3">
                  <label>Valor do curso</label>
                  <input type="text" name="produto_valor" class="form-control money2" value="<?php echo (isset($produto) ? $produto->produto_valor : set_value('produto_valor')); ?>">
                  <?php echo form_error('produto_valor', '<div class="text-danger">', '</div>') ?>
                </div>


              </div>

              <div class="form-row">

                <div class="form-group col-md-3">
                  <label for="inputState">Categoria</label>
                  <select id="inputState" name="produto_categoria_id" class="form-control">


                    <option value="">Escolha...</option>

                    <?php foreach ($categorias as $categoria) : ?>

                      <?php if (isset($produto)) : ?>

                        <option value="<?php echo $categoria->categoria_id; ?>" <?php echo ($categoria->categoria_id == $produto->produto_categoria_id ? 'selected' : '') ?>>
                          <?php echo $categoria->categoria_nome; ?></option>

                      <?php else : ?>

                        <option value="<?php echo $categoria->categoria_id; ?>"><?php echo $categoria->categoria_nome; ?></option>

                      <?php endif; ?>

                    <?php endforeach; ?>

                  </select>
                </div>

                <div class="form-group col-md-3">
                  <label for="inputState">Escola</label>
                  <select id="inputState" name="produto_marca_id" class="form-control">

                    <option value="">Escolha...</option>

                    <?php foreach ($marcas as $marca) : ?>

                      <?php if (isset($produto)) : ?>

                        <option value="<?php echo $marca->marca_id; ?>" <?php echo ($marca->marca_id == $produto->produto_marca_id ? 'selected' : '') ?>>
                          <?php echo $marca->marca_nome; ?></option>

                      <?php else : ?>

                        <option value="<?php echo $marca->marca_id; ?>"><?php echo $marca->marca_nome; ?></option>

                      <?php endif; ?>

                    <?php endforeach; ?>

                  </select>
                </div>

                <div class="form-group col-md-3">
                  <label for="inputState">Ativo</label>
                  <select id="inputState" name="produto_ativo" class="form-control">

                    <?php if (isset($produto)) : ?>

                      <option value="1" <?php echo ($produto->produto_ativo == 1 ? 'selected' : ''); ?>>Sim</option>
                      <option value="0" <?php echo ($produto->produto_ativo == 0 ? 'selected' : ''); ?>>Não</option>

                    <?php else : ?>

                      <option value="1">Sim</option>
                      <option value="0">Não</option>

                    <?php endif; ?>

                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="inputState">Produto em destaque</label>
                  <select id="inputState" name="produto_destaque" class="form-control">

                    <?php if (isset($produto)) : ?>

                      <option value="1" <?php echo ($produto->produto_destaque == 1 ? 'selected' : ''); ?>>Sim</option>
                      <option value="0" <?php echo ($produto->produto_destaque == 0 ? 'selected' : ''); ?>>Não</option>

                    <?php else : ?>

                      <option value="1">Sim</option>
                      <option value="0">Não</option>

                    <?php endif; ?>

                  </select>
                </div>

              </div>

              <div class="form-row">

                <div class="form-group col-md-12">
                  <label>Descrição do curso</label>
                  <textarea class="form-control" name="produto_descricao" rows="2"><?php echo (isset($produto) ? $produto->produto_descricao : set_value('produto_descricao')); ?></textarea>
                  <?php echo form_error('produto_descricao', '<div class="text-danger">', '</div>') ?>
                </div>


              </div>

              <div class="form-row">

                <div class="form-group col-md-8">
                  <label>Imagem do Curso</label>
                      <div id="fileuploader">

                      </div>
                      
                      <div id="erro_uploaded" class="text-danger">

                      </div>
                  <?php echo form_error('fotos_produtos', '<div class="text-danger">', '</div>') ?>
                </div>

              </div>

              <div class="form-row">
                
                <div class="col-md-12">

                  <?php if(isset($produto)):?>

                    <div id="uploaded_image" class="text-danger">
                      
                      <?php foreach ($fotos_produto as $foto): ?>

                        <ul style="list-style: none; display: inline-block">

                          <li>

                            <img src="<?php echo base_url('uploads/cursos/'.$foto->foto_caminho);?>" width="80" class="img-thumbnail mr-1 mb-2">
                            <input type="hidden" name="fotos_produtos[]" value="<?php echo $foto->foto_caminho; ?>">
                            <a href="javascript:(void)" class="btn btn-danger d-block btn-icon mx-auto mb-30 btn-remove"><i class="fas fa-times"></i></a>

                          </li>

                        </ul>

                      <?php endforeach ?>
                    </div>  
                  <?php else: ?> 

                    <div id="uploaded" class="text-danger">
                    
                    </div>

                  <?php endif; ?>

                </div>

              </div>

              <div class="form-row">

                <?php if (isset($produto)) : ?>
                  <input type="hidden" name="produto_id" value="<?php echo $produto->produto_id; ?>">
                <?php endif; ?>
              </div>

            </div>

            <div class="card-footer">
              <button class="btn btn-primary mr-2">Salvar</button>
              <a class="btn btn-dark" href="<?php echo base_url('restrita/produtos'); ?>">Voltar</a>
            </div>

          </div>

          <?php echo form_close(); ?>

        </div>
      </div>
    </div>
  </section>
  <?php $this->load->view('restrita/layout/sidebar_settings'); ?>
</div>