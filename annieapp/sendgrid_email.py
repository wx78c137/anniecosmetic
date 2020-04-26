from django.core.mail import send_mail

def order_notice(instance, emails=[]):
    message ='Bạn có đơn hàng mới \n' 'Mã đơn hàng: ' + instance.order_code + '\n' + 'Vui lòng truy cập trang quản trị để xử lý đơn hàng'
    result = send_mail('Annie Cosmetic Thông báo', message, 'cskh@anniecosmetic.vn', emails)
