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
table.FM-EN-76-00 tbody tr td input{ color:#333;}
table.FM-EN-76-00 tbody tr td:hover input{ background-color:#cce7e8; }
table.FM-EN-76-00 tbody tr td input{ width: 100%; border:none; background-color:#fff; padding:1px 1px; cursor:pointer; text-align:center; font-size:0.80rem; font-family:arial;}
table.FM-EN-76-00 tbody tr td input:focus{ background-color:#cce7e8; border:none; outline: none;}

.btn-sm{ padding:1px 6px;}

.table-none{  border:none; display: block;}
.table-none thead{  border:none;}
.table-none thead tr th{ border:none;}

.testxxx{ display: block; width:40%; max-width:40%; background-color: rgba(255, 0, 0, 0.3); position: absolute; left:50%; margin:auto; margin-top:-10px;margin-left:50px; text-align:center; }
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

  <!--<div class="col-sm-6">
        <span class="irs-bar irs-bar--single" style="left: 0px; width: 50%;"></span><span class="irs-shadow shadow-single" style="display: none;"></span><span class="irs-handle single" style="left: 47.6744%;"><i></i><i></i><i></i></span></span><input id="range_6" type="text" name="range_6" value="" class="irs-hidden-input" tabindex="-1" readonly="">
  </div>
</div>-->

<!--<img src="module/module_en_report/img_test/FM-EN-76-00.jpg" class="img" width="100%"><br /><br />-->
<table class="FM-EN-76-00 table-bordered">
    <thead>
    <tr>
      <th colspan="28">
        <table class="table-borderless">
          <thead>
            <tr>
              <th width="20%"><img src="dist/img/logo_2.png" width="250"></th>
              <th width="50%" style="text-align:left; padding:30px 10px;">Pacific Cold Storage Co. Ltd (Mahachai) <br/> 47/19 Moo2, Nadee, Muang, Samutsakorn 74000 Tel. +66 3411 7899</th>
              <th width="30%" style="text-align:right; font-size:0.90rem;"><strong>ใบ Report 9 (Compessor 1-2)<br />ประจำวันที่:</strong></th>
            </tr>
          </thead>
        </table>
      </th>
    </tr>
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
    //data-target="#modal-default"
    echo '
    <tr>
    <td>'.($value<10 ? 0 : '').number_format($value,2).'</td>
    <td><input type="text" name="col_com_29_sp_'.$value.'" id="col_com_29_sp_'.$value.'" maxlength="10" placeholder="" readonly class="show_numpad" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="col_com_29_sp_'.$value.'"></td>
    <td><input type="text" name="col_com_29_dp_'.$value.'" id="col_com_29_dp_'.$value.'" maxlength="10" placeholder="" readonly class="show_numpad" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="col_com_29_dp_'.$value.'"></td>
    <td><input type="text" name="col_com_29_op_'.$value.'" id="col_com_29_op_'.$value.'" maxlength="10" placeholder="" readonly class="show_numpad" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="col_com_29_op_'.$value.'"></td>
    <td><input type="text" name="col_com_29_afp_'.$value.'" id="col_com_29_afp_'.$value.'" maxlength="10" placeholder="" readonly class="show_numpad" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="col_com_29_afp_'.$value.'"></td>
    <td><input type="text" name="col_com_29_st_'.$value.'" id="col_com_29_st_'.$value.'" maxlength="10" placeholder="" readonly class="show_numpad" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="col_com_29_st_'.$value.'"></td>
    <td><input type="text" name="col_com_29_dt_'.$value.'" id="col_com_29_dt_'.$value.'" maxlength="10" placeholder="" readonly class="show_numpad" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="col_com_29_dt_'.$value.'"></td>
    <td><input type="text" name="col_com_29_ot_'.$value.'" id="col_com_29_ot_'.$value.'" maxlength="10" placeholder="" readonly class="show_numpad" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="col_com_29_ot_'.$value.'"></td>
    <td><input type="text" name="col_com_29_dop_'.$value.'" id="col_com_29_dop_'.$value.'" maxlength="10" placeholder="" readonly class="show_numpad" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="col_com_29_dop_'.$value.'"></td>
    <td><input type="text" name="col_com_29_it_'.$value.'" id="col_com_29_it_'.$value.'" maxlength="10" placeholder="" readonly class="show_numpad" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="col_com_29_it_'.$value.'"></td>
    <td><input type="text" name="col_com_29_ip_'.$value.'" id="col_com_29_ip_'.$value.'" maxlength="10" placeholder="" readonly class="show_numpad" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="col_com_29_ip_'.$value.'"></td>
    <td><input type="text" name="col_com_29_svp_'.$value.'" id="col_com_29_svp_'.$value.'" maxlength="10" placeholder="" readonly class="show_numpad" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="col_com_29_svp_'.$value.'"></td>
    <td><input type="text" name="col_com_29_lsv_'.$value.'" id="col_com_29_lsv_'.$value.'" maxlength="10" placeholder="" readonly class="show_numpad" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="col_com_29_lsv_'.$value.'"></td>
    <td><input type="text" name="col_com_29_ma_'.$value.'" id="col_com_29_ma_'.$value.'" maxlength="10" placeholder="" readonly class="show_numpad" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="col_com_29_ma_'.$value.'"></td>
    <td><input type="text" name="xxxxxxxxx" id="xxxxxxxxx" maxlength="10" placeholder="" readonly class="show_numpad"></td>
    <td><input type="text" name="xxxxxxxxx" id="xxxxxxxxx" maxlength="10" placeholder="" readonly class="show_numpad"></td>
    <td><input type="text" name="xxxxxxxxx" id="xxxxxxxxx" maxlength="10" placeholder="" readonly class="show_numpad"></td>
    <td><input type="text" name="xxxxxxxxx" id="xxxxxxxxx" maxlength="10" placeholder="" readonly class="show_numpad"></td>
    <td><input type="text" name="xxxxxxxxx" id="xxxxxxxxx" maxlength="10" placeholder="" readonly class="show_numpad"></td>
    <td><input type="text" name="xxxxxxxxx" id="xxxxxxxxx" maxlength="10" placeholder="" readonly class="show_numpad"></td>
    <td><input type="text" name="xxxxxxxxx" id="xxxxxxxxx" maxlength="10" placeholder="" readonly class="show_numpad"></td>
    <td><input type="text" name="xxxxxxxxx" id="xxxxxxxxx" maxlength="10" placeholder="" readonly class="show_numpad"></td>
    '.($value==18 ? '<td><div class="testxxx">STOP</div></td>' : '<td><input type="text" name="xxxxxxxxx" id="xxxxxxxxx" maxlength="10" placeholder="" readonly class="show_numpad"></td>').'
    
    <td><input type="text" name="xxxxxxxxx" id="xxxxxxxxx" maxlength="10" placeholder="" readonly class="show_numpad"></td>
    <td><input type="text" name="xxxxxxxxx" id="xxxxxxxxx" maxlength="10" placeholder="" readonly class="show_numpad"></td>
    <td><input type="text" name="xxxxxxxxx" id="xxxxxxxxx" maxlength="10" placeholder="" readonly class="show_numpad"></td>
    <td><input type="text" name="xxxxxxxxx" id="xxxxxxxxx" maxlength="10" placeholder="" readonly class="show_numpad"></td>
    <td><button type="button" class="btn btn-warning btn-sm edit-data" data-id="00000" data-toggle="modal" data-target="#modal-default" id="xxxxxxx" data-backdrop="static" data-keyboard="false" title="xxxxxx"><i class="fa fa-xs fa-copy"></i></button> <button type="button" class="btn btn-danger btn-sm edit-data" data-id="00000" data-toggle="modal" data-target="#modal-default" id="xxxxxxx" data-backdrop="static" data-keyboard="false" title="xxxxxx"><i class="fa fa-xs fa-undo"></i></button></td>
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

$(document).on('click','.show_numpad',function(e){ 
  var col_name = $(this).data('id');
  var col_val  = $(this).val();
  if(col_val!=''){
    $('#display_num').val(col_val);  
  }
  $('#col_name').val(col_name);
  //$('.modal-title').text(col_name);
  $("#modal-default").modal("show");
});

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