<?php

add_theme_support( 'post-thumbnails' );

// Adding excerpt for page
add_post_type_support( 'page', 'excerpt' );

//Cor personalizada
function meu_tema_personalizado($wp_customize) {

    // Adicionando a seção de cores personalizadas
    $wp_customize->add_section('cores_personalizadas', array(
      'title' => __('Cor do site', 'meu-tema'),
      'description' => __('Personalize a cor do site', 'meu-tema'),
      'priority' => 30
    ));
  
    // Adicionando a opção de cor padrão do tema
    $wp_customize->add_setting('cor_padrao', array(
      'default' => '#102d69',
      'transport' => 'refresh'
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cor_padrao', array(
      'label' => __('Cor Padrão do Tema', 'meu-tema'),
      'section' => 'cores_personalizadas',
      'settings' => 'cor_padrao'
    )));  
}
add_action('customize_register', 'meu_tema_personalizado');


//LOGO
function themename_custom_logo_setup() {
    $defaults = array(
        'height'               => 150,
        'width'                => 150,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => false, 
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

// imagem banner
function adicionar_controle_imagem_banner($wp_customize) {
    $wp_customize->add_section('secao_imagem_banner', array(
        'title' => 'Imagem de banner',
        'priority' => 30,
    ));

    $wp_customize->add_setting('imagem_banner', array(
        'default' => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'imagem_banner', array(
        'label' => 'Escolha a imagem do footer: 1900 x 300. (Use https://tinypng.com/ para otimizar o carregamento.)',
        'section' => 'secao_imagem_banner',
        'settings' => 'imagem_banner',
    )));
}
add_action('customize_register', 'adicionar_controle_imagem_banner');

// imagens na seção de mapa
function adicionar_controle_imagens_mapa($wp_customize) {
    $wp_customize->add_section('secao_imagens_mapa', array(
        'title' => 'Imagems de apresentação',
        'priority' => 30,
    ));

    $wp_customize->add_setting('imagem1_mapa', array(
        'default' => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'imagem1_mapa', array(
        'label' => 'Escolha a primeira para apresentar a instituição, que aparecerá abaixo do mapa (use https://tinypng.com/ para otimizar o carregamento.)',
        'section' => 'secao_imagens_mapa',
        'settings' => 'imagem1_mapa',        
    )));   
    
    $wp_customize->add_setting('imagem2_mapa', array(
        'default' => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'imagem2_mapa', array(
        'label' => 'Escolha a segunda imagem, que aparecerá ao lado do mapa',
        'section' => 'secao_imagens_mapa',
        'settings' => 'imagem2_mapa',        
    )));   
}
add_action('customize_register', 'adicionar_controle_imagens_mapa');

//registrar menus
function register_menus() { 
    register_nav_menus(
        array(
            'main-menu' => 'Menu Principal',
            'localizacao-menu' => 'Links em Localização',
            'side-menu' => 'Menu lateral presente em todas as subpágias',            
        )
    ); 
}
add_action( 'init', 'register_menus' );

// adicionar opcao de classes pros menus
function add_menu_link_class( $atts, $item, $args ) {
    if (property_exists($args, 'link_class')) {
      $atts['class'] = $args->link_class;
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );

function cats_related_post() {

    $post_id = get_the_ID();
    $cat_ids = array();
    $categories = get_the_category( $post_id );

    if(!empty($categories) && !is_wp_error($categories)):
        foreach ($categories as $category):
            array_push($cat_ids, $category->term_id);
        endforeach;
    endif;

    $current_post_type = get_post_type($post_id);

    $query_args = array( 
        'category__in'   => $cat_ids,
        'post_type'      => $current_post_type,
        'post__not_in'    => array($post_id),
        'posts_per_page'  => '2',
     );

    $related_cats_post = new WP_Query( $query_args );

    if($related_cats_post->have_posts()): ?>

        <h2 id="outras-n">Notícias Relacionadas</h2>
        <div class="noticias-relacionadas">

        <?php while($related_cats_post->have_posts()): $related_cats_post->the_post(); ?>
            <?php if ( has_post_thumbnail() ) { ?>
                    <div class="noticia-wrapper">
                          <div class="rotulo-claro">
                            <div><?php echo get_the_date( 'd \d\e F Y' ); ?></div>
                            <div class="categorias">
                              <?php
                            // Obtém as categorias do post
                            $categories = get_the_category();

                            // Verifica se existem categorias
                            if ($categories) {
                                // Limita a exibição a duas categorias
                                $categories = array_slice($categories, 0, 2);

                                // Loop pelas categorias
                                foreach ($categories as $category) {
                                    // Exibe o nome da categoria como um link
                                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';

                                    // Adiciona uma vírgula após a categoria, exceto pela última
                                    if (next($categories)) {
                                        echo ', ';
                                    }
                                }
                            }
                            ?>
                            </div> <!-- fecha categorias -->
                          </div> <!-- fecha div rotulo-claro -->
                          <a href="<?php the_permalink();?>" class="noticia-com-img camada-1" style="
                          background-image:
                          url(<?php the_post_thumbnail_url(); ?>)">
                            <div class="background-wrapper">                  
                              <div class="noticia-com-img-titulo"><?php the_title(); ?></div>
                            </div>                          
                          </a>
                    </div>
            <?php } else { ?> 

                    <div class="noticia-wrapper">
                            <div class="rotulo">
                              <div><?php echo get_the_date( 'd \d\e F Y' ); ?></div>
                              <div class="categorias">
                                <?php
                              // Obtém as categorias do post
                              $categories = get_the_category();

                              // Verifica se existem categorias
                              if ($categories) {
                                  // Limita a exibição a duas categorias
                                  $categories = array_slice($categories, 0, 2);

                                  // Loop pelas categorias
                                  foreach ($categories as $category) {
                                      // Exibe o nome da categoria como um link
                                      echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';

                                      // Adiciona uma vírgula após a categoria, exceto pela última
                                      if (next($categories)) {
                                          echo ', ';
                                      }
                                  }
                              }
                              ?>
                              </div> <!-- fecha a div categorias -->
                            </div> <!-- fecha a div rotulo -->
                            <a href="<?php the_permalink();?>" class="noticia-sem-img camada-1">              
                            <div class="noticia-sem-img-titulo"><?php the_title(); ?></div>    
                            </a>
                    </div>


        <?php 
         } 
        endwhile;

        // Restore original Post Data
        wp_reset_postdata();
        ?> 
        </div> <!-- fecha div noticias-relacionadas -->
        <?php
     endif;

}

// Registrar widgets
function registrar_widgets_personalizados() {   
    register_sidebar(array(
        'name'          => 'Área de Widgets da Home',
        'id'            => 'widgets-da-home',
        'description'   => 'Insira os itens correspondentes para ter a visualização na página inicial, o site nunca poderá estar sem a presença da localização, use o link da URL do Google Maps e não o link gerado pelo botão compartilhar, pois esse link não tem os dados de latitude e longitude como o sistema espera.',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ));
    register_sidebar(array(
        'name'          => 'Área de Widgets do Footer',
        'id'            => 'widgets-do-footer',
        'description'   => 'Defina o conteúdo que estará no Footer do site. A imagem é alterada na área de personalização.',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ));
    register_sidebar(array(
        'name'          => 'Área do Widget de Links Rápidos',
        'id'            => 'widget-links-rapidos',
        'description'   => 'Defina os Links rápidos e seus respectivos ícones.',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ));
}
// Hook para registrar os widgets
add_action('widgets_init', 'registrar_widgets_personalizados');

// CENTRO DE ENSINO
// Adiciona seção ao Customizer
function customizer_centro($wp_customize) {
    // Seção para configurações personalizadas
    $wp_customize->add_section('customizer_centro', array(
        'title' => 'Centro de Ensino',
        'priority' => 30,
    ));
    // Campo de texto personalizado
    $wp_customize->add_setting('custom_centro', array(
        'default' => 'Centro de Alguma Coisa',
        'sanitize_callback' => 'sanitize_text_field', // Limpa a entrada do usuário
    ));
    $wp_customize->add_control('custom_centro', array(
        'label' => 'Nome do Centro',
        'section' => 'customizer_centro',
        'type' => 'text',
    ));
    // Campo de URL personalizado
    $wp_customize->add_setting('custom_urlcentro', array(
        'default' => 'https://ufpb.br',
        'sanitize_callback' => 'esc_url_raw', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('custom_urlcentro', array(
        'label' => 'URL do Site do Centro',
        'section' => 'customizer_centro',
        'type' => 'url',
    ));
}

add_action('customize_register', 'customizer_centro');

// Registrar Widget de Destaque solo
function registrar_widget_destaque_solo() {
    register_widget('WidgetDestaqueSolo');
}
add_action('widgets_init', 'registrar_widget_destaque_solo');

class WidgetDestaqueSolo extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Widget_Destaque_Solo',
            'Widget de Destaque Único',
            array(
                'description' => 'Destaca uma página do site de forma belíssima.'
            )
        );
    }

    public function widget($args, $instance) {
        // Extrair os valores dos campos do widget
        $pagina_link = $instance['pagina_link'];
        $titulo = !empty($instance['titulo']) ? $instance['titulo'] : get_the_title(url_to_postid($pagina_link));
        $resumo = !empty($instance['resumo']) ? $instance['resumo'] : get_the_excerpt(url_to_postid($pagina_link));    
        $link_texto = !empty($instance['link_texto']) ? $instance['link_texto'] : 'Saiba mais';

        echo $args['before_widget'];

        echo '
        <div class="destaque-wrapper destaque-solo">  
            <div class="camada-1-alt">
                <h2>' . $titulo . '</h2>
                <p>' . $resumo . '</p>
                <div class="link-wrapper">
                    <a class="mais-link" href=' . $pagina_link . '>' . $link_texto . '</a>           
                </div>
            </div>
            <div class="destaque-solo-img">
                <img src="' . get_the_post_thumbnail_url( url_to_postid($pagina_link)) . '" alt="Imagem da página">
            </div>                
        </div>';
        
        echo $args['after_widget']; 
    }

    public function form($instance) {
        // Exibir o formulário de configuração do widget
        $pagina_link = $instance['pagina_link'];
        $titulo = !empty($instance['titulo']) ? $instance['titulo'] : get_the_title(url_to_postid($pagina_link));
        $resumo = !empty($instance['resumo']) ? $instance['resumo'] : get_the_excerpt(url_to_postid($pagina_link) );    
        $link_texto = !empty($instance['link_texto']) ? $instance['link_texto'] : 'Saiba mais';        

        // Formulário de configuração do widget
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('pagina_link'); ?>">Link da página a ser destacada:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('pagina_link'); ?>" name="<?php echo $this->get_field_name('pagina_link'); ?>" type="text" value="<?php echo $pagina_link; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título do bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('pagina_link'); ?>">Texto do bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('resumo'); ?>" name="<?php echo $this->get_field_name('resumo'); ?>" type="text" value="<?php echo $resumo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_texto'); ?>">Texto do link (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_texto'); ?>" name="<?php echo $this->get_field_name('link_texto'); ?>" type="text" value="<?php echo $link_texto; ?>">
        </p>
        
        <?php
    }

    public function update($new_instance, $old_instance) {
        // Atualizar os valores do widget
        $instance = $old_instance;
        $instance['pagina_link'] = !empty($new_instance['pagina_link']) ? esc_html($new_instance['pagina_link']) : ''; 
        $instance['titulo'] = !empty($new_instance['titulo']) ? esc_html($new_instance['titulo']) : ''; 
        $instance['resumo'] = !empty($new_instance['resumo']) ? esc_html($new_instance['resumo']) : ''; 
        $instance['link_texto'] = !empty($new_instance['link_texto']) ? esc_html($new_instance['link_texto']) : ''; 
        return $instance;
    }
}

// Registrar Widget de Destaque Duplo
function registrar_widget_destaque_duplo() {
    register_widget('WidgetDestaqueDuplo');
}
add_action('widgets_init', 'registrar_widget_destaque_duplo');

class WidgetDestaqueDuplo extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Widget_Destaque_Duplo',
            'Widget de destaque de duas páginas',
            array(
                'description' => 'Destaca duas páginas do site de forma belíssima.'
            )
        );
    }

    public function widget($args, $instance) {
        $pagina_link = $instance['pagina_link'];
        $titulo = !empty($instance['titulo']) ? $instance['titulo'] : get_the_title(url_to_postid($pagina_link));
        $resumo = !empty($instance['resumo']) ? $instance['resumo'] : get_the_excerpt(url_to_postid($pagina_link));    
        $link_texto = !empty($instance['link_texto']) ? $instance['link_texto'] : 'Saiba mais';

        $pagina_link_2 = $instance['pagina_link_2'];
        $titulo_2 = !empty($instance['titulo_2']) ? $instance['titulo_2'] : get_the_title(url_to_postid($pagina_link_2));
        $resumo_2 = !empty($instance['resumo_2']) ? $instance['resumo_2'] : get_the_excerpt(url_to_postid($pagina_link_2));    
        $link_texto_2 = !empty($instance['link_texto_2']) ? $instance['link_texto_2'] : 'Saiba mais';

        echo $args['before_widget'];

        echo '
        <div class="destaque-wrapper destaque-dupla">  
            <div class="destaque camada-1">
                <img src="' . get_the_post_thumbnail_url(url_to_postid($pagina_link)) . '" alt="Imagem da página">
                <div>
                    <h2>' . $titulo . '</h2>
                    <p>' . $resumo . '</p>
                    <div class="link-wrapper">
                        <a class="mais-link" href=' . $pagina_link . '>' . $link_texto . '</a>           
                    </div>
                </div>
            </div>
            <div class="destaque camada-1">
                <img src="' . get_the_post_thumbnail_url(url_to_postid($pagina_link_2)) . '" alt="Imagem da página">
                <div>
                    <h2>' . $titulo_2 . '</h2>
                    <p>' . $resumo_2 . '</p>
                    <div class="link-wrapper">
                        <a class="mais-link" href=' . $pagina_link_2 . '>' . $link_texto_2 . '</a>           
                    </div>
                </div>
            </div>            
        </div>';
        
        echo $args['after_widget']; 
    }

    public function form($instance) {
        // Exibir o formulário de configuração do widget
        $pagina_link = $instance['pagina_link'];
        $titulo = !empty($instance['titulo']) ? $instance['titulo'] : get_the_title(url_to_postid($pagina_link));
        $resumo = !empty($instance['resumo']) ? $instance['resumo'] : get_the_excerpt(url_to_postid($pagina_link) );    
        $link_texto = !empty($instance['link_texto']) ? $instance['link_texto'] : 'Saiba mais';  
        
        $pagina_link_2 = $instance['pagina_link_2'];
        $titulo_2 = !empty($instance['titulo_2']) ? $instance['titulo_2'] : get_the_title(url_to_postid($pagina_link_2));
        $resumo_2 = !empty($instance['resumo_2']) ? $instance['resumo_2'] : get_the_excerpt(url_to_postid($pagina_link_2));    
        $link_texto_2 = !empty($instance['link_texto_2']) ? $instance['link_texto_2'] : 'Saiba mais';

        // Formulário de configuração do widget
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('pagina_link'); ?>">Link da primeira página a ser destacada:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('pagina_link'); ?>" name="<?php echo $this->get_field_name('pagina_link'); ?>" type="text" value="<?php echo $pagina_link; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título do bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('pagina_link'); ?>">Texto do primeiro bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('resumo'); ?>" name="<?php echo $this->get_field_name('resumo'); ?>" type="text" value="<?php echo $resumo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_texto'); ?>">Texto do primeiro link (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_texto'); ?>" name="<?php echo $this->get_field_name('link_texto'); ?>" type="text" value="<?php echo $link_texto; ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('pagina_link_2'); ?>">Link da segunda página a ser destacada:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('pagina_link_2'); ?>" name="<?php echo $this->get_field_name('pagina_link_2'); ?>" type="text" value="<?php echo $pagina_link_2; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('titulo_2'); ?>">Título do segundo bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('titulo_2'); ?>" name="<?php echo $this->get_field_name('titulo_2'); ?>" type="text" value="<?php echo $titulo_2; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('pagina_link_2'); ?>">Texto do segundo bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('resumo_2'); ?>" name="<?php echo $this->get_field_name('resumo_2'); ?>" type="text" value="<?php echo $resumo_2; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_texto_2'); ?>">Texto do link (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_texto_2'); ?>" name="<?php echo $this->get_field_name('link_texto_2'); ?>" type="text" value="<?php echo $link_texto_2; ?>">
        </p>
        
        <?php
    }

    public function update($new_instance, $old_instance) {
        // Atualizar os valores do widget
        $instance = $old_instance;
        $instance['pagina_link'] = !empty($new_instance['pagina_link']) ? esc_html($new_instance['pagina_link']) : ''; 
        $instance['titulo'] = !empty($new_instance['titulo']) ? esc_html($new_instance['titulo']) : ''; 
        $instance['resumo'] = !empty($new_instance['resumo']) ? esc_html($new_instance['resumo']) : ''; 
        $instance['link_texto'] = !empty($new_instance['link_texto']) ? esc_html($new_instance['link_texto']) : ''; 
        $instance['pagina_link_2'] = !empty($new_instance['pagina_link_2']) ? esc_html($new_instance['pagina_link_2']) : ''; 
        $instance['titulo_2'] = !empty($new_instance['titulo_2']) ? esc_html($new_instance['titulo_2']) : ''; 
        $instance['resumo_2'] = !empty($new_instance['resumo_2']) ? esc_html($new_instance['resumo_2']) : ''; 
        $instance['link_texto_2'] = !empty($new_instance['link_texto_2']) ? esc_html($new_instance['link_texto_2']) : ''; 
        return $instance;
    }
}

