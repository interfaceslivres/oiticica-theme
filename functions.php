<?php

//LOGO
function themename_custom_logo_setup() {
    $defaults = array(
        'height'               => 150,
        'width'                => 150,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => true, 
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

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
        // Exibir o conteúdo do widget
        if (!empty($instance['nome-do-departamento'])) {
        echo '<h2 class="secoes">' . esc_html($instance['nome-do-departamento']) . '</h2>';
        }
        
        if (!empty($instance['video-do-curso'])) {
	        $url = esc_url($instance['video-do-curso']);
	        // Substitua "watch" por "embed" na URL
	        $embed_url = str_replace("watch?v=", "embed/", $url);
	        echo '<div class="youtube"><iframe width="100%" height="100%" src="' . $embed_url . '" title="Video Player" frameborder="0" allow="web-share" allowfullscreen></iframe></div>';
    	}
        // FAQ
        echo '<div class="text-curso">';
        for ($i = 1; $i <= 3; $i++) {
            $faq = $instance['faq' . $i];
            $resposta = $instance['resposta' . $i];
            if (!empty($faq) && !empty($resposta)) {
                echo '<h3>' . esc_html($faq) . '</h3><p>' . nl2br(esc_html($resposta)) . '</p>';
            }
        }
        echo '</div> <!-- fecha div text-curso --> </div> <!-- fecha div curso -->';

        // Localização
        if (!empty($instance['localizacao'])) {
				// URL do Google Maps
				$google_maps_url = esc_html($instance['localizacao']);
				if (preg_match('/@([-0-9.]+),([-0-9.]+)/', $google_maps_url, $matches)) {
				    $latitude = $matches[1];
				    $longitude = $matches[2];
				    
				    // Crie o código de incorporação do Google Maps
				    $iframe_code = '<iframe src="https://maps.google.com/maps?q='.$latitude.','.$longitude.'&t=k&hl=pt-BR&z=20&amp;output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
				}

	        echo '<div class="apresentacao camada-1"> <div class="mapa"> <div class="mapa-titulo">';
	        echo '<h2>Localização:</h2></div>';
	        echo '<div class="mapa-img">' . $iframe_code . '</div></div>';
	        echo '<div class="text-ufpb"> <div class="text-ufpb-text"> <p>' . nl2br(esc_html($instance['texto-localizacao'])) . '</p></div><div class="text-ufpb-link">';
    	

            wp_nav_menu(   
                array ( 
                    'theme_location' => 'localizacao-menu',
                    'items_wrap' => '%3$s',
                    'container' => false,
                    'link_class'   => 'mais-link'
                ) 
            ); 

	    }

        echo '</div> </div> </div> </div> </div></div> </div>  <!-- fecha todas as divs do conteiner -->';

        // Imagem Banner
  //      if (!empty($instance['imagem-banner'])) {
   //         echo '<div class="imagem-curso"> <img src="' . esc_url($instance['imagem-banner']) . '" alt="Adendo gráfico do site do curso"></div>';
  //      }

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

// fim do registro de widget personalizado da home


?>