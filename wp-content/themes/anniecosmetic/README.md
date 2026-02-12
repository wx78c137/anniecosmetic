# Annie Cosmetic WordPress Theme

Theme WordPress chuyên nghiệp cho website bán mỹ phẩm Annie Cosmetic, được chuyển đổi từ HTML sang WordPress bằng Cursor.

## Tính năng

- **Responsive Design**: Tương thích hoàn hảo với mọi thiết bị (Desktop, Tablet, Mobile)
- **WooCommerce Ready**: Hỗ trợ đầy đủ WooCommerce để bán hàng online
- **SEO Friendly**: Tối ưu hóa SEO với meta tags và structure data
- **Fast Loading**: Tối ưu hóa tốc độ tải trang
- **Custom Widgets**: Hỗ trợ widget areas cho sidebar và footer
- **Product Sections**: 
  - Sản phẩm khuyến mãi
  - Sản phẩm bán chạy
  - Sản phẩm mới về
- **Navigation Menus**: Menu desktop và mobile riêng biệt
- **Social Media Integration**: Tích hợp các mạng xã hội
- **Google Analytics**: Tích hợp sẵn Google Analytics và Tag Manager

## Yêu cầu

- WordPress 5.0 trở lên
- PHP 7.2 trở lên
- WooCommerce 4.0 trở lên (khuyến nghị)

## Cài đặt

### Cách 1: Upload qua WordPress Admin

1. Đăng nhập vào WordPress Admin
2. Vào **Giao diện > Themes > Thêm mới**
3. Click **Upload Theme**
4. Chọn file ZIP của theme
5. Click **Cài đặt ngay**
6. Kích hoạt theme

### Cách 2: Upload qua FTP

1. Giải nén file ZIP
2. Upload thư mục `anniecosmetic` vào `/wp-content/themes/`
3. Đăng nhập WordPress Admin
4. Vào **Giao diện > Themes**
5. Kích hoạt theme **Annie Cosmetic**

## Cấu trúc thư mục

```
anniecosmetic/
├── assets/
│   ├── css/           # CSS files
│   ├── js/            # JavaScript files
│   ├── images/        # Theme images
│   └── libs/          # Third-party libraries
├── 404.php            # 404 error page
├── archive.php        # Archive page template
├── footer.php         # Footer template
├── functions.php      # Theme functions
├── header.php         # Header template
├── index.php          # Main template (Homepage)
├── page.php           # Page template
├── search.php         # Search results template
├── sidebar.php        # Sidebar template
├── single.php         # Single post template
├── style.css          # Theme stylesheet (required)
└── README.md          # This file
```

## Cấu hình

### 1. Cài đặt assets (CSS, JS, Images)

Theme sử dụng các file assets từ thư mục `assets/`. Bạn cần copy các file từ project Django cũ:

```bash
# Copy từ Django static files
cp -r /path/to/django/static/* wp-content/themes/anniecosmetic/assets/
```

Cấu trúc assets cần có:

```
assets/
├── css/
│   ├── mobilebar.css
│   └── style.css
├── js/
│   ├── countdown.handler.js
│   ├── custom.js
│   ├── main.handler.js
│   └── product-slider.handler.js
├── images/
│   ├── 255x59-02.png          # Logo
│   ├── favicon.ico
│   ├── cart-icon.png
│   ├── status-ico/            # Social icons
│   ├── transportations/       # Shipping icons
│   └── transactions/          # Payment icons
└── libs/
    ├── bootstrap/
    ├── jquery/
    ├── owl-carousel/
    ├── sweetalert/
    └── ... (other libraries)
```

### 2. Cài đặt WooCommerce

1. Cài đặt plugin **WooCommerce**
2. Làm theo wizard để thiết lập store
3. Thêm sản phẩm vào catalog

### 3. Tạo Custom Taxonomy cho Brands (Thương hiệu)

Thêm code sau vào `functions.php` hoặc tạo plugin riêng:

