<script src="plugins/autoNumeric/autoNumeric.js"></script>


<script type="text/javascript">  
(function () {  
'use strict';  
window.addEventListener('load', function () {  
    var form = document.getElementById('needs-validation-rcv');  
    form.addEventListener('submit', function (event) {  
        if (form.checkValidity() === false) {  
            event.preventDefault();  
            event.stopPropagation();  
        }  
        form.classList.add('was-validated');  
    }, false);  
}, false);  
})();  

</script> 


<!-- adj form modal -->
<div class="modal fade" id="adjModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">ปรับยอดวัสดุ-อุปกรณ์<i class="fa fa-user-circle-o" aria-hidden="true"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>


    <!--FORM 1-->
    <div class="container py-1">
        <div class="row">  
            <div class="offset-md-0 col-md-12 offset-md-0">  
                <div class="card">  
                    <div class="card-header bg-primary text-white">  
                        <h4 class="card-title text-uppercase">กรอกรายละเอียด</h4>  
                    </div>  
                    <div class="card-body">  
                        <form id="needs-validation_adj" class="addadj" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">

                        <div class="col-sm-10 col-md-10 col-xs-10"><!--000-->
                            <div class="form-group">  
                            <label for="firstname">ชื่อวัสดุ-อุปกรณ์:</label> <div class="d-inline w-auto" id="offsupp_name"></div>
                            <label for="firstname">หมวด:</label> <div class="d-inline w-auto" id="offsupp_cate"></div>
                            </div>
                            <div class="form-group">  
                                <label for="firstname">คงเหลือปัจจุบัน:</label> <div class="d-inline w-auto" id="total_balance"></div>
                                <input type="hidden" name="val_total_balance" id="val_total_balance" val="">
                            </div>
                        </div><!--000-->


                        <table id="table-lot" class="table">
                            <thead>
                                <th>ลำดับ</th>
                                <th>วันที่รับเข้า</th>
                                <th>เลขที่ PO</th>
                                <th>ลอต</th>
                                <th>จำนวน</th>
                                <th>ราคาต่อหน่วย</th>
                                <th>แก้ไข</th>
                            </thead>
                            <tbody></tbody>
                        </table>

                        </form>  
                    </div>  
                </div>  
            </div>  
        </div>  
    </div>  
    <!--FORM 1-->

  

    </div>    

    </div>
  </div>
</div>
<!-- adj form modal end -->




<!-- rcv form modal -->
<div class="modal fade" id="rcvModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">รับเข้าวัสดุ-อุปกรณ์<i class="fa fa-user-circle-o" aria-hidden="true"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>


    <!--FORM 1-->
    <div class="container py-1">
        <div class="row">  
            <div class="offset-md-0 col-md-12 offset-md-0">  
                <div class="card">  
                    <div class="card-header bg-primary text-white">  
                        <h4 class="card-title text-uppercase">กรอกรายละเอียด</h4>  
                    </div>  
                    <div class="card-body">  
                        <form id="needs-validation-rcv" class="addrcv" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">

                        <div class="col-sm-10 col-md-10 col-xs-10"><!--000-->
                            <div class="form-group">  
                            <label for="firstname">ชื่อวัสดุ-อุปกรณ์:</label> <div class="d-inline w-auto" id="offsupp_name_rcv"></div>
                            <label for="firstname">หมวด:</label> <div class="d-inline w-auto" id="offsupp_cate_rcv"></div>
                            </div>
                            <div class="form-group">  
                                <label for="firstname">คงเหลือปัจจุบัน:</label> <div class="d-inline w-auto" id="total_balance_rcv"></div>
                                <input type="hidden" name="val_total_balance" id="val_total_balance_rcv" val="">
                            </div>
                        </div><!--000-->


<div class="row align-items-start">
    <div class="col-md-4">
        <div class="form-group p-0 m-0"><label for="po_no">เลขที่ PO / เลขที่รับเข้า:<label></div>
        <input type="text" class="form-control input-md" name="po_no" id="po_no" required />    
        <div class="invalid-feedback">กรอกเลขที่ PO / เลขที่รับเข้า</div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group p-0 m-0"><label for="po">วันที่รับเข้า:<label></div>
            <div class="input-group date" id="reservationdate" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input input-md mr-0" id="date_rcv" name="date_rcv" value="<?PHP echo date('Y/m/d');?>" data-target="#reservationdate" required />
            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            <div class="invalid-feedback">เลือกวันที่รับเข้า</div>
        </div>
        </div>
    </div>
</div>

<div class="row align-items-start mt-2">
    <div class="col-md-4">
        <div class="form-group p-0 m-0"><label for="po">ชื่อ Lot:<label></div>
        <input type="text" class="form-control input-md" name="lot_name" id="lot_name" required />
        <div class="invalid-feedback">กรอกชื่อ Lot</div>    
    </div>
    
    <div class="col-md-2">
        <div class="form-group col-md- p-0 m-0"><label for="po">จำนวนที่รับเข้า:<label>
            <input type="text" class="form-control input-md col-md-5 d-inline mt-2 numeric_nocom"  name="rcv_qty" id="rcv_qty" required /> 
            <label for="unit_name" class="d-inline" id="unit_name"><label>
            <div class="invalid-feedback">**</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group p-0 m-0"><label for="po">ราคาต่อหน่วย:<label>
            <input type="text" class="form-control input-md col-md-5 d-inline mt-2 numeric" name="unit_price" id="unit_price" required /> 
            <label for="price" class="d-inline">บาท<label>
            <div class="invalid-feedback">**</div>
        </div>
    </div>

