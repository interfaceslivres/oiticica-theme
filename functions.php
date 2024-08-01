<?php

add_theme_support( 'post-thumbnails' );

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

//registrar menus
function register_menus() { 
    register_nav_menus(
        array(
            'main-menu' => 'Menu Principal',
            'localizacao-menu' => 'Links em Localização'
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
    // Registrar mais areas de widgets personalizados, se necessário
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
        <div class="apresentacao camada-1">
            <div>                 
                <h1>' . nl2br(esc_html($instance['titulo'])) . '</h1>
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
                echo '<div class="youtube"><iframe width="100%" height="100%" src="' . $embed_url . '" title="Youtube Video Player" frameborder="0" allow="web-share" allowfullscreen></iframe></div>';
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
        echo '</div>';
        if (!empty($endereco)) {
            echo '<address>' . wp_kses_post($endereco) . '</address>';
        }
        if (!empty($telefone)) {
            echo '<div class="f-link tel"><a href="tel: ' . esc_html($telefone) . '">' . esc_html($telefone) . '</a></div>';
        }
        if (!empty($contato)) {
            echo '<div class="f-link"><a class="mais-link" href="' . esc_url($contato) . '">Contato</a></div>';
        }
        if (!empty($horario_funcionamento)) {
            echo '<div>' . esc_html($horario_funcionamento) . '</div>';
        }
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

?>