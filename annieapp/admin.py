from django.contrib import admin
from .models import *
from image_cropping import ImageCroppingMixin
# Register your models here.
admin.site.site_header = "Annie Cosmetic"
admin.site.site_title = 'Quản lý'
admin.site.index_title = 'Quản lý Trang'
class OptionsInline(admin.TabularInline):
    model = Options


class OrderItemInline(admin.TabularInline):
    model = OrderItem
    fields = ['order', 'product_version','get_price', 'quantity']
    readonly_fields=['get_price']


class OrderAdmin(admin.ModelAdmin):
    readonly_fields = ['user', 'order_code']
    list_display = ['order_code', 'name', 'email', 'address',
                    'confirm', 'paid', 'created','get_order_user', 'total_cost']
    list_filter = ['confirm', 'paid', 'created']

    inlines = [OrderItemInline]


class BannerAdmin(ImageCroppingMixin, admin.ModelAdmin):
    pass


@admin.register(Category)
class CategoryAdmin(admin.ModelAdmin):
    pass


class ProductAdmin(ImageCroppingMixin, admin.ModelAdmin):
    readonly_fields = ['price']
    list_display = ['name','category', 'get_price']
    inlines =[OptionsInline]


@admin.register(Brand)
class BrandAdmin(admin.ModelAdmin):
    pass


admin.site.register(Product, ProductAdmin)
admin.site.register(Order, OrderAdmin)
admin.site.register(Banner, BannerAdmin)
