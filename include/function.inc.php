<?php
 // bin/class.currency.php
 // class Currency โดย http://www.goragod.com (กรกฎ วิริยะ)
 // สงวนลิขสิทธ์ ห้ามซื้อขาย ให้นำไปใช้ได้ฟรีเท่านั้น

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

?>