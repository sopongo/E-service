<?PHP
$obj = new CRUD();
$numRow_player = $obj->getCount("SELECT count(id_menu) AS total_row FROM tb_category");

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

$min=1;
$max=30;
$xxx = array();

for($i=0; $i<=60; $i++){
  $aaa = rand($min,$max);
  $xxx[]+=$aaa;
}
echo 'xxxxxxxxxxxxxxxxxxx<hr />';
sort($xxx);
echo "<pre>";
echo "</pre>";

//print_r($xxx);

for($i=0; $i<=60; $i++){
    $aaa = rand($min,$max);
    $xxx[]+=$aaa;
}

echo "INSERT INTO `tb_inven_rcv` (`id_rcv`, `ref_id_offsupp_location`, `ref_po_no`, `rcv_date`, `rcv_lot`, `rcv_quantity`, `unit_price`, `rcv_adddate`, `ref_id_user_add`, `rev_editdate`, `ref_id_user_edit`) VALUES <br />";
foreach($xxx as $key => $date) {
  //echo $key.'-----------'.$val.'<br />';
  $Rmd_Qty= rand(0,99);
  $Rmd_price= rand(0,99);
  $SixDigitRandomNumber = rand(100000,999999);
  echo "(0, 24, 'PO".$SixDigitRandomNumber."', '2022-11-".$date."', 'PO.".$SixDigitRandomNumber."-".$date."/11(".$Rmd_Qty."แท่ง)', ".$Rmd_Qty.", ".$Rmd_price.", '2022-11-".$date." 00:00:00', 1, NULL, NULL),<br />";
}

//('', 24, 'PO123456', '2022-12-01', 'PO123456-01/12(100แท่ง)', 100, 17, '2022-12-13 05:17:04', 1, NULL, NULL),




    $startDate = '2022-01-01';

    $endDate = '2022-12-31';

    $idOffsupp = 24;



  //รับเข้า
  //id_rcv, ref_id_offsupp_location, ref_po_no, rcv_date, rcv_lot, rcv_quantity, unit_price, rcv_adddate, ref_id_user_add, rev_editdate, ref_id_user_edit
  $fetchRow = $obj->fetchRows("SELECT id_rcv, ref_id_offsupp_location, ref_po_no, rcv_date, rcv_lot, rcv_quantity FROM tb_inven_rcv 
    WHERE ref_id_offsupp_location=24 
    AND DATE(rcv_date)>='".$startDate."' AND DATE(rcv_date)<='".$endDate."';");
    

    echo "<pre>";
    print_r($fetchRow);
    echo "</pre>";

    if (count($fetchRow)>0) {                       
      foreach($fetchRow as $key => $value) {
        echo $fetchRow[$key]['ref_po_no'].'-ssssssssss<br />';
      }
    }



  //จ่ายออก
  //id_cut, ref_id_offsupp_location, cut_date, ref_id_req, ref_id_offsupp, ref_id_rcv, cut_quantity
  $fetchRowCut = $obj->fetchRows("SELECT id_cut, ref_id_offsupp_location, cut_date, cut_quantity FROM tb_inven_cut 
    WHERE ref_id_offsupp_location=24 
    AND DATE(cut_date)>='".$startDate."' AND DATE(cut_date)<='".$endDate."';");    

    /*echo "<pre>";
    print_r($fetchRowCut);
    echo "</pre>";
*/ echo "<hr />";

    $result = array_merge($fetchRow, $fetchRowCut);

    foreach($result as $key => $value) {

      if (!in_array("ref_po_no", $result)) {
        echo "-------------------------จ่ายออก<br />";
      }else{
        echo $result[$key]['ref_po_no'].'-xxxxxxxxxxxxxxxxx<br />';
      }
    }

  /*  echo "<hr />";

    echo "<pre>";
    print_r($result);
    echo "</pre>";    

    echo "<hr />";
    echo count($result);
    echo "<hr />";
*/



?>






















  </div><!-- /.card-body -->


  </div><!-- /.card -->

</section>
<!-- /.content -->

<script>

</script>