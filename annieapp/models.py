from django.db import models
from django import forms
from image_cropping import ImageRatioField
from django.db.models.signals import post_save, post_delete
from django.dispatch import receiver
from django.contrib.auth.models import User
import random
import string
from .sendgrid_email import order_notice
# Create your models here.


class Banner(models.Model):
    name = models.CharField(
        max_length=50)
    banner_img = models.ImageField(upload_to='images/')
    cropping = ImageRatioField('banner_img', '1920x808')

    def __str__(self):
        return self.name


class Category(models.Model):
    name = models.CharField(
        max_length=50, verbose_name='Tên nhóm sản phẩm (Category)')
    category_img = models.ImageField(upload_to='images/', null=True)

    class Meta:
        verbose_name = 'Nhóm sản phẩm'
        verbose_name_plural = 'Nhóm sản phẩm'

    def __str__(self):
        return self.name


class Brand(models.Model):
    name = models.CharField(
        max_length=50, verbose_name='Tên thương hiệu (Brand)')
    brand_img = models.ImageField(upload_to='images/', null=True)

    class Meta:
        verbose_name = 'Thương hiệu'
        verbose_name_plural = 'Thương hiệu'

    def __str__(self):
        return self.name


class Product(models.Model):
    name = models.CharField(max_length=50, verbose_name='Tên sản phẩm')
    price = models.IntegerField(null=True)
    sale_off = models.IntegerField(
        default=0, help_text='Chữ số, không có dấu %', verbose_name='Giảm giá')
    stock_price = models.IntegerField(default=0, verbose_name='Giá gốc')
    is_new_product = models.BooleanField(
        default=False, verbose_name='Sản phẩm mới')
    is_best_product = models.BooleanField(
        default=False, verbose_name='Sản phẩm bán chạy')
    is_on_sale = models.BooleanField(
        default=False, verbose_name='Sản phẩm sale')
    product_img1 = models.ImageField(verbose_name='Ảnh sản phẩm 1',
                                     upload_to='images/', help_text='(Lưu ý: Ảnh này là ảnh đại diện sản phẩm ngoài trang chủ)')
    cropping_img_1 = ImageRatioField(
        'product_img1', '600x600', verbose_name='Chỉnh sửa')
    product_img2 = models.ImageField(verbose_name='Ảnh sản phẩm 2', null=True, blank=True,
                                     upload_to='images/')
    cropping_img_2 = ImageRatioField(
        'product_img2', '600x600', verbose_name='Chỉnh sửa')
    product_img3 = models.ImageField(verbose_name='Ảnh sản phẩm 3', null=True, blank=True,
                                     upload_to='images/')
    cropping_img_3 = ImageRatioField(
        'product_img3', '600x600', verbose_name='Chỉnh sửa')
    product_detail = models.ImageField(verbose_name='Ảnh chi tiết sản phẩm', null=True, blank=True,
                                       upload_to='images/', help_text='Ảnh và chữ được tạo trong photoshop, chiều ngang 1000, không giới hạn chiều dài')
    brand = models.ForeignKey(
        Brand, on_delete=models.CASCADE, help_text="Nếu chưa có nhấn dấu + để tạo", verbose_name='Thương hiệu (Brand)')
    category = models.ForeignKey(
        Category, on_delete=models.CASCADE, help_text="Nếu chưa có nhấn dấu + để tạo", verbose_name='Phân loại sản phẩm (Category)')

    class Meta:
        verbose_name = 'Sản phẩm'
        verbose_name_plural = 'Sản phẩm'

    def __str__(self):
        return self.name

    def save(self, *args, **kwargs):
        after_sale = (100 - int(self.sale_off)) * self.stock_price / 100
        self.price = round(after_sale, -3)
        super().save(*args, **kwargs)

    def get_price(self):
        price = self.price
        return format(int(price), ',d').replace(",", ".") + ' đ'


