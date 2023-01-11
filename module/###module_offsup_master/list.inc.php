<!-- Ekko Lightbox -->
<script src="plugins/ekko-lightbox/ekko-lightbox.js"></script>  
<script src="plugins/autoNumeric/autoNumeric.js"></script>  

<style type="text/css">
table tr td, table thead th{ color:#333;
        /*font-family: "Noto Sans Thai",arial, Geneva, sans-serif;*/
        font-style: normal;
        font-weight:500;
        line-height:0.80rem;
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
  line-height:1.10rem;
}
.dropdown-item {
  font-size: 0.85rem;
  cursor: pointer;
  line-height:1.20rem;
}
</style>

<script src="plugins/sweetalert/sweetalert.js"></script>

<?PHP
$obj = new CRUD();
$numRow_player = $obj->getCount("SELECT count(id_offsupp) AS total_row FROM tb_office_supplies");
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


          <div class="card-tools">
            <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">คลังวัสดุ-อุปกรณ์</li>
            </ol>
          </div><!-- /.col -->
        </div>


        <div class="card-body">

      <?php
      include_once 'module/module_offsup_master/frm_add-edit.inc.php'; //หน้า add/edit
      include_once 'module/module_offsup_master/frm_rcv-cut.inc.php'; //หน้า add/edit
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
      <div class="col-10">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#userModal,.modal-lg" id="addnewbtn" data-backdrop="static" data-keyboard="false">
        <i class="fas fa-circle"></i> เพิ่มวัสดุ-อุปกรณ์</button>
      </div>
      <!--<div class="col-2">
        <div class="input-group input-group-sm">
          <div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span></div>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="ค้นหา..." id="searchinput">
        </div>
      </div>-->
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
                <col style="width:3%;">
                <col style="width:3%;">
                <col style="width:8%;">
                <col style="width:50%;">
                <col style="width:15%;">
                <col style="width:5%;">
                <col style="width:8%;">
                <col style="width:10%;">
              </colgroup>            
              <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">รูป</th>
                  <th scope="col">รหัสวัสดุอุปกรณ์</th>
                  <th scope="col">ชื่อวัสดุอุปกรณ์</th>
                  <th scope="col">หมวดวัสดุอุปกรณ์</th>
                  <th scope="col">หน่วยนับ</th>
                  <th scope="col">สถานะการใช้งาน</th>
                  <th scope="col">จัดการ</th>
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
  if (row) {
    const rowphoto = row.photo ? row.photo : "default.png";
    aaa='';
    row.SubName==null ? aaa=" ": aaa=' &#187; '+row.SubName;
    DataRow = `<tr>
          <td class="align-middle pt-0 pb-0 pl-1">${numx}.</td>    
          <td class="align-middle text-center"><a href="${row.photo_name}?text=1" data-toggle="lightbox" data-title="${row.offsupp_code} - ${row.offsupp_name}"><img src="${row.photo_name}" class="img-fluid w-40" alt="${row.offsupp_name}"></a></td>
          <td class="align-middle pt-0 pb-0 pl-1">${row.offsupp_code}</td>
          <td class="align-middle pt-0 pb-0 pl-1">${row.offsupp_name}</td>
          <td class="align-middle pt-0 pb-0 pl-1">${row.mainName} ${aaa}</td>
          <td class="align-middle pt-0 pb-0 pl-1">${row.unit_name}</td>
          <td class="align-middle pt-0 pb-0 pl-1 ${row.statusColor} font-weight-bold">${row.offsupp_status}</td>
          <td class="align-middle pt-0 pb-0 pl-1">

          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-toggle="dropdown">จัดการ</button>
            <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">      
              <span class="sr-only">ลิสต์รายการ</span>
            </button>
            <div class="dropdown-menu" role="menu" style="">
              <a class="dropdown-item profile" data-toggle="modal" data-target="#userViewModal" title="Prfile" data-id="${row.id_offsupp}"><i class="fas fa-clipboard-list"></i> ดูรายละเอียด</a>
              <a class="dropdown-item edit_action" data-toggle="modal" data-target="#userModalx" title="แก้ไข" data-id="${row.id_offsupp}"><i class="fas fa-pen"></i> แก้ไข</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item deleteuser" data-id="${row.id_offsupp }"><i class="fas fa-pause-circle"></i> ระงับใช้งาน</a>
            </div>
          </div>
          </td>
        </tr>`;
  }
  return DataRow;
}


