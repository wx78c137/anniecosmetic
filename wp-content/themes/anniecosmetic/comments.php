<?php
/**
 * The template for displaying comments
 *
 * @package AnnieCosmetic
 * @version 1.0.0
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area mt-5">

  <?php if (have_comments()) : ?>
    <h2 class="comments-title">
      <?php
      $comments_number = get_comments_number();
      if ('1' === $comments_number) {
          printf(_x('1 bình luận', 'comments title', 'anniecosmetic'));
      } else {
          printf(
              _nx(
                  '%1$s bình luận',
                  '%1$s bình luận',
                  $comments_number,
                  'comments title',
                  'anniecosmetic'
              ),
              number_format_i18n($comments_number)
          );
      }
      ?>
    </h2>

    <ol class="comment-list list-unstyled">
      <?php
      wp_list_comments(array(
          'style'       => 'ol',
          'short_ping'  => true,
          'avatar_size' => 60,
          'callback'    => 'anniecosmetic_comment_callback',
      ));
      ?>
    </ol>

    <?php
    the_comments_pagination(array(
        'prev_text' => '<i class="fa fa-arrow-left"></i> Trang trước',
        'next_text' => 'Trang sau <i class="fa fa-arrow-right"></i>',
    ));
    ?>

  <?php endif; ?>

  <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
    <p class="no-comments"><?php _e('Bình luận đã đóng.', 'anniecosmetic'); ?></p>
  <?php endif; ?>

  <?php
  comment_form(array(
      'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
      'title_reply_after'  => '</h3>',
      'title_reply'        => __('Để lại bình luận', 'anniecosmetic'),
      'label_submit'       => __('Gửi bình luận', 'anniecosmetic'),
      'class_submit'       => 'btn btn-primary',
      'comment_field'      => '<div class="form-group"><label for="comment">' . _x('Bình luận', 'noun', 'anniecosmetic') . '</label><textarea id="comment" name="comment" class="form-control" rows="5" required></textarea></div>',
      'fields'             => array(
          'author' => '<div class="form-group"><label for="author">' . __('Tên', 'anniecosmetic') . ' <span class="required">*</span></label>' .
                      '<input id="author" name="author" type="text" class="form-control" value="' . esc_attr($commenter['comment_author']) . '" required /></div>',
          'email'  => '<div class="form-group"><label for="email">' . __('Email', 'anniecosmetic') . ' <span class="required">*</span></label>' .
                      '<input id="email" name="email" type="email" class="form-control" value="' . esc_attr($commenter['comment_author_email']) . '" required /></div>',
          'url'    => '<div class="form-group"><label for="url">' . __('Website', 'anniecosmetic') . '</label>' .
                      '<input id="url" name="url" type="url" class="form-control" value="' . esc_attr($commenter['comment_author_url']) . '" /></div>',
      ),
  ));
  ?>

</div>
