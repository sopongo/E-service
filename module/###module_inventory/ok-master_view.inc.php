<?PHP
$obj = new CRUD();
//$numRow_player = $obj->getCount("SELECT count(id_menu) AS total_row FROM tb_category");
?>    
    
<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card">
    
    <div class="card-header">
      <h4 class="display-10 d-inline-block font-weight-bold"><?PHP echo $title_act;?></h4>
      <div class="card-tools">
        <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard v1</li>
        </ol>
      </div>
    </div>


    <div class="card-body">

    
<?PHP

/*
$min=1;
$max=30;
$xxx = array();

for($i=0; $i<=45; $i++){
  $aaa = rand($min,$max);
  $xxx[]+=$aaa;
}

echo "INSERT INTO `tb_inven_cut` (`id_cut`, `ref_id_offsupp_location`, `cut_date`, `ref_id_req`, `ref_id_offsupp`, `ref_id_rcv`, `cut_quantity`) VALUES <br />";
foreach($xxx as $key => $date) {
//echo $key.'-----------'.$val.'<br />';
$Rmd_Qty= rand(0,15);
$Rmd_id_rcv= rand(0,70);
$SixDigitRandomNumber = rand(100000,999999);

echo "(0, 24, '2022-11-".$date."', 1, 17, ".$Rmd_id_rcv.", ".$Rmd_Qty."), <br />";
//echo "(0, 24, 'PO".$SixDigitRandomNumber."', '2022-11-".$date."', 'PO.".$SixDigitRandomNumber."-".$date."/11(".$Rmd_Qty."แท่ง)', ".$Rmd_Qty.", ".$Rmd_price.", '2022-11-".$date." 00:00:00', 1, NULL, NULL),<br />";
}
*/

