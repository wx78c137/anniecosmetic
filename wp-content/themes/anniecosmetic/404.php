<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package AnnieCosmetic
 * @version 1.0.0
 */

get_header();
?>

<div class="row my-5">
  <div class="col-md-12 text-center">
    <div class="error-404 not-found">
      <header class="page-header mb-4">
        <h1 class="page-title" style="font-size: 120px; color: #e91e63;">404</h1>
        <p class="lead">Oops! Trang bạn tìm kiếm không tồn tại.</p>
      </header>

      <div class="page-content">
        <p>Có vẻ như không có gì ở đây. Bạn có muốn thử tìm kiếm?</p>

        <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="my-4">
          <div class="form-group">
            <div class="input-group" style="max-width: 600px; margin: 0 auto;">
              <input type="search" name="s" class="form-control" placeholder="Tìm kiếm..." value="<?php echo get_search_query(); ?>">
              <?php if (function_exists('WC')) : ?>
              <input type="hidden" name="post_type" value="product">
              <?php endif; ?>
              <div class="input-group-append">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-search"></i> Tìm kiếm
                </button>
              </div>
            </div>
          </div>
        </form>

        <div class="my-4">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary btn-lg">
            <i class="fa fa-home"></i> Về trang chủ
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
