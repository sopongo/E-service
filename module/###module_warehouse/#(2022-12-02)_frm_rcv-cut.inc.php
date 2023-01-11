<script src="plugins/autoNumeric/autoNumeric.js"></script>

<script type="text/javascript">  

(function () {  
'use strict';  
window.addEventListener('load', function () {  
var form_rcv = document.getElementById('needs-validation-rcv');  
form_rcv.addEventListener('submit', function (event) {  
  if (form_rcv.checkValidity() === false) {  
      event.preventDefault();  
      event.stopPropagation();  
  }else{
    alert('Ajax');
    return false;
  }
form_rcv.classList.add('was-validated');  
}, false);  
}, false);  
})();  

</script> 



<!--RCV form modal -->
<div class="modal fade" id="rcvModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-circle"></i> รับเข้าวัสดุ-อุปกรณ์</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <!--FORM 1-->
      <div class="container py-1">
        <div class="row">  
            <div class="offset-md-0 col-md-12 offset-md-0">  
                <div class="card">
                  <div class="card-header bg-primary text-white"><h4 class="card-title text-uppercase">กรอกรายละเอียด</h4></div>  
                        <div class="card-body">
                          <form id="needs-validation-rcv" class="addrcv" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">

                        <div class="row">

                          <div class="col-sm-10 col-md-10 col-xs-10"><!--000-->
                              <div class="form-group">  
                              <label for="firstname">ชื่อวัสดุ-อุปกรณ์:</label> <div class="d-inline w-auto" id="offsupp_name_rcv"></div>
                              </div>
                          </div>

                          
                          <div class="col-sm-10 col-md-10 col-xs-10"><!--000-->
                              <div class="form-group">  
                              <label for="firstname">หมวด:</label> <div class="d-inline w-auto" id="offsupp_cate_rcv"></div>
                              </div>
                          </div>

                          <div class="col-sm-10 col-md-10 col-xs-10"><!--000-->
                              <div class="form-group">  
                                <label for="firstname">คงเหลือปัจจุบัน:</label> <div class="d-inline w-auto" id="total_balance_rcv"></div>
                                <input type="hidden" name="val_total_balance" id="val_total_balance_rcv" val="">
                              </div>
                          </div>


                          <div class="col-sm-5 col-md-5 col-xs-5"><!--000-->
                              <div class="form-group">
                              <label for="po_no">เลขที่ PO หรือ เลขที่ใบกำกับฯ:</label>
                              <div class="input-group">
                                <input type="text" class="form-control input-md mr-0" id="po_no" name="po_no" required />
                                <div class="invalid-feedback">กรอกเลขที่ PO หรือ เลขที่ใบกำกับฯ</div>
                              </div>
                              </div><!--form-group-->
                          </div><!--000-->



                          <div class="col-sm-5 col-md-5 col-xs-5"><!--000-->
                              <div class="form-group">  
                                <label for="date_rcv">วันที่รับเข้า:</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                  <input type="text" class="form-control datetimepicker-input input-md mr-0" id="date_rcv" name="date_rcv" value="<?PHP echo date('Y/m/d');?>" data-target="#reservationdate" required />
                                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    <div class="invalid-feedback">เลือกวันที่รับเข้า</div>
                                  </div>
                                </div>
                              </div><!--form-group-->
                          </div><!--000-->


                          <div class="col-sm-5 col-md-5 col-xs-5"><!--000-->
                              <div class="form-group">  
                              <label for="lot_name">ชื่อ LOT:</label>
                              <div class="input-group">
                                <input type="text" class="form-control input-md mr-0" id="lot_name" name="lot_name" required />
                                <div class="invalid-feedback">กรอกชื่อ LOT</div>
                              </div>
                              </div><!--form-group-->
                          </div><!--000-->                          


                          <div class="col-sm-5 col-md-5 col-xs-5"><!--000-->
                              <div class="form-group">  
                              <label for="rcv_qty">จำนวนที่รับเข้า:</label>
                              <div class="input-group">
                                <input type="text" class="form-control numeric_nocom input-md mr-0" id="rcv_qty" name="rcv_qty" required />
                                <div class="invalid-feedback">กรอกจำนวนที่รับเข้า</div>
                              </div>
                              </div><!--form-group-->
                          </div><!--000-->

                          <div class="col-sm-5 col-md-5 col-xs-5"><!--000-->
                              <div class="form-group">  
                              <label for="po_no">ราคาต่อหน่วย:</label>
                              <div class="input-group">
                                <input type="text" class="form-control numeric input-md mr-0" id="unit_price" name="unit_price" required />
                                <div class="invalid-feedback">กรอกราคาต่อหน่วย</div>
                              </div>
                              </div><!--form-group-->
                          </div><!--000-->
                          

                                  <div class="row mt-3 pt-3 border-top w-100"><!--000-->
                                    <div class="col-md-12">
                                      <div class="float-right">  
                                        <button type="button" class="btn btn-danger btn-close" data-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-success" id="addButton">บันทึก</button>
                                        <input type="hidden" name="action" value="addrcv">
                                        <input type="hidden" name="ref_id_offsupp_location" id="ref_id_offsupp_location" value="" />
                                      </div>                            
                                    </div>  
                                  </div><!--000-->


                        </div><!--row-->









                          </form>
                        </div><!--card-body-->
                </div><!--card-->
            </div>                
        </div>
      </div>
      <!--FORM 1-->

    </div><!--modal-content-->
  </div>