```php
// Register Product Brand Taxonomy
function anniecosmetic_register_brand_taxonomy() {
    register_taxonomy('product_brand', 'product', array(
        'labels' => array(
            'name' => 'Thương hiệu',
            'singular_name' => 'Thương hiệu',
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'brand'),
    ));
}
add_action('init', 'anniecosmetic_register_brand_taxonomy');
```

### 4. Tạo Custom Post Type cho Banners

```php
// Register Banner Post Type
function anniecosmetic_register_banner_post_type() {
    register_post_type('banner', array(
        'labels' => array(
            'name' => 'Banners',
            'singular_name' => 'Banner',
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'thumbnail'),
        'menu_icon' => 'dashicons-images-alt2',
    ));
}
add_action('init', 'anniecosmetic_register_banner_post_type');
```

### 5. Cấu hình Menu

1. Vào **Giao diện > Menus**
2. Tạo menu mới
3. Gán vào vị trí **Primary Menu** hoặc **Mobile Menu**

### 6. Cấu hình Widgets

1. Vào **Giao diện > Widgets**
2. Thêm widgets vào các vùng:
   - Sidebar
   - Footer 1, Footer 2, Footer 3

### 7. Thiết lập trang tĩnh

1. Vào **Cài đặt > Đọc**
2. Chọn **Một trang tĩnh**
3. Chọn trang cho **Homepage**

## Chuyển đổi dữ liệu từ Django

### Products (Sản phẩm)

Bạn cần export data từ Django database và import vào WooCommerce. Có thể sử dụng:

1. **WP All Import** plugin
2. **WooCommerce CSV Import**
3. Custom migration script

### Users (Người dùng)

Export users từ Django và import vào WordPress:

```bash
# Export từ Django
python manage.py dumpdata auth.user > users.json

# Convert và import vào WordPress
# (Cần custom script để convert format)
```

## Hỗ trợ Google Analytics

Theme đã tích hợp sẵn:

- Google Analytics (ID: G-DZ7XW76CQ3)
- Google Tag Manager (ID: GTM-TR3WC25)
- Harafunnel widget

Để thay đổi tracking ID, edit trong `functions.php`:

```php
// Line 108-115: Google Analytics
// Line 121-131: Google Tag Manager
```

## Tối ưu hóa

### Caching

Khuyến nghị cài đặt plugin:
- WP Super Cache hoặc W3 Total Cache
- Autoptimize (minify CSS/JS)

### CDN

Cân nhắc sử dụng CDN cho assets:
- Cloudflare
- Amazon CloudFront

### Images

Sử dụng plugin tối ưu hình ảnh:
- Smush
- EWWW Image Optimizer

## Troubleshooting

### Theme không hiển thị đúng

1. Kiểm tra assets đã được copy đầy đủ
2. Clear cache (browser + WordPress)
3. Kiểm tra file permissions (755 for folders, 644 for files)

### WooCommerce không hoạt động

1. Đảm bảo WooCommerce plugin đã được kích hoạt
2. Vào **WooCommerce > Status** để kiểm tra errors
3. Re-save permalink settings: **Cài đặt > Permalinks**

### Menu không hiển thị

1. Tạo menu tại **Giao diện > Menus**
2. Gán menu vào location
3. Clear cache

## Changelog

### Version 1.0.0 (2026-02-12)
- Initial release
- Converted from HTML to WordPress theme
- Full WooCommerce support
- Responsive design
- SEO optimized

## Credits

- **Original Design**: Annie Cosmetic Team
- **Theme Development**: Converted using Cursor AI
- **Bootstrap**: v4.0.0
- **jQuery**: v3.3.1
- **Owl Carousel**: v2.2.1
- **Font Awesome**: v4.7.0

## License

This theme is licensed under GNU General Public License v2 or later.

## Support

Để được hỗ trợ, vui lòng liên hệ:

- Email: contact@anniecosmetic.vn
- Phone: 081 904 6668
- Website: http://anniecosmetic.vn
