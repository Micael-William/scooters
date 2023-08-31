<?php
if($pg_int <> "S"){
	$redir="Location:index.php";
	header($redir);
	die();
}
?>
<div class="header-container d-flex align-items-center justify-content-center">
    <div class="container align-items-center justify-content-between d-flex">
        <div>
            <a href="<?=$host;?>/adm"><img src="<?=$host;?>/img/logo_adm.png" class="logo img100" alt=""></a>
        </div>

        <div class="d-flex flex-column align-items-end right-icons">
            <!-- <div class="float-end d-flex align-items-center contact-side">
                <div class="d-flex social-links align-items-end">
                    <a href="#" target="_blank"><i class="fab me-2 fs-5 text-muted fa-twitter"></i></a>
                    <a href="#" target="_blank"><i class="fab me-2 fs-5 text-muted fa-facebook"></i></a>
                    <a href="#" target="_blank"><i class="fab me-2 fs-5 text-muted fa-youtube"></i></a>
                    <a href="#" target="_blank"><i class="fab me-2 fs-5 text-muted fa-spotify"></i></a>
                    <a href="#" target="_blank"><i class="fab me-3 fs-5 text-muted fa-instagram"></i></a>
                </div>
            </div> -->

            <nav class="top-custom-nav navbar navbar-expand-lg navbar-white">

                <div class="container-fluid">
                    <button class="navbar-toggler first-button" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample">
                        <div class="animated-icon1"><span></span><span></span><span></span></div>
                    </button>

                    <div class="collapse navbar-collapse" id="main_nav">
                        <ul class="navbar-nav text-center">
                            <li class="nav-item"><a class="nav-link" href="<?=$host;?>/adm/inicial"><i class='icone fa fa-home'></i><br>HOME</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?=$host;?>/adm/blog"><i class='icone fa fa-commenting-o'></i><br>BLOG</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?=$host;?>/adm/institucional"><i class='icone fa fa-sitemap'></i><br>INSTITUCIONAL</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link  dropdown-toggle" href="<?=$host;?>/adm" data-bs-toggle="dropdown"><i class='icone fa fa-picture-o'></i><br>SLIDERS</a>
                                <ul class="dropdown-menu fade-up">
                                    <li><a class="dropdown-item" href="<?=$host;?>/adm/banner/principal">Principal</a></li> 
                                    <li><a class="dropdown-item" href="<?=$host;?>/adm/banner/horizontal">Inferior</a></li>
                                </ul>
                            </li> 
                            <li class="nav-item dropdown">
                                <a class="nav-link  dropdown-toggle" href="<?=$host;?>/adm" data-bs-toggle="dropdown"><i class='icone fa fa-car'></i><br>SCOOTERS</a>
                                <ul class="dropdown-menu fade-up">
                                    <li><a class="dropdown-item" href="<?=$host;?>/adm/veiculos/">Anúncios</a></li> 
                                    <li><a class="dropdown-item" href="<?=$host;?>/adm/veiculos/configuracoes">Configurações</a></li>
                                    <li><a class="dropdown-item" href="<?=$host;?>/adm/veiculos/marcas_modelos_api">API Marcas/Modelos</a></li>
                                    <li><hr class="dropdown-divider"></li> 
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link  dropdown-toggle" href="<?=$host;?>/adm/configuracoes" data-bs-toggle="dropdown"><i class='icone fa fa-cog'></i><br>CONFIGURAÇÕES</a>
                                <ul class="dropdown-menu fade-up">
                                    <li><a class="dropdown-item" href="<?=$host;?>/adm/config">Dados gerais</a></li> 
                                    <li><a class="dropdown-item" href="<?=$host;?>/adm/usuarios">Usuários</a></li>
                                    <li><a class="dropdown-item" href="<?=$host;?>/adm/veiculos/atualiza_api">Atualizar API</a></li>
                                </ul>
                            </li>

                            <li class="nav-item"><a class="nav-link" href="<?=$host;?>/adm/sair"><i class='icone fa fa-sign-out'></i><br>SAIR</a></li>
                        </ul>
                    </div>

                    <div class="side-custom-offcanvas offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" data-bs-keyboard="false" data-bs-backdrop="true" data-bs-scroll="true" aria-labelledby="offcanvasExampleLabel">
                        <!-- <div class="offcanvas-header position-absolute">
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div> -->
                        <!-- <div class="faixa_acessibilidade">
                            <div class="container">
                                <div class="row">
                                    <div class='col-12'>
                                        &nbsp;&nbsp;&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div> -->
                        <div class="faixa_menu">
                            <a href="<?=$host;?>/adm"><img src="<?=$host;?>/img/logo_adm.png" class="logo-img rounded ms-3" alt=""></a>
                        </div>
                        <div class="offcanvas-body" id="sidebar">
                            <ul class="navbar-nav">
                                <a href="<?=$host;?>/adm/inicial" class="nav-link">HOME</a>
                                <a href="<?=$host;?>/adm/blog" class="nav-link">BLOG</a>
                                <a href="<?=$host;?>/adm/institucional" class="nav-link">INSTITUCIONAL</a>
                                <a href="<?=$host;?>/adm/clientes" class="nav-link">CLIENTES</a>
                                <a href="#menu_slider" class="nav-link collapsed dropdown-toggle" data-bs-toggle="collapse" role="button">SLIDERS</a>
                                <div class="collapse ps-2" id="menu_slider" data-bs-parent="#sidebar">
                                    <a class="nav-link" href="<?=$host;?>/adm/banner/principal">PRINCIPAL</a> 
                                    <a class="nav-link" href="<?=$host;?>/adm/banner/horizontal">INFERIOR</a>
                                </div>
                                <a href="#menu_anuncios" class="nav-link collapsed dropdown-toggle" data-bs-toggle="collapse" role="button">SCOOTERS</a>
                                <div class="collapse ps-2" id="menu_anuncios" data-bs-parent="#sidebar">
                                    <a class="nav-link" href="<?=$host;?>/adm/veiculos">ANÚNCIOS</a> 
                                    <a class="nav-link" href="<?=$host;?>/adm/veiculos/configuracoes">CONFIGURAÇÕES</a>
                                    <a class="nav-link" href="<?=$host;?>/adm/veiculos/atualiza_api">ATUALIZAR API</a>
                                </div>
                                <a href="#menu_config" class="nav-link collapsed dropdown-toggle" data-bs-toggle="collapse" role="button">CONFIGURAÇÕES</a>
                                <div class="collapse ps-2" id="menu_config" data-bs-parent="#sidebar">
                                    <a class="nav-link" href="<?=$host;?>/adm/config">DADOS GERAIS</a> 
                                    <a class="nav-link" href="<?=$host;?>/adm/usuarios">USUÁRIOS</a>
                                </div>
                            </ul>
                        </div>

                        <div class="float-end d-flex align-items-center contact-side bt_vermelho">
                            <div class="d-flex social-links align-items-center text-center">
                                <a href="#" target="_blank"><i class="fab me-4 fs-5 text-muted fa-facebook"></i></a>
                                <a href="#" target="_blank"><i class="fab me-4 fs-5 text-muted fa-youtube"></i></a>
                                <a href="#" target="_blank"><i class="fab me-4 fs-5 text-muted fa-instagram"></i></a>
                            </div>
                        </div>

                    </div>

                </div>
            </nav>

        </div>
    </div>
</div> 