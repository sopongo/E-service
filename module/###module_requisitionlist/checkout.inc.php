<?PHP 
?>
<style type="text/css">

.ui-w-40 {
    width:40px !important;
    height: auto;
}
</style>

<!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        
      <div class="card-header no-print">
          <h4 class="display-10 d-inline-block font-weight-bold"><?PHP echo $title_act;?></h4>
          <div class="card-tools">
            <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active">สรุปรายการเบิกวัสดุ-อุปกรณ์</li>
            </ol>
          </div>
        </div>




        <div class="card-body">
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="callout callout-info no-print">
<h5><i class="fas fa-info"></i> Note:</h5>
ใบเบิกจะสมบรูณ์และจ่ายของตามรายการได้ เมื่อผู้จัดการ,หัวหน้าแผนกอนุมัติแล้วเท่านั้น
</div>

<div class="invoice p-3 mb-3">

<div class="row">
<div class="col-12 mt-4">
<h4>
<img src="dist/img/logo_2.png" alt="JWD Logo" class="brand-image" width="120" /> JWD Cold Chain ใบเบิกวัสดุ-อุปกรณ์สำนักงาน<small class="float-right">Date: <?PHP echo date('Y/m/d');?></small>
</h4>
</div>

</div>

<div class="row invoice-info mt-4">
<div class="col-sm-3 invoice-col">
<strong>ผู้เบิก (<?PHP echo $_SESSION['sess_no_user'];?>)</strong>
<address>
<strong><?PHP echo $_SESSION['sess_fullname'];?></strong><br>
ไซต์งาน: <?PHP echo $_SESSION['sess_location_name'];?><br />
แผนก: <?PHP echo $_SESSION['sess_dept_name'];?><br />
อีเมล์: <?PHP echo $_SESSION['sess_email'];?>
</address>
</div>

<div class="col-sm-3 invoice-col">
<strong>ผู้อนุมัติ</strong>
<address>
<strong>Waiting..</strong><br>
ไซต์งาน: -<br />
แผนก: -<br />
อีเมล์: -
</address>
</div>

<div class="col-sm-2 invoice-col">
<strong>ผู้จ่าย</strong>
<address>
<strong>Waiting..</strong><br>
ไซต์งาน: -<br />
แผนก: -<br />
อีเมล์: -
</address>
</div>

<div class="col-sm-4 invoice-col">
<b>เลขที่ใบเบิก Waiting..</b><br>
<br>
<b style="width:23%; display:inline-block;">วันที่เบิก:</b> <?PHP echo date('Y-m-d H:i:s');?><br />
<b style="width:23%; display:inline-block;">วันที่อนุมัติ:</b> -<br />
<b style="width:23%; display:inline-block;">วันที่จ่าย:</b> -<br />
</div>

</div>


<div class="row">
<div class="col-12 table-responsive">
<table class="table table-striped" id="table-req">
<thead>
<tr>
<th>#</th>
<th>รหัสวัสดุอุปกรณ์</th>
<th>รูป</th>
<th>ชื่อวัสดุอุปกรณ์</th>
<th>จำนวนที่เบิก</th>
</tr>
</thead>

<tbody>

<?PHP
              if(isset($_SESSION["cart_item"]) && count($_SESSION["cart_item"])>0){
                $No = 0;
                foreach ($_SESSION["cart_item"] as $item){
                  $No++;
                  echo '
                  <tr>
                  <td>'.$No.'</td>
                  <td>'.$item['itemCode'].'</td>
                  <td><img src="'.$item['image'].'" class="d-block ui-w-40 ui-bordered mr-4 border p-1" alt=""></td>
                  <td>'.$item['name'].'</td>
                  <td>'.$item["quantity"].' '.$item["unit"].'</td>
                  </tr>';
                }
              }else{
                echo '<tr class="tr_notfound"><td colspan="5" class="text-center">ยังไม่มีรายการเบิก</td></tr>';
              }
?>
</tbody>
</table>
<hr />
</div>

</div>

<div class="row">

<div class="col-6">
<p class="lead">Memo / Remark:</p>
<div class="col-sm-0">
<!-- textarea -->
<div class="form-group">
<textarea class="form-control req_remark" name="req_remark" rows="3" placeholder="ใส่ข้อความถึงผู้จ่าย (ถ้ามี) ..."></textarea>
</div>
</div>
</div>

<div class="col-6">
<p class="lead">รวมรายการเบิก:</p>
<div class="table-responsive">
<table class="table table-border">
<tbody><tr>
<th style="width:55%">รวม:</th>
<td><?PHP echo $No;?> รายการ</td>
</tr>
</table>
</div>
</div>

</div>


<div class="row no-print">
<div class="col-12">
<a rel="noopener" target="_blank" onclick="window.print();" class="btn btn-default"><i class="fas fa-print"></i> พิมพ์</a>
<button type="button" class="btn btn-default" onclick="history.back();"><i class="fas fa-angle-double-left"></i> ย้อนกลับ</button>

<button type="button" class="btn btn-success float-right save-req"><i class="far fa-credit-card"></i> ส่งใบเบิก</button>
</div>
</div>
</div>

</div>
</div>
</div>
</section>
        </div><!-- /.card-body -->

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->



<script type="text/javascript"> 
$(document).ready(function(){



  $(document).on("click", ".save-req", function (event) {
    var req_remark = $('.req_remark').val();
    var rowCount = $('#table-req tbody tr').length;
    //alert(rowCount);
    if(rowCount<=0){
      sweetAlert("ผิดพลาด!", "ยังไม่มีรายการเบิก", "error");
      return false;
    }
    sweetAlert({
    title: "ยืนยันการส่งใบเบิก ?",
    text: "ต้องการส่งใบเบิกรายการนี้หรือไม่!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "ตกลง, ส่งใบเบิก",
    cancelButtonText: "ไม่, ยกเลิก",
    closeOnConfirm: true,
    closeOnCancel: true
    },
      function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: "module/module_requisition/cart_action.php",
            type: "POST",
            dataType: "json",
            data:{req_remark:req_remark, action:"save-requisition"},
            beforeSend: function () {
              //$("#overlay").fadeIn();
            },success: function (json) {
                console.log(json); return false;
                window.location = '?module=requisitionlist';
                sweetAlert({
                  title: "Hello World", 
                  type: "error",   
                  showConfirmButton: true,
                  confirmButtonText: "Ok",
                  closeOnConfirm: true 
                }, function() {
                  window.location = '?module=requisitionlist';
                });
            },error: function (json) {
              console.log(json);
              sweetAlert("ผิดพลาด!", "ไม่สามารถลบข้อมูลได้", "error");
            }
          });
        } else {
          sweetAlert.close();
        }
      });
    event.preventDefault();
    return false;
  });



});  

</script>