<?php
/**
 * Child theme functions
 *
 * Functions file for child theme, enqueues parent and child stylesheets by default.
 *
 * @since   1.0.0
 * @package aa
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! function_exists( 'aa_enqueue_styles' ) ) {
    // Add enqueue function to the desired action.
    add_action( 'wp_enqueue_scripts', 'aa_enqueue_styles' );

    /**
     * Enqueue Styles.
     *
     * Enqueue parent style and child styles where parent are the dependency
     * for child styles so that parent styles always get enqueued first.
     *
     * @since 1.0.0
     */
    function aa_enqueue_styles() {
        // Parent style variable.
        $parent_style = 'parent-style';

        // Enqueue Parent theme's stylesheet.
        wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );

        // Enqueue Child theme's stylesheet.
        // Setting 'parent-style' as a dependency will ensure that the child theme stylesheet loads after it.
        wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
        wp_enqueue_style( 'fancy', get_stylesheet_directory_uri() . '/css/jquery.fancybox.css');
        wp_enqueue_style( 'rtl', get_stylesheet_directory_uri() . '/rtl.css');
    }
}
function include_custom_jquery() {

    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);

}
add_action('wp_enqueue_scripts', 'include_custom_jquery');
function include_fancy_dep_jquery() {
    wp_enqueue_script( 'fancybox', get_stylesheet_directory_uri() . '/js/jquery.fancybox.js', array('jquery') );
}
function include_myscript_dep_jquery() {
    wp_enqueue_script( 'myscripts', get_stylesheet_directory_uri() . '/js/js.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'include_fancy_dep_jquery' );
add_action( 'wp_enqueue_scripts', 'include_myscript_dep_jquery' );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
// add a new fonction to the hook
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 50 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 40 );
add_action( 'init', 'create_my_taxonomies', 0 );
function create_my_taxonomies() {
    register_taxonomy(
        'genre',
        'books',
        array(
            'labels' => array(
                'name' => 'Books Genre',
                'add_new_item' => 'Add New Books Genre',
                'new_item_name' => "New Books Type Genre"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}
function books_post_type() {

    $labels = array(
        'name'                => _x( 'Books', 'Post Type General Name', 'devastor' ),
        'singular_name'       => _x( 'Book', 'Post Type Singular Name', 'devastor' ),
        'menu_name'           => __( 'Books', 'devastor' ),
        'parent_item_colon'   => __( 'Parent Books:', 'devastor' ),
        'all_items'           => __( 'All books', 'devastor' ),
        'view_item'           => __( 'View books', 'devastor' ),
        'add_new_item'        => __( 'Add new book.', 'devastor' ),
        'add_new'             => __( 'Add new', 'devastor' ),
        'edit_item'           => __( 'Edit book', 'devastor' ),
        'update_item'         => __( 'Update book', 'devastor' ),
        'search_items'        => __( 'Search books', 'devastor' ),
        'not_found'           => __( 'No Books found', 'devastor' ),
        'not_found_in_trash'  => __( 'No Books found in Trash', 'devastor' ),
    );
    $args = array(
        'label'               => __( 'book', 'devastor' ),
        'description'         => __( 'Book information pages', 'devastor' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'          => array('genre'),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
    register_post_type( 'books', $args );

}

// Hook into the 'init' action
add_action( 'init', 'books_post_type', 0 );