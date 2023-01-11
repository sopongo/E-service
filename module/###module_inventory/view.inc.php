<?PHP
$obj = new CRUD();
//$numRow_player = $obj->getCount("SELECT count(id_menu) AS total_row FROM tb_category");


/*
$url = 'slt_location=1&slt_id_offsupp_location=24&period=12%2F19%2F2022%20-%2012%2F19%2F2022';
parse_str($url, $output);
echo $output['period'];
*/
?>    
<style>
.select2{ font-size:0.95em ; }
</style>
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

    <div class="table-responsive rounded-lg bg-light p-2"><!--000-->
          <form id="addinv" name="addinv" class="addinv" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="offset-md-12 col-md-12 col-sm-12 pt-2 pb-2">
              <div class="form-group">  
                <h4 class="card-title font-weight-bold mb-2"><i class="fas fa-exchange-alt"></i> เลือกรหัสวัสดุ-อุปกรณ์ และช่วงเวลาที่ต้องการดูรายการ</h4>
              </div>
            </div>

            <div class="card-body pb-0">
            <div class="row">

            <div class="col-md-5 pb-2">
                <div class="form-group mb-0"><!-- .form-group -->
                  <label>ไซต์งาน</label>
                  <select class="slt_location form-control select2" style="width:100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="slt_location" id="slt_location">
                    <option data-id="0" disabled selected value="0">เลือกไซต์งาน</option>
                    <?PHP
                      $_SESSION['sess_class_user']!=4 ? $conditon_query = 'WHERE id_location='.$_SESSION['sess_id_location'].' AND' : $conditon_query = 'WHERE ';
                      $fetchRow = $obj->fetchRows("SELECT tb_location.* FROM tb_location $conditon_query status_location=1 ORDER BY id_location DESC");
                      if (!empty($fetchRow)) {
                        foreach($fetchRow as $key=>$value){
                          echo '<option '.($fetchRow[$key]['id_location']==$_SESSION['sess_id_location'] ? '' : '').' data-select2-id="'.$fetchRow[$key]['id_location'].'" value="'.$fetchRow[$key]['id_location'].'">'.$fetchRow[$key]['location_short'].'-'.$fetchRow[$key]['location_name'].'</option>';//selected="selected"
                        }
                      }                      
                    ?>
                  </select>                                    
                </div>
                <!-- /.form-group -->
              </div><!-- /.col -->

              <div class="col-md-5 pb-0">
                <div class="form-group mb-0"><!-- .form-group -->
                  <label>รหัสวัสดุ-อุปกรณ์ (เลือกหมวดหลักก่อน)</label>
                  <select class="slt_id_offsupp_location form-control select2 select2-hidden-accessible" style="width:100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" id="slt_id_offsupp_location" name="slt_id_offsupp_location">
                  <option data-id="0" disabled selected value="0">เลือกวัสดุ-อุปกรณ์</option>
                  </select>
                </div>
                <!-- /.form-group -->
              </div><!-- /.col -->            
              
              <div class="col-md-5 pb-2">
                <div class="form-group mb-0"><!-- .form-group -->
                  <label>หมวดหลัก</label>
                  <select class="ref_id_menu form-control select2 select2-hidden-accessible" style="width:100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" id="ref_id_menu" name="ref_id_menu">
                    <?PHP
                      $rowData = $obj->fetchRows("SELECT id_menu, menu_code, name_menu FROM tb_category WHERE level_menu=1 ORDER BY id_menu ASC");
                        echo '<option value="0" disabled selected>เลือกหมวดหลัก</option>';
                        if (count($rowData)!=0) {
                          foreach($rowData as $key => $value) {
                            echo '<option value="'.$rowData[$key]['id_menu'].'">'.$rowData[$key]['menu_code'].' - '.$rowData[$key]['name_menu'].'</option>';
                          }
                        }
                    ?>
                  </select>                                    
                </div>
                <!-- /.form-group -->
              </div><!-- /.col -->

              <div class="col-md-5 pb-0">
                <div class="form-group mb-0"><!-- .form-group -->
                  <label>หมวดย่อย</label>
                  <select id="ref_id_menu_sub" class="ref_id_menu_sub form-control select2 select2-hidden-accessible" style="width:100%;" data-id="1" tabindex="-1" aria-hidden="true">
                    <option selected="selected" data-select2-id="3">เลือกหมวดหลักก่อน</option>
                  </select>                                    
                </div>
                <!-- /.form-group -->
              </div><!-- /.col -->              

              <div class="col-md-5 pb-0">
                <label>ช่วงเวลารับ-จ่าย:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control select2 float-right" id="period" name="period" value="<?PHP echo date('m/d/Y').' - '.date('m/d/Y'); ?>" />
                </div>
                <!-- /.input group -->
              </div>


              <div class="col-md-5 pb-0">
                <label>&nbsp;</label>
                <div class="form-group mb-0"><!-- .form-group -->
                  <input class="btn btn-success btn-search" type="button" id="btn-search" value="แสดงรายการรับ-จ่าย" />
                  <input class="btn btn-danger btn-reset" type="reset" id="btn-reset" value="รีเซ็ต" />
                </div>
                <!-- /.form-group -->
              </div><!-- /.col -->                            

              </div><!-- /.card-body -->
            </div><!-- /.card-body -->
          
          </form>
        </div><!--000-->

<?PHP

?>

<p class="mt-3 text-bold inven-title">&nbsp;</p>

