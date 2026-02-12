<?php
/**
 * The template for displaying archive pages
 *
 * @package AnnieCosmetic
 * @version 1.0.0
 */

get_header();
?>

<div class="row my-4">
  <div class="col-md-12">
    <header class="page-header mb-4">
      <?php
      the_archive_title('<h1 class="page-title">', '</h1>');
      the_archive_description('<div class="archive-description">', '</div>');
      ?>
    </header>

    <?php if (have_posts()) : ?>
    <div class="row">
      <?php
      while (have_posts()) :
          the_post();
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
            
            <div class="entry-meta text-muted mb-2">
              <small>
                <i class="fa fa-calendar"></i> <?php echo get_the_date(); ?>
              </small>
            </div>
            
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
    <p><?php _e('Không tìm thấy bài viết nào.', 'anniecosmetic'); ?></p>
    <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>
