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

</style>



<?PHP
$obj = new CRUD();
$numRow_player = $obj->getCount("SELECT count(id_req) AS total_row FROM tb_requisition");

?>    
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

      <?php include_once 'module/module_requisition/frm_add-edit.inc.php'; //หน้า add/edit?>

      <!-- profile modal start -->
      <div class="modal fade" id="userViewModal" tabindex="-1" role="dialog" aria-labelledby="userViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-circle"></i></i> ไซต์งาน</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container" id="profile">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- profile modal end -->
      
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
              <col style="width:5%;">
              <col style="width:7%;">
              <col style="width:20%;">
              <col style="width:50%;">
              <col style="width:12%;">
              <col style="width:10%;">
            </colgroup>            
              <thead class="thead-light">                
                <tr>
                <th scope="col">#</th>
                <th scope="col">เลขที่ใบเบิก</th>
                <th scope="col">วันที่เบิก</th>
                <th scope="col">ไซต์งาน</th>
                <th scope="col">แผนก</th>
                <th scope="col">ผู้เบิก</th>
                <th scope="col">จำนวนรายการที่เบิก</th>
                <th scope="col">สถานะอนุมัติ</th>
                <th scope="col">สถานะจ่าย</th>
                <th scope="col">สถานะใบเบิก</th>
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
        <input type="hidden" name="currentpage" id="currentpage" value="1" />
        <input type="hidden" name="limit_perPage" id="limit_perPage" value="<?PHP echo $limit_perPage; ?>" />


        </div>


  <div id="overlay" style="display:none;">
    <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;"></div>
    <br />
    Loading...
  </div>

        <div class="card-footer">
        <?PHP include_once('footer.inc.php');?>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

<script type="text/javascript"> 
$(document).ready(function(){

});
</script>



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
     dataRow = `<tr>
          <td class="align-middle pt-2 pb-2 pl-1">${numx}.</td>
          <td class="align-middle pt-2 pb-2 pl-1"><?PHP echo $req_digit;?>${row.req_no}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.req_datetime}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.location_remark}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.location_remark}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.location_remark}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.location_remark}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.location_remark}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.location_remark}</td>
          <td class="align-middle pt-2 pb-2 pl-1 font-weight-bold text-${row.status_location}">${row.status_chk}</td>
          <td class="align-middle pt-2 pb-2 pl-1">
          <a href="#" class="btn-sm btn-success mr-3 profile" data-toggle="modal" data-target="#userViewModal" title="Prfile" data-id="${row.id_location}">ดูข้อมูล</a>
          <a href="#" class="btn-sm btn-warning mr-3 editdata" data-toggle="modal" data-target="#userModal" title="Edit" data-id="${row.id_location}">แก้ไข</a>
          <a href="#" class="btn-sm btn-danger deleterow" data-id_menu="14" title="Delete" data-id="${row.id_location}">ลบ</a>
          </td>
        </tr>`;
  }
  return dataRow;
}


//var jqueryarray = <?PHP echo json_encode($deptArr); ?>;
var statusArr_js = <?PHP echo json_encode($statusArr); ?>;

/*ฟังก์ชั่นแบ่งหน้า โดยใช้ ajax-json (แก้ไขสมบรูณ์แล้ว)*/
function func_getDatalist() {
  var limit_perPage = $("#limit_perPage").val();
  var pageno = parseInt($("#currentpage").val());
  $.ajax({
    url: "module/module_requisition/ajax_action.php",
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
          row.status_chk = statusArr_js[row.status_location];
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
      url: "module/module_requisition/ajax_action.php",
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

  //get user
  $(document).on("click", "a.editdata", function () {
    var id_row = $(this).data("id");
    $.ajax({
      url: "module/module_requisition/ajax_action.php",
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

  // delete user
  $(document).on("click", "a.deleterow", function (e) {
    e.preventDefault();
    var id_location = $(this).data("id");
    sweetAlert({
      title: "ยืนยันการลบข้อมูล ?",
      text: "คลิก 'OK' เพื่อลบข้อมูล",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    },)
    .then((willDelete) => {
      if (willDelete) {
          $.ajax({
          url: "module/module_requisition/ajax_action.php",
          type: "GET",
          dataType: "json",
          data: { id: id_location, action: "deleterow" },
          beforeSend: function () {
            $("#overlay").fadeIn();
          },
          success: function (res) {
            console.log(res);
            if (res == 1) {
              $("#overlay").fadeOut();              
              sweetAlert("สำเร็จ! ลบข้อมูลเรียบร้อยแล้ว!", {icon: "success",});
              func_getDatalist();
            }
          },
          error: function () {
            console.log("มีบางอย่างผิดพลาด กรุณาตรวจสอบ");
          },
        });
      }
    });
  });

  
  // get profile
  $(document).on("click", "a.profile", function () {
    var id_row = $(this).data("id");
    $.ajax({
      url: "module/module_requisition/ajax_action.php",
      type: "GET",
      dataType: "json",
      data: { id_row : id_row, action: "getuser" },
      success: function (row) {
        if (row) {
          const profile = `<div class="row">
                <div class="col-sm-1 col-md-12">
                  <h4 class="text-primary font-weight-bold">${row.location_name}</h4>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 d-inline-block">สถานะ:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block font-weight-bold text-${row.status_location}">${statusArr_js[row.status_location]}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 d-inline-block">ชื่อย่อไซต์งาน:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${row.location_short}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 d-inline-block">ชื่อไซต์งาน:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${row.location_name}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 d-inline-block">หมายเหตุ	:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${row.location_remark}</span>
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
    var limit_perPage = $("#limit_perPage").val();
    var pageno = 1;    
    if (searchText.length > 1) {
      $.ajax({
        url: "module/module_requisition/ajax_action.php",
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
  