</div>

        <div class="row mt-3 pt-3 border-top w-100">
            <div class="col-md-12">
                <div class="float-right">  
                <button type="button" class="btn btn-danger btn-close" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-success" id="addButton">บันทึก</button>
                <input type="hidden" name="action" value="addrcv">
                <input type="hidden" name="ref_id_offsupp" id="ref_id_offsupp" />
                </div>                            
            </div>  
        </div>  


                        </form>  
                    </div>  
                </div>  
            </div>  
        </div>  
    </div>  
    <!--FORM 1-->

  

    </div>    

    </div>
  </div>
</div>
<!-- rcv form modal end -->



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

<script type="text/javascript"> 

//It restrict the non-numbers
var specialKeys = new Array();
specialKeys.push(8,46,9); //Backspace
function IsNumeric(e) {
    var keyCode = e.which ? e.which : e.keyCode;
    console.log( keyCode );
    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
    return ret;
}


$(document).ready(function(){

    
   $(document).on("click", ".btn-close", function (event) {
    $('body').find('.was-validated').removeClass();
    $('form').each(function() { this.reset() });
   });


    //เมื่อกดปุ่ม rcv_action จะเรียกข้อมูลวัสดุ+แสดงฟอร์มรับเข้า
    $(document).on("click", "a.rcv_action", function () {
    var id_offsupp = $(this).data("id");
    $("#rcvModal").modal("show"); 
    //alert(id_offsupp); return false;
    $.ajax({
        url: "module/module_office_supplies/ajax_inven_action.php",
        type: "GET",
        dataType: "json",
        data: { id_offsupp:id_offsupp, action:"rcv" },
        beforeSend: function () {
        $("#overlay").fadeIn();
        },
        success: function (row){
        console.log(row);
        $("#offsupp_name_rcv").html(row.offsupp_name);
        $("#total_balance_rcv").html(addCommas(row.total_balance)+' '+row.unit_name);
        $("#offsupp_cate_rcv").html(row.mainName+' » '+row.SubName);
        $("#ref_id_offsupp").val(id_offsupp);
        $("#val_total_balance_rcv").val(row.total_balance);
        $("#unit_name_rcv").text(row.unit_name);

        $("#overlay").fadeOut();
        },
        error: function () {
        console.log(row);
        console.log("Error!!");
        },
    });
    });

        
  /*ปุ่ม ADD Recive รับวัสดุเข้าระบบ*/
  $(document).on("submit", ".addrcv", function (event) {
    event.preventDefault();         
    var alertmsg =
      $("#id_offsupp").val().length > 0
        ? "เพิ่มรายการรับเข้าเรียบร้อยแล้ว"
        : "เพิ่มข้อมูลเรียบร้อยแล้ว";
        //alert(alertmsg); return false;        
    $.ajax({
      url: "module/module_office_supplies/ajax_inven_action.php",
      type: "POST",
      dataType: "json",
      data: new FormData(this),
      processData: false,
      contentType: false,
      beforeSend: function () {
        //$("#overlay").fadeIn();
      },
      success: function (row) {
        console.log(row);
        //return false;
        func_getDatalist();
        $(".addrcv")[0].reset();
        $("#overlay").fadeOut();
        $("#rcvModal").modal("hide"); 
        $(".modal-backdrop").hide().fadeOut();
        sweetAlert("สำเร็จ...", alertmsg, "success"); //The error will display
      },
      error: function () {
        console.log(row);
        console.log("ไม่สำเร็จ! มีบางอย่างผิดพลาด!");
      },
    });
  });

/*เมื่อคลิกปุ่มคลาส adj_action จะแสดงฟอร์มปรับยอด เรียกจากไฟล์ frm_rcv-cut.inc.php ที่ include*/
$(document).on("click", "a.adj_action", function () {
    var id_offsupp = $(this).data("id");
    $("#adjModal").modal("show"); 
    //alert(id_offsupp); return false;
    $.ajax({
      url: "module/module_office_supplies/ajax_inven_action.php",
      type: "GET",
      dataType: "json",
      data: { id_offsupp:id_offsupp, action:"adj" },
      beforeSend: function () {
        //$("#overlay").fadeIn();
      },
      success: function (Data) {
        console.log(Data);

        $("#offsupp_name").html(Data.row.offsupp_name);
        $("#total_balance").html(addCommas(Data.row.total_balance)+' '+Data.row.unit_name);
        $("#offsupp_cate").html(Data.row.mainName+' » '+Data.row.SubName);
        $("#ref_id_offsupp").val(id_offsupp);
        $("#val_total_balance").val(Data.row.total_balance);
        $("#unit_name").text(Data.row.unit_name);
        $("#table-lot tbody").append(Data.lot);


        $("#overlay").fadeOut();
      },
      error: function () {
        console.log(Data);
        console.log("Error!!");
      },
    });
  });


    $(function($) {
      $('.numeric').autoNumeric('init');

      $('.numeric_nocom').autoNumeric('init', {aSep:',', aDec:false, aPad: false}); 

    });    

    //Date picker
    $('#reservationdate').datetimepicker({
        //format: 'L',
        format: 'YYYY/MM/DD'
    });


    $('.numberonly').keypress(function (e) {    
    var charCode = (e.which) ? e.which : event.keyCode    
       if (String.fromCharCode(charCode).match(/[^0-9]/g))    
       return false;                        
    }); 

});//document
</script>