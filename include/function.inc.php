<?php
 // bin/class.currency.php
 // class Currency โดย http://www.goragod.com (กรกฎ วิริยะ)
 // สงวนลิขสิทธ์ ห้ามซื้อขาย ให้นำไปใช้ได้ฟรีเท่านั้น

 function duration($begin,$end){
    $remain=intval(strtotime($end)-strtotime($begin));
    $wan=floor($remain/86400);
    $l_wan=$remain%86400;
    $hour=floor($l_wan/3600);
    $l_hour=$l_wan%3600;
    $minute=floor($l_hour/60);
    $second=$l_hour%60;
    return "".$wan." วัน ".$hour." ชั่วโมง ".$minute." นาที ".$second." วินาที";
}

 function  chk_iconTimeline($index) {
    switch($index){ //$rowTM[$key]['ref_arr_timeline'];
        case 0:
        case 1:
        default:
            $icon = '<i class="fas fa-file-invoice bg-primary"></i>';
            return $icon;
        break;

        case 4:
            $icon = '<i class="fas fa-clipboard-check bg-success"></i>';
            return $icon;
        break;        

    }
 }

 function searchArray($arrays, $key, $search) {
    $count = 0; 
    foreach($arrays as $object) {
        if(is_object($object)) {
           $object = get_object_vars($object);
        }
        if(array_key_exists($key, $object) && $object[$key] == $search) $count++;
    }
      return $count;
      //return $search.'-------มีจำนวน-------'.$count.'---------------ฟิลด์ที่ค้นหา==='.$key.'----------------'.$object[$key];
  }



//ฟังก์ชั่นหาค่าในอาร์เรย์ว่าอยู่ไอดีไหน **ใช้ชั่วคราวไปก่อน** Function to iteratively search for a given value 
function searchForId($search_value, $array, $id_path) {

	// Iterating over main array
	foreach ($array as $key1 => $val1) {

		$temp_path = $id_path;
		
		// Adding current key to search path
		array_push($temp_path, $key1);

		// Check if this value is an array
		// with atleast one element
		if(is_array($val1) and count($val1)) {

			// Iterating over the nested array
			foreach ($val1 as $key2 => $val2) {

				if($val2 == $search_value) {
						
					// Adding current key to search path
					array_push($temp_path, $key2);
				
          return join($search_value."----", $temp_path);          
				}
			}
		}
		
		elseif($val1 == $search_value) {
			return join($search_value."----", $temp_path);
		}
	}
	
	return null;
}


function write($path, $content, $mode="w+"){
	if (file_exists($path) && !is_writeable($path)){ return false; }
	if ($fp = fopen($path, $mode)){
		fwrite($fp, $content);
		fclose($fp);
	}
	else { return false; }
	return true;
}

##แปลง URL ให้เป็น UTF-8
function utf8_urldecode($str) {
	$str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
	return html_entity_decode($str,null,'UTF-8');;
}

function removespecialchars($raw){
     return preg_replace('#[^a-zA-Z0-9-]#u', '', $raw);
}

##เช็คนามสกุลไฟล์
function file_extension($fileName){ return strtolower(substr(strrchr($fileName,'.'),1)); }

##แปลงหน่วยนับหน่วยความจำ
function convert_memuse($size){ $unit=array('ไบต์','กิโลไบต์','เมกกะไบต์','จิกะไบต์','เทระไบต์','เพระไบต์'); return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i]; }

function nowDate($date){
	$d = substr($date, -11, -8);
	$m = substr($date, -14, -12);
	$y = substr($date, -19, -15);
	$thMonth = array("01"=>"มกราคม", "02"=>"กุมภาพันธ์", "03"=>"มีนาคม", "04"=>"เมษายน", "05"=>"พฤษภาคม", "06"=>"มิถุนายน", "07"=>"กรกฏาคม", "08"=>"สิงหาคม", "09"=>"กันยายน", "10"=>"ตุลาคม", "11"=>"พฤศจิกายน", "12"=>"ธันวาคม");
	return ((int) $d).' '.$thMonth[$m].' '.($y+543); 
}

