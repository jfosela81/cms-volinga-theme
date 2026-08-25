<?php
/**
 * Volinga CMS Theme — functions.php
 * Tema de preview editorial para cms.volinga.ai
 */

// ── Estilos ────────────────────────────────────────────────────────────────
add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'volinga-cms',
        get_stylesheet_uri(),
        [],
        filemtime( get_stylesheet_directory() . '/style.css' )
    );
    // Rethink Sans — variable font (wght 400–800, normal + italic)
    wp_enqueue_style(
        'volinga-fonts',
        'https://fonts.googleapis.com/css2?family=Rethink+Sans:ital,wght@0,400..800;1,400..800&display=swap',
        [],
        null
    );
} );

// ── Soporte de features ────────────────────────────────────────────────────
add_action( 'after_setup_theme', function () {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_editor_style( 'assets/css/editor.css?v=' . filemtime( get_template_directory() . '/assets/css/editor.css' ) );

    // Tamaños de imagen
    add_image_size( 'volinga-featured', 1248, 702, true );
    add_image_size( 'volinga-card', 640, 360, true );
} );

// ── Block Patterns ─────────────────────────────────────────────────────────
add_action( 'init', function () {
    register_block_pattern_category(
        'volinga',
        [ 'label' => __( 'Volinga', 'volinga-cms' ) ]
    );

    // Cargar patterns desde /patterns/
    $pattern_files = glob( get_template_directory() . '/patterns/*.php' );
    foreach ( $pattern_files as $file ) {
        require $file;
    }
} );

// ── Deshabilitar registro público (seguridad) ──────────────────────────────
add_filter( 'option_users_can_register', '__return_false' );

// ── Deshabilitar xmlrpc ────────────────────────────────────────────────────
add_filter( 'xmlrpc_enabled', '__return_false' );

// ── REST API: autenticación requerida para rutas de escritura ──────────────
add_filter( 'rest_authentication_errors', function ( $result ) {
    if ( ! empty( $result ) ) return $result;
    if ( ! is_user_logged_in() ) {
        // Solo lectura pública para GET (Astro necesita leer posts)
        if ( isset( $_SERVER['REQUEST_METHOD'] ) && $_SERVER['REQUEST_METHOD'] !== 'GET' ) {
            return new WP_Error( 'rest_not_logged_in', 'Solo lectura pública.', [ 'status' => 401 ] );
        }
    }
    return $result;
} );