<div class="table-responsive">
<table id="tb_inventory" class="table table-bordered table-striped table-hover table-md text-nowrap table-fixed">
  <thead>
    <tr>
      <th class="th-md col-1">วันที่ทำรายการ</th>
      <th class="th-md col-3">รายการ</th>
      <th class="th-md col-3">ลอต</th>
      <th class="th-md col-1">รับเข้า</th>
      <th class="th-md col-1">จ่ายออก</th>
      <th class="th-md col-1">รับคืน</th>
      <th class="th-md col-1">ปรับยอด</th>
      <th class="th-md col-1">คงเหลือ</th>
    </tr>
  </thead>
  <tbody>
  <tr>
      <td colspan="8" class="text-center">ยังไม่ได้เลือกรายการ</td>
    </tr>   
  </tbody>
</table>
</div><!-- /.table-responsive -->

  </div><!-- /.card-body -->
  </div><!-- /.card -->

</section>
<!-- /.content -->

<!-- daterange picker -->
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script>
  $(function () {
    //Date range picker
    $('#period').daterangepicker({
      format: "YYYY/mm/dd - YYYY/mm/dd"
    });
  });


  $(document).on('change','select[id=slt_location]',function(e){
    var val_location = $("#slt_location option:selected" ).val();
    var ref_id_menu = $("#ref_id_menu option:selected" ).val();
    var ref_id_menu_sub = $("#ref_id_menu_sub option:selected" ).val();
    //alert(val_location); return false;
    $.ajax({
      url: "module/module_inventory/ajax_action.php",
      type: "POST",
      dataType: "json",
      data: { action: "chk_offsupp_location", val_location:val_location, ref_id_menu:ref_id_menu, ref_id_menu_sub:ref_id_menu_sub },
      beforeSend: function () {
        $("#slt_id_offsupp_location option").remove();
        $("#ref_id_menu_sub option").remove();
      },
      success: function (result) {
        console.log(result);
        $('#slt_id_offsupp_location').append(result.listsupp);
        $('#ref_id_menu_sub').append(result.subcate);
      },
      error: function (result) {
        console.log("ผิดพลาด: "+result);
      },
    });
    e.preventDefault();
  });

  $(document).on('change','select[id=ref_id_menu], select[id=ref_id_menu_sub]',function(){
    var val_location = $("#slt_location option:selected" ).val();
    var ref_id_menu = $("#ref_id_menu option:selected" ).val();
    var ref_id_menu_sub = $("#ref_id_menu_sub option:selected" ).val();
    //alert(val_location); return false;
    if(val_location==0){
      sweetAlert("ผิดพลาด..", "กรุณาเลือกไซต์งานก่อน", "warning"); 
      $('#ref_id_menu option:eq(0)').prop('selected', true)
      return false;
    }
    $.ajax({
      url: "module/module_inventory/ajax_action.php",
      type: "POST",
      dataType: "json",
      data: { action: "chk_offsupp_location", val_location:val_location, ref_id_menu:ref_id_menu, ref_id_menu_sub:ref_id_menu_sub },
      beforeSend: function () {
        $("#slt_id_offsupp_location option").remove();
        $("#ref_id_menu_sub option").remove();
      },
      success: function (result) {
        console.log(result);
        $('#slt_id_offsupp_location').append(result.listsupp);
        $('#ref_id_menu_sub').append(result.subcate);
      },
      error: function (result) {
        console.log("ผิดพลาด: "+result);
      },
    });
    //e.preventDefault();   //slt_location ref_id_menu
  });  

  $(document).on('click','.btn-reset',function(){
    $('form#addinv')[0].reset();
    $('#tb_inventory tbody tr').remove();
    $('#tb_inventory tbody').html('<tr><td colspan="8" class="text-center">ยังไม่ได้เลือกรายการ</td></tr>');
    $('.inven-title').html("&nbsp;");
  });

  $(document).on('click','.btn-search',function(){
    //$("#addinv").submit(function(event){    
    var val_location = $("#slt_location option:selected" ).val();
    var ref_id_menu = $("#ref_id_menu option:selected" ).val();
    var ref_id_menu_sub = $("#ref_id_menu_sub option:selected" ).val();
    var slt_id_offsupp_location = $("#slt_id_offsupp_location option:selected" ).val();
    var slt_id_offsupp_location_txt = $("#slt_id_offsupp_location option:selected" ).text();
    var period_date = $('#period').val().split(" - ");

    var period_start = new Date(period_date[0]);
    var period_end = new Date(period_date[1]);
    var current_date= new Date('<?php echo date('m/d/Y');?>');

    //var data = $('form#addinv').serialize() + '&' + $.param(object)    
    /*if((period_start>current_date)  || period_end>current_date){
      sweetAlert("ผิดพลาด..", "วันที่เลือกมากกว่าวันที่ปัจจุบัน", "warning"); return false;      
    }*/    
    if(val_location==0){
      sweetAlert("ผิดพลาด..", "กรุณาเลือกไซต์งานก่อน", "warning"); return false;
    }
    /*if(ref_id_menu==0){
      sweetAlert("ผิดพลาด..", "กรุณาเลือกหมวดหลักก่อน", "warning"); return false;
    }*/
    if(slt_id_offsupp_location==0){
      sweetAlert("ผิดพลาด..", "กรุณาเลือกรหัสวัสดุ-อุปกรณ์", "warning"); return false;
    }
    var data = $('form#addinv').serialize();
    //alert(data); return false;
    $.ajax({
      url: "module/module_inventory/ajax_action.php",
      type: "POST",
      dataType: "json",
      data: { action: "inventory", data:data},
      beforeSend: function () {
        $('#tb_inventory tbody tr').remove();
      },
      success: function (result) {
        //console.log(result);
        $('#tb_inventory tbody').html(result.tbody);
        $('.inven-title').html(result.title);
        $('.offsupps-code').html(slt_id_offsupp_location_txt);
      },
      error: function (result) {
        console.log("ผิดพลาด: "+result);
      },
    });    
    event.preventDefault();
  });  

</script>