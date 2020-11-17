<?php $this->load->view('web/layout/navbar'); ?>

<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="<?php echo base_url('/');?>">Home</a></li>
                <li class="active"><?php echo $termo_digitado?></li>
            </ul>
        </div>
    </div>
</div>

<!-- Begin Li's Content Wraper Area -->
<div class="content-wraper pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <!-- shop-products-wrapper start -->
                <div class="shop-products-wrapper">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                            <div class="product-area shop-product-area">
                                <div class="row">

                                <?php if(isset($produtos)): ?>

                                    <?php foreach($produtos as $produto):?>
                                
                                <div class="col-lg-3 col-md-4 col-sm-6 mt-40 mb-60">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="<?php echo base_url('produto/'. $produto->produto_meta_link); ?>">
                                                <img src="<?php echo base_url('uploads/cursos/'.$produto->foto_caminho);?>" alt="<?php echo $produto->produto_nome; ?>">
                                            </a>
                                            <span class="sticker">New</span>
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a href="product-details.html">Avaliações</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name" href="single-product.html"><?php echo word_limiter($produto->produto_nome, 4) ?></a></h4>
                                                <div class="price-box">
                                                    <span class="new-price"><?php echo 'R$ '.$produto->produto_valor;?></span>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active"><a href="<?php echo base_url('produto/'.$produto->produto_meta_link); ?>">Visualizar</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>

                            <?php endforeach; ?>

                                <?php else: ?>

                                <?php echo $termo_digitado; ?>

                                <?php endif; ?>

                                </div>
                            </div>
                        
                    </div>
                </div>
                <!-- shop-products-wrapper end -->
            </div>
        </div>
    </div>
</div>
