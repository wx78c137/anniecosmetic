from django.shortcuts import render, redirect, get_object_or_404
from django.contrib.auth import login, authenticate, logout
from .models import *
from django.contrib.auth.forms import UserCreationForm, AuthenticationForm
from .forms import cartForm, AddressForm
from .cart import Cart
from django.conf import settings
from django.core.paginator import Paginator


# Create your views here.


def index(request):
    banners = Banner.objects.all()
    sale_products = Product.objects.filter(is_on_sale=True)[:10]
    best_products = Product.objects.filter(is_best_product=True)[:10]
    new_products = Product.objects.filter(is_new_product=True)[:10]
    return render(request, 'annieapp/index.html', {'banners': banners, 'sale_products': sale_products, 'best_products': best_products, 'new_products': new_products})

# PRODUCT


def product_detail(request, id):
    # Call cart class to create session
    cart = Cart(request)
    #
    # get same product
    product = get_object_or_404(Product, id=id)
    same_products = Product.objects.filter(category=product.category)[:10]
    #
    # Find product version
    options = Options.objects.filter(product=product)
    choices = []
    for option in options:
        choices.append({'name': option.name, 'id': option.id})
    #
    if request.method == 'POST':
        print(request.POST)
        form = cartForm(request.POST)
        # Buy
        if 'buy' in request.POST:
            if len(choices) == 1:
                product_version_id = choices[0]['id']
            else:
                product_version_id = request.POST['version_id']
            product_version = get_object_or_404(Options, id=product_version_id)
            cart.add(product_version, quantity=int(request.POST['quantity']))
            return redirect('cart')
        #
        # Add to cart
        elif form.is_valid():
            if len(choices) == 1:
                product_version_id = choices[0]['id']
            else:
                product_version_id = request.POST['version_id']
            product_version = get_object_or_404(Options, id=product_version_id)
            cart.add(product_version, quantity=int(
                form.cleaned_data['quantity']))
            return redirect(request.path)
        #
    else:
        if len(choices) == 1:
            choices = []
        form = cartForm()
    return render(request, 'annieapp/product_detail.html', {'product': product, 'same_products': same_products, 'form': form, 'choices': choices})

# AUTH


def register(request):
    page_name = "Đăng ký"
    if request.user.is_authenticated:
        return redirect('index')
    if request.method == 'POST':
        form = UserCreationForm(request.POST)
        if form.is_valid():
            form.save()
            username = form.cleaned_data.get('username')
            raw_password = form.cleaned_data.get('password1')
            user = authenticate(username=username, password=raw_password)
            login(request, user)
            return redirect('index')
    else:
        form = UserCreationForm()
        form.fields['username'].label = "Họ tên"
        form.fields['password1'].label = "Mật khẩu"
        form.fields['password2'].label = "Nhập lại Mật khẩu"
    return render(request, 'annieapp/register.html', {'form': form, 'page_name': page_name})


def loginview(request):
    page_name = "Đăng Nhập"
    if request.user.is_authenticated:
        return redirect('index')
    if request.method == "POST":
        form = AuthenticationForm(request, data=request.POST)
        if form.is_valid():
            username, password = form.cleaned_data['username'], form.cleaned_data['password']
            user = authenticate(username=username, password=password)
            if user is not None and user.is_active:
                login(request, user)
                return redirect('index')
        else:
            form.add_error(None, "Your user is inactive.")
    else:
        form = AuthenticationForm()
        form.fields['username'].label = "Tên đăng nhập"
        form.fields['password'].label = "Mật khẩu"
    return render(request, 'annieapp/register.html', {'form': form, 'page_name': page_name})


def logoutview(request):
    logout(request)
    return redirect('index')

def history(request):
    if request.user.is_authenticated:
        orders = Order.objects.filter(user = request.user)
        return render(request ,'annieapp/history.html', {'orders': orders})
    else:
        return redirect('login')
# END AUTH

# CART


