
<script src="plugins/autoNumeric/autoNumeric.js"></script>  

<style type="text/css">
table tr td, table thead th{ color:#333;
        /*font-family: "Noto Sans Thai",arial, Geneva, sans-serif;*/
        font-style: normal;
        font-weight:500;
}
table thead th{ color:#333;
        font-weight:bold;
}
a.page-link{
        /*font-family: "Noto Sans Thai",arial, Geneva, sans-serif;*/
        font-style: normal;
        font-weight:500;	
}
.pagination-input{ position: relative; float:left; width:10%; }
input.form-control{ width: auto; background:#fff; margin-right:10px;}


.w-40 {
    width:30px !important;
    height: auto;
}
.btn-group > .btn, .btn-group-vertical > .btn{
  font-size: 0.85rem;
}
.dropdown-item {
  font-size: 0.85rem;
  cursor: pointer;

}
</style>

<script src="plugins/sweetalert/sweetalert.js"></script>

<?PHP

$obj = new CRUD();
$numRow_player = $obj->getCount("SELECT count(id_offsupp_location) AS total_row FROM tb_offsupp_location $class_query");
//echo "SELECT count(id_offsupp_location) AS total_row FROM tb_offsupp_location $class_query";
?>

<script>

$('.auto').autoNumeric({aSep: ','});

$(document).on("click", ".btn-adj-balance", function (e){
  e.preventDefault();
    var id_balance = $(this).data("id");
    $(this).closest("tr").find('span.span-quantity').toggleClass("d-none d-inline");
    $(this).closest("tr").find('input.input-quantity').toggleClass("d-none d-block");
    $(this).closest("tr").find('div.dbbbb').toggleClass("d-none d-inline");
    //$(this).parents('span.span-quantity').toggleClass("d-none d-inline"); 
    //$(this).parents('input.input-quantity').toggleClass("d-none d-inline"); 
    //alert(id_balance);
});

</script>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h4 class="display-10 d-inline-block font-weight-bold"><?PHP echo $title_act;?></h4>

          <!--<div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>-->

          <div class="card-tools">
            <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">คลังวัสดุ-อุปกรณ์</li>
            </ol>
          </div><!-- /.col -->
        </div>


        <div class="card-body">

      <?php
      include_once 'module/module_warehouse/frm_add-edit.inc.php'; //หน้า เพิ่ม/แก้ไขวัสดุ รายไซต์
      include_once 'module/module_warehouse/frm_rcv-cut.inc.php'; //หน้า รับเข้า-ตัดจ่าย-ปรับ-คืน-โอนวัสดุ รายไซต์
      ?>

      <!-- profile modal start -->
      <div class="modal fade" id="userViewModal" tabindex="-1" role="dialog" aria-labelledby="userViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-circle"></i> วัสดุ-อุปกรณ์</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container" id="profile">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- profile modal end -->
      
      <div class="row">
      <?PHP if($_SESSION['sess_class_user']==4){ ?>
      <div class="col-10">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#userModal,.modal-md" id="addnewbtn" data-backdrop="static" data-keyboard="false">
        <i class="fas fa-circle"></i> เพิ่มวัสดุ-อุปกรณ์</button>
      </div>
      <?PHP }?>
      <div class="col-2">
        <div class="input-group input-group-md"><strong>ค้นหา:&nbsp;</strong> 
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
          </div>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="กรอกคำค้นหา..." id="searchinput">       
        </div>
      </div>
    </div>  

            <hr />
            <div class="pt-0 pb-1 card-title total">
              <span>จำนวนทั้งหมด: <span id="totalRows"></span> รายการ</span>
               <span>แสดงผลหน้าที่:</span>
               <span id="page-number-1">1</span>
              <span>จาก: <span id="totalpages"></span> หน้า</span>
            </div>
    
    
            <!-- table -->
            <div class="table-responsive">
            <table class="table table-bordered table-hover table-md text-nowrap table-fixed" id="userstable">
              <colgroup>
                <col style="width:5%;">
                <col style="width:5%;">
                <col style="width:5%;">
                <col style="width:8%;">
                <col style="width:40%;">
                <col style="width:15%;">
                <col style="width:8%;">
                <?PHP if($_SESSION['sess_class_user']==4){ ?><col style="width:8%;">
                <col style="width:10%;"><?PHP } ?>
              </colgroup>            
              <thead class="thead-light">                
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">รูป</th>
                  <th scope="col">ไซต์งาน</th>
                  <th scope="col">รหัสวัสดุอุปกรณ์</th>
                  <th scope="col">ชื่อวัสดุอุปกรณ์</th>
                  <th scope="col">หมวดวัสดุอุปกรณ์</th>
                  <th scope="col" class="text-right">จำนวนคงเหลือ</th>
                  <th scope="col">หน่วยนับ</th>
                  <?PHP if($_SESSION['sess_class_user']==4){ ?><th scope="col">สถานะการใช้งาน</th>
                  <th scope="col">จัดการ</th><?PHP }?>
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
        <nav id="pagination d-block" class="w-75 p-3"></nav>
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

<script type="text/javascript"> 
$(document).ready(function(){

});
</script>



<script type="text/javascript">

function addCommas(nStr){ //เพิ่มคอมม่าในช่อง #คงเหลือ ตอนคำนวนเสร็จ
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
  

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
  var DataRow = "";
  //alert(row['offsupp_name']); return false;
  if (row) {
    const rowphoto = row.photo ? row.photo : "default.png";
     aaa='';
     bbb='';
    //alert(row.SubName);addCommas
    row.SubName==null ? aaa=" ": aaa=' &#187; '+row.SubName;
    //${row.total_balance} = addCommas(row.total_balance);
    /*
<a href="#" class="btn-sm btn-success pt-1 pb-2 mr-1 view_offsupps" data-toggle="modal" data-target="#userViewModal" title="ดูข้อมูล" data-id="${row.id_offsupp_location }">ดูข้อมูล</a>
<a href="#" class="btn-sm btn-info pt-1 pb-2 mr-1 rcv_action" data-toggle="modal" data-target="#rcvModal" title="รับเข้า" data-id="${row.id_offsupp_location }">รับเข้า</a>
<a href="#" class="btn-sm btn-secondary pt-1 pb-2 mr-1 adj_action" data-toggle="modal" data-target="#adjModal" title="ปรับยอด" data-id="${row.id_offsupp_location }">ปรับยอด</a>
<a href="#" class="btn-sm btn-primary pt-1 pb-2 mr-1 rtn_action" data-toggle="modal" data-target="#userModalx" title="รับคืน" data-id="${row.id_offsupp_location }">รับคืน</a>
<a href="#" class="btn-sm btn-warning pt-1 pb-2 mr-1 edit_action" data-toggle="modal" data-target="#userModalx" title="แก้ไข" data-id="${row.id_offsupp_location }">โอนย้าย</a>
<a href="#" class="btn-sm btn-danger deleteuser" title="Delete" data-id="${row.id_offsupp_location }">ลบ</a>    
    */
    DataRow = `<tr>
          <td class="align-middle pt-1 pb-1 pl-1">${numx}.</td>    
          <td class="align-middle pt-1 pb-1 pl-1"><img src="${row.photo_name}" class="w-40" /></td>
          <td class="align-middle pt-1 pb-1 pl-1">${row.location_short}</td>
          <td class="align-middle pt-1 pb-1 pl-1">${row.offsupp_code}</></td>
          <td class="align-middle pt-1 pb-1 pl-1">${row.offsupp_name}</td>
          <td class="align-middle pt-1 pb-1 pl-1">${row.mainName} ${aaa}</td>
          <td class="align-middle pt-1 pb-1 pl-1 text-right">${addCommas(row.total_balance)}</td>
          <td class="align-middle pt-1 pb-1 pl-1">${row.unit_name}</td>
          <?PHP if($_SESSION['sess_class_user']==4){ ?>
          <td class="align-middle pt-1 pb-1 pl-1 ${row.statusColor}">${statusReqArr[row.status_use_offsupp]}</td>
          <td class="align-middle pt-1 pb-1 pl-1">
          <div class="btn-group">
                    <button type="button" class="btn btn-warning">จัดการ</button>
                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">ลิสต์รายการ</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a class="dropdown-item view_offsupps" data-toggle="modal" data-target="#userViewModal" title="ดูข้อมูล" data-id="${row.id_offsupp_location }"><i class="fas fa-clipboard-list"></i> ดูรายละเอียด</a>
                      <a class="dropdown-item rcv_action" data-toggle="modal" data-target="#rcvModal" title="รับเข้า" data-id="${row.id_offsupp_location }" ><i class="fas fa-dolly-flatbed"></i> รับเข้า</a>
                      <a class="dropdown-item adj_action" data-toggle="modal" data-target="#adjModal" title="ปรับยอด" data-id="${row.id_offsupp_location }"><i class="fas fa-arrows-alt-v"></i> ปรับยอด</a>
                      <a class="dropdown-item rtn_action" data-toggle="modal" data-target="#userModalx" title="รับคืน" data-id="${row.id_offsupp_location }"><i class="fas fa-undo"></i> รับคืน</a>
                      <a class="dropdown-item trn_action" data-toggle="modal" data-target="#userModalx" title="แก้ไข" data-id="${row.id_offsupp_location }"><i class="fas fa-exchange-alt"></i> โอนย้าย</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item deleteuser" data-id="${row.id_offsupp_location }"><i class="fas fa-pause"></i> ระงับใช้งาน</a>
                    </div>
                  </div>
          </td>
          <?PHP }?>
        </tr>`;
  }
  return DataRow;
}


var statusReqArr = <?PHP echo json_encode($statusReqArr); ?>;



/*ฟังก์ชั่นแบ่งหน้า โดยใช้ ajax-json (แก้ไขสมบรูณ์แล้ว)*/
function func_getDatalist() {
  var limit_perPage = $("#limit_perPage").val();
  var pageno = parseInt($("#currentpage").val());
  $.ajax({
    url: "module/module_warehouse/ajax_action.php",
    type: "GET",
    dataType: "json",    
    data: { page: pageno, action: "getDataList" },
    beforeSend: function () {
      $("#overlay").fadeIn();
    },
    success: function (Data){
      console.log(Data);
      if (Data.row) {
        $("#totalRows").html(Data.count);
        var rowlist = "";
        let totalrow = Data.count;
        let totalpages = Math.ceil(parseInt(totalrow) / limit_perPage);
        const currentpage = $("#currentpage").val();
        if(pageno!=1){
          numz = parseInt(pageno*limit_perPage); 
          numx = totalrow ;
          numx = parseInt((totalrow-numz+parseInt(limit_perPage)));
        }else{
          numz = 0;
          numx = totalrow ;
        }
        $.each(Data.row, function (index, row) {
          //alert(Data.row[index]['offsupp_name']);          
          if(row.status_use_offsupp==1){row.statusColor='text-success'}
          if(row.status_use_offsupp==2){row.statusColor='text-danger'}
          if(row.photo_name==null){
            row.photo_name='<?php echo $pathOffsuppDefault; ?>';
          }else{
            row.photo_name='<?php echo $pathOffsupp; ?>'+row.photo_name;
          }

          //row.status_use_offsupp = statusReqArr[row.status_use_offsupp];          
          rowlist += getplayerrow(row);
          numx--;
        });
        //alert(rowlist);return false;
        $("#userstable tbody").html(rowlist);
        $("#itemsCount").val(totalrow);
        $("#totalpages").html(totalpages);
        $("#overlay").fadeOut();
      }
    },
    error: function () {
      console.log(Data);
      console.log("ระบบมีข้อผิดพลาด");
    },
  });
}


$(document).ready(function () {

  /*โหลดรายการ เมื่อมีการเข้ามาที่หน้านี้*/
  func_getDatalist();


  $(document).on('change','select[id=txt_ref_id_unit]',function(){
    var txt_ref_id_unit = $("#txt_ref_id_unit option:selected" ).text();    
    $(".txt_moq").html('/'+txt_ref_id_unit);    $(".txt_min_stock").html('/'+txt_ref_id_unit);
  });


  
  $(document).on('change','select[id=slt_id_offsupps]',function(){
    var id_offsupps = $("#slt_id_offsupps option:selected" ).val();
    //alert(id_offsupps);
    $.each(save_offsupp, function (key, value) {
      if(value.id_offsupp==id_offsupps){
        //$('#offsupp_detail').html(value.id_offsupp+'-----------'+value.photo_name+'-----------'+value.offsupp_name+'-------'+value.offsupp_detail+'<br />');
        if(!value.photo_name){
          $('#img_offsupp').html('<img src="<?PHP echo $pathOffsuppDefault; ?>" class="rounded responsive w-100" />');
        }else{
          $('#img_offsupp').html('<img src="<?PHP echo $pathOffsupp; ?>'+value.photo_name+'" class="rounded responsive w-100" />');
        }

        $('#offsupp_detail').html(value.offsupp_detail);       
       
      }      
    });    
    
  });


  var save_offsupp = '';  //สร้างไว้รับอาร์เรย์ JSON -- row ของ selectBox ref_id_menu
  
  $(document).on('change','select[id=ref_id_menu]',function(){
    var ref_id_menu = $("#ref_id_menu option:selected" ).val();
    //alert(ref_id_menu);
    //$('#ref_id_menu_sub').html( '<option value="" disabled="" selected="">เลือกหมวดหลักก่อน</option>' );
    $.ajax({
      url: "module/module_warehouse/ajax_action.php",
      type: "GET",
      dataType: "json",
      data: { ref_id_menu: ref_id_menu, action: "getsubmenu" },
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: function (row) {
        console.log(row);        

        if(row.offsupp.length!==0){
            save_offsupp = row.offsupp;
            $('#slt_id_offsupps').html( '<option value="" disabled="" selected="">เลือกวัสดุอุปกรณ์</option>' );
            $.each(row.offsupp, function (key, value) {
              //console.log(value.name_menu);
              $('#slt_id_offsupps').append($('<option>',
              {
                value: value.id_offsupp, text : value.offsupp_code+': '+value.offsupp_name 
              }
              ));
            });
          }else{
            $('#slt_id_offsupps').html( '<option value="" disabled="" selected="">ไม่มีรายการในหมวดนี้</option>' );
          }

          if(row.sub.length!==0){
            $('#ref_id_menu_sub').html( '<option value="" selected="" disabled="">เลือกหมวดย่อย</option>' );
            $.each(row.sub, function (key, value) {
              //console.log(value.name_menu);
              $('#ref_id_menu_sub').append($('<option>',
              {
                value: value.id_menu, text : value.name_menu 
              }
              ));
            });
          }else{
            $('#ref_id_menu_sub').html( '<option value="0" disabled="" selected="selected">ไม่มีหมวดย่อย</option>' );
          }
        $("#overlay").fadeOut();
      },
      error: function () {
        console.log("Error!!");
      },
    });       

  });  


  function isValidDate(dateString) {
    var regEx = /^\d{4}-\d{2}-\d{2}$/;
    return dateString.match(regEx) != null;
  }


  
  $(document).on("click", ".btn-reset", function (e){ //ก่อนแก้ใช้คลาส ul.pagination li a
    e.preventDefault();
    $(".addform")[0].reset();
    $("#id_offsupp").val("");
    $(".addform").removeClass('was-validated');
  });

  //เพิ่มข้อมูลวัสดุตามไซต์
  $(document).on("submit", ".addform", function (event) {
    //alert('xxxxxxxxx');
    event.preventDefault();
    var alertmsg =
      $("#id_offsupp").val().length > 0
        ? "เพิ่มรายการรับเข้าเรียบร้อยแล้ว"
        : "เพิ่มข้อมูลเรียบร้อยแล้ว";
        //alert(alertmsg); return false;        
    $.ajax({
      url: "module/module_warehouse/ajax_action.php",
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
        if(row=='DuplicateRows'){
          sweetAlert("ผิดพลาด...", 'มีรหัสวัสดุอุปกรณ์นี้ที่ไซต์งานที่เลือกแล้ว', "error"); //แจ้ง Error ซ้ำ
          return false;
        }
        func_getDatalist();
        //$("#overlay").fadeOut();
        $("#userModal").modal("hide"); $(".modal-backdrop").fadeOut();
        sweetAlert("สำเร็จ...", alertmsg, "success"); //The error will display
        $(".addform").removeClass('was-validated');
        $('#img_offsupp').html('');
        $('#offsupp_detail').html('');        
        $(".addform")[0].reset();
      },
      error: function () {
        console.log(row);
        console.log("ไม่สำเร็จ! มีบางอย่างผิดพลาด!");
      },
    });
  });


  $(document).on('keypress',".input-page", function() { //*****ยังไม่เสร็จ */
    if(e.which == 13) {
      const pagenum = $(this).val();
      $("#currentpage").val(pagenum);
      func_getDatalist();     
    }
  });

  // Go pagination ปุ่ม GO
  $(document).on("click", ".page-togo", function (e){ //ก่อนแก้ใช้คลาส ul.pagination li a
    e.preventDefault();
    //alert($(".input-page").val());
    const pagenum = $(".input-page").val();
    $("#currentpage").val(pagenum);
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
  $("#addnewbtn").on("click", function () {
    $(".addform")[0].reset();
    $("#userid").val("");
  });


  // delete user
  $(document).on("click", "a.deleteuser", function (e) {
    e.preventDefault();
    var pid = $(this).data("id");
    if (confirm("Are you sure want to delete this?")) {
      $.ajax({
        url: "module/module_warehouse/ajax_action.php",
        type: "GET",
        dataType: "json",
        data: { id: pid, action: "deleteuser" },
        beforeSend: function () {
          $("#overlay").fadeIn();
        },
        success: function (res) {
          if (res.deleted == 1) {
            $(".message")
              .html("Player has been deleted successfully!")
              .fadeIn()
              .delay(3000)
              .fadeOut();
            func_getDatalist();
            $("#overlay").fadeOut();
          }
        },
        error: function () {
          console.log("something went wrong");
        },
      });
    }
  });

  /*
      <!-- table total balance -->
      <div class="table-responsive">
      <table class="table table-bordered table-hover table-md text-nowrap table-fixed" id="userstable">
      <colgroup>
        <col style="width:5%;">
        <col style="width:10%;">
        <col style="width:25%;">
        <col style="width:50%;">
        <col style="width:10%;">
      </colgroup>            
      <thead class="thead-light">                
        <tr>
          <th scope="col">#</th>
          <th scope="col">วันที่รับเข้า</th>
          <th scope="col">เลขที่ PO</th>
          <th scope="col">ลอต</th>
          <th scope="col">คงเหลือ</th>
        </tr>
      </thead>
    </table>
    </div>
    <!-- table total balance --> 
  
  
  */
  //คลิกดูวัสดุ-อุปกรณ์
  $(document).on("click", "a.view_offsupps", function () {
    var ref_id_offsupp_location = $(this).data("id");
    $.ajax({
      url: "module/module_warehouse/ajax_action.php",
      type: "GET",
      dataType: "json",
      data: { ref_id_offsupp_location: ref_id_offsupp_location, action: "getData" },
      success: function (data) {
        console.log(data);
        if (data.row) {
          const photo_name = data.row.photo_name ? data.row.photo_name : "default.png";     
          //const SubName = data.row.SubName!=null ? data.row.SubName : "-";
          data.row.SubName==null ? data.row.SubName="-": data.row.SubName=data.row.SubName;
          data.row.min_req==null ? data.row.min_req="-": data.row.min_req;
          data.row.status_use_offsupp==1 ? data.row.statusColor='text-success' : data.row.statusColor='text-danger';     
          
          const profile = `<div class="row">
                <div class="col-sm-4 col-md-4">
                  <img src="<?PHP echo $pathOffsupp; ?>${photo_name}" class="rounded responsive w-100" />
                </div>
                <div class="col-sm-2 col-md-8">
                  <h4 class="text-primary">${data.row.offsupp_name}</h4>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-light d-inline-block">ไซต์งาน:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${data.row.location_name}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-light d-inline-block">รหัสวัสดุ-อุปกรณ์:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${data.row.offsupp_code}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-light d-inline-block">ชื่อวัสดุ-อุปกรณ์:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${data.row.offsupp_name}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-light d-inline-block">หมวดหลัก:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6  d-inline-block">${data.row.mainName}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-light d-inline-block">หมวดย่อย:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${data.row.SubName}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-light d-inline-block">เบิกได้ไม่เกิน:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${data.row.min_req} ${data.row.unit_name} ต่อ 1 ใบเบิก</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-light d-inline-block">คงเหลือขั้นต่ำ:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${data.row.min_stock} ${data.row.unit_name}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-light d-inline-block">MOQ:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${data.row.moq}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-light d-inline-block">Leadtime:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${data.row.leadtime}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-light d-inline-block">สถานะการใช้งาน:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block ${data.row.statusColor}">${statusReqArr[data.row.status_use_offsupp]}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-light d-inline-block">คงเหลือในระบบ:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${addCommas(data.row.total_balance)} ${data.row.unit_name}</span>
                </div>
                <div style="width:100%" class="mt-1 p-1 bg-primary d-block">
                  <h6 class="pt-2">รายการลอตที่มียอดคงเหลือ</h6>
                </div>
              </div>
              <!-- table total balance -->
      <div class="table-responsive">
      <table class="table table-bordered table-hover table-md text-nowrap table-fixed" id="table-lot-balance">
      <colgroup>
        <col style="width:5%;">
        <col style="width:10%;">
        <col style="width:25%;">
        <col style="width:50%;">
        <col style="width:10%;">
      </colgroup>            
      <thead class="thead-light">                
        <tr>
          <th scope="col">#</th>
          <th scope="col">วันที่รับเข้า</th>
          <th scope="col">เลขที่ PO</th>
          <th scope="col">ลอต</th>
          <th scope="col">คงเหลือ</th>
        </tr>
      </thead>
      <tbody>
      </tbody>      
    </table>
    </div>
    <!-- table total balance --> `;

              lotrow=``;
              $.each(data.lot, function (index, row){
                lotrow+=`
                <tr>
                  <td>${index+1}</td>
                  <td>${data.lot[index]['rcv_date']}</td>
                  <td>${data.lot[index]['ref_po_no']}</td>
                  <td>${data.lot[index]['rcv_lot']}</td>
                  <td>${addCommas(data.lot[index]['total_balance'])}</td>
                </tr>`;
              });
          $("#profile").html(profile);
          $("#table-lot-balance tbody").html(lotrow);
        }
      },
      error: function () {
        console.log("something went wrong");
      },
    });
  });

  // searching
  $("#searchinput").on("keyup", function () {
    const searchText = $(this).val();
    var rowlist = "";
    if (searchText.length > 1) {
      $.ajax({
        url: "module/module_warehouse/ajax_action.php",
        type: "GET",
        dataType: "json",
        data: { searchText: searchText, action: "search" },
        success: function (Data) {
           console.log(Data);
            if (Data.row) {
              numx = Data.rowcount;
              $.each(Data.row, function (index, row) {
                if(row.status_use_offsupp==1){row.statusColor='text-success'}
                if(row.status_use_offsupp==2){row.statusColor='text-danger'}
                if(row.photo_name==null){
                  row.photo_name='<?php echo $pathOffsuppDefault; ?>';
                }else{
                  row.photo_name='<?php echo $pathOffsupp; ?>'+row.photo_name;
                }
                rowlist+= getplayerrow(row);
                numx--;
              });
              $("#userstable tbody").html(rowlist);
              $("#totalRows").html(Data.rowcount);
              $("#totalpages").html(1);
              $("div[id^=page-number-]").html(1);
              
              //$(".pagination-container").hide();
              
            }
        },
        error: function () {
          console.log("something went wrong"+Data);
        },
      });
    } else {
      func_getDatalist();
      $("#pagination").show();
    }
  });

});

  </script>