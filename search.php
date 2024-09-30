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
                                'link_class'   => 'mais-link',
                                'fallback_cb' => '__return_false'
                            ) 
                        ); 
                    ?>
                </ul>                
            </div>                
        </div>
        
        <div class="content-grid"> <?php           
            echo '<h1>Resultados para: ' . get_search_query() . '</h1>
            <div class="cards-lista">';
                if (have_posts() ) {
                    while (have_posts()){
                        the_post();                      
                        echo '<a href="' , esc_url(the_permalink()) , '" class="noticia-wrapper camada-1">';
                        /*if (has_post_thumbnail()) {
                            echo '<div class="noticia-img2-wrapper"><img class="noticia-img2" src="', esc_url(the_post_thumbnail_url()), '"></div>';
                        }*/
                        echo '<div class="noticia-sem-img">'; 
                            echo '<div class="rotulo-escuro">';                                                               
                            echo '
                            <div>' . get_the_date( 'd \d\e F \d\e Y' ) . '</div>';
                            /*echo '<div class="categorias">';
                                $categories = get_the_category();
                                
                                if ($categories) {
                                    $categories = array_slice($categories, 0, 2);
                                    foreach ($categories as $category) {                                                    
                                        echo '<div>' , esc_html($category->name) , '</div>';
                                        if (next($categories)) {
                                            echo ', ';
                                        }
                                    }
                                }
                            echo '    
                                </div>';<!-- fecha div categorias -->*/
                            echo '</div><!-- fecha div rotulo -->';
                            echo '<div class="noticia-titulo">' , esc_html(the_title()) , '</div>';                                    
                    
                            echo '</div>'; //noticia-com/sem-img
                        echo '</a>'; //noticia-wrapper    
                    }
                    echo '
                    <div class="paginas-nav">
                        <div class="pagination">';
                            // Adiciona a paginação
                            the_posts_pagination(array(
                                'prev_text' => __('Anterior', 'text-domain'),
                                'next_text' => __('Próximo', 'text-domain'),
                                ));
                        echo '</div>
                    </div>';
                } else {
                    echo '<p>Desculpe, nenhum post corresponde aos seus critérios.</p>';
                }
                echo '
            </div>     
        </div>
    </div>

        <div class="imagem-grande">';
            // Obtém a URL da imagem do Customizer
            $imagem_banner_url = get_theme_mod('imagem_banner');

            if (!empty($imagem_banner_url)) {
                echo '<img src="' . esc_url($imagem_banner_url) . '" alt="Imagem decorativa do site">';
                /*echo '<div class="imagem" style="background-image: url("' . esc_url($imagem_banner_url) . '")" alt="Imagem decorativa do site"><div>';*/
            }
            echo '
            <div class="imagem-sombra"></div>
        </div>    

    </div>
</div>';

get_footer();