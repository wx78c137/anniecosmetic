<?php
/**
 * The footer for Annie Cosmetic theme
 *
 * @package AnnieCosmetic
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

    <footer id="footer">
      <div class="footer-top">
        <div class="row row-mx-5 mb-3">
          <div class="col-md-3">
            <div class="footer-logo">
              <a href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/255x59-02.png'); ?>" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
              </a>
            </div>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-3 align-self-center font-weight-bold text-right">
            <span class="mr-3">Đăng ký nhận email</span>
          </div>
          <div class="col-md-4 align-self-center">
            <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" id="newsletterForm">
              <input type="hidden" name="action" value="anniecosmetic_newsletter">
              <?php wp_nonce_field('anniecosmetic_newsletter_action', 'anniecosmetic_newsletter_nonce'); ?>
              <div class="form-group mb-0">
                <div class="input-group">
                  <input type="email" name="email" class="form-control" placeholder="Nhập địa chỉ Email" required>
                  <span class="input-group-btn">
                    <button class="btn btn-primary"><i class="fa fa-envelope-open fa-lg"></i></button>
                  </span>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row row-mx-5">
          <div class="col-lg-3 text-center"></div>
          <div class="col-lg-2 col-md-4">
            <ul class="list">
              <li class="list-title">Về ANNIE COSMETIC</li>
              <li class="list-item"><a href="<?php echo esc_url(home_url('/gioi-thieu')); ?>" class="list-link">Giới thiệu</a></li>
              <li class="list-item"><a href="<?php echo esc_url(home_url('/blog')); ?>" class="list-link">Bài viết sự kiện</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-4">
            <ul class="list">
              <li class="list-title">Chính sách</li>
              <li class="list-item"><a href="<?php echo esc_url(home_url('/chinh-sach-bao-mat')); ?>" class="list-link">Chính sách bảo mật</a></li>
              <li class="list-item"><a href="<?php echo esc_url(home_url('/chinh-sach-doi-tra')); ?>" class="list-link">Chính sách đổi trả và hoàn tiền</a></li>
              <li class="list-item"><a href="<?php echo esc_url(home_url('/chinh-sach-van-chuyen')); ?>" class="list-link">Chính sách vận chuyển giao nhận</a></li>
              <li class="list-item"><a href="<?php echo esc_url(home_url('/hinh-thuc-thanh-toan')); ?>" class="list-link">Quy định và hình thức thanh toán</a></li>
              <li class="list-item"><a href="<?php echo esc_url(home_url('/hoi-dap')); ?>" class="list-link">Hỏi đáp</a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-4">
            <ul class="list">
              <li class="list-title">Liên hệ</li>
              <li class="list-item">Địa chỉ: Annie Cosmetic, 407 Phạm Văn Chiêu, Phường 14, Gò Vấp, TP.Hồ Chí Minh</li>
              <li class="list-item">Tel: <a href="tel:081 904 6668">081 904 6668</a></li>
              <li class="list-item">Mail: <a href="mailto:contact@anniecosmetic.vn">contact@anniecosmetic.vn</a></li>
              <li class="list-item mt-2">
                <a href="#">
                  <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/facebook-ico.png'); ?>" height="35" style="border-radius: 10px">
                </a>
                <a href="#">
                  <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/instagram-ico.png'); ?>" height="35" style="border-radius: 10px">
                </a>
                <a href="#">
                  <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/zalo-ico.png'); ?>" height="35" style="border-radius: 10px">
                </a>
                <a href="#">
                  <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/shopee-ico.png'); ?>" height="35" style="border-radius: 10px">
                </a>
                <a href="#">
                  <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/youtube-ico.png'); ?>" height="35" style="border-radius: 10px">
                </a>
              </li>
              <li class="list-item" style='display:none'>
                <a href="#">
                  <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/bocongthuong.png'); ?>" alt="Đã thông báo bộ công thương" height="50">
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="mr-1">
          <div class="d-none d-lg-inline mr-1">Đơn vị vận chuyển</div>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/transportations/giaohangtietkiem.jpg'); ?>">
          Giấy phép ĐKKD số: 01255884598 cấp ngày 08/11/2017 tại Sở Kế Hoạch và Đầu tư TP. Hồ Chí Minh
        </div>
        <div class="text-md-right">
          <div class="d-none d-lg-inline mr-1">Phương thức thanh toán</div>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/transactions/tienmat.png'); ?>">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/transactions/sacombank.jpg'); ?>">
        </div>
      </div>
    </footer>
  </div><!-- #mainContainer -->

  <!-- MOBILE NAVIGATION -->
  <nav id="navToggle" class="scrollbar">
    <div class="top">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/255x59-02.png'); ?>" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
    </div>
    <form class="middle" action="<?php echo esc_url(home_url('/')); ?>" method="get">
      <div class="form-group">
        <div class="input-group">
          <input type="search" class="form-control" name="s" placeholder="Tìm kiếm" value="<?php echo get_search_query(); ?>">
          <?php if (function_exists('WC')) : ?>
          <input type="hidden" name="post_type" value="product">
          <?php endif; ?>
          <span class="input-group-btn">
            <button type="submit" class="btn btn-default" onclick="open_nav()">
              <svg id="i-search" viewBox="0 0 32 32" width="22" height="22" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                <circle cx="14" cy="14" r="12"></circle>
                <path d="M23 23 L30 30"></path>
              </svg>
            </button>
          </span>
        </div>
      </div>
    </form>
    <div class="bottom">
      <ul class="nav nav-pills nav-justified" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="pill" href="#pillsMenu" role="tab" aria-controls="pillsMenu" aria-selected="true">
            <i class="fa fa-list-ul fa-lg" aria-hidden="true"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="pill" href="#pillsAuth" role="tab" aria-controls="pillsAuth" aria-selected="true">
            <i class="fa fa-user-circle-o fa-lg" aria-hidden="true"></i>
          </a>
        </li>
        <li class="nav-item close-nav">
          <a class="nav-link" onclick="close_nav()">
            <svg id="i-close" viewBox="0 0 32 32" width="15" height="15" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5">
              <path d="M2 30 L30 2 M30 30 L2 2"></path>
            </svg>
          </a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="pillsMenu" role="tabpanel">
          <div class="item single">
            <a href="<?php echo esc_url(home_url('/')); ?>">
              <i class="fa fa-angle-right" aria-hidden="true"></i> Trang chủ
            </a>
          </div>
          <div class="item single">
            <a href="<?php echo esc_url(home_url('/hot')); ?>">
              <i class="fa fa-angle-right" aria-hidden="true"></i> Hot
            </a>
          </div>
          <?php 
          $categories = anniecosmetic_get_product_categories();
          if (!empty($categories)) :
            foreach ($categories as $category) : 
          ?>
          <div class="item">
            <a href="<?php echo esc_url(get_term_link($category)); ?>" aria-expanded="false" class="collapsed">
              <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo esc_html($category->name); ?>
            </a>
          </div>
          <?php 
            endforeach;
          endif;
          
          $brands = anniecosmetic_get_product_brands();
          if (!empty($brands)) :
            foreach ($brands as $brand) : 
          ?>
          <div class="item">
            <a href="<?php echo esc_url(get_term_link($brand)); ?>" aria-expanded="false" class="collapsed">
              <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo esc_html($brand->name); ?>
            </a>
          </div>
          <?php 
            endforeach;
          endif;
          ?>
        </div>
        <div class="tab-pane fade" id="pillsAuth" role="tabpanel">
          <?php if (!is_user_logged_in()) : ?>
          <div class="item single">
            <a href="<?php echo esc_url(wp_login_url()); ?>">
              <i class="fa fa-angle-right" aria-hidden="true"></i> Đăng nhập
            </a>
          </div>
          <div class="item single">
            <a href="<?php echo esc_url(wp_registration_url()); ?>">
              <i class="fa fa-angle-right" aria-hidden="true"></i> Đăng ký
            </a>
          </div>
          <?php else : ?>
          <div class="item single">
            <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">
              <i class="fa fa-angle-right" aria-hidden="true"></i> Thoát tài khoản
            </a>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <!-- Fixed Support Box -->
  <div class="fixedbox" id="supportion">
    <a href="<?php echo esc_url(home_url('/dich-vu')); ?>" class="fixed-item mb-3">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/support-ico.png'); ?>">
      DỊCH VỤ
    </a>
    <a href="<?php echo esc_url(home_url('/lien-he')); ?>" class="fixed-item">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/contact-ico.png'); ?>">
      LIÊN HỆ
    </a>
  </div>
  <div class="fixedbox" id="position">
    <div class="fixed-item mt-4 d-none d-md-block">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/scrolltotop.png'); ?>" onclick="scroll_top()">
    </div>
  </div>

  <?php wp_footer(); ?>
</body>
</html>
