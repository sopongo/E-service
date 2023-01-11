<?php
class Processing{

  function __construct(){

  }
  public function Start_Time(){
  return time()+ microtime(true);
  }
  public  function End_Time(){
  return time()+ microtime(true);
  }
  public function Total_Time($ini_t,$end_t){
  return round($end_t - $ini_t,4);
  }
  public function show_msg($time){
   echo "ใช้เวลาในการประมวลผลหน้านี้: $time วินาที.";
  }
}

/*
        //$startTime = microtime(true); //float(1559370720.4323)
        //$usedTime = microtime(true) - $startTime; //12.67
        echo time();
        echo "<hr />";
        echo microtime();
*/
?>