echo "<hr />";

    $startDate = '2022-11-15';
    $endDate = '2022-12-31';
    $idOffsupp = 24;

    $transaction =  array();
    $rec =  array();


    echo '<h3 class="text-danger">ไอดีที่เรียกดู:'.$idOffsupp.' ตั้งแต่วันที่: '.$startDate.' ถึงวันที่: '.$endDate.'</h3><hr />';


  //หายอดคงเหลือ
  $bf_rcv = $obj->customSelect("SELECT SUM(rcv_quantity) AS total FROM tb_inven_rcv WHERE ref_id_offsupp_location=24 AND DATE(rcv_date)<'".$startDate."';");
  $bf_cut = $obj->customSelect("SELECT SUM(cut_quantity) AS total FROM tb_inven_cut WHERE ref_id_offsupp_location=24 AND DATE(cut_date)<'".$startDate."';");  
  $bf_rtn = $obj->customSelect("SELECT SUM(rtn_quantity) AS total FROM tb_inven_rtn WHERE ref_id_offsupp_location=24 AND DATE(rtn_date)<'".$startDate."';");  

  /*SUM(adj_quantity) AS total 
    SUM(CASE WHEN adj_quantity > 0 THEN adj_quantity ELSE 0 END) AS posSum,
  SUM(CASE WHEN adj_quantity < 0 THEN adj_quantity ELSE 0 END) AS negSum,
  */
  $bf_adj = $obj->customSelect("SELECT 
  SUM(case when adj_quantity >= 0 then adj_quantity else 0 end) as positive,
  SUM(case when adj_quantity < 0 then  adj_quantity else 0 end) as negative
  FROM tb_inven_adj WHERE ref_id_offsupp_location=24 AND DATE(adj_date)<'".$startDate."';");  

  echo "<h1>(1)รวมรับเข้าก่อน ".$startDate."</h1>";
  echo $bf_rcv['total'];
  echo "<hr />";

  echo "<h1>(2)รวมจ่ายออกก่อน ".$startDate."</h1>";
  echo $bf_cut['total'];
  echo "<hr />";

  echo "<h1>(3)รวมรับคืนก่อน ".$startDate."</h1>";
  echo $bf_rtn['total'];
  echo "<hr />";

  echo "<h1>รวมปรับยอดก่อน ".$startDate."</h1>";
  echo '(4)ยอดปรับบวก(+): '.$bf_adj['positive'].'<br />';
  echo '(5)ยอดปรับลบ(-): '.$bf_adj['negative'].'<br />';
  echo "<hr />";  

  echo 'ยอดยกมาก่อนวันที่ '.$startDate.'=(((1)+(3)+(4))-(2))-(-5) :'.((($bf_rcv['total']+$bf_rtn['total']+$bf_adj['positive'])-$bf_cut['total'])-(-$bf_adj['negative']));
  echo "<hr />";


  $bf_total = (($bf_rcv['total']+$bf_rtn['total']+$bf_adj['positive'])-$bf_cut['total'])-(-$bf_adj['negative']);

  $rec = array(0=>array(
    'id'=>0,
    'id_offsupp_location'=>24,
    'inven_type'=> 'bf_total',
    'inven_date'=> $startDate,
    'lot_name'=> null,
    'quantity'=>$bf_total
  ));
  $transaction = array_merge($transaction,$rec);


  //รับเข้า
  //id_rcv, ref_id_offsupp_location, ref_po_no, rcv_date, rcv_lot, rcv_quantity, unit_price, rcv_adddate, ref_id_user_add, rev_editdate, ref_id_user_edit
  $fetchRow = $obj->fetchRows("SELECT id_rcv, ref_id_offsupp_location, ref_po_no, rcv_date, rcv_lot, rcv_quantity FROM tb_inven_rcv 
  WHERE ref_id_offsupp_location=24 
  AND DATE(rcv_date)>='".$startDate."' AND DATE(rcv_date)<='".$endDate."';");
  /*echo "<pre>";  print_r($fetchRow);  echo "</pre>";*/

  //echo "<h1>รับเข้า</h1>";
  if (count($fetchRow)>0) {                       
    foreach($fetchRow as $key => $value) {
      /*echo 'id: '.$fetchRow[$key]['id_rcv'].'<br />';
      echo 'id_offsupp_location: '.$fetchRow[$key]['ref_id_offsupp_location'].'<br />';
      echo 'inven_type: rcv <br />';
      echo 'inven_date: '.$fetchRow[$key]['rcv_date'].'<br />';
      echo 'lot_name: '.$fetchRow[$key]['rcv_lot'].'<br />';
      echo 'quantity: '.$fetchRow[$key]['rcv_quantity'].'<br /><hr />';*/
      $rec = array($fetchRow[$key]['id_rcv']=>array(
        'id'=>$fetchRow[$key]['id_rcv'],
        'id_offsupp_location'=>$fetchRow[$key]['ref_id_offsupp_location'],
        'inven_type'=> 'rcv',
        'inven_date'=>$fetchRow[$key]['rcv_date'],
        'lot_name'=>$fetchRow[$key]['rcv_lot'],
        'quantity'=>$fetchRow[$key]['rcv_quantity']
      ));
      $transaction = array_merge($transaction,$rec);      
    }
  }


  
  //จ่ายออก
  //id_cut, ref_id_offsupp_location, cut_date, ref_id_req, ref_id_offsupp, ref_id_rcv, cut_quantity
  $fetchCut = $obj->fetchRows("SELECT tb_inven_cut.id_cut, tb_inven_cut.ref_id_offsupp_location, tb_inven_cut.cut_date, tb_inven_cut.cut_quantity, tb_inven_cut.ref_id_rcv, 
  tb_inven_rcv.rcv_lot FROM tb_inven_cut 
  LEFT JOIN tb_inven_rcv ON (tb_inven_rcv.id_rcv=tb_inven_cut.ref_id_rcv)
  WHERE tb_inven_cut.ref_id_offsupp_location=24 
  AND DATE(tb_inven_cut.cut_date)>='".$startDate."' AND DATE(tb_inven_cut.cut_date)<='".$endDate."';");    

  //echo "<h1>จ่ายออก</h1>";
  if (count($fetchCut)>0) {
    foreach($fetchCut as $key => $value) {
      /*
      echo 'id: '.$fetchCut[$key]['id_cut'].'<br />';
      echo 'id_offsupp_location: '.$fetchCut[$key]['ref_id_offsupp_location'].'<br />';
      echo 'inven_type: cut <br />';
      echo 'inven_date: '.$fetchCut[$key]['cut_date'].'<br />';
      echo 'lot_name: '.$fetchCut[$key]['rcv_lot'].'<br />';
      echo 'quantity: '.$fetchCut[$key]['cut_quantity'].'<br /><hr />';
      */
      $rec = array($fetchCut[$key]['id_cut']=>array(
        'id'=>$fetchCut[$key]['id_cut'],
        'id_offsupp_location'=>$fetchCut[$key]['ref_id_offsupp_location'],
        'inven_type'=> 'cut',
        'inven_date'=>$fetchCut[$key]['cut_date'],
        'lot_name'=>$fetchCut[$key]['rcv_lot'],
        'quantity'=>$fetchCut[$key]['cut_quantity']
      ));
      $transaction = array_merge($transaction,$rec);
    }
  }


  //รับคืน
  //id_rtn, ref_id_offsupp_location, rtn_date, ref_id_req, ref_id_rcv, rtn_quantity, rtn_remark, rtn_adddate, ref_id_user_add, rtn_editdate, ref_id_user_edit
  $fetchRtn = $obj->fetchRows("SELECT 
  tb_inven_rtn.id_rtn, tb_inven_rtn.ref_id_offsupp_location, tb_inven_rtn.rtn_date, tb_inven_rtn.ref_id_req, tb_inven_rtn.ref_id_rcv, tb_inven_rtn.rtn_quantity, tb_inven_rtn.rtn_remark, 
  tb_inven_rcv.rcv_lot FROM tb_inven_rtn 
  LEFT JOIN tb_inven_rcv ON (tb_inven_rcv.id_rcv=tb_inven_rtn.ref_id_rcv)
  WHERE tb_inven_rtn.ref_id_offsupp_location=24 
  AND DATE(tb_inven_rtn.rtn_date)>='".$startDate."' AND DATE(tb_inven_rtn.rtn_date)<='".$endDate."';");    

  //echo "<h1>รับคืน</h1>";
  if (count($fetchRtn)>0) {
    foreach($fetchRtn as $key => $value) {
      /*echo 'id: '.$fetchRtn[$key]['id_rtn'].'<br />';
      echo 'id_offsupp_location: '.$fetchRtn[$key]['ref_id_offsupp_location'].'<br />';
      echo 'inven_type: rtn <br />';
      echo 'inven_date: '.$fetchRtn[$key]['rtn_date'].'<br />';
      echo 'lot_name: '.$fetchRtn[$key]['rcv_lot'].'<br />';
      echo 'quantity: '.$fetchRtn[$key]['rtn_quantity'].'<br /><hr />';*/

      $rec = array($fetchRtn[$key]['id_rtn']=>array(
        'id'=>$fetchRtn[$key]['id_rtn'],
        'id_offsupp_location'=>$fetchRtn[$key]['ref_id_offsupp_location'],
        'inven_type'=> 'rtn',
        'inven_date'=>$fetchRtn[$key]['rtn_date'],
        'lot_name'=>$fetchRtn[$key]['rcv_lot'],
        'quantity'=>$fetchRtn[$key]['rtn_quantity']
      ));
      $transaction = array_merge($transaction,$rec);
    }
  }  

  //ปรับยอด
  //tb_inven_adj.id_adj, tb_inven_adj.ref_id_offsupp_location, tb_inven_adj.adj_date, tb_inven_adj.ref_id_rcv, tb_inven_adj.adj_quantity, tb_inven_adj.adj_adddate
  $fetchAdj = $obj->fetchRows("SELECT tb_inven_adj.id_adj, tb_inven_adj.ref_id_offsupp_location, tb_inven_adj.adj_date, tb_inven_adj.ref_id_rcv, 
  tb_inven_adj.adj_quantity, tb_inven_adj.adj_adddate, tb_inven_rcv.rcv_lot FROM tb_inven_adj 
  LEFT JOIN tb_inven_rcv ON (tb_inven_rcv.id_rcv=tb_inven_adj.ref_id_rcv)
  WHERE tb_inven_adj.ref_id_offsupp_location=24 
  AND DATE(tb_inven_adj.adj_date)>='".$startDate."' AND DATE(tb_inven_adj.adj_date)<='".$endDate."';");    

  //echo "<h1>ปรับยอด</h1>";
  if (count($fetchAdj)>0) {
    foreach($fetchAdj as $key => $value) {
      /*echo 'id: '.$fetchAdj[$key]['id_adj'].'<br />';
      echo 'id_offsupp_location: '.$fetchAdj[$key]['ref_id_offsupp_location'].'<br />';
      echo 'inven_type: adj <br />';
      echo 'inven_date: '.$fetchAdj[$key]['adj_date'].'<br />';
      echo 'lot_name: '.$fetchAdj[$key]['rcv_lot'].'<br />';
      echo 'quantity: '.$fetchAdj[$key]['adj_quantity'].'<br /><hr />';*/

      $rec = array($fetchAdj[$key]['id_adj']=>array(
        'id'=>$fetchAdj[$key]['id_adj'],
        'id_offsupp_location'=>$fetchAdj[$key]['ref_id_offsupp_location'],
        'inven_type'=> 'adj',
        'inven_date'=>$fetchAdj[$key]['adj_date'],
        'lot_name'=>$fetchAdj[$key]['rcv_lot'],
        'quantity'=>$fetchAdj[$key]['adj_quantity']
      ));
      $transaction = array_merge($transaction,$rec);      
    }
  }





  echo '<hr />'.(count($transaction)).'<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>ไอดีเทเบิล</th>
      <th>ไอดีวัสดุรายไซต์</th>
      <th>ประเภทรายการ</th>
      <th>วันที่ทำรายการ</th>
      <th>ลอต</th>
      <th>รับเข้า</th>
      <th>จ่ายออก</th>
      <th>รับคืน</th>
      <th>ปรับยอด</th>
      <th>คงเหลือ</th>
    </tr></thead><tbody>';

  $total_balance = 0;
  $sDate= array_column($transaction, 'inven_date');
  array_multisort($sDate, SORT_ASC, $transaction);//SORT_DESC SORT_ASC
  
  foreach ($transaction as $item){
    echo '
    <tr>
    <td>'.$item['id'].'</td>
    <td>'.$item['id_offsupp_location'].'</td>
    <td>'.$item['inven_type'].'</td>
    <td>'.$item['inven_date'].'</td>
    <td>'.$item['lot_name'].'</td>';

    switch ($item['inven_type']){
      case "bf_total" :
        $total_balance+=$item['quantity'];
        echo '
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>'.number_format($total_balance,0).'</td>
        ';
      break;
      case "rcv" :
        $total_balance+=$item['quantity'];
        echo '
        <td>'.$item['quantity'].'</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>'.number_format($total_balance,0).'</td>
        ';
      break;

      case "cut" :
        $total_balance-=$item['quantity'];
        echo '
        <td>&nbsp;</td>
        <td>'.$item['quantity'].'</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>'.number_format($total_balance,0).'</td>
        ';
      break;

      case "rtn" :
        $total_balance+=$item['quantity'];
        echo '
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>'.$item['quantity'].'</td>
        <td>&nbsp;</td>
        <td>'.number_format($total_balance,0).'</td>
        ';
      break;

      case "adj" :

        //$total_balance+=$item['quantity'];
        if($item['quantity']>0){
         $qqq ='ยอดเต็ม';
         $total_balance+=$item['quantity'];
        }else{
          $qqq ='ยอดติดลบ';
          $total_balance+=$item['quantity'];
        }

        echo '
        <td>'.$qqq.'</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>'.$item['quantity'].'</td>
        <td>'.number_format($total_balance,0).'</td>
        ';
      break;

      default:
      echo '
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      ';
      break;
      echo'</tr>';
    }
  }
  echo "</tbody></table><hr />";    


?>









  </div><!-- /.card-body -->


  </div><!-- /.card -->

</section>
<!-- /.content -->

<script>

</script>