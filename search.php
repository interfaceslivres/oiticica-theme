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
                </ul>                
            </div>                
        </div>
        
        <div class="content-grid">            
            <h1><?php printf(__('Resultados para: %s', 'text-domain'), '<span>' . get_search_query() . '</span>'); ?></h1>
            <div class="cards-lista">
                <?php if (have_posts() ) : ?>
                    <!-- begin loop -->
                    <?php while (have_posts() ) : the_post(); ?>  
                    <?php if ( has_post_thumbnail()) : ?>
                        <div class="noticia-wrapper camada-1">
                            <div class="rotulo-claro">
                                <div><?php echo get_the_date( 'd \d\e F Y' ); ?></div>                                
                                <div class="categorias">
                                    <?php                                        
                                    $categories = get_the_category();   // Obtém as categorias do post                                        
                                    if ($categories) {  // Verifica se existem categorias                                            
                                        $categories = array_slice($categories, 0, 2); // Limita a exibição a duas categorias                                            
                                        foreach ($categories as $category) {    // Loop pelas categorias
                                            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';                                                
                                            if (next($categories)) {    // Adiciona uma vírgula após a categoria, exceto pela última
                                                echo ', ';
                                            }
                                        }
                                    }
                                    ?>
                                </div><!-- fecha div categorias -->
                            </div><!-- fecha div rotulo -->
                            <img class="noticia-img" src="<?php the_post_thumbnail_url(); ?>">
                            <a href="<?php the_permalink();?>" class="noticia-com-img">
                                <div class="noticia-titulo">                  
                                    <?php the_title(); ?>
                                </div>                          
                            </a>
                        </div>
                    <?php else : ?> 
                        <div class="noticia-wrapper camada-1">
                            <div class="rotulo-escuro">
                                <div><?php echo get_the_date( 'd \d\e F Y' ); ?></div>
                                <div class="categorias">
                                    <?php                                        
                                    $categories = get_the_category();   // Obtém as categorias do post                                        
                                    if ($categories) {  // Verifica se existem categorias                                            
                                        $categories = array_slice($categories, 0, 2); // Limita a exibição a duas categorias                                            
                                        foreach ($categories as $category) {    // Loop pelas categorias
                                            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';                                                
                                            if (next($categories)) {    // Adiciona uma vírgula após a categoria, exceto pela última
                                                echo ', ';
                                            }
                                        }
                                    }
                                    ?>
                                </div><!-- fecha div categorias -->
                            </div><!-- fecha div rotulo -->
                            <a class="noticia-sem-img" href="<?php the_permalink();?>"> 
                                <div class="noticia-titulo" ><?php the_title(); ?></div>
                            </a>
                        </div>                                                        
                    <?php endif; ?> 
                    <?php endwhile; ?> 

                    <div class="paginas-nav">
                        <div class="pagination">
                            <?php 
                            // Adiciona a paginação
                            the_posts_pagination(array(
                                'prev_text' => __('Anterior', 'text-domain'),
                                'next_text' => __('Próximo', 'text-domain'),
                                ));
                            ?>
                        </div>
                    </div>
                <?php else : ?>
                    <p><?php _e( 'Desculpe, nenhum post corresponde aos seus critérios.' ); ?></p>
                <?php endif; ?>
            </div>     
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