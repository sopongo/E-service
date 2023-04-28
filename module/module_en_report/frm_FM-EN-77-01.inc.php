<style type="text/css"> 
.modal{ top:0%;}

</style>

<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="card">

<div class="card-header">
    <h2 class="display-8 d-inline-block font-weight-bold"><?PHP echo $title_act;?></h2>
    <div class="card-tools">
    <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard v1</li>
    </ol>
    </div>
</div>

<style type="text/css">
table.FM-EN-76-00{border-collapse: collapse; border-spacing:0px; 
    width:100%;
    table-layout: fixed;
}
table.FM-EN-76-00 thead tr th{ padding:0px 0px; }
table.FM-EN-76-00 thead tr th, table.FM-EN-76-00 tbody tr td{ 
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    border:1px #888 solid; 
}
table.FM-EN-76-00 thead tr th{ text-align:center; font-size:0.80rem; background-color:#fafafa; border:1px #888 solid; }
table.FM-EN-76-00 thead tr th.th_title{ padding:5px 0px;}
table.FM-EN-76-00 thead tr th.th_time{ width:50px; background-color:#F00; }

table.FM-EN-76-00 thead tr th:first-child{ background-color:#fafafa; width:5%; }
table.FM-EN-76-00 thead tr th:last-child{ background-color:#fafafa; width:5%; }

table.FM-EN-76-00 thead tr th.col{ width: 180px; }

table.FM-EN-76-00 tbody tr td{ padding:2px 2px; font-size:0.85rem; text-align:center;  }
/*table.FM-EN-76-00 tbody tr td:nth-child(2){ width: 120px;} */
table.FM-EN-76-00 tbody tr:hover{ background-color:#f3f3f3; }
table.FM-EN-76-00 tbody tr td input{ color:#333; font-size:10px;}
table.FM-EN-76-00 tbody tr td:hover input{ background-color:#cce7e8; }
table.FM-EN-76-00 tbody tr td input{ width: 100%; border:none; background-color:#fff; padding:1px 1px; cursor:pointer; text-align:center; font-size:0.80rem; font-family:arial;}
table.FM-EN-76-00 tbody tr td input:focus{ background-color:#cce7e8; border:none; outline: none;}

.btn-sm{ padding:1px 6px;}

.table-none{  border:none; display: block;}
.table-none thead{  border:none;}
.table-none thead tr th{ border:none;}

.testxxx{ display: block; width:40%; max-width:40%; background-color: rgba(255, 0, 0, 0.3); position: absolute; left:50%; margin:auto; margin-top:-10px;margin-left:50px; text-align:center; }

.d_bottom{ background-color:#EEE;
  bottom: 10px;
  width: 100%; padding:4px 0px;
  border-top:1px dotted #333; margin-top:8px;

}
</style>


<?PHP
  include_once 'module/module_en_report/frm_input.inc.php'; //หน้า frm_input
?>

<div class="card-body">

  <!--<div class="col-sm-6">
        <span class="irs-bar irs-bar--single" style="left: 0px; width: 50%;"></span><span class="irs-shadow shadow-single" style="display: none;"></span><span class="irs-handle single" style="left: 47.6744%;"><i></i><i></i><i></i></span></span><input id="range_6" type="text" name="range_6" value="" class="irs-hidden-input" tabindex="-1" readonly="">
  </div>
</div>-->

<!--<img src="module/module_en_report/img_test/FM-EN-76-00.jpg" class="img" width="100%"><br /><br />-->
<table class="table-bordered FM-EN-76-00">
    <thead>
    <tr>
        <th colspan="24">frm_FM-EN-77-01</th>
    </tr>   
    <tr>
        <th scope="col" class="th_time">Time</th>
        <th scope="col" rowspan="2">AMP <br />(A)<br />&#60;400</th>
        <th scope="col" rowspan="2">CAPA<br />CITOR<br />0.85</th>
        <th scope="col" rowspan="2">Total <br />KWh<br />(kWh)</th>
        <th scope="col" colspan="2" class="th_title">Vessel Pump</th>
        <th scope="col" colspan="4">Temp control ASRS</th>
        <th scope="col" colspan="4">Temp Room ASRS</th>
        <th scope="col">Ante</th>
        <th scope="col" colspan="2">Ante Loading </th>
        <th scope="col" colspan="2">Loading Area </th>
        <th scope="col" colspan="4">RECEVER TANK</th>
        <th scope="col" rowspan="2">#</th>
    </tr>
    <tr>
        <th>SET</th>
        <th>P1 <div class="d_bottom">(A)</div></th>
        <th>P2 <div class="d_bottom">(A)</div></th>
        <th>Coil<div class="d_bottom">1(°C)</div></th>
        <th>Coil<div class="d_bottom">2(°C)</div></th>
        <th>Coil <div class="d_bottom">3(°C)</div></th>
        <th>Coil <div class="d_bottom">4(°C)</div></th>
        <th>Temp<div class="d_bottom">1(°C)</div></th>
        <th>Temp <div class="d_bottom">2(°C)</div></th>
        <th>Temp <div class="d_bottom">3(°C)</div></th>
        <th>Temp <div class="d_bottom">4(°C)</div></th>
        <th>Coil<div class="d_bottom">1(°C)</div></th>
        <th>Coil <div class="d_bottom">1(°C)</div></th>
        <th>Coil <div class="d_bottom">2(°C)</div></th>
        <th>Coil <div class="d_bottom">1(°C)</div></th>
        <th>Coil <div class="d_bottom">2(°C)</div></th>
        <th>1/4<div class="d_bottom">&#10003;</div></th>
        <th>2/4<div class="d_bottom">&#10003;</div></th>
        <th>3/4<div class="d_bottom">&#10003;</div></th>
        <th>4/4<div class="d_bottom">&#10003;</div></th>
    </tr>
    </thead> 
    <?PHP
    foreach($time_schedule as $key=>$value){
    //data-target="#modal-default"
    echo '
    <tr>
    <td>'.($value<10 ? 0 : '').number_format($value,2).'</td>
    <td>'.rand(100,999).'</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
      <div class="icheck-success d-inline">
        <input type="radio" name="xxxxx_'.$value.'" id="radioPrimary_'.$value.'_1">
        <label for="radioPrimary_'.$value.'_1"></label>
      </div>
    </td>
    <td>
      <div class="icheck-success d-inline">
        <input type="radio" name="xxxxx_'.$value.'" id="radioPrimary_'.$value.'_2">
        <label for="radioPrimary_'.$value.'_2"></label>
    </div>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    ';
    ?>
  <?PHP } ?>  
</table>

</div><!-- /.card-body -->

</div><!-- /.card -->


</section>
<!-- /.content -->



<!-- Page specific script -->
<script>


  
</script>