from decimal import Decimal
from django.conf import settings
from .models import Product, Options
# https://github.com/muvatech/Shopping-Cart-Using-Django-2.0-and-Python-3.6

class Cart(object):
    def __init__(self, request):
        self.session = request.session
        cart = self.session.get(settings.CART_SESSION_ID)
        if not cart:
            cart = self.session[settings.CART_SESSION_ID] = {}
        self.cart = cart

    def add(self, product_version, quantity=1, update_quantity=False):
        product_version_id = str(product_version.id)
        if product_version_id not in self.cart:
            self.cart[product_version_id] = {'quantity': 0, 'price': str(product_version.product.price)}
        if update_quantity:
            self.cart[product_version_id]['quantity'] = quantity
        else:
            self.cart[product_version_id]['quantity'] += quantity
        self.save()

    def save(self):
        self.session[settings.CART_SESSION_ID] = self.cart
        self.session.modified = True

    def remove(self, product_version):
        product_version_id = str(product_version.id)
        if product_version_id in self.cart:
            del self.cart[product_version_id]
            self.save()

    def __iter__(self):
        product_version_ids = self.cart.keys()
        product_versions = Options.objects.filter(id__in=product_version_ids)
        for product_version in product_versions:
            self.cart[str(product_version.id)]['product_version'] = product_version

        for item in self.cart.values():
            item['price'] = Decimal(item['price'])
            item['total_price'] = item['price'] * item['quantity']
            yield item

    def __len__(self):
        return sum(int(item['quantity']) for item in self.cart.values())

    def get_total_price(self):
        return sum(Decimal(item['price']) * item['quantity'] for item in self.cart.values())

    def clear(self):
        del self.session[settings.CART_SESSION_ID]
        self.session.modified = True
