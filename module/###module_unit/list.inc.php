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
$numRow_player = $obj->getCount("SELECT count(id_unit) AS total_row FROM tb_unit");
?>    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h4 class="display-10 d-inline-block font-weight-bold"><?PHP echo $title_act;?></h4>

          <div class="card-tools">
            <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active"><?PHP echo $breadcrumb_txt; ?></li>
            </ol>
          </div><!-- /.col -->
        </div>


        <div class="card-body">

      <?php include_once 'module/module_unit/frm_add-edit.inc.php'; //หน้า add/edit?>

      <!-- profile modal start -->
      <div class="modal fade" id="userViewModal" tabindex="-1" role="dialog" aria-labelledby="userViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-circle"></i></i> <?PHP echo $title_site; ?> <span class="data-name text-1"></span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div id="profile"></div>
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
        <i class="fas fa-circle"></i> เพิ่มหน่วยนับ</button>
      </div>
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
              <col style="width:10%;">
              <col style="width:60%;">
              <col style="width:12%;">
              <col style="width:10%;">
            </colgroup>            
              <thead class="thead-light">                
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">ชื่อหน่วยนับ</th>
                  <th scope="col">หมายเหตุ</th>
                  <th scope="col">สถานะ</th>
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

(function () {/*ฟังก์ชั่นเช็คฟอร์มก่อนเซฟ*/
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
  if (row) {
     dataRow = `<tr>
          <td class="align-middle pt-2 pb-2 pl-1">${numx}.</td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.unit_name}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.unit_remark}</td>
          <td class="align-middle pt-2 pb-2 pl-1 font-weight-bold text-${row.status_unit}">${row.status_chk}</td>
          <td class="align-middle pt-2 pb-2 pl-1">
          <a href="#" class="btn-sm pt-1 pb-2 btn-success mr-3 profile" data-toggle="modal" data-target="#userViewModal" title="Prfile" data-id="${row.id_unit}">ดูข้อมูล</a>
          <a href="#" class="btn-sm pt-1 pb-2 btn-warning mr-3 editdata" data-toggle="modal" data-target="#userModal" title="Edit" data-id="${row.id_unit}">แก้ไข</a>
          <a href="#" class="btn-sm pt-1 pb-2 btn-danger deleterow" data-id_menu="14" title="Delete" data-id="${row.id_unit}">ลบ</a>
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
    url: "module/module_unit/ajax_action.php",
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
          row.status_chk = statusArr_js[row.status_unit];
          if(row.unit_remark==null){row.unit_remark ='';}
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


  
  $('.goto-num').on("keypress", function(e) {
    if (e.keyCode == 13) {
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
    $("#id_menu").val("");
    $(".addform").removeClass('was-validated');
  });

  
  $("#addnewbtn").on("click", function () {
    $(".addform")[0].reset();
    $("#id_menu").val("");
  });



  //ปุ่มกดบันทึก เพิ่ม-แก้ไขข้อมูล
  $(document).on("submit", ".addform", function (event) {
      event.preventDefault();  
      var level_menu = $("input:radio[name=level_menu]:checked").val();
          var chk_subMenu = $("#ref_id_menu :checked").val();
          if(level_menu=="2" && chk_subMenu=="0"){
            sweetAlert("ผิดพลาด..", "กรุณาเลือกหมวดหลัก", "warning"); return false;
          }
      $.ajax({
        url: "module/module_unit/ajax_action.php",
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
            $(".addform").removeClass('was-validated');
            $("#userModal").modal("hide"); $(".modal-backdrop").fadeOut();
            $(".addform")[0].reset();
            $("#id_unit").val("");
            func_getDatalist();
            sweetAlert("สำเร็จ..", "บันทึกข้อมูลแล้ว", "success"); return false;
            $("#overlay").fadeOut();
          }
        },
        error: function () {
          console.log("บันทึกไม่สำเร็จ! มีบางอย่างผิดพลาด!");
        },
      });
  });

  //ปุ่มแก้ไขข้อมูล
  $(document).on("click", "a.editdata", function () {
    var id_row = $(this).data("id");
    $.ajax({
      url: "module/module_unit/ajax_action.php",
      type: "GET",
      dataType: "json",
      data: { id_row: id_row, action: "viewdata"},
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: function (data) {
        if (data) {
          if(data.status_unit==1){
            $("#status_use").attr('checked', true);
          }else{
            $("#status_hold").attr('checked', true);
          }
          $("#exampleModalLabel").html('แก้ไขหน่วยนับ');
          $(".div_status").removeClass("d-none").show();
          $("#id_unit").val(data.id_unit);
          $("#unit_name").val(data.unit_name);
          $("#unit_remark").val(data.unit_remark);
        }
        $("#overlay").fadeOut();
      },
      error: function () {
        console.log("Error!!");
      },
    });
  });
  
  //ปุ่มดูข้อมูล
  $(document).on("click", "a.profile", function () {
    var id_row = $(this).data("id");
    $.ajax({
      url: "module/module_unit/ajax_action.php",
      type: "GET",
      dataType: "json",
      data: { id_row : id_row, action: "viewdata" },
      success: function (row) {
        if (row) {
          $('.data-name').html(row.unit_name);
          if(row.unit_remark==null){row.unit_remark ='';}
          const profile = `<div class="row">
                <div class="col-sm-1 col-md-12">
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 d-inline-block">สถานะ:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block font-weight-bold text-${row.status_unit}">${statusArr_js[row.status_unit]}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 d-inline-block">ชื่อหน่วยนับ:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${row.unit_name}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 d-inline-block">หมายเหตุ	:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 d-inline-block">${row.unit_remark}</span>
                </div>
              </div>`;
          $("#exampleModalLabel").html('ข้อมูลหน่วยนับ');
          $("#profile").html(profile);
        }
      },
      error: function () {
        console.log("something went wrong");
      },
    });
  });

  //ค้นหาข้อมูล
  $("#searchinput").on("keyup", function () {
    const searchText = $(this).val();
    var limit_perPage = $("#limit_perPage").val();
    var pageno = 1;    
    if (searchText.length > 1) {
      $.ajax({
        url: "module/module_unit/ajax_action.php",
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
              if(row.unit_remark==null){row.unit_remark ='';}
              row.status_chk = statusArr_js[row.status_unit];
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

  /*ลบข้อมูล*/
  $(document).on("click", "a.deleterow", function (e) {
    e.preventDefault();
    var id_row = $(this).data("id"); 
    sweetAlert({
    title: "ยืนยันการลบข้อมูล ?",
    text: "ต้องการลบข้อมูลนี้หรือไม่!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "ตกลง, ลบข้อมูล!",
    cancelButtonText: "ไม่, ยกเลิก!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
    function (isConfirm) {
      if (isConfirm) {
        //alert(id_row); return false;
        $.ajax({
          url: "module/module_unit/ajax_action.php",
          type: "GET",
          dataType: "json",
          data: { id: id_row, action: "deleterow" },
          beforeSend: function () {
            $("#overlay").fadeIn();
          },success: function (data) {
            if(data==1){
              func_getDatalist();
              $("#overlay").fadeOut();
              sweetAlert({title: "สำเร็จ !", text: "ลบข้อมูลเรียบร้อย!", confirmButtonText: "ปิด", type: "success"});            
            }else{
              sweetAlert("ผิดพลาด!", "ไม่สามารถลบข้อมูลได้", "error");
            }
          },error: function (data) {
            sweetAlert("ผิดพลาด!", "ไม่สามารถลบข้อมูลได้", "error");
          }
        });
      } else {
        sweetAlert.close();
      }
    });
  return false;
  });







});//doc ready


  </script>