function nowDateEN($date){
	$d = substr($date, -11, -8);
	$m = substr($date, -14, -12);
	$y = substr($date, -19, -15);
	$thMonth = array("01"=>"January", "02"=>"February", "03"=>"March", "04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December");
	return ((int) $d).' '.$thMonth[$m].' '.($y); 
}

function nowDateShort($date){
	$exDate = explode("-",$date);
	$thMonth = array("01"=>"ม.ค.", "02"=>"ก.พ.", "03"=>"มี.ค.", "04"=>"เม.ย.", "05"=>"พ.ค.", "06"=>"มิ.ย.", "07"=>"ก.ค.", "08"=>"ส.ค.", "09"=>"ก.ย.", "10"=>"ต.ค.", "11"=>"พ.ย.", "12"=>"ธ.ค.");
	return ((int) $exDate[2]).' '.$thMonth[$exDate[1]].' '.substr(($exDate[0]+543),2); 
}

function shortDateEN($date){
	$d = substr($date, -11, -8);
	$m = substr($date, -14, -12);
	$y = substr($date, -19, -15);
	//$thMonth = array("01"=>"Jan", "02"=>"Feb", "03"=>"Mar", "04"=>"Apr", "05"=>"May", "06"=>"Jun", "07"=>"Jul", "08"=>"Aug", "09"=>"Sep", "10"=>"Oct", "11"=>"Nov", "12"=>"Dec");
	$thMonth = array("01"=>"01", "02"=>"02", "03"=>"03", "04"=>"04", "05"=>"05", "06"=>"06", "07"=>"07", "08"=>"08", "09"=>"09", "10"=>"10", "11"=>"11", "12"=>"12");	
	return ((int) $d).'/'.$thMonth[$m].'/'.($y); 
}

//00:00:00
function nowTime($date){ $h = substr($date, -8, -6); $m = substr($date, -5, -3); $s = substr($date, -2, 2);  return $h.':'.$m.':'.$s.' น.'; }	

function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "เมื่อสักครู่นี้";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "ประมาณ 1 นาทีที่ผ่านมา";
        }
        else{
            return "ประมาณ $minutes นาที";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "ประมาณ 1 ชั่วโมง";
        }else{
            return "ประมาณ $hours ชั่วโมง";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "ประมาณ 1 วัน";
        }else{
            return "ประมาณ $days วัน";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "1 อาทิตย์";
        }else{
            return "$weeks อาทิตย์ที่ผ่านมา";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "ประมาณ 1 เดือน";
        }else{
            return "$months เดือน";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}

function fb_date($timestamp){	
/*ถ้าเก็บเวลาในรูปแบบ timestamp (ตัวอย่าง 1300950558)
$date_you=1300950558;
echo fb_date($date_you);
ถ้าเก็บเวลาในรูปแบบ  datetime (ตัวอย่าง 2011-03-24 15:30:50)
$date_you="2011-03-24 15:30:50";
echo fb_date(strtotime($date_you));
*/
$difference = time() - $timestamp;
$periods = array("วินาที", "นาที", "ชั่วโมง");
$ending="ผ่านมา";
if($difference<60){
$j=0;
$periods[$j].=($difference != 1)?"":"";
	$difference=($difference==3 || $difference==4)?"ไม่กี่":$difference;
	$text = "$difference $periods[$j] $ending";
	}elseif($difference<3600){
	$j=1;
	$difference=round($difference/60);
	$periods[$j].=($difference != 1)?"":"";
	$difference=($difference==3 || $difference==4)?"ไม่กี่":$difference;
	$text = "$difference $periods[$j] $ending"; 
	}elseif($difference<86400){
	$j=2;
	$difference=round($difference/3600);
	$periods[$j].=($difference != 1)?"":"";
	$difference=($difference != 1)?$difference:"ประมาณ";
	$text = "$difference $periods[$j] $ending"; 
	}elseif($difference<172800){
	$difference=round($difference/86400);
	$periods[$j].=($difference != 1)? " ":" ";
	$text = "เมื่อวานนี้ ".date("g:ia",$timestamp); 
	}else{
	if($timestamp<strtotime(date("Y-01-01 00:00:00"))){
	$text = date("l j, Y",$timestamp)." เมื่อxx ".date("g:ia",$timestamp); 
	}else{
	$text = date("l j",$timestamp)." เมื่อzz ".date("g:ia",$timestamp); 
	}
	}
	return $text;
	}

