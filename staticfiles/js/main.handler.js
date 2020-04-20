function open_nav() {
    $("#navToggle").addClass("open");
    $("#viewport").addClass("slide");
    $(".overlay").addClass("show");
}

function close_nav() {
    $("#navToggle").removeClass("open");
    $("#viewport").removeClass("slide");
    $(".overlay").removeClass("show");
}
var scroll_top = function() {
    $("html, body").animate({
        scrollTop: 0
    }, "slow");
};
var quantity_add = function(event,max = 0) {
	if(max == 0){
	    var control = $(event.target).parents(".custom-number").find("input");
	    if (control.val() < 1) control.val(1);
	    else
	        control.val(parseInt(control.val()) + 1);
          console.log('plus plus');
	}else{
		var control = $(event.target).parents(".custom-number").find("input");
	    if (control.val() < 1){
	    	control.val(1);
	    }else if(control.val() >= 2){
	    	control.val(2);
	    	swal('Lỗi!', 'Bạn không được mua quá 2 sản phẩm cho sản phẩm khuyến mãi này.', 'error');
	    }else{
	        control.val(parseInt(control.val()) + 1);
	    }
	}
};
var quantity_sub = function(event) {
    var control = $(event.target).parents(".custom-number").find("input");
    if (control.val() > 1) control.val(parseInt(control.val()) - 1);
    else
        control.val(1);
};
var upload_img_preview = function(event) {
    var files = event.target.files;
    var file = files[0];
    var size = file.size;
    if (file) {
        if (size > 2097152) {
            toastr.error("<strong>Lỗi</strong><br/>Dung lượng ảnh vượt quá kích thước cho phép (2MB).");
            $(event.target).val("");
            $(event.target).parents(".image-preview").find("img").removeAttr("src");
        } else {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(event.target).parents(".image-preview").find("img").attr("src", e.target.result);
            };
            reader.readAsDataURL(file);
        }
    }
}
var remove_file = function(event) {
    $(event.target).parents(".custom-image-upload").find("img.img-preview").removeAttr("src");
    $(event.target).parents(".custom-image-upload").find("input[type=file]").val("");
}
$(document).ready(function() {
    $("#check-all").on("change", function() {
        if ($(this).prop('checked') == true) {
            $(".table input[type=checkbox]").prop("checked", true);
        } else {
            $(".table input[type=checkbox]").prop("checked", false);
        }
    });
});

function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
};
var make_money_format = function(event) {
    var val = event.target.value;
    if (val != "") val = number_format(val);
    $(event.target).val(val);
};

function convertToSlug(str) {
    str = str.replace(/^\s+|\s+$/g, '');
    str = str.toLowerCase();
    var from = "äàáảãạăằắẳẵặâầấẩẫậđèéẻẽẹêềếểễệëìíỉĩịòóỏõọôồốổỗộơờớởỡợưỳýỷỹỵùúủũụưừứửữựïîöñç·/_,:;";
    var to = "aaaaaaaaaaaaaaaaaadeeeeeeeeeeeeiiiiiooooooooooooooooouyyyyyuuuuuuuuuuuiionc------";
    for (var i = 0, l = from.length; i < l; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }
    str = str.replace(/[^a-z0-9 -]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
    return str;
}
$(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
$(document).ready(function() {
    $(".dropdown-hover").hover(function() {
        $(this).find(".dropdown-menu").addClass("show");
    }, function() {
        $(this).find(".dropdown-menu").removeClass("show");
    });
});
