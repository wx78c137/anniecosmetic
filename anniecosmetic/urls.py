"""anniecosmetic URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/3.0/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.contrib import admin
from django.urls import path, include
from annieapp import views
from django.conf import settings
from django.conf.urls.static import static
from django.contrib.staticfiles.urls import staticfiles_urlpatterns
from rest_framework import routers

router = routers.DefaultRouter()
router.register(r'orders', views.OrderViewSet)
router.register(r'users', views.UserViewSet)

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', views.index,name='index'),
    path('accounts/register', views.register),
    path('accounts/login', views.loginview, name='login'),
    path('accounts/logout', views.logoutview),
    path('accounts/history', views.history),
    path('social-auth/', include('social_django.urls', namespace="social")),
    path('checkout/cart', views.get_cart,name='cart'),
    path('checkout/remove/<int:id>', views.remove_cart_product),
    path('checkout/update/<int:id>', views.update_cart_product),
    path('checkout/address', views.checkout_address),
    path('checkout/success/<int:id>', views.checkout_success, name='order'),
    path('products/<int:id>', views.product_detail),
    path('products/hot', views.get_hot_product),
    path('products/new', views.get_new_product),
    path('products/sale', views.get_sale_product),
    path('page/dich-vu', views.dich_vu),
    path('categories/<int:id>', views.get_product_category),
    path('brands/<int:id>', views.get_product_brand),
    path('search', views.search),
    path('api/', include(router.urls)),
    path('api-auth/', include('rest_framework.urls', namespace='rest_framework')),
    path('api/login', views.api_login)

]
urlpatterns += staticfiles_urlpatterns()
if settings.DEBUG: # new
    urlpatterns += static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)
