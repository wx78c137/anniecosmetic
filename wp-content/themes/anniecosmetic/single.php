<?php
/**
 * The template for displaying single posts
 *
 * @package AnnieCosmetic
 * @version 1.0.0
 */

get_header();
?>

<div class="row my-4">
  <div class="col-md-8">
    <?php
    while (have_posts()) :
        the_post();
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <header class="entry-header mb-3">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <div class="entry-meta text-muted mb-2">
          <span class="posted-on">
            <i class="fa fa-calendar"></i> <?php echo get_the_date(); ?>
          </span>
          <span class="byline ml-3">
            <i class="fa fa-user"></i> <?php the_author(); ?>
          </span>
          <?php if (has_category()) : ?>
          <span class="cat-links ml-3">
            <i class="fa fa-folder"></i> <?php the_category(', '); ?>
          </span>
          <?php endif; ?>
        </div>
      </header>

      <?php if (has_post_thumbnail()) : ?>
      <div class="post-thumbnail mb-4">
        <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
      </div>
      <?php endif; ?>

      <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . __('Pages:', 'anniecosmetic'),
            'after'  => '</div>',
        ));
        ?>
      </div>

      <?php if (has_tag()) : ?>
      <footer class="entry-footer mt-4">
        <div class="tags-links">
          <i class="fa fa-tags"></i> <?php the_tags('', ', ', ''); ?>
        </div>
      </footer>
      <?php endif; ?>
    </article>

    <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;

    // Previous/next post navigation.
    the_post_navigation(array(
        'prev_text' => '<i class="fa fa-arrow-left"></i> %title',
        'next_text' => '%title <i class="fa fa-arrow-right"></i>',
    ));

    endwhile;
    ?>
  </div>

  <div class="col-md-4">
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>