def update_cart_product(request, id):
    cart = Cart(request)
    product_version = get_object_or_404(Options, id=id)
    if request.method == 'POST':
        form = cartForm(request.POST)
        if form.is_valid():
            quantity = form.cleaned_data['quantity']
            quantity = int(quantity)
            cart.add(product_version, quantity=quantity,
                     update_quantity=quantity)
            return redirect('cart')


def get_cart(request):
    cart = Cart(request)
    cart_len = cart.__len__()
    form = cartForm()
    return render(request, 'annieapp/cart.html', {'cart': cart, 'cart_len': cart_len, 'form': form})


def remove_cart_product(request, id):
    cart = Cart(request)
    product_version = get_object_or_404(Options, id=id)
    cart.remove(product_version)
    return redirect('cart')


def checkout_address(request):
    if request.method == 'POST':
        cart = Cart(request)
        form = AddressForm(request.POST)
        if form.is_valid():
            order = form.save()
            if request.user.is_authenticated:
                order.user = request.user
                order.save()
            for item in cart:
                OrderItem.objects.create(
                    order=order,
                    product_version=item['product_version'],
                    price=item['price'],
                    quantity=item['quantity']
                )
            cart.clear()
            return redirect('order', id=order.id)
    else:
        form = AddressForm()
    return render(request, 'annieapp/address.html', {'form': form})


def checkout_success(request, id):
    order = get_object_or_404(Order, id=id)
    order_items = OrderItem.objects.filter(order=order)
    return render(request, 'annieapp/order_success.html', {'order': order, 'order_items': order_items})
# END CART

# Filter


def get_hot_product(request):
    page_name = "Sản phẩm bán chạy"
    products = Product.objects.filter(is_best_product=True)
    paginator = Paginator(products, 25)  # Show 25 contacts per page.
    page_number = request.GET.get('page')
    page_obj = paginator.get_page(page_number)
    return render(request, 'annieapp/product_filter.html', {'products': products, 'page_name': page_name, 'page_obj': page_obj})


def get_new_product(request):
    page_name = "Sản phẩm mới"
    products = Product.objects.filter(is_new_product=True)
    paginator = Paginator(products, 25)  # Show 25 contacts per page.
    page_number = request.GET.get('page')
    page_obj = paginator.get_page(page_number)
    return render(request, 'annieapp/product_filter.html', {'products': products, 'page_name': page_name, 'page_obj': page_obj})


def get_sale_product(request):
    page_name = "Sản phẩm sale"
    products = Product.objects.filter(is_on_sale=True)
    paginator = Paginator(products, 25)  # Show 25 contacts per page.
    page_number = request.GET.get('page')
    page_obj = paginator.get_page(page_number)
    return render(request, 'annieapp/product_filter.html', {'products': products, 'page_name': page_name, 'page_obj': page_obj})


def get_product_category(request, id):
    category = get_object_or_404(Category, id=id)
    products = Product.objects.filter(category=category)
    paginator = Paginator(products, 25)  # Show 25 contacts per page.
    page_number = request.GET.get('page')
    page_obj = paginator.get_page(page_number)
    return render(request, 'annieapp/product_filter.html', {'products': products, 'category': category, 'page_obj': page_obj})


def get_product_brand(request, id):
    brand = get_object_or_404(Brand, id=id)
    products = Product.objects.filter(brand=brand)
    paginator = Paginator(products, 25)  # Show 25 contacts per page.
    page_number = request.GET.get('page')
    page_obj = paginator.get_page(page_number)
    return render(request, 'annieapp/product_filter.html', {'products': products, 'brand': brand, 'page_obj': page_obj})
# OTHER


def dich_vu(request):
    return render(request, 'annieapp/dich-vu.html')


def search(request):
    if request.method == 'POST':
        page_name = 'Tìm kiếm'
        keyword = request.POST['keywords']
        products = Product.objects.filter(name__contains=keyword)
        paginator = Paginator(products, 25)  # Show 25 contacts per page.
        page_number = request.GET.get('page')
        page_obj = paginator.get_page(page_number)
        return render(request, 'annieapp/product_filter.html', {'products': products, 'page_obj': page_obj, 'page_name': page_name})
