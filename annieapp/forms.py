from django import forms
from .models import Order, Options

# creating a form


class cartForm(forms.Form):
    quantity = forms.CharField()


class AddressForm(forms.ModelForm):
	type = forms.ChoiceField(choices=[('Home','Nhà riêng/Chung cư'), ('Company','Cơ quan/Công ty')], widget=forms.RadioSelect())
	class Meta:
		model = Order
		fields = ['name', 'phone_number', 'address', 'type', 'email']
