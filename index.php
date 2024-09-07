<?php get_header(); ?>
<div class="corpo" id="conteudo_pagina">
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
  <div class="corpo-wrapper">
             

    <?php $widget_values = dynamic_sidebar('widget-links-rapidos'); ?>

    

    <!--div class="destaque-wrapper destaque-trio">
      <div class="destaque camada-1">
        <?php
          echo '<img src="' . get_the_post_thumbnail_url( url_to_postid('http://localhost/wordpress/oportunidades/projetos-de-extensao/'), 'medium' ) . '" alt="Imagem da página">';
        ?>
        <div>
          <h2>
            <?php echo get_the_title( url_to_postid('http://localhost/wordpress/oportunidades/projetos-de-extensao/') ); ?>
          </h2>
          <?php
            echo '<p>' . get_the_excerpt( url_to_postid('http://localhost/wordpress/oportunidades/projetos-de-extensao/') ) . '</p>';        
          ?>
          <div class="link-wrapper">
            <a class="mais-link" href="http://localhost/wordpress/oportunidades/projetos-de-extensao/">Saiba mais</a>           
          </div>
        </div>
      </div>   
      
      <div class="destaque camada-1">
        <?php
          echo '<img src="' . get_the_post_thumbnail_url( url_to_postid('http://localhost/wordpress/oportunidades/projetos-de-extensao/'), 'medium' ) . '" alt="Imagem da página">';
        ?>
        <div>
          <h2>
            <?php echo get_the_title( url_to_postid('http://localhost/wordpress/oportunidades/projetos-de-extensao/') ); ?>
          </h2>
          <?php
            echo '<p>' . get_the_excerpt( url_to_postid('http://localhost/wordpress/oportunidades/projetos-de-extensao/') ) . '</p>';        
          ?>
          <div class="link-wrapper">
            <a class="mais-link" href="http://localhost/wordpress/oportunidades/projetos-de-extensao/">Saiba mais</a>           
          </div>
        </div>
      </div> 

      <div class="destaque camada-1">
        <?php
          echo '<img src="' . get_the_post_thumbnail_url( url_to_postid('http://localhost/wordpress/oportunidades/projetos-de-extensao/'), 'medium' ) . '" alt="Imagem da página">';
        ?>
        <div>
          <h2>
            <?php echo get_the_title( url_to_postid('http://localhost/wordpress/oportunidades/projetos-de-extensao/') ); ?>
          </h2>
          <?php
            echo '<p>' . get_the_excerpt( url_to_postid('http://localhost/wordpress/oportunidades/projetos-de-extensao/') ) . '</p>';        
          ?>
          <div class="link-wrapper">
            <a class="mais-link" href="http://localhost/wordpress/oportunidades/projetos-de-extensao/">Saiba mais</a>           
          </div>
        </div>
      </div> 
      
    </div-->         

    <?php $widget_values = dynamic_sidebar('widgets-da-home'); ?>

    <!--div class="mapa">
      <h1>Encontre o Departamento</h1>
      <div class="mapa-grid">
        <div id="mapa-coluna1">
          <div id="mapa-inlay">
            <iframe scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d111.87252228998113!2d-34.84983169399343!3d-7.137336889729705!2m3!1f22.312500000000025!2f48.49688112803378!3f0!3m2!1i1024!2i768!4f35!3m3!1m2!1s0x7acc2b97fcc474f%3A0x7330f1f2dbd68687!2sDEMID - Departamento de Mídias Digitais!5e1!3m2!1sen!2sbr!4v1682431792367!5m2!1sen!2sbr" width="100%" height="100%" frameborder="0"><a href="https://www.maps.ie/distance-area-calculator.html">area maps</a></iframe>
          </div>
          <div class="foto">
            <img src="<?php echo get_bloginfo("template_directory"); ?>/img/foto1.jpg" alt="">
          </div>
        </div>
        <div id="mapa-coluna2" class="foto">
          <img src="<?php echo get_bloginfo("template_directory"); ?>/img/foto2.png" alt="">
        </div>
      </div>
    </div-->
    

  </div>      
</div>
	
	
<?php get_footer(); ?>