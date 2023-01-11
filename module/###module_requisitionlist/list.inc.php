<script src="plugins/autoNumeric/autoNumeric.js"></script>  

<style type="text/css">
table tr td{ color:#333;
        font-style: normal;
        font-weight:500;
}
a.page-link{
        font-style: normal;
        font-weight:500;	
}
.pagination-input{ position: relative; float:left; width:10%; }
input.form-control{ width: auto; background:#fff; margin-right:10px;}

.text-muted{ font-size:0.9rem; color:#ff4f68;}

a{ cursor:pointer;}


input[placeholder="ระบุสาเหตุที่ไม่อนุมัติ"]{ margin:auto; width:100%; padding:10px 10px; text-indent:10px;}
input[placeholder="ระบุสาเหตุที่ยกเลิกใบเบิก"]{ margin:auto; width:100%; padding:10px 10px; text-indent:10px;}

.text-color1{ color:#993366;}

.w-40 {
    width:30px !important;
    height: auto;
}

@media print {
  .req_remark{ 
    border:0px;background-color:#FFF;
  }
}
</style>


<?PHP
$obj = new CRUD();
$numRow_player = $obj->getCount("SELECT count(id_req) AS total_row FROM tb_requisition");
?>    

<?php include_once 'module/module_requisitionlist/frm_add-edit.inc.php'; //หน้า add/edit?>

<!-- profile modal start -->
<?php include_once 'module/module_requisitionlist/view.inc.php'; //หน้า add/edit?>
<!-- profile modal end -->


    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h4 class="display-10 d-inline-block font-weight-bold"><?PHP echo $title_act;?></h4>

          <div class="card-tools">
            <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ใบเบิกวัสดุ-อุปกรณ์</li>
            </ol>
          </div><!-- /.col -->
        </div>


        <div class="card-body">


      
      <div class="row">

      <div class="col-2">
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
          </div>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="ค้นหา..." id="searchinput">
        </div>
      </div>
    </div>  

    <div class="pt-3 pb-3 card-title total">
        <span>จำนวนทั้งหมด: <span id="totalRows"></span> รายการ</span>
       <span>แสดงผลหน้าที่:</span>
       <span id="page-number-1">1</span>
        <span>จาก: <span id="totalpages"></span> หน้า</span>
      </div>

      
       
            <!-- table -->
            <div class="table-responsive">
            <table class="table table-bordered table-hover table-md text-nowrap table-fixed" id="userstable">
            <colgroup>
              <col style="width:4%;">
              <col style="width:9%;">
              <col style="width:9%;">
              <col style="width:6%;">
              <col style="width:5%;">
              <col style="width:15%;">
              <col style="width:15%;">
              <col style="width:15%;">
              <col style="width:7%;">
              <col style="width:9%;">
              <col style="width:9%;">
              <col style="width:9%;">
            </colgroup>            
              <thead class="thead-light">                
                <tr>
                <th scope="col">#</th>
                <th scope="col">เลขที่ใบเบิก</th>
                <th scope="col">วันที่เบิก</th>
                <th scope="col">ไซต์งาน</th>
                <th scope="col">แผนก</th>
                <th scope="col">ผู้เบิก</th>
                <th scope="col">ผู้อนุมัติ</th>
                <th scope="col">ผู้จ่าย</th>
                <th scope="col">รายการที่เบิก</th>
                <th scope="col">สถานะอนุมัติ</th>
                <th scope="col">จัดการ</th>
                <th scope="col">สถานะใบเบิก</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            </div>
            <!-- table -->
        </div>
        <!-- /.card-body -->

        <hr style="width:98%; margin:auto;" />
        <div id="pagination-1" class="d-block" style="overflow:auto; width:98%; margin:auto; margin-top:15px;" ></div>
        <hr style="width:98%; margin:auto;" />
        <input type="hidden" name="currentpage" id="currentpage" value="1" />
        <input type="hidden" name="limit_perPage" id="limit_perPage" value="<?PHP echo $limit_perPage; ?>" />


        </div>
       

  <div id="overlay" style="display:none;">
    <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;"></div>
    <br />
    Loading...
  </div>


      </div>
      <!-- /.card -->

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

<script type="text/javascript">

  //ส่วนเช็ค validate ตอนสมัครสมาชิก
  (function () {  
      'use strict';  
      window.addEventListener('load', function () {  
      var form = document.getElementById('needs-validation');  
        form.addEventListener('submit', function (event) {  
          if (form.checkValidity() === false) {  
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');  
            }, false);
          }, false);
    })();  


    function pageClick1(pageNumber) {
        document.getElementById("page-number-1").innerText = pageNumber;
    }
    document.addEventListener("DOMContentLoaded", function () {
        var itemsCount = <?PHP echo $numRow_player; ?>;
        var itemsOnPage = <?PHP echo $limit_perPage; ?>;
  
        var pagination1 = new Pagination({
            container: document.getElementById("pagination-1"),
            pageClickCallback: pageClick1,
            maxVisibleElements: <?PHP echo $btn_perPage?>, //จำนวนเลขหน้าต่อ1เพจ
            showInput: true,
            goToButtonLabel: "ไป",
            inputTitle: "ไปหน้าที่:"            

        });
        pagination1.make(itemsCount, itemsOnPage);  
    });    


    $(document).on('keyup', '.numonly', function() {
     if (/\D/g.test(this.value))
     {
     // Filter non-digits from input value.
      this.value = this.value.replace(/\D/g, '');
     }
    });


     
// get player row
function getplayerrow(row) {
  var dataRow= "";
  //id_req, req_no, req_datetime, req_date_approve, req_date_paid, ref_id_user, ref_id_approver, ref_id_payer, req_remark, disburse_remark, req_paid, req_status
  if (row) {
     dataRow+=`<tr>
          <td class="align-middle pt-1 pb-1 pl-1">${numx}.</td>
          <td class="align-middle pt-1 pb-1 pl-1 req_code">          
          <a href="#" class="profile text-success" data-toggle="modal" data-target="#userViewModal" title="คลิกดูรายละเอียดใบเบิก" data-backdrop="static" data-keyboard="false" data-id="${row.id_req}"><strong>${row.location_short}<?PHP echo $req_digit;?>${row.req_no}</strong></a>
          </td>
          <td class="align-middle pt-1 pb-1 pl-1">${row.req_datetime}</td>
          <td class="align-middle pt-1 pb-1 pl-1">${row.location_short}</td>
          <td class="align-middle pt-1 pb-1 pl-1">${row.initial_name}</td>
          <td class="align-middle pt-1 pb-1 pl-1">${row.fullname}</td>
          <td class="align-middle pt-1 pb-1 pl-1">${row.appr_fullname}</td>
          <td class="align-middle pt-1 pb-1 pl-1">${row.payer_fullname}</td>
          <td class="align-middle pt-1 pb-1 pl-1">${row.total_req} รายการ</td>
          <td class="align-middle pt-1 pb-1 pl-1"><strong class="${row.req_paidColor}">${row.req_paid_text}</strong>`;
          if(row.req_paid==1){
            dataRow+=`
            <div class="btn-group">
              <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                การอนุมัติ
              </button>
              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                <a class="dropdown-item accept" data-id="${row.id_req}"><i class="fas fa-check"></i> อนุมัติ</a>
                <a class="dropdown-item reject" data-id="${row.id_req}"><i class="fas fa-ban"></i> ไม่อนุมัติ</a>
              </div>
            </div>`;
          }
          dataRow+=`
          </td>
          <td class="align-middle pt-1 pb-1 pl-1">
          <div class="btn-group">
            <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              จัดการ
            </button>
            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
              <a class="dropdown-item profile" data-toggle="modal" data-target="#userViewModal" title="Prfile" data-id="${row.id_req}"><i class="fas fa-clipboard-list"></i> ดู-จ่ายวัสดุอุปกรณ์</a>
              <!--<a class="dropdown-item" href="#"><i class="fas fa-file-signature"></i></i> แก้ไข</a>-->
              <a class="dropdown-item deleterow" href="#"><i class="fas fa-times-circle"></i> ยกเลิกใบเบิก</a>
            </div>
          </div>
          <!--<a href="#" class="btn-sm pt-1 pb-2 btn-success profile" data-toggle="modal" data-target="#userViewModal" title="Prfile" data-id="${row.id_req}">จ่ายวัสดุ-อุปกรณ์</a>
          <a href="#" class="btn-sm pt-1 pb-2 btn-warning editdata" data-toggle="modal" data-target="#userModal" title="Edit" data-id="${row.id_req}">แก้ไข</a>
          <a href="#" class="btn-sm pt-1 pb-2 btn-danger deleterow" data-id_menu="14" title="Delete" data-id="${row.id_req}">ยกเลิก</a>-->
          </td>
          <td class="align-middle pt-1 pb-1 pl-1"><strong class="${row.req_statusColor}">${row.req_status}</strong></td>
        </tr>`;
  }
  return dataRow;
}



var statusReqArr = <?PHP echo json_encode($statusReqArr); ?>;
var paidStatusArr_js = <?PHP echo json_encode($paidStatusArr); ?>;

/*ฟังก์ชั่นแบ่งหน้า โดยใช้ ajax-json (แก้ไขสมบรูณ์แล้ว)*/
function func_getDatalist() {
  var limit_perPage = $("#limit_perPage").val();
  var pageno = parseInt($("#currentpage").val());
  $.ajax({
    url: "module/module_requisitionlist/ajax_action.php",
    type: "GET",
    dataType: "json",    
    data: { page: pageno, action: "getDataList" },
    beforeSend: function () {
      $("#overlay").fadeIn();
    },
    success: function (data){
      console.log(data);
      if (data.row) {
        $("#totalRows").html(data.count);
        var rowlist = "";
        let totaluser = data.count;
        let totalpages = Math.ceil(parseInt(totaluser) / limit_perPage);
        const currentpage = $("#currentpage").val();
        if(pageno!=1){
          numz = parseInt(pageno*limit_perPage); 
          numx = totaluser ;
          numx = parseInt((totaluser-numz+parseInt(limit_perPage)));
        }else{
          numz = 0;
          numx = totaluser ;
        }
        $.each(data.row, function (index, row) {
          if(row.req_paid==1){row.req_paidColor='text-black'}
          if(row.req_paid==2){row.req_paidColor='text-danger'}
          if(row.req_paid==3){row.req_paidColor='text-info'}
          if(row.req_paid==4){row.req_paidColor='text-success'}
          if(row.req_paid==5){row.req_paidColor='text-color1'}
          
          if(row.req_status==2){row.req_statusColor='text-danger'}

          row.req_paid_text = paidStatusArr_js[row.req_paid];
          row.req_status = statusReqArr[row.req_status];
          
          rowlist += getplayerrow(row);
          numx--;
        });
        //alert(userlist);return false;
        $("#userstable tbody").html(rowlist);
        $("#itemsCount").val(totaluser);
        $("#totalpages").html(totalpages);
        $("#overlay").fadeOut();
      }
    },
    error: function () {
      console.log("ผิดพลาด!! ไม่สามารถแสดงข้อมูลได้");
    },
  });
}


$(document).ready(function () {

  $('.auto').autoNumeric({aSep: ','});

  /*โหลดรายการ เมื่อมีการเข้ามาที่หน้านี้*/
   func_getDatalist();


  // add/edit user
  $(document).on("submit", ".addform", function (event) {
    event.preventDefault();  
    var level_menu = $("input:radio[name=level_menu]:checked").val();
        var chk_subMenu = $("#ref_id_menu :checked").val();
        if(level_menu=="2" && chk_subMenu=="0"){
          sweetAlert("ผิดพลาด..", "กรุณาเลือกหมวดหลัก", "warning"); return false;
        }
    $.ajax({
      url: "module/module_requisitionlist/ajax_action.php",
      type: "POST",
      dataType: "json",
      data: new FormData(this),
      processData: false,
      contentType: false,
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: function (response) {
        console.log(response);
        if (response){
          $("#userModal").modal("hide"); $(".modal-backdrop").fadeOut();
          $(".addform")[0].reset();
          func_getDatalist();
          sweetAlert("สำเร็จ..", "บันทึกข้อมูลแล้ว", "success"); return false;
          $("#overlay").fadeOut();
          
        }
      },
      error: function () {
        console.log("ไม่สำเร็จ! มีบางอย่างผิดพลาด!");
      },
    });
  });



$('.goto-num').on("keypress", function(e) {
        if (e.keyCode == 13) {
          //alert("Enter pressed");
          //return false; // prevent the button click from happening
          //var pageno = parseInt($(this).val());
          var pageno = parseInt($(this).val());
          $("#currentpage").val(pageno);
          func_getDatalist();  
        }
});  


  // Go pagination ปุ่ม GO
  $(document).on("click", ".page-togo", function (e){ //ก่อนแก้ใช้คลาส ul.pagination li a
    e.preventDefault();
    var pageno = parseInt($(".goto-num").val());
    $("#currentpage").val(pageno);
    func_getDatalist();
  });


  // pagination
  $(document).on("click", "a.page-link", function (e){ //ก่อนแก้ใช้คลาส ul.pagination li a
    e.preventDefault();
    var $this = $(this);
    const pagenum = $this.data("page-number");
    $("#currentpage").val(pagenum);
    func_getDatalist();
    $this.parent().siblings().removeClass("active");
    $this.parent().addClass("active");
  });

  // form reset on new button
  $(".close, .btn-close").on("click", function () {
    $(".addform")[0].reset();
    $("#mainMenu").addClass("d-none").hide();
    $("#id_menu").val("");
  });

  
  $("#addnewbtn").on("click", function () {
    $(".addform")[0].reset();
    $("#id_menu").val("");
  });


  $(document).on("click", ".cutitem", function (e) {
    e.preventDefault();
    var split_val = $(this).data("id").split(':');
    var ref_id_req = split_val[0];
    var id_offsupp_location = split_val[1];
    //alert(ref_id_req+'----------------'+id_offsupp_location);
    $.ajax({
      url: "module/module_requisitionlist/ajax_action.php",
      type: "POST",
      dataType: "json",
      data: { ref_id_req: ref_id_req, id_offsupp_location: id_offsupp_location, action: "cutitem" },
      beforeSend: function () {
        //alert(inputValue); return false;
      },
      success: function (data) {
        console.log(data);
        if (data) {
          $('#lottable tbody').html(data.fetchLot);
          $('body .detail-req').html(data.fetchRow);
          //$("a.accept[data-id="+req_id+"]").closest("tr").find("td:nth-child(7)").html("<?PHP echo $_SESSION['sess_fullname']; ?>");
          //$("a.accept[data-id="+req_id+"]").closest("td").html('<strong class="text-danger">ไม่อนุมัติ</strong>');
          //swal("ไม่อนุมัติ!", "ใบเบิกเลขที่: "+req_code+" แล้ว", "success");
          return false;
        }
      },
      error: function () {
        console.log("Error!!");
      },
    });
  });

  
  $(document).on("click", ".cut_inv", function (event) {
    event.preventDefault();
    //var split_val = $(this).data("lot").split('&');
    var total_pay = 0;

    var lot_total_balance = $(this).closest('tr').find("span.lot_total_balance").text().replace(/,/g,''); 

    var sum_total_lot = $('body span.sum_total_lot').html().replace(/,/g,'');

    var lot_select = $(this).data("lot");
    var offsupp_code_select = $(this).data("code");
    var ref_id_req = $('input[name=ref_id_req]').val().replace(/,/g,'');
    var id_offsupp_location = $('input[name=id_offsupp_location]').val().replace(/,/g,'');
    var total_req = $('input[name=total_req]').val().replace(/,/g,'');
    var total_pay = $('input[name=total_pay]').val().replace(/,/g,'');        
    var current_pay = $(this).closest('td').find('input[name=current_pay]').val().replace(/,/g,'');
    var str = $('#frm_payitem').serialize();
    
    //alert('ไอดีใบเบิก(ref_id_req)='+ref_id_req+'-----ไอดีวัสดุรายไซต์(id_offsupp_location)='+id_offsupp_location+'-----ไอดีลอตที่เลือก(id_balance)='+lot_select+'-----จำนวนที่เบิก(total_req)='+total_req+'-----จำนวนที่จ่ายแล้ว(total_pay)='+total_pay+'-----จำนวนที่กรอก(current_pay)='+current_pay+'-----ยอดคงเหลือของลอตนี้(lot_total_balance)='+lot_total_balance);
    var cutdate = new Date($('#date_cut').val().replace(/\//g, '-'));
    var current_date= new Date('<?php echo date('Y-m-d');?>');

    if(cutdate>current_date){
      swal("ผิดพลาด!", "วันที่ตัดจ่ายมากกว่าวันที่ปัจจุบัน"); return false;      
    }
    if(isNaN(parseFloat(current_pay)) || current_pay<=0){
      swal("ผิดพลาด!", "กรอกจำนวนที่จะจ่ายออก"); return false;
    }
    if(parseFloat(current_pay)>parseFloat(lot_total_balance)){
      swal("ผิดพลาด!", "กรอกจำนวนเกินยอดคงเหลือของลอตนี้");return false;
    }
    if((parseFloat(current_pay)+parseFloat(total_pay))>parseFloat(total_req)){
      swal("ผิดพลาด!", "ไม่สามารถจ่ายเกินยอดที่เบิกได้"); return false;    
    }

    //alert(all_data);return false;
    //swal("ผ่าน", "ผ่าน-ผ่าน-ผ่าน-ผ่าน-ผ่าน"); return false;

    $.ajax({
      url: "module/module_requisitionlist/ajax_action.php",
      type: "POST",
      dataType: "json",
      data: { all_data:str, current_pay:current_pay, lot_select:lot_select, action: "payitem" },
      beforeSend: function () {
        //alert(inputValue); return false;
      },
      success: function (data) {
        console.log(data);
        if(data=='error-0'){ swal("ผิดพลาด!", "กรอกจำนวนที่จะจ่ายออก"); return false; }
        if(data=='error-1'){ swal("SQL Error!", "ไม่พบรายการตามที่ระบุ"); return false; }
        if(data=='error-2'){ swal("ผิดพลาด!", "ไม่สามารถจ่ายเกินยอดที่เบิกได้"); return false;}
        if(data=='error-3'){ swal("ผิดพลาด!", "ยอดคงเหลือไม่พอตัดจ่าย เนื่องจากมีการตัดจ่ายก่อนหน้า"); return false;    }
        if(data=='error-4'){ swal("ผิดพลาด!", "ไม่สามารถจ่ายเกินยอดที่เบิกได้"); return false; }

        if(data=='Success'){
          //return false;
          var new_total_pay = parseFloat($('body h3.total_pay').html())+parseFloat(current_pay);
          var new_lot_total_balance = parseFloat(lot_total_balance)-parseFloat(current_pay);
          
          //alert(data);

          $('body h3.total_pay').html(addCommas(new_total_pay));
          $('body table#table-req tr.'+offsupp_code_select+' td:nth-child(6) span.span_total_pay').html(addCommas(new_total_pay));
          $('body table#lottable tr.tr_idlot-'+lot_select+' td:nth-child(5) span.lot_total_balance').html(addCommas(new_lot_total_balance));
          $('body span.sum_total_lot').html(addCommas(parseFloat(sum_total_lot)-parseFloat(current_pay)));

          $('body input[name=current_pay]').val('');
          $('input[name=date_cut]').val('<?PHP echo date('Y/m/d');?>');         
          swal("สำเร็จ", "บันทึกการตัดจ่ายเรียบร้อยแล้ว", "success");
          //swal.close();
        }
      },
      error: function(){
        console.log("Error!! :"+data);
      },
    });
  });


  $(document).on("click", ".reject", function (e) {
    var req_id = $(this).data("id");
    var req_code = $(this).closest('tr').find("td.req_code").text();
        
    swal({
    title: "ไม่อนุมัติ",
    text: "ระบุสาเหตุที่ไม่อนุมัติใบเบิกเลขที่: "+req_code+"",
    confirmButtonText: 'บันทึก, ไม่อนุมัติ!',
    cancelButtonText: "ปิดหน้าต่างนี้",
    type: "input",
    showCancelButton: true,
    closeOnConfirm: false,
    //animation: "slide-from-top",
    inputPlaceholder: "ระบุสาเหตุที่ยกเลิกใบเบิก",
    },
    function(inputValue){
      //alert(inputValue.length);
      if(inputValue==false){
        //swal.close(); 
        return false;
        e.preventDefault();
      }
      if(inputValue==='') {
        //alert('xxxxxxx');
        swal.showInputError("ระบุสาเหตุที่ไม่อนุมัติ!");
        //swal("Cancelled", "Your imaginary file is safe :)", "error");
        e.preventDefault();      
        return false;
      }
      $.ajax({
          url: "module/module_requisitionlist/ajax_action.php",
          type: "POST",
          dataType: "json",
          data: { req_code: req_code, req_id: req_id, inputValue: inputValue, action: "reject" },
          beforeSend: function () {
            //alert(inputValue); return false;
          },
          success: function (data) {
            console.log(data);
            if (data) {
              $("a.accept[data-id="+req_id+"]").closest("tr").find("td:nth-child(7)").html("<?PHP echo $_SESSION['sess_fullname']; ?>");
              $("a.accept[data-id="+req_id+"]").closest("td").html('<strong class="text-danger">ไม่อนุมัติ</strong>');
              swal("ไม่อนุมัติ!", "ใบเบิกเลขที่: "+req_code+" แล้ว", "success");
              return false;
            }
          },
          error: function () {
            console.log("Error!!");
          },
        });
    });
  });    


  $(document).on("click", ".accept", function (e) {
    var req_id = $(this).data("id");
    var req_code = $(this).closest('tr').find("td.req_code").text();
    swal({
      title: "ยืนยันการอนุมัติ ?",
      text: "ใบเบิกเลขที่: "+req_code+" หากอนุมัติแล้วจะไม่สามารถยกเลิกได้ ต้องติดต่อ Administrator เพื่อยกเลิกเท่านั้น",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'อนุมัติ, ใบเบิกนี้!',
      cancelButtonText: "ปิดหน้าต่างนี้",
      closeOnConfirm: false,
      closeOnCancel: false,
      function(){
        $('.sa-button-container').hide();
      }
      },
      function(isConfirm){
      //alert(isConfirm);
      if (isConfirm==true){
        $.ajax({
          url: "module/module_requisitionlist/ajax_action.php",
          type: "POST",
          dataType: "json",
          data: { req_code: req_code, req_id: req_id, action: "accept" },
          beforeSend: function () {
          },
          success: function (data) {
            console.log(data);
            if (data) {
              $("a.accept[data-id="+req_id+"]").closest("tr").find("td:nth-child(7)").html("<?PHP echo $_SESSION['sess_fullname']; ?>");
              $("a.accept[data-id="+req_id+"]").closest("td").html('<strong class="text-info">อนุมัติ (รอจ่าย)</strong>');
              swal("อนุมัติเรียบร้อย!", "ใบเบิกเลขที่: "+req_code+" ได้รับการอนุมัติแล้ว", "success");
              return false;
            }
          },
          error: function () {
            console.log("Error!!");
          },
        });
      }
      if(isConfirm==false) {
        swal.close();
        //swal("Cancelled", "Your imaginary file is safe :)", "error");
        //e.preventDefault();         //return false;
      }
    }
    );  
  });  


  //get user
  $(document).on("click", "a.editdata", function () {
    var id_row = $(this).data("id");
    $.ajax({
      url: "module/module_requisitionlist/ajax_action.php",
      type: "GET",
      dataType: "json",
      data: { id_row: id_row, action: "getuser" },
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: function (data) {
        if (data) {
          if(data.status_location==1){
            $("#status_use").attr('checked', true);
          }else{
            $("#status_hold").attr('checked', true);
          }
          $("#exampleModalLabel").html('แก้ไขไซต์งาน');
          $(".div_status").removeClass("d-none").show();
          $("#id_location").val(data.id_location);
          $("#name_location").val(data.location_name);
          $("#location_short").val(data.location_short);
          $("#desc_location").val(data.location_remark);
          $("#id_menu").val(data.id_menu);
        }
        $("#overlay").fadeOut();
      },
      error: function () {
        console.log("Error!!");
      },
    });
  });


  $(document).on("click", ".deleterow", function (e) {
    var req_id = $(this).data("id");
    var req_code = $(this).closest('tr').find("td.req_code").text();
        
    swal({
    title: "ยกเลิกใบเบิก",
    text: "ระบุสาเหตุที่ยกเลิกใบเบิกเลขที่: "+req_code+" หากยังมียอดจ่ายไม่ครบ จะไม่สามารถตัดจ่ายได้อีก",
    confirmButtonText: 'ยืนยัน, ยกเลิก!',
    cancelButtonText: "ปิดหน้าต่างนี้",
    type: "input",
    showCancelButton: true,
    closeOnConfirm: false,
    //animation: "slide-from-top",
    inputPlaceholder: "ระบุสาเหตุที่ยกเลิกใบเบิก",
    },
    function(inputValue){
      //alert(inputValue.length);
      if(inputValue==false){
        //swal.close(); 
        return false;
        e.preventDefault();
      }
      if(inputValue==='') {
        //alert('xxxxxxx');
        swal.showInputError("ระบุสาเหตุที่ยกเลิกใบเบิก!");
        //swal("Cancelled", "Your imaginary file is safe :)", "error");
        e.preventDefault();      
        return false;
      }
      $.ajax({
          url: "module/module_requisitionlist/ajax_action.php",
          type: "POST",
          dataType: "json",
          data: { req_code: req_code, req_id: req_id, inputValue: inputValue, action: "cancel" },
          beforeSend: function () {
            //alert(inputValue); return false;
          },
          success: function (data) {
            console.log(data);
            if (data) {
              $("a.accept[data-id="+req_id+"]").closest("tr").find("td:nth-child(7)").html("<?PHP echo $_SESSION['sess_fullname']; ?>");
              $("a.accept[data-id="+req_id+"]").closest("td").html('<strong class="text-danger">ไม่อนุมัติ</strong>');
              swal("ยกเลิก!", "ใบเบิกเลขที่: "+req_code+" แล้ว", "success");
              return false;
            }
          },
          error: function () {
            console.log("Error!!");
          },
        });
    });
  });    

  
  // get profile
  $(document).on("click", "a.profile", function () {
    var id_row = $(this).data("id");
    var req_code = $(this).text();
    //alert(id_row+'----------'+req_code);
    $.ajax({
      url: "module/module_requisitionlist/ajax_action.php",
      type: "GET",
      dataType: "json",
      data: { id_row : id_row, action: "get_req" },
      success: function (row) {
        console.log(row);
        if (row) {
          /*row-footer*/
          $('.invoice-info').html(row.htmlData);
          $('.row-footer').html(row.htmlFootter);          
          $('.title-req_no').html(req_code);
          $('.txt-approve').html(row.approve);
          $('#table-req tbody').html(row.itemData);
          $('#print-req').attr('href',row.linkprint);          
                    
        }
      },
      error: function () {
        console.log("something went wrong"+row);
      },
    });
  });

  // searching
  $("#searchinput").on("keyup", function () {
    const searchText = $(this).val();
    var limit_perPage = $("#limit_perPage").val();
    var pageno = 1;    
    if (searchText.length > 1) {
      $.ajax({
        url: "module/module_requisitionlist/ajax_action.php",
        type: "GET",
        dataType: "json",
        data: { searchText: searchText, action: "search" },
        success: function (result) {
          console.log(result);//return false;//alert(result.length);
          if (result) {
            $("#totalRows").html(result.count);
            var rowlist = "";
            let totalRow = result.count;
            let totalpages = Math.ceil(parseInt(totalRow) / limit_perPage);
            const currentpage = $("#currentpage").val();
            if(pageno!=1){
              numz = parseInt(pageno*limit_perPage); 
              numx = totalRow ;
              numx = parseInt((totalRow-numz+parseInt(limit_perPage)));
            }else{
              numz = 0;
              numx = totalRow ;
            }
            $.each(result.row, function (index, row) {
              row.status_chk = statusArr_js[row.status_location];
              rowlist += getplayerrow(row);
              numx--;
            });
            //alert(userlist);return false;
            $("#pagination").hide();
            $("#userstable tbody").html(rowlist);
            $("#itemsCount").val(totalRow);
            $("#totalpages").html(totalpages);
            $("#overlay").fadeOut();
          }
        },
        error: function () {
          console.log("something went wrong");
        },
      });
    } else {
      func_getDatalist();
      $("#pagination").show();
    }
  });

});

  </script>