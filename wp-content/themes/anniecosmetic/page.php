<?php
/**
 * The template for displaying pages
 *
 * @package AnnieCosmetic
 * @version 1.0.0
 */

get_header();
?>

<div class="row my-4">
  <div class="col-md-12">
    <?php
    while (have_posts()) :
        the_post();
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <header class="entry-header mb-4">
        <h1 class="entry-title"><?php the_title(); ?></h1>
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
    </article>

    <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;

    endwhile;
    ?>
  </div>
</div>

<?php get_footer(); ?>
