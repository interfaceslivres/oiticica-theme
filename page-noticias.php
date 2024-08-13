<?php get_header(); ?>

<div class="corpo" id="conteudo_pagina">
    <div class="corpo-grid">
        <div class="sidebar">  
            <div class="sidebar-wrapper" id="sidebar-menu">
                <h2>Acesso Rápido</h2>
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
            <h1>Notícias</h1>
            <div class="cards-lista">
                <?php  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Página atual
                $args = array(
                    'post_type' => 'post',
                    'paged' => $paged,
                );

                $post_query = new WP_Query($args);
                if ($post_query->have_posts() ) : ?>
                    <!-- begin loop -->
                    <?php while ($post_query->have_posts() ) : $post_query->the_post(); ?>  
                    <?php if ( has_post_thumbnail()) : ?>
                        <div class="noticia-wrapper">
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
                            <a href="<?php the_permalink();?>" class="noticia-com-img camada-1" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
                                <div class="background-wrapper">                  
                                    <div class="noticia-com-img-titulo"><?php the_title(); ?></div>
                                </div>                          
                            </a>
                        </div>
                    <?php else : ?> 
                        <div class="noticia-wrapper">
                            <div class="rotulo">
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
                            <a class="noticia-sem-img camada-1" href="<?php the_permalink();?>"> 
                                <div class="noticia-sem-img-titulo" ><?php the_title(); ?></div>
                            </a>
                        </div>                                                        
                    <?php endif; ?> 
                    <?php endwhile; ?> 

                    <div class="paginas-nav">
                        <div class="pagination">
                            <?php 
                                // Adiciona a paginação
                            echo paginate_links(array(
                                'total' => $post_query->max_num_pages,
                                'current' => max(1, $paged),
                                'prev_text' => __('Anterior'),
                                'next_text' => __('Próximo'),
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