// Registrar o widget personalizado p/ home
function registrar_widget_apresentacao() {
    register_widget('Widget_Apresentacao');
}
add_action('widgets_init', 'registrar_widget_apresentacao');

// Criar a classe do widget personalizado
class Widget_Apresentacao extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'widget_apresentacao',
            'Widget de Apresentação',
            array(
                'description' => 'Um widget personalizado para apresentar a instituição, com título, vídeo, links, fotos e localização.'
            )
        );
    }

    // Função para exibir o widget no frontend
    public function widget($args, $instance) {
        echo $args['before_widget'];

        echo '
        <div class="apresentacao">
            <div class="camada-1">                 
                <h2>' . nl2br(esc_html($instance['titulo'])) . '</h2>
                <p>' . nl2br(esc_html($instance['texto-apresentacao'])) . '</p>
                <div class="apresentacao-links">';

                wp_nav_menu(   
                    array ( 
                        'theme_location' => 'localizacao-menu',
                        'items_wrap' => '%3$s',
                        'container' => false,
                        'link_class'   => 'mais-link'
                    ) 
                );

                echo '</div>
            </div>';

            if (!empty($instance['video-institucional'])) {
                $url = esc_url($instance['video-institucional']);
                // Substitua "watch" por "embed" na URL
                $embed_url = str_replace("watch?v=", "embed/", $url);
                echo '<div class="youtube camada-1"><iframe width="100%" height="100%" src="' . $embed_url . '" title="Youtube Video Player" frameborder="0" allow="web-share" allowfullscreen></iframe></div>';
            }

        echo '</div>';   
        echo $args['after_widget'];
    }

    // Função para exibir o formulário de configuração do widget no painel de controle
    public function form($instance) {
        // Campos do widget
        $campos = array(
            'titulo' => 'Título da Apresentação',
            'video-institucional' => 'Vídeo Institucional',            
            'localizacao' => 'Localização (cole apenas a URL do Google Maps)',
            'texto-apresentacao' => 'Texto sobre a instituição (670 caracteres)'
        );

		// Exibir campos do formulário
		$index = 0;
		foreach ($campos as $campo => $label) {
		    $valor = !empty($instance[$campo]) ? esc_attr($instance[$campo]) : '';
		    echo '<p>';
		    echo '<label for="' . $this->get_field_id($campo) . '">' . esc_html($label) . ':</label>';

		    // Verificar se o índice é par
		    if ($index < 3 || $index == 4 || $index == 6 || $index == 8) {
		        echo '<input class="widefat" id="' . $this->get_field_id($campo) . '" name="' . $this->get_field_name($campo) . '" type="text" value="' . $valor . '">';
		    } else {
		        echo '<textarea class="widefat"  maxlength="677" id="' . $this->get_field_id($campo) . '" name="' . $this->get_field_name($campo) . '" rows="5">' . $valor . '</textarea>';
		    }

		    echo '</p>';
		    $index++;
		}
    }

    // Função para atualizar os valores do widget no painel de controle
    public function update($new_instance, $old_instance) {
        $instance = array();
        foreach ($new_instance as $campo => $valor) {
            $instance[$campo] = (!empty($valor)) ? strip_tags($valor) : '';
        }
        return $instance;
    }
}