/*
$big_array = array();
for ($i = 0; $i < 1000000; $i++)
{
   $big_array[] = $i;
}
echo 'After building the array.<br>';
print_mem();
unset($big_array);
echo 'After unsetting the array.<br>';
print_mem();
*/
function print_mem()
{
   /* Currently used memory */
   $mem_usage = memory_get_usage();
   
   /* Peak memory usage */
   $mem_peak = memory_get_peak_usage();
   //echo 'The script is now using: <strong>' . round($mem_usage / 1024) . 'KB</strong> of memory.<br>';
   //echo 'Peak usage: <strong>' . round($mem_peak / 1024) . 'KB</strong> of memory.<br><br>';
   echo ' ใช้หน่วยความจำไป: <strong>' . round($mem_usage / 1024) . 'KB</strong>.';
}

function dateRange( $first, $last, $step = '+1 day', $format = 'Y-m-d' ) {
    $dates = [];
    $current = strtotime( $first );
    $last = strtotime( $last );

    while( $current <= $last ) {

        $dates[] = date( $format, $current );
        $current = strtotime( $step, $current );
    }

    return $dates;
}

function timeDifference($date,$date2){
    $from_time = strtotime($date); 
    $to_time = strtotime($date2); 
    $diff_minutes = round(abs($from_time - $to_time) / 60,2);

    return $diff_minutes;
}

function dates_month($month, $year) {
    $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $dates_month = array();

    for ($i = 1; $i <= $num; $i++) {
        $mktime = mktime(0, 0, 0,   $year,$month,$i,);
        $date = $year.'-'.$month.'-'.$i;
        $dates_month[$i] = $date;
    }

    return $dates_month;
}

function nowDates_month($month, $year) {
    $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $dates_month = array();
    $nowDate = date('d');

    for ($i = 1; $i <= $nowDate; $i++) {
        $mktime = mktime(0, 0, 0,   $year,$month,$i,);
        $date = $year.'-'.$month.'-'.$i;
        $dates_month[$i] = $date;
    }

    return $dates_month;
}

function SortStatus($fetch){

    $TotalWait_approved = 0;
    $TotalNo_approved = 0;
    $TotalRepairing = 0;
    $TotalWait_repair = 0;
    $TotalWait_accept = 0;
    $TotalWait_hand_over = 0;
    $TotalHand_over = 0;
    $TotalCancel = 0;

    foreach ($fetch as $key => $value) {

        if ($value['status_approved'] == 0 && $value['allotted_date'] == null && $value['maintenance_request_status'] == 1
            && $value['duration_serv_end'] == null && $value['hand_over_date'] == null) {
            $TotalWait_approved++;
        } else if ($value['status_approved'] == 1 && $value['allotted_date'] != null && $value['maintenance_request_status'] == 1
            && $value['allotted_accept_date'] == null && $value['ref_user_id_accept_request'] == null && $value['duration_serv_start'] == null
            && $value['duration_serv_end'] == null && $value['hand_over_date'] == null) {
            $TotalWait_accept++;
        } else if ($value['status_approved'] == 1 && $value['allotted_date'] != null && $value['maintenance_request_status'] == 1
            && $value['allotted_accept_date'] != null && $value['ref_user_id_accept_request'] != null && $value['duration_serv_start'] == null
            && $value['duration_serv_end'] == null && $value['hand_over_date'] == null) {
            $TotalWait_repair++;
        } else if ($value['status_approved'] == 1 && $value['allotted_date'] != null && $value['maintenance_request_status'] == 1
            && $value['allotted_accept_date'] != null && $value['ref_user_id_accept_request'] != null && $value['duration_serv_start'] != null
            && $value['duration_serv_end'] == null && $value['hand_over_date'] == null) {
            $TotalRepairing++;
        } else if ($value['status_approved'] == 1 && $value['allotted_date'] != null && $value['maintenance_request_status'] == 1
            && $value['allotted_accept_date'] != null && $value['ref_user_id_accept_request'] != null && $value['duration_serv_start'] != null
            && $value['duration_serv_end'] != null && $value['hand_over_date'] == null) {
            $TotalWait_hand_over++;
        } else if ($value['status_approved'] == 1 && $value['allotted_date'] != null && $value['maintenance_request_status'] == 1
            && $value['duration_serv_start'] != null && $value['duration_serv_end'] != null && $value['hand_over_date'] != null) {
            $TotalHand_over++;
        } else if ($value['status_approved'] == 2 && $value['allotted_date'] != null && $value['maintenance_request_status'] == 1
            && $value['duration_serv_end'] == null && $value['hand_over_date'] == null) {
            $TotalNo_approved++;
        } else if ($value['maintenance_request_status'] == 2) {
            $TotalCancel++;
        }

    }

    $arrTotal = array(
        "Wait_approved" => $TotalWait_approved,
        "Wait_accept" => $TotalWait_accept,
        "Wait_repair" => $TotalWait_repair,
        "Repairing" => $TotalRepairing,
        "Wait_hand_over" => $TotalWait_hand_over,
        "Hand_over" => $TotalHand_over,
        "No_approved" => $TotalNo_approved,
        "Cancel" => $TotalCancel,
    );

    return $arrTotal;

}

