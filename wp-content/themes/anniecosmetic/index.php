<?php
/**
 * The main template file - Homepage
 *
 * @package AnnieCosmetic
 * @version 1.0.0
 */

get_header();
?>

<!-- Banner Slider -->
<div class="block-banner mb-4">
  <div class="owl-carousel" id="bannerSlider">
    <?php
    // Get banner images from a custom post type or custom field
    // For now, we'll use a simple example
    $banner_args = array(
        'post_type' => 'banner',
        'posts_per_page' => 5,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );
    $banners = new WP_Query($banner_args);
    
    if ($banners->have_posts()) :
        while ($banners->have_posts()) : $banners->the_post();
            if (has_post_thumbnail()) :
    ?>
    <div class="item">
      <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail('full', array('alt' => get_the_title(), 'width' => '100%')); ?>
      </a>
    </div>
    <?php
            endif;
        endwhile;
        wp_reset_postdata();
    else :
        // Default banners if no custom post type exists
    ?>
    <div class="item">
      <a href="#">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/banner-default.jpg'); ?>" alt="Banner" width="100%">
      </a>
    </div>
    <?php endif; ?>
  </div>
</div>

<!-- Sub Banner -->
<div class="block-qcs my-2 my-md-4 d-none d-md-block">
  <div class="owl-carousel sub-banner-slider">
    <div class="item">
      <a href="#">
        <img src="https://cdn.fistore.vn/media/slides/fi-store-block-quang-cao-1-ijuzg.jpg" width="100%">
      </a>
    </div>
    <div class="item">
      <a href="#">
        <img src="https://cdn.fistore.vn/media/slides/fi-store-block-quang-cao-1-gczbs.jpg" width="100%">
      </a>
    </div>
    <div class="item">
      <a href="#">
        <img src="https://cdn.fistore.vn/media/slides/fi-store-block-quang-cao-1-kgkx2.jpg" width="100%">
      </a>
    </div>
  </div>
</div>

<!-- Brand Slider -->
<div class="block-brands my-4">
  <div class="owl-carousel" id="brandSlider">
  </div>
  <script>
    jQuery(document).ready(function($) {
      $('#brandSlider').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        smartSpeed: 700,
        responsive: {
          0: { items: 4 },
          768: { items: 7 },
          992: { items: 9 },
          1200: { items: 10 },
        },
      });
    });
  </script>
</div>

<!-- Khuyến mãi (Sale Products) -->
<?php if (function_exists('WC')) : 
  $sale_args = array(
      'post_type' => 'product',
      'posts_per_page' => 12,
      'meta_query' => array(
          array(
              'key' => '_sale_price',
              'value' => 0,
              'compare' => '>',
              'type' => 'NUMERIC'
          )
      )
  );
  $sale_products = new WP_Query($sale_args);
  
  if ($sale_products->have_posts()) :
?>
<div class="block-primary my-2 my-md-4">
  <div class="block-header">
    <div class="block-title">Khuyến mãi</div>
    <ul class="nav-product saleoff">
    </ul>
    <div class="view-more" style="margin-top: 1.5rem">
      <a href="<?php echo esc_url(home_url('/sale')); ?>">
        Xem thêm <i class="fa fa-angle-double-right"></i>
      </a>
    </div>
  </div>
  <div class="block-body tab-contain saleoff">
    <div class="tab-panel" id="tabSaleOf">
      <div class="owl-carousel product-slider" id="owlSaleOf">
        <?php while ($sale_products->have_posts()) : $sale_products->the_post(); 
          global $product;
          $regular_price = $product->get_regular_price();
          $sale_price = $product->get_sale_price();
          $discount_percentage = $regular_price > 0 ? round((($regular_price - $sale_price) / $regular_price) * 100) : 0;
        ?>
        <div class="item">
          <div class="item-product">
            <div class="item-thumbnail item-thumbnail1">
              <a href="<?php the_permalink(); ?>">
                <?php 
                if (has_post_thumbnail()) {
                    the_post_thumbnail('medium', array('alt' => get_the_title()));
                } else {
                    echo '<img src="' . esc_url(wc_placeholder_img_src()) . '" alt="' . esc_attr(get_the_title()) . '">';
                }
                ?>
              </a>
              <?php if ($discount_percentage > 0) : ?>
              <label class="saleof"> -<?php echo $discount_percentage; ?>%</label>
              <?php endif; ?>
            </div>
            <div class="item-info item-info1">
              <div class="item-brand-name">
                <?php
                $terms = get_the_terms(get_the_ID(), 'product_cat');
                if ($terms && !is_wp_error($terms)) :
                    $term = array_shift($terms);
                ?>
                <a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a>
                <?php endif; ?>
              </div>
              <div class="item-name">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </div>
              <div class="item-price">
                <?php echo anniecosmetic_format_price($sale_price); ?> đ
                <strike class="fz-down-1 text-muted"><?php echo anniecosmetic_format_price($regular_price); ?> đ</strike>
              </div>
              <div class="item-action">
                <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block">XEM NGAY</a>
              </div>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>
<?php 
  wp_reset_postdata();
  endif;
endif; 
?>
<!-- End Khuyến mãi -->

<!-- Hàng bán chạy (Best Selling) -->
<?php if (function_exists('WC')) : 
  $best_args = array(
      'post_type' => 'product',
      'posts_per_page' => 12,
      'meta_key' => 'total_sales',
      'orderby' => 'meta_value_num',
      'order' => 'DESC'
  );
  $best_products = new WP_Query($best_args);
  
  if ($best_products->have_posts()) :
