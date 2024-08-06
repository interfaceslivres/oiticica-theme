<?php get_header(); ?>

    <div class="corpo" id="conteudo_pagina">
        <div class="corpo-grid">
            <div class="sidebar">
                <div class="sidebar-wrapper">
                    <h2>Notícias e Eventos</h2>
                    <ul class="menu-lateral">
                    <li><a href="#">Notícias</a></li>
                    <li><a href="#">Eventos</a></li>
                    <li><a href="#">Eventos passados</a></li>
                </ul>
                </div>                    
            </div>
            <?php
            while ( have_posts() ) :
            the_post(); ?>
            <div class="content-grid">
                <h1 class="noticia-titulo"><?php the_title(); ?></h1>
                <div class="noticia-h2">
                    <div>
                        <div><?php echo get_the_date( 'd \d\e F Y' ); ?></div>
                        <div class="noticia-categorias">Categorias:
                            <?php
                              // Obtém as categorias do post
                              $categories = get_the_category();

                              // Verifica se existem categorias
                              //if ($categories) {
                                  // Limita a exibição a duas categorias
                                  //$categories = array_slice($categories, 0, 2);

                                  // Loop pelas categorias
                                  foreach ($categories as $category) {
                                      // Exibe o nome da categoria como um link
                                      echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';

                                      // Adiciona uma vírgula após a categoria, exceto pela última
                                      if (next($categories)) {
                                          echo ', ';
                                      }
                                  }
                              //}
                            ?>
                        </div>
                    </div>                     
                    
                    <div class="noticia-compartilhe">
                        <div>Compartilhe:</div>
                        <div class="redes-sociais noticia-redes">
                            <a href="https://api.whatsapp.com/send?text=Acesse%20esta%20p%C3%A1gina:%20<?php echo get_permalink();?>" target="_blank"><i class="fa-brands fa-square-whatsapp"></i></a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo get_permalink();?>"  target="_blank"><i class="fa-brands fa-square-twitter"></i></a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink();?>" target="_blank"><i class="fa-brands fa-square-facebook"></i></a>
                        </div>
                    </div>                        
                </div>

                <?php the_content(); ?>
                                 
            <?php 
            endwhile; ?>

                <div class="noticia-links-relacionados">
                    <h2>Arquivos</h2>
                    <a href="#"><div class="noticia-link-relacionado">https://mobile.fraudes.com/cdn-content/manual_v2.pdf?id=7dc68bDB879D68BC</div></a>                    
                    <a href="#"><div class="noticia-link-relacionado">Manual de como se defender da nova espécie</div></a>
                </div>
                                    

                <h2>Notícias Relacionadas</h2>
                <div class="noticias-relacionadas">
                    <div class="noticia-wrapper">
                        <div class="rotulo-claro">
                            <div>15 de Setembro de 2022</div>
                            <div><a href="ufpb.br">Notícia</a>, <a href="ufpb.br">Calamidade</a></div>
                        </div>
                        <a href="noticia.html" class="noticia-com-img camada-1" style="
                        background-image:
                        linear-gradient(180deg, rgba(0,   0,   0, 0.5) 0%, rgba(0, 0, 0, 0) 50%), 
                        linear-gradient(180deg, rgba(255, 255, 255, 0) 0%, #ffffff 85%),
                        url('img/noticia.jpeg')">
                            <div class="background-wrapper">                  
                            <div class="noticia-com-img-titulo">Resultado final do concurso de "Marketing Digital e Empreendedorismo"</div>
                            </div>                          
                        </a>
                        </div>
            
                        <div class="noticia-wrapper">
                        <div class="rotulo">
                            <div>15 de Setembro de 2022</div>
                            <div><a href="ufpb.br">Notícia</a>, <a href="ufpb.br">Calamidade</a></div>
                        </div>
                        <a href="noticia.html" class="noticia-sem-img camada-1">              
                            <div class="noticia-sem-img-titulo">Resultado final do concurso de "Áudio Digital"</div>              
                        </a>
                        </div>
                        </div>
                    </div>
            </div>
        </div>

        <div class="imagem">
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