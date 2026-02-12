<?php
/**
 * Annie Cosmetic Theme Functions
 * 
 * @package AnnieCosmetic
 * @version 1.0.0
 */

// Ngăn truy cập trực tiếp
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function anniecosmetic_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo');
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'anniecosmetic'),
        'mobile' => __('Mobile Menu', 'anniecosmetic'),
    ));

    // Set content width
    if (!isset($content_width)) {
        $content_width = 1200;
    }
}
add_action('after_setup_theme', 'anniecosmetic_setup');

/**
 * Enqueue scripts and styles
 */
function anniecosmetic_scripts() {
    // CSS Libraries
    wp_enqueue_style('jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.min.css', array(), '1.12.1');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/libs/bootstrap/4-4.0.0-beta/css/bootstrap.min.css', array(), '4.0.0');
    wp_enqueue_style('sweetalert', get_template_directory_uri() . '/assets/libs/sweetalert/2v7.0.9/sweetalert.min.css', array(), '7.0.9');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Varela+Round&subset=latin-ext,vietnamese', array(), null);
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/libs/owl-carousel/2v2.2.1/owl.carousel.min.css', array(), '2.2.1');
    wp_enqueue_style('mobilebar', get_template_directory_uri() . '/assets/css/mobilebar.css', array(), '1.0.0');
    wp_enqueue_style('xzoom', get_template_directory_uri() . '/assets/libs/xzoom/1.0.8/xzoom.css', array(), '1.0.8');
    wp_enqueue_style('anniecosmetic-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0');
    wp_enqueue_style('anniecosmetic-main', get_stylesheet_uri(), array(), '1.0.0');

    // JavaScript Libraries
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/libs/jquery/jquery-3.3.1.min.js', array(), '3.3.1', false);
    wp_enqueue_script('jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array('jquery'), '1.12.1', false);
    wp_enqueue_script('popper', get_template_directory_uri() . '/assets/libs/popper/1.14.3/popper.min.js', array('jquery'), '1.14.3', false);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/libs/bootstrap/4-4.0.0-beta/js/bootstrap.min.js', array('jquery', 'popper'), '4.0.0', false);
    wp_enqueue_script('sweetalert', get_template_directory_uri() . '/assets/libs/sweetalert/2v7.0.9/sweetalert.min.js', array('jquery'), '7.0.9', false);
    wp_enqueue_script('countdown', get_template_directory_uri() . '/assets/js/countdown.handler.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('jquery-validate', get_template_directory_uri() . '/assets/libs/jquery-validation/1.17.0/jquery.validate.min.js', array('jquery'), '1.17.0', true);
    wp_enqueue_script('jquery-validate-vi', get_template_directory_uri() . '/assets/libs/jquery-validation/1.17.0/localization/messages_vi.js', array('jquery-validate'), '1.17.0', true);
    wp_enqueue_script('fontawesome-kit', 'https://kit.fontawesome.com/8ca29e9b4c.js', array(), null, true);
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/libs/owl-carousel/2v2.2.1/owl.carousel.min.js', array('jquery'), '2.2.1', true);
    wp_enqueue_script('bar-rating', get_template_directory_uri() . '/assets/libs/bar-rating-master/jquery.barrating.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('xzoom', get_template_directory_uri() . '/assets/libs/xzoom/1.0.8/xzoom.min.js', array('jquery'), '1.0.8', true);
    wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('main-handler', get_template_directory_uri() . '/assets/js/main.handler.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('product-slider', get_template_directory_uri() . '/assets/js/product-slider.handler.js', array('jquery', 'owl-carousel'), '1.0.0', true);
    wp_enqueue_script('jquery-session', get_template_directory_uri() . '/assets/libs/jquery-session/jquery-session.js', array('jquery'), '1.0.0', true);

    // Google Analytics
    wp_add_inline_script('jquery', "
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-DZ7XW76CQ3');
    ");
}
add_action('wp_enqueue_scripts', 'anniecosmetic_scripts');

/**
 * Add Google Analytics to header
 */
function anniecosmetic_google_analytics() {
    ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DZ7XW76CQ3"></script>
    
    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TR3WC25');
    </script>
    <!-- End Google Tag Manager -->
    
    <!-- harafunnel -->
    <script src="//harafunnel.com/widget/1882121868702051.js" async="async"></script>
    <?php
}
add_action('wp_head', 'anniecosmetic_google_analytics');

/**
 * Add Google Tag Manager noscript to body
 */
function anniecosmetic_google_tag_manager_body() {
    ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TR3WC25" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
}
add_action('wp_body_open', 'anniecosmetic_google_tag_manager_body');

/**
 * Register Widget Areas
 */
function anniecosmetic_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'anniecosmetic'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'anniecosmetic'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 1', 'anniecosmetic'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'anniecosmetic'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 2', 'anniecosmetic'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here to appear in your footer.', 'anniecosmetic'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 3', 'anniecosmetic'),
        'id'            => 'footer-3',
        'description'   => __('Add widgets here to appear in your footer.', 'anniecosmetic'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'anniecosmetic_widgets_init');

/**
 * Get cart count for header display
 */
function anniecosmetic_get_cart_count() {
    if (function_exists('WC')) {
        return WC()->cart->get_cart_contents_count();
    }
    return 0;
}

/**
 * Add cart count to AJAX
 */
function anniecosmetic_update_cart_count() {
    echo anniecosmetic_get_cart_count();
    wp_die();
}
add_action('wp_ajax_anniecosmetic_update_cart_count', 'anniecosmetic_update_cart_count');
add_action('wp_ajax_nopriv_anniecosmetic_update_cart_count', 'anniecosmetic_update_cart_count');

/**
 * Get product categories for menu
 */
function anniecosmetic_get_product_categories() {
    if (function_exists('WC')) {
        $args = array(
            'taxonomy'   => 'product_cat',
            'hide_empty' => true,
            'orderby'    => 'name',
            'order'      => 'ASC',
        );
        return get_terms($args);
    }
    return array();
}

/**
 * Get product brands (assuming you'll create a custom taxonomy)
 */
function anniecosmetic_get_product_brands() {
    if (taxonomy_exists('product_brand')) {
        $args = array(
            'taxonomy'   => 'product_brand',
            'hide_empty' => true,
            'orderby'    => 'name',
            'order'      => 'ASC',
        );
        return get_terms($args);
    }
    return array();
}

/**
 * Custom excerpt length
 */
function anniecosmetic_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'anniecosmetic_excerpt_length');

/**
 * Custom excerpt more
 */
function anniecosmetic_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'anniecosmetic_excerpt_more');

/**
 * Add body classes
 */
function anniecosmetic_body_classes($classes) {
    $classes[] = 'scrollbar';
    return $classes;
}
add_filter('body_class', 'anniecosmetic_body_classes');

/**
 * Number format for prices (Vietnamese style)
 */
function anniecosmetic_format_price($price) {
    return number_format($price, 0, ',', '.');
}
