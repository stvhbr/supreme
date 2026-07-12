<?php
/**
 * Supreme Steel Pipe — Child Theme Functions
 *
 * Registers:
 *  - 6 Custom Post Types: product, brand, application, resource, location, faq
 *  - 4 Taxonomies: product_category, material_type, faq_group, resource_type
 *  - ACF Options Pages: Homepage, Global CTA, Company Info, Footer, Quote Form, SEO Defaults
 *  - Scripts & Styles
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'supreme-pipe-theme', get_stylesheet_directory_uri() . '/assets/css/theme.css', [ 'parent-style' ], '1.0.0' );
    wp_enqueue_script( 'supreme-pipe-nav', get_stylesheet_directory_uri() . '/assets/js/nav.js', [], '1.0.0', true );
} );

add_action( 'init', function () {

    register_post_type( 'product', [
        'labels'          => [ 'name' => 'Products', 'singular_name' => 'Product', 'add_new_item' => 'Add New Product', 'edit_item' => 'Edit Product', 'menu_name' => 'Products' ],
        'public'          => true,
        'has_archive'     => true,
        'rewrite'         => [ 'slug' => 'products', 'with_front' => false ],
        'supports'        => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ],
        'menu_icon'       => 'dashicons-hammer',
        'menu_position'   => 5,
        'show_in_rest'    => true,
        'capability_type' => 'post',
    ] );

    register_post_type( 'brand', [
        'labels'          => [ 'name' => 'Brands', 'singular_name' => 'Brand', 'add_new_item' => 'Add New Brand', 'edit_item' => 'Edit Brand', 'menu_name' => 'Brands' ],
        'public'          => true,
        'has_archive'     => true,
        'rewrite'         => [ 'slug' => 'brands', 'with_front' => false ],
        'supports'        => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ],
        'menu_icon'       => 'dashicons-tag',
        'menu_position'   => 6,
        'show_in_rest'    => true,
        'capability_type' => 'post',
    ] );

    register_post_type( 'application', [
        'labels'          => [ 'name' => 'Applications', 'singular_name' => 'Application', 'add_new_item' => 'Add New Application', 'edit_item' => 'Edit Application', 'menu_name' => 'Applications' ],
        'public'          => true,
        'has_archive'     => true,
        'rewrite'         => [ 'slug' => 'applications', 'with_front' => false ],
        'supports'        => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ],
        'menu_icon'       => 'dashicons-admin-tools',
        'menu_position'   => 7,
        'show_in_rest'    => true,
        'capability_type' => 'post',
    ] );

    register_post_type( 'resource', [
        'labels'          => [ 'name' => 'Resources', 'singular_name' => 'Resource', 'add_new_item' => 'Add New Resource', 'edit_item' => 'Edit Resource', 'menu_name' => 'Resources' ],
        'public'          => true,
        'has_archive'     => true,
        'rewrite'         => [ 'slug' => 'resources', 'with_front' => false ],
        'supports'        => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ],
        'menu_icon'       => 'dashicons-media-document',
        'menu_position'   => 8,
        'show_in_rest'    => true,
        'capability_type' => 'post',
    ] );

    register_post_type( 'location', [
        'labels'             => [ 'name' => 'Locations', 'singular_name' => 'Location', 'add_new_item' => 'Add New Location', 'edit_item' => 'Edit Location', 'menu_name' => 'Locations' ],
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'supports'           => [ 'title', 'custom-fields', 'revisions' ],
        'menu_icon'          => 'dashicons-location',
        'menu_position'      => 9,
        'show_in_rest'       => true,
        'capability_type'    => 'post',
    ] );

    register_post_type( 'faq', [
        'labels'          => [ 'name' => 'FAQs', 'singular_name' => 'FAQ', 'add_new_item' => 'Add New FAQ', 'edit_item' => 'Edit FAQ', 'menu_name' => 'FAQs' ],
        'public'          => true,
        'has_archive'     => true,
        'rewrite'         => [ 'slug' => 'faqs', 'with_front' => false ],
        'supports'        => [ 'title', 'custom-fields', 'revisions' ],
        'menu_icon'       => 'dashicons-editor-help',
        'menu_position'   => 10,
        'show_in_rest'    => true,
        'capability_type' => 'post',
    ] );

} );

add_action( 'init', function () {

    register_taxonomy( 'product_category', 'product', [
        'labels'            => [ 'name' => 'Product Categories', 'singular_name' => 'Product Category' ],
        'hierarchical'      => true,
        'public'            => true,
        'rewrite'           => [ 'slug' => 'product-category', 'with_front' => false ],
        'show_in_rest'      => true,
        'show_admin_column' => true,
    ] );

    register_taxonomy( 'material_type', 'product', [
        'labels'            => [ 'name' => 'Material Types', 'singular_name' => 'Material Type' ],
        'hierarchical'      => false,
        'public'            => true,
        'rewrite'           => [ 'slug' => 'material', 'with_front' => false ],
        'show_in_rest'      => true,
        'show_admin_column' => true,
    ] );

    register_taxonomy( 'faq_group', 'faq', [
        'labels'            => [ 'name' => 'FAQ Groups', 'singular_name' => 'FAQ Group' ],
        'hierarchical'      => false,
        'public'            => false,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
    ] );

    register_taxonomy( 'resource_type', 'resource', [
        'labels'            => [ 'name' => 'Resource Types', 'singular_name' => 'Resource Type' ],
        'hierarchical'      => false,
        'public'            => true,
        'rewrite'           => [ 'slug' => 'resource-type', 'with_front' => false ],
        'show_in_rest'      => true,
        'show_admin_column' => true,
    ] );

} );

add_action( 'acf/init', function () {
    if ( ! function_exists( 'acf_add_options_page' ) ) return;

    acf_add_options_page( [
        'page_title' => 'Site Settings',
        'menu_title' => 'Site Settings',
        'menu_slug'  => 'supreme-settings',
        'capability' => 'manage_options',
        'icon_url'   => 'dashicons-admin-settings',
        'position'   => 2,
        'redirect'   => true,
    ] );

    foreach ( [
        [ 'page_title' => 'Homepage',    'menu_title' => 'Homepage',    'menu_slug' => 'supreme-homepage' ],
        [ 'page_title' => 'Global CTA',  'menu_title' => 'Global CTA',  'menu_slug' => 'supreme-cta' ],
        [ 'page_title' => 'Company Info','menu_title' => 'Company Info','menu_slug' => 'supreme-company' ],
        [ 'page_title' => 'Footer',      'menu_title' => 'Footer',      'menu_slug' => 'supreme-footer' ],
        [ 'page_title' => 'Quote Form',  'menu_title' => 'Quote Form',  'menu_slug' => 'supreme-quote-form' ],
        [ 'page_title' => 'SEO Defaults','menu_title' => 'SEO Defaults','menu_slug' => 'supreme-seo' ],
    ] as $sub ) {
        acf_add_options_sub_page( array_merge( $sub, [ 'parent_slug' => 'supreme-settings', 'capability' => 'manage_options' ] ) );
    }
} );

add_filter( 'acf/settings/save_json', function () {
    return get_stylesheet_directory() . '/acf-json';
} );

add_filter( 'acf/settings/load_json', function ( $paths ) {
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
} );

add_action( 'wp_head', function () {
    $name   = get_field( 'company_name', 'option' ) ?: 'Supreme Steel Pipe Corporation';
    $logo   = get_field( 'schema_logo', 'option' );
    $social = [];
    foreach ( [ 'facebook_url', 'tiktok_url', 'instagram_url', 'linkedin_url' ] as $f ) {
        $v = get_field( $f, 'option' );
        if ( $v ) $social[] = $v;
    }
    $schema = [
        '@context'     => 'https://schema.org',
        '@type'        => 'Organization',
        'name'         => $name,
        'url'          => home_url(),
        'foundingDate' => '1991',
        'logo'         => $logo ? $logo['url'] : '',
        'sameAs'       => $social,
        'contactPoint' => [
            '@type'       => 'ContactPoint',
            'telephone'   => get_field( 'phone_main', 'option' ),
            'email'       => get_field( 'email_main', 'option' ),
            'contactType' => 'sales',
            'areaServed'  => 'PH',
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
} );

function supreme_breadcrumb_schema( array $crumbs ) {
    $items = [];
    foreach ( $crumbs as $i => $crumb ) {
        $items[] = [ '@type' => 'ListItem', 'position' => $i + 1, 'name' => $crumb['name'], 'item' => $crumb['url'] ];
    }
    $schema = [ '@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $items ];
    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}

function supreme_faq_schema( array $faqs ) {
    $entities = [];
    foreach ( $faqs as $faq ) {
        $entities[] = [ '@type' => 'Question', 'name' => $faq['question'], 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => wp_strip_all_tags( $faq['answer'] ) ] ];
    }
    $schema = [ '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $entities ];
    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}

add_action( 'after_setup_theme', function () {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', [ 'search-form', 'comment-list', 'gallery', 'caption' ] );
    add_image_size( 'supreme-hero',  1280, 600, true );
    add_image_size( 'supreme-card',  600,  400, true );
    add_image_size( 'supreme-thumb', 300,  200, true );
    add_image_size( 'supreme-og',    1200, 630, true );
} );

add_action( 'after_switch_theme', 'flush_rewrite_rules' );
