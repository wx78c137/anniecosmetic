function countdown_full(event,single=false){
	var target=event.target||event.srcElement;
	var time=$(target).data('countdown');
	var countDownDate=new Date(time).getTime();
	var x=setInterval(function(){
		var now=new Date().getTime();
		var distance=countDownDate-now;
		var days=Math.floor(distance/(1000*60*60*24));
		var hours=Math.floor((distance%(1000*60*60*24))/(1000*60*60));
		var minutes=Math.floor((distance%(1000*60*60))/(1000*60));
		var seconds=Math.floor((distance%(1000*60))/1000);
		if(distance<0){
			clearInterval(x);
			var count="HẾT HẠN";
			target.setAttribute("disabled",true);
			target.removeAttribute("href");
			if(single){
				location.reload();
			}
		}
		else{
			if(hours<10)hours='0'+hours;
			if(minutes<10)minutes='0'+minutes;
			if(seconds<10)seconds='0'+seconds;

			if(days==0&&hours==0&&minutes==0)count=seconds+" giây";
			else if(days==0&&hours==0)count=minutes+" phút "+seconds+" giây";
			else if(days==0)count=hours+" giờ "+minutes+" phút "+seconds+" giây";
			else
				count=days+" ngày "+hours+" giờ "+minutes+" phút "+seconds+" giây";
		}
		target.innerHTML=count;
	}
	,1000);
}
function countdown_compact(event,single=false){
	var target=event.target||event.srcElement;
	var time=$(target).data('countdown');
	var countDownDate=new Date(time).getTime();
	var x=setInterval(function(){
		var now=new Date().getTime();
		var distance=countDownDate-now;
		var days=Math.floor(distance/(1000*60*60*24));
		var hours=Math.floor((distance%(1000*60*60*24))/(1000*60*60));
		var minutes=Math.floor((distance%(1000*60*60))/(1000*60));
		var seconds=Math.floor((distance%(1000*60))/1000);
		if(distance<0){
			clearInterval(x);
			var count="HẾT HẠN";
			target.setAttribute("disabled",true);
			target.removeAttribute("href");
			if(single){
				location.reload();
			}
		}
		else{
			if(hours<10)hours='0'+hours;
			if(minutes<10)minutes='0'+minutes;
			if(seconds<10)seconds='0'+seconds;

			if(days==0&&hours==0&&minutes==0)count=seconds;
			else if(days==0&&hours==0)count=minutes+":"+seconds;
			else if(days==0)count=hours+":"+minutes+":"+seconds;
			else
				count=days+" ngày "+hours+":"+minutes+":"+seconds;
		}
		target.innerHTML=count;
	}
	,1000);
}
function countdown(event,single=false){
	var target=event.target||event.srcElement;
	var time=$(target).data('countdown');
	var countDownDate=new Date(time).getTime();
	var x=setInterval(function(){
		var now=new Date().getTime();
		var distance=countDownDate-now;
		var days=Math.floor(distance/(1000*60*60*24));
		var hours=Math.floor((distance%(1000*60*60*24))/(1000*60*60));
		var minutes=Math.floor((distance%(1000*60*60))/(1000*60));
		var seconds=Math.floor((distance%(1000*60))/1000);
		if(distance<0){
			clearInterval(x);
			var count="HẾT HẠN";
			target.setAttribute("disabled",true);
			target.removeAttribute("href");
			if(single){
				location.reload();
			}
		}
		else{
			if(days>0)hours=hours+(days*24);
			if(hours<10)hours='0'+hours;
			if(minutes<10)minutes='0'+minutes;
			if(seconds<10)seconds='0'+seconds;
			count=hours+":"+minutes+":"+seconds;
		}
		target.innerHTML=count;
	}
	,1000);
}
$(document).ready(function(){
	$(".countdown").trigger("load");
}
);