class WidgetRedesSociais extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'widget_footer_top',
            'Widget Footer',
            array(
                'description' => 'Widget com os itens padronizados do footer.'
            )
        );
    }

    public function widget($args, $instance) {
        // Extrair os valores dos campos do widget
        $twitter = !empty($instance['twitter']) ? esc_url($instance['twitter']) : '';
        $instagram = !empty($instance['instagram']) ? esc_url($instance['instagram']) : '';
        $facebook = !empty($instance['facebook']) ? esc_url($instance['facebook']) : '';
        $youtube = !empty($instance['youtube']) ? esc_url($instance['youtube']) : '';
        $endereco = !empty($instance['endereco']) ? esc_textarea($instance['endereco']) : '';
        $telefone = !empty($instance['telefone']) ? esc_html($instance['telefone']) : '';
        $contato = !empty($instance['contato']) ? esc_url($instance['contato']) : '';
        $horario_funcionamento = !empty($instance['horario_funcionamento']) ? esc_html($instance['horario_funcionamento']) : '';

        // Exibir o conteúdo do widget
        echo $args['before_widget'];
        
        if (!empty($endereco)) {
            echo '<address>' . wp_kses_post($endereco) . '</address>';
        }
        if (!empty($telefone)) {
            echo '<div class="f-link tel"><a href="tel: ' . esc_html($telefone) . '">Telefone: ' . esc_html($telefone) . '</a></div>';
        }
        if (!empty($contato)) {
            echo '<div class="f-link"><a class="mais-link" href="' . esc_url($contato) . '">Contato</a></div>';
        }
        if (!empty($horario_funcionamento)) {
            echo '<div>Horário de funcionamento: ' . esc_html($horario_funcionamento) . '</div>';
        }
        echo '<div class="redes-sociais">';
                echo '<a href="';
                echo bloginfo('atom_url');
                echo '"><i class="fa-solid fa-square-rss"></i></a>';
            if (!empty($instagram)) {
                echo '<a href="' . esc_url($instagram) . '"><i class="fa-brands fa-square-instagram"></i></a>';
            }
            if (!empty($twitter)) {
                echo '<a href="' . esc_url($twitter) . '"><i class="fa-brands fa-square-twitter"></i></a>';
            }
            if (!empty($facebook)) {
                echo '<a href="' . esc_url($facebook) . '"><i class="fa-brands fa-square-facebook"></i></a>';
            }
            if (!empty($youtube)) {
                echo '<a href="' . esc_url($youtube) . '"><i class="fa-brands fa-square-youtube"></i></a>';
            }            
        echo '</div></div>';
        echo $args['after_widget'];
    }

    public function form($instance) {
        // Exibir o formulário de configuração do widget
        $twitter = !empty($instance['twitter']) ? esc_attr($instance['twitter']) : '';
        $instagram = !empty($instance['instagram']) ? esc_attr($instance['instagram']) : '';
        $facebook = !empty($instance['facebook']) ? esc_attr($instance['facebook']) : '';
        $youtube = !empty($instance['youtube']) ? esc_attr($instance['youtube']) : '';
        $endereco = !empty($instance['endereco']) ? esc_textarea($instance['endereco']) : '';
        $telefone = !empty($instance['telefone']) ? esc_attr($instance['telefone']) : '';
        $contato = !empty($instance['contato']) ? esc_attr($instance['contato']) : '';
        $horario_funcionamento = !empty($instance['horario_funcionamento']) ? esc_attr($instance['horario_funcionamento']) : '';

        // Formulário de configuração do widget
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>">Link do Twitter:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="url" value="<?php echo $twitter; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('instagram'); ?>">Link do Instagram:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="url" value="<?php echo $instagram; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>">Link do Facebook:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="url" value="<?php echo $facebook; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('youtube'); ?>">Link do YouTube:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="url" value="<?php echo $youtube; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('endereco'); ?>">Endereço:</label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('endereco'); ?>" name="<?php echo $this->get_field_name('endereco'); ?>" rows="5"><?php echo $endereco; ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('telefone'); ?>">Telefone:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('telefone'); ?>" name="<?php echo $this->get_field_name('telefone'); ?>" type="text" value="<?php echo $telefone; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('contato'); ?>">Link de Contato:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('contato'); ?>" name="<?php echo $this->get_field_name('contato'); ?>" type="url" value="<?php echo $contato; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('horario_funcionamento'); ?>">Horário de Funcionamento:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('horario_funcionamento'); ?>" name="<?php echo $this->get_field_name('horario_funcionamento'); ?>" type="text" value="<?php echo $horario_funcionamento; ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        // Atualizar os valores do widget
        $instance = $old_instance;
        $instance['twitter'] = !empty($new_instance['twitter']) ? esc_url($new_instance['twitter']) : '';
        $instance['instagram'] = !empty($new_instance['instagram']) ? esc_url($new_instance['instagram']) : '';
        $instance['facebook'] = !empty($new_instance['facebook']) ? esc_url($new_instance['facebook']) : '';
        $instance['youtube'] = !empty($new_instance['youtube']) ? esc_url($new_instance['youtube']) : '';
        $instance['endereco'] = !empty($new_instance['endereco']) ? esc_textarea($new_instance['endereco']) : '';
        $instance['telefone'] = !empty($new_instance['telefone']) ? esc_html($new_instance['telefone']) : '';
        $instance['contato'] = !empty($new_instance['contato']) ? esc_url($new_instance['contato']) : '';
        $instance['horario_funcionamento'] = !empty($new_instance['horario_funcionamento']) ? esc_html($new_instance['horario_funcionamento']) : '';

        return $instance;
    }
}

