<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <!-- Font Rawline-->
  <link
    rel="stylesheet"
    href="https://cdngovbr-ds.estaleiro.serpro.gov.br/design-system/fonts/rawline/css/rawline.css"
  />
  <!-- Font Raleway-->
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900&amp;display=swap"
  />
  <link href="<?php echo get_bloginfo("template_directory"); ?>/assets/fontawesome6/css/fontawesome.css" rel="stylesheet">
  <link href="<?php echo get_bloginfo("template_directory"); ?>/assets/fontawesome6/css/brands.css" rel="stylesheet">
  <link href="<?php echo get_bloginfo("template_directory"); ?>/assets/fontawesome6/css/solid.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo get_bloginfo("template_directory"); ?>/js/controller.js"></script>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Departamento de Mídias Digitais - UFPB</title>
  <?php wp_head(); ?>
</head>
<body>
    <div class="container">
        <div class="topo camada-1">
            <div id="cabecalho-id" class="cabecalho-wrapper">
                <div class="cabecalho">
                <div class="cabecalho-esquerda">
                    <a class="logo" href="<?php echo get_home_url(); ?>">
                        <!--<img class="logo" src="<?php echo get_bloginfo("template_directory"); ?>/img/logo.jpeg">-->
                        <div >
                            <?php the_custom_logo(); ?>
                        </div>  
                    </a>
                    <div>
                        <a href="<?php $custom_urlcentro = esc_url(get_theme_mod('custom_urlcentro', 'https://www.ufpb.br/ufpb/menu/institucional/centros-de-ensino')); echo esc_url($custom_urlcentro) ?>" class="centro-titulo">
                            <?php $custom_centro = get_theme_mod('custom_centro', 'Centro de Alguma Coisa'); echo esc_html($custom_centro);?>
                        </a>
                        <a href="<?php echo get_home_url(); ?>" class="departamento-titulo"><?php echo get_bloginfo( 'name' ); ?></a>
                    </div>
                </div>
                <a href="http://ufpb.br" class="brasao">
                    <img src="<?php echo get_bloginfo("template_directory"); ?>/img/SVG final.svg">
                </a>
                </div>
            </div>
            <div id="menu-nav" class="menu-wrapper">
                <div class="menu">
                    <button type="nav" id="hamburger">
                        <i class="fa-solid fa-bars"></i>
                        <div>Menu</div>
                    </button>
                    <ul id="desktop-menu">
                        <li><a href="">Institucional</a></li>
                        <li><a href="">Equipe</a></li>
                        <li><a href="">Ensino</a></li>
                        <li><a href="">Oportunidades</a>
                        <ul>
                            <li><a href="">Projetos de Pesquisa</a></li>
                            <li><a href="texto.html">Projetos de Extensão</a></li>
                            <li><a href="">Monitoria</a></li>
                            <li><a href="">Estágio</a></li>
                        </ul>
                        </li>
                        <li><a href="noticias.html">Notícias</a></li>
                        <li><a href="">Eventos</a></li>
                        <li><a href="">Documentos</a>
                        <ul>
                            <li><a href="documentos.html#">Todos os documentos</a></li>
                            <li><a href="documentos.html#documentos-discentes">Documentos discentes</a></li>
                            <li><a href="documentos.html#documentos-docentes">Documentos docentes</a></li>
                            <li><a href="documentos.html#resolucoes">Resoluções</a></li>
                            <li><a href="documentos.html#formularios">Formulários</a></li>
                        </ul>
                        </li>
                        <li><a href="contato.html">Contato</a></li>
                    </ul>                    
                    <div class="busca-teste hidden" id="busca-barra">                    
                        <div>
                            <form action="">
                                <input type="search" placeholder="O que você procura?">                            
                                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                <button type="button" id="busca-fecha"><i class="fa-solid fa-times"></i></button>
                            </form>
                        </div>
                    </div>
                    <div id="menu-buttons">
                        <button id="busca"><i class="fa-solid fa-magnifying-glass"></i></button>
                        
                        <i class="fa-solid fa-universal-access"></i>        
                    </div>
                </div>      
            </div>            
        </div> 
        <div id="menu-overlay" class="top-fixed-overlay camada-2 hidden">
            <ul id="mobile-menu">
                <li><a href="">Institucional</a></li>
                <li><a href="">Equipe</a></li>
                <li><a href="">Institucional</a></li>
                <li><a href="">Equipe</a></li>
                <li><a href="">Ensino</a></li>
                <li><a href="">Oportunidades</a>
                <li><a href="">Institucional</a></li>
                <li><a href="">Equipe</a></li>
                <li><a href="">Ensino</a></li>
                <li><a href="">Oportunidades</a>
                <li><a href="">Institucional</a></li>
                <li><a href="">Equipe</a></li>
                <li><a href="">Ensino</a></li>
                <li><a href="">Falta 4</a>
                <ul>
                    <li><a href="">Projetos de Pesquisa</a></li>
                    <li><a href="texto.html">Projetos de Extensão</a></li>
                    <li><a href="">Monitoria</a></li>
                    <li><a href="">Estágio</a></li>
                </ul>
                </li>
                <li><a href="noticias.html">Falta 3</a></li>
                <li><a href="">Falta 2</a></li>
                <li><a href="">Falta 1</a>
                <ul>
                    <li><a href="documentos.html#">Todos os documentos</a></li>
                    <li><a href="documentos.html#documentos-discentes">Documentos discentes</a></li>
                    <li><a href="documentos.html#documentos-docentes">Documentos docentes</a></li>
                    <li><a href="documentos.html#resolucoes">Resoluções</a></li>
                    <li><a href="documentos.html#formularios">Formulários</a></li>
                </ul>
                </li>
                <li><a href="contato.html">Fim!!!</a></li>
            </ul>
        </div>