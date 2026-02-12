<?php
/**
 * The header for Annie Cosmetic theme
 *
 * @package AnnieCosmetic
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="ANNIE COSMETIC - là sàn thương mại điện tử về mỹ phẩm - phân phối mỹ phẩm chính hãng BLACK ROUGE và các thương hiệu khác.">
  <meta name="keywords" content="<?php echo esc_attr(get_bloginfo('name')); ?>" />
  <meta name="author" content="Công ty TNHH DM&amp;C" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>" />
  <meta property="og:description" content="ANNIE COSMETIC - là sàn thương mại điện tử về mỹ phẩm - phân phối mỹ phẩm chính hãng BLACK ROUGE và các thương hiệu khác." />
  <meta property="og:image" content="<?php echo esc_url(get_template_directory_uri() . '/assets/images/255x59-02.png'); ?>" />

  <link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon.ico'); ?>" type="image/x-icon">
  <link rel="icon" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon.ico'); ?>">

  <?php wp_head(); ?>

  <style>
    .fb_customer_chat_bubble_animated_no_badge {
      bottom: 60pt !important;
      right: 6pt !important;
    }
  </style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <div class="overlay" onclick="close_nav()"></div>

  <!-- Mobile Navigation -->
  <nav id="navMobile">
    <div class="left">
      <button type="button" class="btn btn-default" onclick="open_nav()">
        <svg id="i-menu" viewBox="0 0 32 32" width="22" height="22" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
          <path d="M4 8 L28 8 M4 16 L28 16 M4 24 L28 24" />
        </svg>
      </button>
    </div>
    <div class="center">
      <a href="<?php echo esc_url(home_url('/')); ?>">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/255x59-02.png'); ?>" class="margin-left-10" alt="<?php bloginfo('name'); ?>">
      </a>
    </div>
    <div class="right">
      <?php if (function_exists('WC')) : ?>
      <a href="<?php echo esc_url(wc_get_cart_url()); ?>">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/cart-icon.png'); ?>">
        <span class="data-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
      </a>
      <?php endif; ?>
      <span class="dropdown dropdown-hover">
        <div data-toggle="dropdown"><i class="fa fa-user-circle"></i></div>
        <div class="dropdown-menu dropdown-menu-right">
          <?php if (!is_user_logged_in()) : ?>
          <a class="dropdown-item" href="<?php echo esc_url(wp_login_url()); ?>">Đăng nhập</a>
          <a class="dropdown-item" href="<?php echo esc_url(wp_registration_url()); ?>">Đăng ký</a>
          <?php else : ?>
          <a class="dropdown-item" href="<?php echo esc_url(wp_logout_url(home_url())); ?>">Thoát tài khoản</a>
          <?php endif; ?>
        </div>
      </span>
    </div>
  </nav>

  <!-- Status Bar -->
  <nav id="status">
    <div class="container">
      <div class="row">
        <div class="col-left col-6">
          <span>Mạng xã hội:
            <a href="#"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/status-ico/facebook-icon.png'); ?>" width="15"></a>
            <a href="#"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/status-ico/instagram-icon.png'); ?>" width="15"></a>
            <a href="#"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/status-ico/zalo-icon.png'); ?>" width="15"></a>
            <a href="#"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/status-ico/shopee-icon.png'); ?>" width="15"></a>
            <a href="#"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/status-ico/youtube-icon.png'); ?>" width=" 15"></a>
          </span>
          <span>Hotline: <a href="tel:081 904 6668">081 904 6668</a></span>
        </div>
        <div class="col-right col-6">
          <span class="dropdown dropdown-hover">
            <?php if (!is_user_logged_in()) : ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tài khoản</a>
            <?php else : 
              $current_user = wp_get_current_user();
              $display_name = $current_user->display_name ? $current_user->display_name : $current_user->user_login;
            ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo esc_html($display_name); ?></a>
            <?php endif; ?>
            <div class="dropdown-menu">
              <?php if (!is_user_logged_in()) : ?>
              <a class="dropdown-item" href="<?php echo esc_url(wp_login_url()); ?>">Đăng nhập</a>
              <a class="dropdown-item" href="<?php echo esc_url(wp_registration_url()); ?>">Đăng ký</a>
              <?php else : ?>
              <a class="dropdown-item" href="<?php echo esc_url(wp_logout_url(home_url())); ?>">Thoát tài khoản</a>
              <?php endif; ?>
            </div>
          </span>
          <span>
            <?php if (function_exists('WC')) : ?>
            <a href="<?php echo esc_url(wc_get_cart_url()); ?>">
              <i class="fa fa-shopping-bag fa-fw"></i> Giỏ hàng (<b class="data-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></b>)
            </a>
            <?php endif; ?>
          </span>
          <span>
            <a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>">
              <i class="fa fa-file-text fa-fw"></i> Theo dõi đơn hàng
            </a>
          </span>
        </div>
      </div>
    </div>
  </nav>

  <!-- SEARCH -->
  <header id="header">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="header-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
              <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/255x59-02.png'); ?>" class="margin-left-10" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
              <h1 class="d-none"><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></h1>
            </a>
          </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
            <div class="input-group">
              <input type="search" name="s" class="form-control" placeholder="Tìm sản phẩm, thương hiệu bạn mong muốn..." value="<?php echo get_search_query(); ?>">
              <?php if (function_exists('WC')) : ?>
              <input type="hidden" name="post_type" value="product">
              <?php endif; ?>
              <div class="input-group-append">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </header>
  <!-- END SEARCH-->

  <!-- MENU -->
  <div id="nav-target"></div>
  <nav id="navigation">
    <div class="container">
      <ul class="nav-wrap">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo esc_url(home_url('/')); ?>"><i class="fa fa-home fa-lg"></i></a>
        </li>
        <li class="nav-item dropdown dropdown-hover">
          <a href="<?php echo esc_url(home_url('/hot')); ?>" class="nav-link">HOT ANNIE</a>
          <div class="dropdown-menu">
            <div class="cat-thumbnail">
              <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/sale-cat.jpg'); ?>" alt="Khuyến mãi" width="350">
            </div>
          </div>
        </li>
        
        <?php 
        // Display product categories
        $categories = anniecosmetic_get_product_categories();
        if (!empty($categories)) :
          foreach ($categories as $category) : 
            $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
            $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : get_template_directory_uri() . '/assets/images/default-cat.jpg';
        ?>
        <li class="nav-item dropdown dropdown-hover">
          <a href="<?php echo esc_url(get_term_link($category)); ?>" class="nav-link"><?php echo esc_html($category->name); ?></a>
          <div class="dropdown-menu">
            <div class="cat-thumbnail">
              <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>" width="350">
            </div>
          </div>
        </li>
        <?php 
          endforeach;
        endif;
        
        // Display product brands (custom taxonomy)
        $brands = anniecosmetic_get_product_brands();
        if (!empty($brands)) :
          foreach ($brands as $brand) : 
            $thumbnail_id = get_term_meta($brand->term_id, 'thumbnail_id', true);
            $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : get_template_directory_uri() . '/assets/images/default-brand.jpg';
        ?>
        <li class="nav-item dropdown dropdown-hover">
          <a href="<?php echo esc_url(get_term_link($brand)); ?>" class="nav-link"><?php echo esc_html($brand->name); ?></a>
          <div class="dropdown-menu">
            <div class="cat-thumbnail">
              <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($brand->name); ?>" width="350">
            </div>
          </div>
        </li>
        <?php 
          endforeach;
        endif;
        ?>
      </ul>
    </div>
  </nav>
  <!-- END MENU-->

  <div class="container" id="mainContainer">
