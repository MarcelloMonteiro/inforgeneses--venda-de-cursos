            <!-- Begin Header Area -->
            <header>
                <!-- Begin Header Top Area -->
                <div class="header-top">
                    <div class="container">
                        <div class="row">
                            <!-- Begin Header Top Left Area -->
                            <div class="col-lg-4 col-md-4">
                                <div class="header-top-left">
                                    <ul class="phone-wrap">
                                        <?php $sistema = info_header_footer(); ?>
                                        <li><span>Telefones: </span><?php echo $sistema->sistema_telefone_fixo . ' - ' . $sistema->sistema_telefone_movel ?></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Header Top Left Area End Here -->
                            <!-- Begin Header Top Right Area -->
                            <div class="col-lg-8 col-md-8">
                                <div class="header-top-right">
                                    <ul class="ht-menu">
                                        <!-- Begin Setting Area -->
                                        <li>
                                            <div class="ht-setting-trigger"><span>Principais Escolas</span></div>
                                            <div class="setting ht-setting">
                                                <ul class="ht-setting-list">

                                                    <?php $grandes_marcas = grandes_marcas_navbar(); ?>

                                                    <?php foreach ($grandes_marcas as $marca) : ?>

                                                        <li><a href="#"><?php echo $marca->marca_nome; ?></a></li>

                                                    <?php endforeach; ?>


                                                </ul>
                                            </div>
                                        </li>
                                        <!-- Setting Area End Here -->
                                        <!-- Begin Currency Area -->
                                        <li>
                                            <div class="ht-currency-trigger"><span>Entre ou registre-se</span></div>
                                            <div class="currency ht-currency">
                                                <ul class="ht-setting-list">

                                                <?php if(!$this->ion_auth->logged_in()):?>
                                                    <li><a href="<?php echo base_url('login')?>">Entrar</a></li>

                                                <?php else: ?>
                                                    <li><a href="#">Perfil</a></li>
                                                    <li><a href="#">Pedidos</a></li>
                                                    <li class="active"><a href="<?php echo base_url('login/logout')?>">Logout</a></li>
                                                <?php endif; ?>
                                                    
                                                 </ul>
                                            </div>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                            <!-- Header Top Right Area End Here -->
                        </div>
                    </div>
                </div>
                <!-- Header Top Area End Here -->
                <!-- Begin Header Middle Area -->
                <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
                    <div class="container">
                        <div class="row">
                            <!-- Begin Header Logo Area -->
                            <div class="col-lg-3">
                                <div class="logo pb-sm-30 pb-xs-30">
                                    <a href="index.html">
                                        <img src="<?php echo base_url('public/web/logo.png')?>" alt="">
                                    </a>
                                </div>
                            </div>
                            <!-- Header Logo Area End Here -->
                            <!-- Begin Header Middle Right Area -->
                            <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                                <!-- Begin Header Middle Searchbox Area -->

                                <?php 
                                    $atributos = array(
                                        'class'=> 'hm-searchbox',
                                    );
                                ?>

                                <?php echo form_open('busca', $atributos)?>

                                    <input type="text" name="busca" placeholder="Qual o curso que você procura ?">
                                    <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                                
                                <?php echo form_close(); ?>

                                <!-- Header Middle Searchbox Area End Here -->
                                <!-- Begin Header Middle Right Area -->
                                <div class="header-middle-right">
                                    <ul class="hm-menu">

                                        <!-- Begin Header Mini Cart Area -->
                                        <li class="hm-minicart">
                                            <div class="hm-minicart-trigger">
                                                <span class="item-icon"></span>
                                                <span class="item-text">
                                                    <span class="cart-item-count"></span>
                                                </span>
                                            </div>
                                            <span></span>
                                            <div class="minicart">
                                                <ul class="minicart-product-list">

                                                </ul>
                                                <p class="minicart-total">Total <span>R$ 0.00</span></p>
                                                <div class="minicart-button">
                                                    <a href="shopping-cart.html" class="li-button li-button-fullwidth li-button-dark">
                                                        <span>vizualizar</span>
                                                    </a>
                                                    <a href="checkout.html" class="li-button li-button-fullwidth">
                                                        <span>Finalizar</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- Header Mini Cart Area End Here -->
                                    </ul>
                                </div>
                                <!-- Header Middle Right Area End Here -->
                            </div>
                            <!-- Header Middle Right Area End Here -->
                        </div>
                    </div>
                </div>
                <!-- Header Middle Area End Here -->
                <!-- Begin Header Bottom Area -->
                <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Begin Header Bottom Menu Area -->
                                <div class="hb-menu">
                                    <nav>
                                        <ul>
                                            <li class="dropdown-holder"><a href="<?php base_url('/'); ?>">Home</a>
                                            </li>

                                            <?php $categorias_pai = get_categorias_pai_navbar();?>

                                            <?php foreach ($categorias_pai as $cat_pai) : ?>

                                                <?php $categorias_filhas = get_categorias_filhas_navbar($cat_pai->categoria_pai_id); ?>

                                                <li class="dropdown-holder"><a href="<?php echo base_url('master/'.$cat_pai->categoria_pai_meta_link); ?>"><?php echo $cat_pai->categoria_pai_nome; ?></a>

                                                    <ul class="hb-dropdown">
                                                    <?php foreach ($categorias_filhas as $cat_filhas) : ?>

                                                        <li class="active"><a href="<?php echo base_url('categoria/'.$cat_filhas->categoria_meta_link) ?>"><?php echo $cat_filhas->categoria_nome;?></a></li>

                                                        <?php endforeach; ?>
                                                    </ul>
                                                </li>

                                            <?php endforeach; ?>

                                        </ul>
                                    </nav>
                                </div>
                                <!-- Header Bottom Menu Area End Here -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Header Bottom Area End Here -->
                <!-- Begin Mobile Menu Area -->
                <div class="mobile-menu-area d-lg-none d-xl-none col-12">
                    <div class="container">
                        <div class="row">
                            <div class="mobile-menu">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mobile Menu Area End Here -->
            </header>
            <!-- Header Area End Here -->