function DataTableStatus($value){

    if ($value['status_approved'] == 0 && $value['allotted_date'] == null && $value['maintenance_request_status'] == 1
    && $value['duration_serv_end'] == null && $value['hand_over_date'] == null) {
    $req_textstatus = '<span class="text-bold text-danger">รออนุมัติ/จ่ายงาน</span>';
    } else if ($value['status_approved'] == 1 && $value['allotted_date'] != null && $value['maintenance_request_status'] == 1
        && $value['allotted_accept_date'] == null && $value['ref_user_id_accept_request'] == null && $value['duration_serv_start'] == null 
        && $value['duration_serv_end'] == null && $value['hand_over_date'] == null) {
        $req_textstatus = '<span class="text-bold text-danger">รอช่างรับงานซ่อม</span>';
    } else if ($value['status_approved'] == 1 && $value['allotted_date'] != null && $value['maintenance_request_status'] == 1
        && $value['allotted_accept_date'] != null && $value['ref_user_id_accept_request'] != null && $value['duration_serv_start'] == null 
        && $value['duration_serv_end'] == null && $value['hand_over_date'] == null) {
    $req_textstatus = '<span class="text-bold text-danger">รอซ่อม</span>';
    } else if ($value['status_approved'] == 1 && $value['allotted_date'] != null && $value['maintenance_request_status'] == 1
        && $value['allotted_accept_date'] != null && $value['ref_user_id_accept_request'] != null && $value['duration_serv_start'] != null 
        && $value['duration_serv_end'] == null && $value['hand_over_date'] == null) {
        $req_textstatus = '<span class="text-bold text-success">กำลังซ่อม</span>';
    } else if ($value['status_approved'] == 1 && $value['allotted_date'] != null && $value['maintenance_request_status'] == 1
        && $value['allotted_accept_date'] != null && $value['ref_user_id_accept_request'] != null && $value['duration_serv_start'] != null
        && $value['duration_serv_end'] != null && $value['hand_over_date'] == null) {
        $req_textstatus = '<span class="text-bold text-success"> งานรอส่งมอบ</span>';
    } else if ($value['status_approved'] == 1 && $value['allotted_date'] != null && $value['maintenance_request_status'] == 1
        && $value['duration_serv_start'] != null && $value['duration_serv_end'] != null && $value['hand_over_date'] != null) {
        $req_textstatus = '<span class="text-bold text-success"> ปิดงานและส่งมอบแล้ว</span>';
    } else if ($value['status_approved'] == 2 && $value['allotted_date'] != null && $value['maintenance_request_status'] == 1
        && $value['duration_serv_end'] == null && $value['hand_over_date'] == null) {
        $req_textstatus = '<span class="text-bold text-danger">ไม่อนุมัติ</span>';
    } else if ($value['maintenance_request_status'] == 2) {
        $req_textstatus = '<span class="text-bold text-gray">ยกเลิกใบแจ้งซ่อม</span>';
    } else {
        $req_textstatus = '-';
    }

return $req_textstatus;

}



?>