function registrar_widget_footer_top() {
    register_widget('WidgetRedesSociais');
}
add_action('widgets_init', 'registrar_widget_footer_top');

class WidgetLinksRapidos extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'widget_links_rapidos',
            'Widget de Links Rápidos',
            array(
                'description' => 'Widget para adicionar 6 links rápidos'
            )
        );
    }

    public function widget($args, $instance) {
        // Extrair os valores dos campos do widget
        $text_primeiro = $instance['text_primeiro'];
        $text_segundo = $instance['text_segundo'];
        $text_terceiro = $instance['text_terceiro'];
        $text_quarto = $instance['text_quarto'];
        $text_quinto = $instance['text_quinto'];
        $text_sexto = $instance['text_sexto'];

        $icon_primeiro = $instance['icon_primeiro'];
        $icon_segundo = $instance['icon_segundo'];
        $icon_terceiro = $instance['icon_terceiro'];
        $icon_quarto = $instance['icon_quarto'];
        $icon_quinto = $instance['icon_quinto'];
        $icon_sexto = $instance['icon_sexto'];

        
        $primeiro = $instance['primeiro'];
        $segundo = $instance['segundo'];
        $terceiro = $instance['terceiro'];
        $quarto = $instance['quarto'];
        $quinto = $instance['quinto'];
        $sexto = $instance['sexto'];

        echo $args['before_widget'];
        echo '
        <div class="links-wrapper">
            <div class="links">

            <a href="' . esc_url($primeiro) . '" class="link-full camada-1">
                <div class="link-image-wrapper">              
                    <i class="' . esc_attr($icon_primeiro) . '"></i>              
                </div>          
                <div class="link-text" href="#">' . esc_html($text_primeiro) . '</div>
            </a>
            <a href="' . esc_url($segundo) . '" class="link-full camada-1">
                <div class="link-image-wrapper">
                    <i class="' . esc_attr($icon_segundo) . '"></i>
                </div>          
                <div class="link-text" href="#">' . esc_html($text_segundo) . '</div>
            </a>
            <a href="' . esc_url($terceiro) . '" class="link-full camada-1">
                <div class="link-image-wrapper">
                    <i class="' . esc_attr($icon_terceiro) . '"></i>
                </div>          
                <div class="link-text" href="#">' . esc_html($text_terceiro) . '</div>
            </a>
            <a href="' . esc_url($quarto) . '" class="link-full camada-1">
                <div class="link-image-wrapper">
                    <i class="' . esc_attr($icon_quarto) . '"></i>
                </div>          
                <div class="link-text" href="#">' . esc_html($text_quarto) . '</div>
            </a>
            <a href="' . esc_url($quinto) . '" class="link-full camada-1">
                <div class="link-image-wrapper">
                    <i class="' . esc_attr($icon_quinto) . '"></i>
                </div>          
                <div class="link-text" href="#">' . esc_html($text_quinto) . '</div>
            </a>
            <a href="' . esc_url($sexto) . '" class="link-full camada-1">
            <div class="link-image-wrapper">
                    <i class="' . esc_attr($icon_sexto) . '"></i>
                </div>          
                <div class="link-text" href="#">' . esc_html($text_sexto) . '</div>
            </a>';
        
        echo '
            </div>
        </div>';
        echo $args['after_widget'];            
    }

    public function form($instance) {
        // Exibir o formulário de configuração do widget
        // nomes dos links, para exibição
        $text_primeiro = !empty($instance['text_primeiro']) ? esc_html($instance['text_primeiro']) : 'Pri';
        $text_segundo = !empty($instance['text_segundo']) ? esc_html($instance['text_segundo']) : 'Seg';
        $text_terceiro = !empty($instance['text_terceiro']) ? esc_html($instance['text_terceiro']) : 'Ter';
        $text_quarto = !empty($instance['text_quarto']) ? esc_html($instance['text_quarto']) : 'Qua';
        $text_quinto = !empty($instance['text_quinto']) ? esc_html($instance['text_quinto']) : 'Qui';
        $text_sexto = !empty($instance['text_sexto']) ? esc_html($instance['text_sexto']) : 'Sex';

        //icones do fontawesome
        $icon_primeiro = !empty($instance['icon_primeiro']) ? esc_attr($instance['icon_primeiro']) : 'fa-solid fa-pen-fancy';
        $icon_segundo = !empty($instance['icon_segundo']) ? esc_attr($instance['icon_segundo']) : 'fa-solid fa-pen-fancy';
        $icon_terceiro = !empty($instance['icon_terceiro']) ? esc_attr($instance['icon_terceiro']) : 'fa-solid fa-pen-fancy';
        $icon_quarto = !empty($instance['icon_quarto']) ? esc_attr($instance['icon_quarto']) : 'fa-solid fa-pen-fancy';
        $icon_quinto = !empty($instance['icon_quinto']) ? esc_attr($instance['icon_quinto']) : 'fa-solid fa-pen-fancy';
        $icon_sexto = !empty($instance['icon_sexto']) ? esc_attr($instance['icon_sexto']) : 'fa-solid fa-pen-fancy';

        //links dos... bem, links
        $primeiro = !empty($instance['primeiro']) ? esc_url($instance['primeiro']) : '#';
        $segundo = !empty($instance['segundo']) ? esc_url($instance['segundo']) : '#';
        $terceiro = !empty($instance['terceiro']) ? esc_url($instance['terceiro']) : '#';
        $quarto = !empty($instance['quarto']) ? esc_url($instance['quarto']) : '#';
        $quinto = !empty($instance['quinto']) ? esc_url($instance['quinto']) : '#';
        $sexto = !empty($instance['sexto']) ? esc_url($instance['sexto']) : '#';        

        // Formulário de configuração do widget
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('text_primeiro'); ?>">Título do primeiro link:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('text_primero'); ?>" name="<?php echo $this->get_field_name('text_primeiro'); ?>" type="text" value="<?php echo $text_primeiro; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('icon_primeiro'); ?>">Ícone do primeiro link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('icon_primero'); ?>" name="<?php echo $this->get_field_name('icon_primeiro'); ?>" type="text" value="<?php echo $icon_primeiro; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('primeiro'); ?>">Endereço do primeiro link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('primero'); ?>" name="<?php echo $this->get_field_name('primeiro'); ?>" type="url" value="<?php echo $primeiro; ?>">
        </p><br>

        <p>
            <label for="<?php echo $this->get_field_id('text_segundo'); ?>">Título do segundo link:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('text_segundo'); ?>" name="<?php echo $this->get_field_name('text_segundo'); ?>" type="text" value="<?php echo $text_segundo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('icon_segundo'); ?>">Ícone do primeiro link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('icon_segundo'); ?>" name="<?php echo $this->get_field_name('icon_segundo'); ?>" type="text" value="<?php echo $icon_segundo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('segundo'); ?>">Endereço do segundo link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('segundo'); ?>" name="<?php echo $this->get_field_name('segundo'); ?>" type="url" value="<?php echo $segundo; ?>">
        </p><br>

        <p>
            <label for="<?php echo $this->get_field_id('text_terceiro'); ?>">Título do terceiro link:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('text_terceiro'); ?>" name="<?php echo $this->get_field_name('text_terceiro'); ?>" type="text" value="<?php echo $text_terceiro; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('icon_terceiro'); ?>">Ícone do primeiro link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('icon_terceiro'); ?>" name="<?php echo $this->get_field_name('icon_terceiro'); ?>" type="text" value="<?php echo $icon_terceiro; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('terceiro'); ?>">Endereço do terceiro link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('terceiro'); ?>" name="<?php echo $this->get_field_name('terceiro'); ?>" type="url" value="<?php echo $terceiro; ?>">
        </p><br>

        <p>
            <label for="<?php echo $this->get_field_id('text_quarto'); ?>">Título do quarto link:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('text_quarto'); ?>" name="<?php echo $this->get_field_name('text_quarto'); ?>" type="text" value="<?php echo $text_quarto; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('icon_quarto'); ?>">Ícone do primeiro link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('icon_quarto'); ?>" name="<?php echo $this->get_field_name('icon_quarto'); ?>" type="text" value="<?php echo $icon_quarto; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('quarto'); ?>">Endereço do quarto link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('quarto'); ?>" name="<?php echo $this->get_field_name('quarto'); ?>" type="url" value="<?php echo $quarto; ?>">
        </p><br>

        <p>
            <label for="<?php echo $this->get_field_id('text_quinto'); ?>">Título do quinto link:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('text_quinto'); ?>" name="<?php echo $this->get_field_name('text_quinto'); ?>" type="text" value="<?php echo $text_quinto; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('icon_quinto'); ?>">Ícone do primeiro link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('icon_quinto'); ?>" name="<?php echo $this->get_field_name('icon_quinto'); ?>" type="text" value="<?php echo $icon_quinto; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('quinto'); ?>">Endereço do quinto link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('quinto'); ?>" name="<?php echo $this->get_field_name('quinto'); ?>" type="url" value="<?php echo $quinto; ?>">
        </p><br>

        <p>
            <label for="<?php echo $this->get_field_id('text_sexto'); ?>">Título do sexto link:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('text_sexto'); ?>" name="<?php echo $this->get_field_name('text_sexto'); ?>" type="text" value="<?php echo $text_sexto; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('icon_sexto'); ?>">Ícone do primeiro link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('icon_sexto'); ?>" name="<?php echo $this->get_field_name('icon_sexto'); ?>" type="text" value="<?php echo $icon_sexto; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('sexto'); ?>">Endereço do sexto link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('sexto'); ?>" name="<?php echo $this->get_field_name('sexto'); ?>" type="url" value="<?php echo $sexto; ?>">
        </p>        
        <?php
    }

    public function update($new_instance, $old_instance) {
        // Atualizar os valores do widget
        $instance = $old_instance;
        $instance['text_primeiro'] = !empty($new_instance['text_primeiro']) ? esc_html($new_instance['text_primeiro']) : 'erro';
        $instance['icon_primeiro'] = !empty($new_instance['icon_primeiro']) ? esc_attr($new_instance['icon_primeiro']) : 'fa-solid fa-pen-fancy';
        $instance['primeiro'] = !empty($new_instance['primeiro']) ? esc_url($new_instance['primeiro']) : '#';

        $instance['text_segundo'] = !empty($new_instance['text_segundo']) ? esc_html($new_instance['text_segundo']) : 'erro';
        $instance['icon_segundo'] = !empty($new_instance['icon_segundo']) ? esc_attr($new_instance['icon_segundo']) : 'fa-solid fa-pen-fancy';
        $instance['segundo'] = !empty($new_instance['segundo']) ? esc_url($new_instance['segundo']) : '#';

        $instance['text_terceiro'] = !empty($new_instance['text_terceiro']) ? esc_html($new_instance['text_terceiro']) : 'erro';
        $instance['icon_terceiro'] = !empty($new_instance['icon_terceiro']) ? esc_attr($new_instance['icon_terceiro']) : 'fa-solid fa-pen-fancy';
        $instance['terceiro'] = !empty($new_instance['terceiro']) ? esc_url($new_instance['terceiro']) : '#';

        $instance['text_quarto'] = !empty($new_instance['text_quarto']) ? esc_html($new_instance['text_quarto']) : 'erro';
        $instance['icon_quarto'] = !empty($new_instance['icon_quarto']) ? esc_attr($new_instance['icon_quarto']) : 'fa-solid fa-pen-fancy';
        $instance['quarto'] = !empty($new_instance['quarto']) ? esc_url($new_instance['quarto']) : '#';

        $instance['text_quinto'] = !empty($new_instance['text_quinto']) ? esc_html($new_instance['text_quinto']) : 'erro';
        $instance['icon_quinto'] = !empty($new_instance['icon_quinto']) ? esc_attr($new_instance['icon_quinto']) : 'fa-solid fa-pen-fancy';
        $instance['quinto'] = !empty($new_instance['quinto']) ? esc_url($new_instance['quinto']) : '#';

        $instance['text_sexto'] = !empty($new_instance['text_sexto']) ? esc_html($new_instance['text_sexto']) : 'erro';
        $instance['icon_sexto'] = !empty($new_instance['icon_sexto']) ? esc_attr($new_instance['icon_sexto']) : 'fa-solid fa-pen-fancy';
        $instance['sexto'] = !empty($new_instance['sexto']) ? esc_url($new_instance['sexto']) : '#';

        return $instance;
    }

}

