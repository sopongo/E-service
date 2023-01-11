$(document).on('keyup', '.numonly', function() {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});



function addCommas(nStr){ //เพิ่มคอมม่าในช่อง #คงเหลือ ตอนคำนวนเสร็จ
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */
/*เวลา*/  
var dNow = new Date();
var localdate= (dNow.getMonth()+1) + '/' + dNow.getDate() + '/' + dNow.getFullYear() + ' ' + dNow.getHours() + ':' + dNow.getMinutes() + ':' + dNow.getSeconds();
//alert(localdate);
$(function(){
	var nowDateTime=new Date(localdate);
	var d=nowDateTime.getTime();
	var mkHour,mkMinute,mkSecond;
	 setInterval(function(){
		d=parseInt(d)+1000;
		var nowDateTime=new Date(d);
		mkHour=new String(nowDateTime.getHours());  
		if(mkHour.length==1){  
			mkHour="0"+mkHour;  
		}
		mkMinute=new String(nowDateTime.getMinutes());  
		if(mkMinute.length==1){  
			mkMinute="0"+mkMinute;  
		} 		 
		mkSecond=new String(nowDateTime.getSeconds());  
		if(mkSecond.length==1){  
			mkSecond="0"+mkSecond;  
		} 	
		var runDateTime=mkHour+":"+mkMinute+":"+mkSecond;		 
		$("#css_time_run").html('เวลา: '+runDateTime+' นาที');	 
	 },1000);
});  
/*เวลา*/
