from django import template
from annieapp.cart import Cart

register = template.Library()


@register.filter
def percent_cal(val1, val2):
    final_price = (100 - val1) * (val2 / 100)
    return int(final_price)


@register.filter
def thousand_seperator(val):
    val = int(val)
    return format(val, ',d').replace(",", ".")

@register.filter
def get_cart_len(request):
    cart = Cart(request)
    return len(cart)
