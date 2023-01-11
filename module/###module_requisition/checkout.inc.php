<?PHP 
if(!isset($_SESSION['cart_item']) || count($_SESSION["cart_item"])==0){
  header('Location:?module=requisition');
}
?>
<style type="text/css">

.ui-w-40 {
    width:40px !important;
    height: auto;
}

@media print {
  .req_remark{ 
    border:0px;background-color:#FFF;
  }

/* WebKit browsers */
input:focus::-webkit-input-placeholder { color:transparent; }

/* Mozilla Firefox 4 to 18 */
input:focus:-moz-placeholder { color:transparent; }

/* Mozilla Firefox 19+ */
input:focus::-moz-placeholder { color:transparent; }

/* Internet Explorer 10+ */
input:focus:-ms-input-placeholder { color:transparent; }

}

.bill-footer{ line-height:1.9rem;}


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
    $No = 0;
    if(isset($_SESSION["cart_item"]) && count($_SESSION["cart_item"])>0){
      foreach ($_SESSION["cart_item"] as $item){
        $No++;
        echo '
        <tr>
        <td>'.$No.'</td>
        <td>'.$item['itemCode'].'</td>
        <td><img src="'.$item['image'].'" class="d-block ui-w-40 ui-bordered mr-4 border p-1" alt=""></td>
        <td>'.$item['name'].'</td>
        <td>'.number_format($item["quantity"],0).' '.$item["unit"].'</td>
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
  <p class="view_remark d-none"></p>
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

    <div class="bill-footer col-2 border border-gray border-right-0 p-2">
        <div class="title">ผู้เบิก:</div>
        <div class="w-100 text-center">_________________________</div>
        <div></div>
        <div class="w-100 text-center">___________________</div>
        <div class="w-100 text-center">(ผู้เบิก)</div>
    </div>

    <div class="bill-footer col-2 border border-gray border-right-0 p-2">
        <div class="title">ผู้อนุมัติ:</div>
        <div class="w-100 text-center">_________________________</div>
        <div></div>
        <div class="w-100 text-center">___________________</div>
        <div class="w-100 text-center">(ผู้อนุมัติ)</div>
    </div>

    <div class="bill-footer col-2 border border-gray  p-2">
        <div class="title">ผู้จ่าย:</div>
        <div class="w-100 text-center">_________________________</div>
        <div></div>
        <div class="w-100 text-center">___________________</div>
        <div class="w-100 text-center">(ผู้จ่าย)</div>
    </div>

</div>


<div class="row no-print mt-5">
<div class="col-12">
<a rel="noopener" target="_blank" onclick="window.print();" class="btn btn-default btn-print"><i class="fas fa-print"></i> พิมพ์</a>
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

  $(document).on("click", ".btn-print", function (event) {
    //var req_remark = $('.req_remark').val();
    //$('.view_remark').html(req_remark).toggleClass("d-none d-inline");
    //alert(req_remark);
  });


  $(document).on("click", ".save-req", function (event) {
    var req_remark = $('.req_remark').val();
    var rowCount = $('#table-req tbody tr').length;
    //alert(rowCount);

    if(rowCount<=0){
      sweetAlert("ผิดพลาด!", "ยังไม่มีรายการเบิก", "error");
      return false;
    }
    swal({
        title: "ยืนยันการส่งใบเบิก ?",   text: "ต้องการส่งใบเบิกรายการนี้หรือไม่.",
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "ตกลง, ส่งใบเบิก",
        cancelButtonText: "ไม่, ยกเลิก",        
        closeOnConfirm: false 
      }, function(){   
        $.ajax({
            url: "module/module_requisition/cart_action.php",
            type: "POST",
            dataType: "json",
            data:{req_remark:req_remark, action:"save-requisition"},
            beforeSend: function () {
              //$("#overlay").fadeIn();
            },success: function (json) {
              console.log(json); 
              if(json.error=='over_req'){
                sweetAlert("ผิดพลาด!", "รหัส:"+json.offsupps_code+" จำนวนคงเหลือไม่พอให้เบิกแล้ว", "error");
                return false;
              }
              swal({
                title: "ส่งใบเบิกเรียบร้อย!",
                text: "ใบเบิกของคุณอยู่ระหว่างการอนุมัติ.",
                type: "success",
                //timer: 3000
              }, 
              function(){
                window.location.href = "?module=requisitionlist";
              })
          },error: function (json) {
            console.log(json);
            sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
          }
        });
    });
    event.preventDefault();
    return false;
  });




});  

</script>