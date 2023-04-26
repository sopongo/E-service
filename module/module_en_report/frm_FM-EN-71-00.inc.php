<style type="text/css"> 
.modal{ top:15%;}

.numpad{  width:28% ; padding:5px 5px; margin:5px 5px; text-align:left; }

.btn-cel{ font-size:0.5rem;}
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
table.FM-EN-76-00 thead tr th{ padding:6px 6px; }
table.FM-EN-76-00 thead tr th, table.FM-EN-76-00 tbody tr td{ 
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    border:1px #888 solid; 
}
table.FM-EN-76-00 thead tr th{ width:70px; text-align:center; font-size:0.80rem; background-color:#fafafa; border:1px #888 solid; }
table.FM-EN-76-00 thead tr th:first-child{ background-color:#fafafa; width:5%; }
table.FM-EN-76-00 thead tr th:last-child{ background-color:#fafafa; width:5%; }
table.FM-EN-76-00 tbody tr td{ padding:2px 2px; font-size:0.85rem;  }
table.FM-EN-76-00 tbody tr td:nth-child(2){ width: 120px;} 
table.FM-EN-76-00 tbody tr:hover{ /*background-color:#cce7e8;*/ }
table.FM-EN-76-00 tbody tr td:hover input{ background-color:#cce7e8; }
table.FM-EN-76-00 tbody tr td input{ width: 100%; border:none; padding:1px 1px; cursor:pointer; text-align:center; font-size:0.80rem; font-family:arial;}
table.FM-EN-76-00 tbody tr td input:focus{ background-color:#cce7e8; border:none; outline: none;}
</style>

  <!-- Ion Slider -->
  <link rel="stylesheet" href="plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
  <!-- bootstrap slider -->
  <link rel="stylesheet" href="plugins/bootstrap-slider/css/bootstrap-slider.min.css">

    
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>  
  <!-- Ion Slider -->
<script src="plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
<!-- Bootstrap slider -->
<script src="plugins/bootstrap-slider/bootstrap-slider.min.js"></script>

<?PHP
  include_once 'module/module_en_report/frm_input.inc.php'; //หน้า frm_input
?>

<div class="card-body">
  <div class="col-sm-6">
        <span class="irs-bar irs-bar--single" style="left: 0px; width: 50%;"></span><span class="irs-shadow shadow-single" style="display: none;"></span><span class="irs-handle single" style="left: 47.6744%;"><i></i><i></i><i></i></span></span><input id="range_6" type="text" name="range_6" value="" class="irs-hidden-input" tabindex="-1" readonly="">
  </div>
</div>

<div class="card-body">
<!--<img src="module/module_en_report/img_test/FM-EN-76-00.jpg" class="img" width="100%"><br /><br />-->


<table class="table-bordered">
  <thead>
    <tr>
      <th><img src="dist/img/logo_2.png" class="img" width="20%"></th>
      <th>Pacific Cold Storage Co. Ltd<br/>(Mahachai) 47/19 Moo2, Nadee, Muang, Samutsakorn 74000 Tel. +66 3411 7899</th>
      <th><h6>ใบ Report 9 (Compessor 1-2)</h6></th>
    </tr>
  </thead>
</table>
<table class="FM-EN-76-00 table-bordered">
    <thead>
    <tr>
    <th rowspan="2">TIME</th>
    <th colspan="13">COMPESSOR 29</th>
    <th colspan="13">COMPESSOR 30</th>
    <th rowspan="2">Copy to</th>    
  </tr>
  <tr>
    <th>SP</th>
    <th>DP</th>
    <th>OP</th>
    <th>AFP</th>
    <th>ST</th>
    <th>DT</th>
    <th>OT</th>
    <th>DOP</th>
    <th>IT</th>
    <th>IP</th>
    <th>SVP</th>
    <th>LSV</th>
    <th>MA</th>
    <th>SP</th>
    <th>DP</th>
    <th>OP</th>
    <th>AFP</th>
    <th>ST</th>
    <th>DT</th>
    <th>OT</th>
    <th>DOP</th>
    <th>IT</th>
    <th>IP</th>
    <th>SVP</th>
    <th>LSV</th>
    <th>MA</th>
  </tr>
    </thead>
    <tbody>
  <?PHP
  foreach($time_schedule as $key=>$value){
    echo '
    <tr>
    <td>'.($value<10 ? 0 : '').number_format($value,2).'</td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" readonly class="xxxx" data-toggle="modal" data-target="#modal-default" id="addData" data-backdrop="static" data-keyboard="false"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" disabled class="xxxx"></td>
    <td>xxxxx</td>
  </tr>
    ';
  }
  ?>
    </tbody>
</table>

</div><!-- /.card-body -->

</div><!-- /.card -->


</section>
<!-- /.content -->



<!-- Page specific script -->
<script>

//plugins/

  $(function () {
    /* BOOTSTRAP SLIDER */
    $('.slider').bootstrapSlider()

    $('#range_6').ionRangeSlider({
      skin: "big",
      min     : -50,
      max     : 50,
      from    : 0,
      type    : 'single',
      step    : 0.2,
      postfix : '°',
      grid: true,
      prettify: true,
      hasGrid : true
    })

  })
</script>