</div>
<!-- RCV form modal end -->




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
      $('body').find('.was-validated').removeClass();
      $("form").trigger("reset");
      $("#rcvModal").modal("show"); 
      //$('form').each(function() { this.reset() });
      var ref_id_offsupp_location = $(this).data("id");
      //$("#ref_id_offsupp_location").val(8888888);
      //alert(ref_id_offsupp_location ); return false;
    $.ajax({
        url: "module/module_warehouse/ajax_inven_action.php",
        type: "GET",
        dataType: "json",
        data: { ref_id_offsupp_location:ref_id_offsupp_location  , action:"rcv" },
        beforeSend: function () {
          $("#overlay").fadeIn();
        },
        success: function (row){
          console.log(row);
          if(row.SubName!=null){
            row.SubName = ' » '+row.SubName
          }else{
            row.SubName = '';
          }

          $("#offsupp_name_rcv").html(row.offsupp_name);
          $("#total_balance_rcv").html(addCommas(row.total_balance)+' '+row.unit_name);
          $("#offsupp_cate_rcv").html(row.mainName+row.SubName);
          $("#ref_id_offsupp_location").val(ref_id_offsupp_location);
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


  /*ปุ่ม ADD Recive รับวัสดุเข้าระบบ <<<<<<<<<< เขียนใหม่ใช้โค๊ดนี้ สมบรูณ์กว่าไม่มีบั๊ครีเฟรชหน้าจอ*/
  $('form.addrcv').on('submit', function(event) {
    /*
    event.preventDefault();
    if ($('form.addrcv')[0].checkValidity() === false) {
        event.preventDefault();  
        event.stopPropagation();          
    } else {
      //alert('test action');
      $.ajax({
        url: "module/module_warehouse/ajax_inven_action.php",
        type: "POST",
        data: $(this).serialize(),
        beforeSend: function () {
          //alert('xxxxx'); return false;
        },
        success: function (data) {
          console.log(data);
          //return false;
          $("#rcvModal").modal("hide"); 
          $(".modal-backdrop").hide().fadeOut();
          $("#overlay").fadeOut();
          sweetAlert("สำเร็จ...", "รับวัสดุเข้าเรียบร้อยแล้ว", "success"); //The error will display
          func_getDatalist();
          $('body').find('.was-validated').removeClass();
          $('form').each(function() { this.reset() });
          //event.preventDefault();
        },
        error: function (jXHR, textStatus, errorThrown) {
          console.log(data);
          alert(errorThrown);
        }
      });
    }
    $('form.addrcv').addClass('was-validated');
*/

      /*
      $.ajax({
        url: "module/module_warehouse/ajax_inven_action.php",
        type: "POST",
        data: $(this).serialize(),
        beforeSend: function () {
          //alert('xxxxx'); return false;
        },
        success: function (data) {
          console.log(data);
          //return false;
          $("#rcvModal").modal("hide"); 
          $(".modal-backdrop").hide().fadeOut();
          $("#overlay").fadeOut();
          sweetAlert("สำเร็จ...", "รับวัสดุเข้าเรียบร้อยแล้ว", "success"); //The error will display
          func_getDatalist();
          $('body').find('.was-validated').removeClass();
          $('form').each(function() { this.reset() });
          //event.preventDefault();
        },
        error: function (jXHR, textStatus, errorThrown) {
          console.log(data);
          alert(errorThrown);
        }
      });
      */
  });
  


  /*ปุ่ม ADD Recive รับวัสดุเข้าระบบ*/
  /*
  $(document).on("submit", ".addrcv", function (event) {//event
    var alertmsg =
      $("#id_offsupp").val().length > 0
        ? "เพิ่มรายการรับเข้าเรียบร้อยแล้ว"
        : "เพิ่มข้อมูลเรียบร้อยแล้ว";
        //alert(alertmsg); return false;        
    $.ajax({
      url: "module/module_warehouse/ajax_inven_action.php",
      type: "POST",
      dataType: "json",
      data: new FormData(this),
      processData: false,
      contentType: false,      
      beforeSend: function () {
      },
      success: function (row) {
        console.log(row);
        //return false;
        $("#rcvModal").modal("hide"); 
        $(".modal-backdrop").hide().fadeOut();
        //$("#overlay").fadeOut();
        sweetAlert("สำเร็จ...", "รับวัสดุเข้าเรียบร้อยแล้ว", "success"); //The error will display
        func_getDatalist();
        $('body').find('.was-validated').removeClass();
        $("form").trigger("reset");
        //return false;
        event.preventDefault();
      },
      error: function () {
        console.log(row);
        console.log("ไม่สำเร็จ! มีบางอย่างผิดพลาด!");
      },
    });
  });
  */

/*เมื่อคลิกปุ่มคลาส adj_action จะแสดงฟอร์มปรับยอด เรียกจากไฟล์ frm_rcv-cut.inc.php ที่ include*/
$(document).on("click", "a.adj_action", function () {
    var id_offsupp = $(this).data("id");
    $("#adjModal").modal("show"); 
    //alert(id_offsupp); return false;
    $.ajax({
      url: "module/module_warehouse/ajax_inven_action.php",
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