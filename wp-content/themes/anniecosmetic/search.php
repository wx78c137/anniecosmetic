<?php
/**
 * The template for displaying search results
 *
 * @package AnnieCosmetic
 * @version 1.0.0
 */

get_header();
?>

<div class="row my-4">
  <div class="col-md-12">
    <header class="page-header mb-4">
      <h1 class="page-title">
        <?php
        printf(
            __('Kết quả tìm kiếm cho: %s', 'anniecosmetic'),
            '<span>' . get_search_query() . '</span>'
        );
        ?>
      </h1>
    </header>

    <?php if (have_posts()) : ?>
    <div class="row">
      <?php
      while (have_posts()) :
          the_post();
          
          // Check if it's a product
          if (get_post_type() === 'product' && function_exists('WC')) :
              global $product;
              $regular_price = $product->get_regular_price();
              $sale_price = $product->get_sale_price() ? $product->get_sale_price() : $regular_price;
              $discount_percentage = $regular_price > 0 && $sale_price < $regular_price ? round((($regular_price - $sale_price) / $regular_price) * 100) : 0;
      ?>
      <div class="col-md-3 mb-4">
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
      <?php
          else : // Regular post
      ?>
      <div class="col-md-4 mb-4">
        <article id="post-<?php the_ID(); ?>" <?php post_class('card h-100'); ?>>
          <?php if (has_post_thumbnail()) : ?>
          <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('medium', array('class' => 'card-img-top')); ?>
          </a>
          <?php endif; ?>
          
          <div class="card-body">
            <h2 class="card-title h5">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            
            <div class="card-text">
              <?php the_excerpt(); ?>
            </div>
            
            <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">
              Xem thêm <i class="fa fa-arrow-right"></i>
            </a>
          </div>
        </article>
      </div>
      <?php
          endif;
      endwhile;
      ?>
    </div>

    <?php
    // Pagination
    the_posts_pagination(array(
        'mid_size'  => 2,
        'prev_text' => '<i class="fa fa-arrow-left"></i> Trang trước',
        'next_text' => 'Trang sau <i class="fa fa-arrow-right"></i>',
    ));

    else :
    ?>
    <p><?php _e('Không tìm thấy kết quả nào. Vui lòng thử lại với từ khóa khác.', 'anniecosmetic'); ?></p>
    <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>