?>
<div class="block-primary my-2 my-md-4">
  <div class="block-header">
    <div class="block-title">Hàng bán chạy</div>
    <div class="view-more">
      <a href="<?php echo esc_url(home_url('/hot')); ?>">
        Xem thêm <i class="fa fa-angle-double-right"></i>
      </a>
    </div>
  </div>
  <div class="block-body">
    <div class="owl-carousel product-slider">
      <?php while ($best_products->have_posts()) : $best_products->the_post(); 
        global $product;
        $regular_price = $product->get_regular_price();
        $sale_price = $product->get_sale_price() ? $product->get_sale_price() : $regular_price;
        $discount_percentage = $regular_price > 0 && $sale_price < $regular_price ? round((($regular_price - $sale_price) / $regular_price) * 100) : 0;
      ?>
      <div class="item">
        <div class="item-product">
          <div class="item-thumbnail item-thumbnail1">
            <a href="<?php the_permalink(); ?>">
              <?php 
              if (has_post_thumbnail()) {
                  the_post_thumbnail('medium', array('alt' => get_the_title()));
              } else {
                  echo '<img src="' . esc_url(wc_placeholder_img_src()) . '" alt="' . esc_attr(get_the_title()) . '">';
              }
              ?>
            </a>
            <?php if ($discount_percentage > 0) : ?>
            <label class="saleof"> -<?php echo $discount_percentage; ?>%</label>
            <?php endif; ?>
          </div>
          <div class="item-info item-info1">
            <div class="item-brand-name">
              <?php
              $terms = get_the_terms(get_the_ID(), 'product_cat');
              if ($terms && !is_wp_error($terms)) :
                  $term = array_shift($terms);
              ?>
              <a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a>
              <?php endif; ?>
            </div>
            <div class="item-name">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>
            <div class="item-price">
              <?php echo anniecosmetic_format_price($sale_price); ?> đ
              <?php if ($discount_percentage > 0) : ?>
              <strike class="fz-down-1 text-muted"><?php echo anniecosmetic_format_price($regular_price); ?> đ</strike>
              <?php endif; ?>
            </div>
            <div class="item-action">
              <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block">XEM NGAY</a>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
<?php 
  wp_reset_postdata();
  endif;
endif; 
?>
<!-- End Hàng bán chạy -->

<!-- Sub Banner 2 -->
<div class="block-qcs my-2 my-md-4">
  <div class="owl-carousel sub-banner-slider">
    <div class="item">
      <a href="#">
        <img src="https://cdn.fistore.vn/media/slides/fi-store-block-quang-cao-3-sdr9h.jpg" width="100%">
      </a>
    </div>
    <div class="item">
      <a href="#">
        <img src="https://cdn.fistore.vn/media/slides/fi-store-block-quang-cao-3-1budt.jpg" width="100%">
      </a>
    </div>
    <div class="item">
      <a href="#">
        <img src="https://cdn.fistore.vn/media/slides/fi-store-block-quang-cao-3-etnn5.jpg" width="100%">
      </a>
    </div>
  </div>
</div>

<!-- Hàng mới về (New Arrivals) -->
<?php if (function_exists('WC')) : 
  $new_args = array(
      'post_type' => 'product',
      'posts_per_page' => 12,
      'orderby' => 'date',
      'order' => 'DESC'
  );
  $new_products = new WP_Query($new_args);
  
  if ($new_products->have_posts()) :
?>
<div class="block-primary my-2 my-md-4">
  <div class="block-header">
    <div class="block-title">Hàng mới về</div>
    <div class="view-more">
      <a href="<?php echo esc_url(home_url('/new')); ?>">
        Xem thêm <i class="fa fa-angle-double-right"></i>
      </a>
    </div>
  </div>
  <div class="block-body">
    <div class="owl-carousel product-slider">
      <?php while ($new_products->have_posts()) : $new_products->the_post(); 
        global $product;
        $regular_price = $product->get_regular_price();
        $sale_price = $product->get_sale_price() ? $product->get_sale_price() : $regular_price;
        $discount_percentage = $regular_price > 0 && $sale_price < $regular_price ? round((($regular_price - $sale_price) / $regular_price) * 100) : 0;
      ?>
      <div class="item">
        <div class="item-product">
          <div class="item-thumbnail item-thumbnail1">
            <a href="<?php the_permalink(); ?>">
              <?php 
              if (has_post_thumbnail()) {
                  the_post_thumbnail('medium', array('alt' => get_the_title()));
              } else {
                  echo '<img src="' . esc_url(wc_placeholder_img_src()) . '" alt="' . esc_attr(get_the_title()) . '">';
              }
              ?>
            </a>
            <?php if ($discount_percentage > 0) : ?>
            <label class="saleof"> -<?php echo $discount_percentage; ?>%</label>
            <?php endif; ?>
          </div>
          <div class="item-info item-info1">
            <div class="item-brand-name">
              <?php
              $terms = get_the_terms(get_the_ID(), 'product_cat');
              if ($terms && !is_wp_error($terms)) :
                  $term = array_shift($terms);
              ?>
              <a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a>
              <?php endif; ?>
            </div>
            <div class="item-name">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>
            <div class="item-price">
              <?php echo anniecosmetic_format_price($sale_price); ?> đ
              <?php if ($discount_percentage > 0) : ?>
              <strike class="fz-down-1 text-muted"><?php echo anniecosmetic_format_price($regular_price); ?> đ</strike>
              <?php endif; ?>
            </div>
            <div class="item-action">
              <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block">XEM NGAY</a>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
<?php 
  wp_reset_postdata();
  endif;
endif; 
?>
<!-- End Hàng mới về -->

<?php get_footer(); ?>
