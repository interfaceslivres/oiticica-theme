<?php get_header(); ?>

<div class="corpo" id="conteudo_pagina">
    <div class="corpo-grid">
        <div class="sidebar">
            <div class="sidebar-wrapper" id="sidebar-menu">
                <h2 class="menu-lateral-h2">Acesso Rápido</h2>
                <ul class="menu-lateral">
                    <?php 
                        wp_nav_menu(   
                            array ( 
                                'theme_location' => 'side-menu',
                                'items_wrap' => '%3$s',
                                'container' => false,
                                'link_class'   => 'mais-link'
                            ) 
                        ); 
                    ?>
                    <!--li><a href="#">Notícias</a></li>
                    <li><a href="#">Eventos</a></li>
                    <li><a href="#">Eventos passados</a></li-->
            </ul>
            </div>                    
        </div>
        <?php
        while ( have_posts() ) :
        the_post(); 
        ?>        
        <div class="content-grid">            
            <h1 class="noticia-pagina-titulo"><?php the_title(); ?></h1>
            <h1 class="noticia-pagina-titulo"><?php $my_meta = get_post_meta( get_the_ID(), '__custom_date_meta_key', true ); echo date('Y-m-d', $my_meta)?></h1>
            <h1 class="noticia-pagina-titulo"><?php echo get_the_date("d M Y"); ?></h1>
            <?php if ( has_excerpt() ) : ?>
                <h2 class="bigode"><?php echo wp_strip_all_tags( get_the_excerpt(), true ); ?></h2>
            <?php endif; ?>                     
                

            <?php the_content(); ?>
                                
        <?php endwhile; ?>

            <!--div class="noticia-links-relacionados">
                <h2>Arquivos</h2>
                <a href="#"><div class="noticia-link-relacionado">https://mobile.fraudes.com/cdn-content/manual_v2.pdf?id=7dc68bDB879D68BC</div></a>                    
                <a href="#"><div class="noticia-link-relacionado">Manual de como se defender da nova espécie</div></a>
            </div-->
            
            <div class="noticia-compartilhe">
                <!--div>Compartilhe:</div-->
                <div class="redes-sociais noticia-redes">
                    <a href="https://api.whatsapp.com/send?text=Acesse%20esta%20p%C3%A1gina:%20<?php echo get_permalink();?>" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo get_permalink();?>"  target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink();?>" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                </div>
            </div>

            <?php cats_related_post() ?>            
        </div>
    </div>

        <div class="imagem-grande">
            <?php
            // Obtém a URL da imagem do Customizer
            $imagem_banner_url = get_theme_mod('imagem_banner');

            if (!empty($imagem_banner_url)) {
                echo '<img src="' . esc_url($imagem_banner_url) . '" alt="Imagem decorativa do site">';
                /*echo '<div class="imagem" style="background-image: url("' . esc_url($imagem_banner_url) . '")" alt="Imagem decorativa do site"><div>';*/
            }
            ?>
            <div class="imagem-sombra"></div>
        </div>    

    </div>
</div>

<?php get_footer(); ?>