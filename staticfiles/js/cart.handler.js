var prev_val = 0;

function prev_value(event)
{
	var target = $(event.target);
	return prev_val = target.parents("tr").find("input[name=quantity]").val();
}

function update_cart(event,max = 0)
{
	var target = $(event.target);
	if(target.parents("tr").find("input[name=quantity]").val() > 2){
    	swal('Lỗi!', 'Bạn không được mua quá 2 sản phẩm cho sản phẩm khuyến mãi này.', 'error');
    }else{
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $.ajax({
	        url : base_url + '/checkout/cart/update',
	        data : {
	            rowId: target.parents("tr").find("input[name=rowId]").val(),
	            qty: target.parents("tr").find("input[name=quantity]").val()
	        },
	        type : 'POST',
	        success : function (data) {
	            $(".data-cart-count").html(data.count);
	            $(".data-cart-subtotal").html(data.subtotal);
	            $(".data-cart-discount").html(data.discount);
	            $(".data-cart-total").html(data.total);
	        },
	        error: function (xhr, ajaxOptions, thrownError) {
	            swal('Lỗi!', xhr.responseText, 'error');
	            target.parents("tr").find("input[name=quantity]").val(prev_val);
	        }
	    });
    }
}

function remove_cart_item(event)
{
	var target = $(event.target);
	swal({
		title: 'Bạn có chắc',
		text: "Xóa sản phẩm này khỏi giỏ hàng?",
		type: 'question',
		showCancelButton: true,
		confirmButtonColor: '#d33',
		cancelButtonColor: '#3085d6',
		confirmButtonText: 'Xóa',
		cancelButtonText: 'Bỏ qua'
	}).then(function(isConfirm) {
		if (isConfirm.value) {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url : base_url + '/checkout/cart/remove',
				data : {
					rowId: target.parents("tr").find("input[name=rowId]").val()
				},
				type : 'POST',
				success : function (data) {
					swal(data.title, data.msg, data.alert);
					$(".data-cart-count").html(data.count);
					$(".data-cart-subtotal").html(data.subtotal);
					$(".data-cart-discount").html(data.discount);
					$(".data-cart-total").html(data.total);
					if(data.count > 0) {
						target.parents("tr").remove();
					}else{
						$("#cartNotEmpty").remove();
						$("#cartEmpty").show();
					}					
				},
				error: function (xhr, ajaxOptions, thrownError) {
					swal('Lỗi!', xhr.responseText, 'error');
				}
			});
		}
	});
}

function destroy_cart(event)
{
	var target = $(event.target);
	swal({
		title: 'Bạn có chắc',
		text: "Xóa toàn bộ sản phẩm trong giỏ hàng?",
		type: 'question',
		showCancelButton: true,
		confirmButtonColor: '#d33',
		cancelButtonColor: '#3085d6',
		confirmButtonText: 'Xóa',
		cancelButtonText: 'Bỏ qua'
	}).then(function(isConfirm) {
		if (isConfirm.value) {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url : base_url + '/checkout/cart/destroy',
				type : 'POST',
				success : function (data) {
					swal(data.title, data.msg, data.alert);
					$(".cart-count").html(data.count);
					$(".cart-total").html(data.total);
					$("#cartNotEmpty").remove();
					$("#cartEmpty").show();
				},
				error: function (xhr, ajaxOptions, thrownError) {
					swal('Lỗi!', xhr.responseText, 'error');
				}
			});
		}
	});
}