class Options(models.Model):
    name = models.CharField(verbose_name='Màu sắc, lựa chọn', max_length=60)
    product = models.ForeignKey(Product, on_delete=models.CASCADE)

    def __str__(self):
        if self.name == 'none':
            return self.product.name
        name = self.product.name + ' + Tùy chọn: ' + self.name
        return name

    def get_product_name(self):
        return self.product.name


class Order(models.Model):
    order_code = models.CharField(
        verbose_name='Mã đơn hàng', max_length=30, null=True, blank=True)
    user = models.ForeignKey(User, blank=True, null=True,
                             on_delete=models.DO_NOTHING, verbose_name='Thành viên')
    name = models.CharField(verbose_name='Tên khách hàng', max_length=60)
    email = models.EmailField()
    address = models.CharField(verbose_name='Địa chỉ', max_length=150)
    type = models.CharField(verbose_name='Dạng', max_length=60)
    phone_number = models.CharField(
        verbose_name='Số điện thoại', max_length=100, help_text='Gọi điện để xác nhận đơn hàng')
    created = models.DateTimeField(
        verbose_name='Được tạo lúc', auto_now_add=True)
    updated = models.DateTimeField(verbose_name='Chỉnh sửa lúc', auto_now=True)
    confirm = models.BooleanField(verbose_name='Đã xác nhận', default=False)
    paid = models.BooleanField(verbose_name='Đã thanh toán', default=False)

    class Meta:
        ordering = ('-created', )
        verbose_name = 'Đơn hàng'
        verbose_name_plural = 'Đơn hàng'

    def randomString(self, stringLength=10):
        """Generate a random string of fixed length """
        letters = ''.join((string.ascii_uppercase, string.digits))
        return ''.join(random.choice(letters) for i in range(stringLength))

    def save(self, *args, **kwargs):
        if not self.order_code:
            random_string = self.randomString()
            self.order_code = random_string
            super().save(*args, **kwargs)
        else:
            super().save(*args, **kwargs)

    def __str__(self):
        return 'Order {}'.format(self.id)

    def custom_name(self):
        return "Đơn hàng {}".format(self.id)

    def get_total_cost(self):
        return sum(item.get_cost() for item in self.items.all())

    def total_cost(self):
        total = sum(item.get_cost() for item in self.items.all())
        return format(int(total), ',d').replace(",", ".") + ' đ'

    def get_order_user(self):
        return self.user
    get_order_user.short_description = 'Thành viên'
    total_cost.short_description = 'Tổng tiền'


class OrderItem(models.Model):
    order = models.ForeignKey(
        Order, related_name='items', on_delete=models.CASCADE,)
    product_version = models.ForeignKey(
        Options, related_name='order_items', on_delete=models.CASCADE, null=True, verbose_name='Tên sản phẩm')
    price = models.DecimalField(
        max_digits=10, decimal_places=2, verbose_name='Giá tiền')
    quantity = models.PositiveIntegerField(default=1, verbose_name='Số lượng')

    def __str__(self):
        return '{}'.format(self.product_version.product.name)

    def get_price(self):
        if self.price:
            vnd_price = format(int(self.price), ',d').replace(",", ".") + ' đ'
            return vnd_price
    get_price.short_description = "Giá từng sản phẩm"

    def get_cost(self):
        return self.price * self.quantity

    def get_option_name(self):
        return self.product_version.name

    def get_product_name(self):
        return self.product_version.get_product_name()


@receiver(post_save, sender=Product, dispatch_uid="create_options")
def create_options(sender, instance, **kwargs):
    options = Options.objects.filter(product=instance)
    if not options:
        option = Options(name='none', product=instance)
        option.save()


@receiver(post_save,  sender=Order, dispatch_uid='create_orders')
def after_order_save(sender, instance, created, **kwargs):
    if created:
        emails = ['vuhoang17891@gmail.com', ]
        staff = User.objects.filter(is_staff=True)
        for p_staff in staff:
            emails.append(p_staff.email)
        order_notice(instance, emails)


def randomString(stringLength=10):
    """Generate a random string of fixed length """
    letters = string.ascii_lowercase
    return ''.join(random.choice(letters) for i in range(stringLength))