function registrar_widget_links_rapidos() {
    register_widget('WidgetLinksRapidos');
}
add_action('widgets_init', 'registrar_widget_links_rapidos');


class WidgetMapaEFotos extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'widget_mapa',
            'Widget de Mapa e Fotos',
            array(
                'description' => 'Widget com a localização e fotos da instituição.'
            )
        );
    }

    public function widget($args, $instance) {
        // Extrair os valores dos campos do widget
        $titulo = !empty($instance['titulo']) ? $instance['titulo'] : 'Encontre-nos!';
        $mapa_iframe = !empty($instance['mapa_iframe']) ? $instance['mapa_iframe'] : '';        
        $image_1 = ! empty(get_theme_mod('imagem2_mapa')) ? get_theme_mod('imagem2_mapa') : '';  
        $image_2 = ! empty(get_theme_mod('imagem1_mapa')) ? get_theme_mod('imagem1_mapa') : '';         

        echo $args['before_widget'];
        echo '
        <div class="mapa">
        <div>
            <h2>' . esc_html($titulo) . '</h2>
            <div class="mapa-grid">                
                <div id="mapa-inlay">
                    ' . $mapa_iframe . '         
                </div>

                <div id="foto1" class="foto">
                    <img src="' . esc_url($image_1) . '" alt="Imagem decorativa do site">
                    <!--img src="<?php echo get_bloginfo("template_directory"); ?>/img/foto1.jpg" alt=""-->
                </div>
                
                <div id="foto2" class="foto">
                    <img src="' . esc_url($image_2) . '" alt="Imagem decorativa do site">
                    <!--img src="<?php echo get_bloginfo("template_directory"); ?>/img/foto2.png" alt=""-->
                </div>
            </div>
        </div>
        </div>';
        
        echo $args['after_widget']; 
    }

    public function form($instance) {
        // Exibir o formulário de configuração do widget
        $titulo = !empty($instance['titulo']) ? esc_html($instance['titulo']) : 'Encontre-nos!';
        $mapa_iframe = !empty($instance['mapa_iframe']) ? $instance['mapa_iframe'] : 'iframe_do_mapa';         

        // Formulário de configuração do widget
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título da seção:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('mapa_iframe'); ?>">Código de embed (iframe) do google maps, obtido através do compartilhar do maps:</label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('mapa_iframe'); ?>" name="<?php echo $this->get_field_name('mapa_iframe'); ?>" type="html" value="<?php echo $mapa_iframe; ?>"></textarea>
        </p> 
        <?php
    }

    public function update($new_instance, $old_instance) {
        // Atualizar os valores do widget
        $instance = $old_instance;
        $instance['titulo'] = !empty($new_instance['titulo']) ? esc_html($new_instance['titulo']) : '';
        $instance['mapa_iframe'] = !empty($new_instance['mapa_iframe']) ? $new_instance['mapa_iframe'] : 'cagou-se';  
        return $instance;
    }
}

function registrar_widget_mapa() {
    register_widget('WidgetMapaEFotos');
}
add_action('widgets_init', 'registrar_widget_mapa');

// get top ancestor
// from https://www.youtube.com/watch?v=GHTZn3atTcM
function get_top_ancestor_id() {
    global $post;

    if ($post->post_parent) {
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
    }
    return $post->ID;
}

// pagina tem filho?
function has_children() {
    global $post;

    $pages = get_pages('child_of=' . $post->ID);
    return count($pages);
}

?>