var statusReqArr = <?PHP echo json_encode($statusReqArr); ?>;
var statusArr_js = <?PHP echo json_encode($statusArr); ?>;

/*ฟังก์ชั่นแบ่งหน้า โดยใช้ ajax-json (แก้ไขสมบรูณ์แล้ว)*/
function func_getDatalist() {
  var limit_perPage = $("#limit_perPage").val();
  var pageno = parseInt($("#currentpage").val());
  $.ajax({
    url: "module/module_offsup_master/ajax_action.php",
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
          if(row.offsupp_status==1){row.statusColor='text-success'}
          if(row.offsupp_status==2){row.statusColor='text-danger'}
          if(row.photo_name==null){
            row.photo_name='<?php echo $pathOffsuppDefault; ?>';
          }else{
            row.photo_name='<?php echo $pathOffsupp; ?>'+row.photo_name;
          }

          row.offsupp_status = statusReqArr[row.offsupp_status];          
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

  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    /*$('.filter-container').filterizr({gutterPixels: 3});*/
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
    

    $(document).on('change','select[id=txt_ref_id_unit]',function(){
     var txt_ref_id_unit = $("#txt_ref_id_unit option:selected" ).text();    
     $(".txt_moq").html('/'+txt_ref_id_unit);    $(".txt_min_stock").html('/'+txt_ref_id_unit);
    });

  $(document).on('change','select[id=txt_ref_id_menu]',function(){
    var txt_ref_id_menu = $("#txt_ref_id_menu option:selected" ).val();
    var txt_id_menu = $("#txt_ref_id_menu option:selected" ).text();    
    var result = txt_id_menu.split('-');
        result[0] = result[0].replace(" ", "");


    $('#txt_offsupp_code').val('ST-'+result[0]+'-???')

    $('#txt_ref_id_menu_sub').html( '<option value="" disabled="" selected="">เลือกหมวดหลักก่อน</option>' );
    $.ajax({
      url: "module/module_offsup_master/ajax_action.php",
      type: "GET",
      dataType: "json",
      data: { id_menu: txt_ref_id_menu, action: "getsubmenu" },
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: function (Data) {
        if (Data.length>0) {
          console.log(Data);
          $('#txt_ref_id_menu_sub').html( '<option value="0" selected="">เลือกหมวดย่อย</option>' );
          $.each(Data, function (key, value) {
            //console.log(value.name_menu);
            $('#txt_ref_id_menu_sub').append($('<option>',
            {
              value: value.id_menu, text : value.name_menu 
            }
            ));
          });
        }
        $("#overlay").fadeOut();
      },
      error: function () {
        console.log("Error!!");
      },
    });       

  });  

  
  $(document).on("click", ".btn-reset", function (e){ //ก่อนแก้ใช้คลาส ul.pagination li a
    e.preventDefault();
    $(".addform")[0].reset();
    $("#id_offsupp").val("");
    $(".addform").removeClass('was-validated');
  });

    //ADD OffSupp
    $(document).on("submit", ".addform", function (event) {
    event.preventDefault();         
    var alertmsg =
      $("#id_offsupp").val().length > 0
        ? "เพิ่มรายการรับเข้าเรียบร้อยแล้ว"
        : "เพิ่มข้อมูลเรียบร้อยแล้ว";
        //alert(alertmsg); return false;        
    $.ajax({
      url: "module/module_offsup_master/ajax_action.php",
      type: "POST",
      dataType: "json",
      data: new FormData(this),
      processData: false,
      contentType: false,
      beforeSend: function () {
        //$("#overlay").fadeIn();
      },
      success: function (row) {
        //console.log(row); return false;
        func_getDatalist();
        $("#overlay").fadeOut();
        $("#userModal").modal("hide"); $(".modal-backdrop").fadeOut();
        sweetAlert("สำเร็จ...", alertmsg, "success"); //The error will display
        $(".addrcv")[0].reset();
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
        url: "module/module_offsup_master/ajax_action.php",
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
    "id_offsupp": "75",
    "ref_id_menu": "3",
    "ref_id_menu_sub": "0",
    "offsupp_code": "ST-PEN-0010",
    "offsupp_name": "testxxx",
    "ref_id_unit": "1",
    "offsupp_detail": "test",
    "offsupp_status": "1",
    "moq": "1",
    "min_stock": "11",
    "leadtime": "1",
    "ref_iduser_add": "1",
    "offsupp_adddate": "2022-12-01 02:51:07",
    "ref_iduser_edit": "0",
    "offsupp_editdate": "0000-00-00 00:00:00",
    "photo_name": "12fed046e5d522335586f004bbc0ccc0.jpg"
*/
  //คลิกดูรายละเอียดวัสดุอุปกรณ์
  $(document).on("click", "a.profile", function () {
    var id_offsupp = $(this).data("id");
    $.ajax({
      url: "module/module_offsup_master/ajax_action.php",
      type: "GET",
      dataType: "json",
      data: { id_offsupp: id_offsupp, action: "get_offsupp" },
      success: function (offsupps) {
        console.log(offsupps);
        if (offsupps) {
          const photo_name = offsupps.photo_name ? offsupps.photo_name : "default.png";
          offsupps.SubName==null ? offsupps.SubName="-": offsupps.SubName=offsupps.SubName;
          offsupps.offsupp_detail=='' ? offsupps.offsupp_detail="-": offsupps.offsupp_detail=offsupps.offsupp_detail;
          const profile = `<div class="row">
                <div class="col-sm-4 col-md-4">
                  <img src="<?PHP echo $pathOffsupp; ?>${photo_name}" class="rounded responsive w-100" />
                </div>
                <div class="col-sm-2 col-md-8">
                  <h4 class="text-primary">${offsupps.offsupp_name}</h4>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 d-inline-block">รหัสวัสดุ-อุปกรณ์:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${offsupps.offsupp_code}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 align-top d-inline-block">ชื่อวัสดุ-อุปกรณ์:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${offsupps.offsupp_name}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 align-top d-inline-block">หมวดหลัก:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6  d-inline-block">${offsupps.mainName}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 align-top d-inline-block">หมวดย่อย:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${offsupps.SubName}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 align-top d-inline-block">หน่วยนับ:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${offsupps.unit_name}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 align-top d-inline-block text-danger">จำกัดเบิกได้ไม่เกิน:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${offsupps.max_req} ${offsupps.unit_name} ต่อ 1 ใบเบิก</span>                 
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 align-top d-inline-block">คงเหลือขั้นต่ำ:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${offsupps.min_stock} ${offsupps.unit_name}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 align-top d-inline-block">MOQ:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${offsupps.moq} ${offsupps.unit_name}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 align-top d-inline-block">Leadtime:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${offsupps.leadtime} วัน</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 align-top d-inline-block">สถานะการใช้งาน:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${statusArr_js[offsupps.offsupp_status]}</span>
                </div>
                <div style="width:98%" class="mt-1 p-1 text-white bg-white"><strong>รายละเอียด:</strong><br /><br />
                <p>${offsupps.offsupp_detail}</p>
                </div>
              </div>`;
          $("#exampleModalLabel").html('ข้อมูลผู้ใช้งาน');
          $("#profile").html(profile);
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
    if (searchText.length > 1) {
      $.ajax({
        url: "module/module_offsup_master/ajax_action.php",
        type: "GET",
        dataType: "json",
        data: { searchText: searchText, action: "search" },
        success: function (result) {
          if (result) {
            var resultlist = "";
            $.each(result, function (index, user) {
              resultlist += getplayerrow(user);
              numx++;
            });
            $("#userstable tbody").html(resultlist);
            $("#pagination").hide();
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