(function(factory){if(typeof define==="function"&&define.amd){define(["jquery","../jquery.validate"],factory);}else if(typeof module==="object"&&module.exports){module.exports=factory(require("jquery"));}else{factory(jQuery);}}(function($){$.extend($.validator.messages,{required:"Vui lòng không bỏ trống thông tin này.",remote:"Thông tin không đúng định dạng.",email:"Vui lòng nhập vào một địa chỉ email.",url:"Vui lòng nhập vào một địa chỉ url.",date:"Vui lòng chọn một ngày cụ thể.",dateISO:"Vui lòng chọn một ngày cụ thể (ISO).",number:"Vui lòng nhập vào một số.",digits:"Vui lòng nhập vào một chữ số.",creditcard:"Vui lòng nhập vào số thẻ tín dụng.",equalTo:"Thông tin nhập vào không trùng.",extension:"Phần mở rộng không đúng.",maxlength:$.validator.format("Vui lòng nhập từ {0} kí tự trở xuống."),minlength:$.validator.format("Vui lòng nhập từ {0} kí tự trở lên."),rangelength:$.validator.format("Vui lòng nhập từ {0} đến {1} kí tự."),range:$.validator.format("Vui lòng nhập từ {0} đến {1}."),max:$.validator.format("Vui lòng nhập từ {0} trở xuống."),min:$.validator.format("Vui lòng nhập từ {0} trở lên.")});return $;}));