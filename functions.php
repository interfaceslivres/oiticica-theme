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

?>