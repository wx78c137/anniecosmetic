from .models import Category, Brand
from .cart import Cart


def get_categories(request):
    categories = Category.objects.all()
    return {'categories': categories}


def get_brands(request):
    brands = Brand.objects.all()
    return {'brands': brands}


def get_cart_len(request):
    cart = Cart(request)
    cart_len = len(cart)
    return {'cart_len': cart_len}
