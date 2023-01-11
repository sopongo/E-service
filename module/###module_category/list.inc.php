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
$numRow_player = $obj->getCount("SELECT count(id_menu) AS total_row FROM tb_category");

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
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div>


        <div class="card-body">

      <?php include_once 'module/module_category/frm_add-edit.inc.php'; //หน้า add/edit?>

      <!-- profile modal start -->
      <div class="modal fade" id="userViewModal" tabindex="-1" role="dialog" aria-labelledby="userViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-user"></i> หมวดวัสดุ-อุปกรณ์</h5>
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
      <div class="col-10">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#userModal,.modal-lg" id="addnewbtn" data-backdrop="static" data-keyboard="false">
        <i class="fas fa-circle"></i> เพิ่มหมวดวัสดุ-อุปกรณ์</button>
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
        <col style="width:15%;">
        <col style="width:8%;">
        <col style="width:45%;">
        <col style="width:12%;">
        <col style="width:8%;">
        <col style="width:10%;">
      </colgroup>            
              <thead class="thead-light">                
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">ชื่อหมวด</th>
                  <th scope="col">ประเภทหมวด</th>
                  <th scope="col">หมายเหตุ</th>
                  <th scope="col">วันที่เพิ่มหมวด</th>
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
//id_menu	level_menu  sort_menu   ref_id_menu ref_id_sub  name_menu desc_menu menu_adddate	addmenu_ref_idmem   menu_editdate	editmenu_ref_idmem	status_menu        
function getplayerrow(user) {
  var userRow = "";
  if (user) {
    userRow = `<tr>
          <td class="align-middle pt-2 pb-2 pl-1">${numx}.</td>
          <td class="align-middle pt-2 pb-2 pl-1">${user.name_menu}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${user.level_menu}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${user.desc_menu}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${user.menu_adddate}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${user.status_menu}</td>
          <td class="align-middle pt-2 pb-2 pl-1">
          <a href="#" class="btn-sm btn-success mr-3 profile pt-1 pb-2" data-toggle="modal" data-target="#userViewModal" title="Prfile" data-id="${user.id_menu}">ดูข้อมูล</a>
          <a href="#" class="btn-sm btn-warning mr-3 editdata pt-1 pb-2" data-toggle="modal" data-target="#userModal" title="Edit" data-id="${user.id_menu}">แก้ไข</a>
          <a href="#" class="btn-sm btn-danger deleteuser pt-1 pb-2" data-id_menu="14" title="Delete" data-id="${user.id_menu}">ลบ</a>
          </td>
        </tr>`;
  }
  return userRow;
}


/*ฟังก์ชั่นแบ่งหน้า โดยใช้ ajax-json (แก้ไขสมบรูณ์แล้ว)*/
function func_getDatalist() {
  var limit_perPage = $("#limit_perPage").val();
  var pageno = parseInt($("#currentpage").val());
  $.ajax({
    url: "module/module_category/ajax_action.php",
    type: "GET",
    dataType: "json",    
    data: { page: pageno, action: "getDataList" },
    beforeSend: function () {
      $("#overlay").fadeIn();
    },
    success: function (rows){
      console.log(rows);
      if (rows.user) {
        //alert(rows.count);
        $("#totalRows").html(rows.count);
        var userlist = "";
        let totaluser = rows.count;
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
        $.each(rows.user, function (index, user) {
          userlist += getplayerrow(user);
          numx--;
        });
        //alert(userlist);return false;
        $("#userstable tbody").html(userlist);
        $("#itemsCount").val(totaluser);
        $("#totalpages").html(totalpages);
        $("#overlay").fadeOut();
      }
    },
    error: function () {
      console.log("ระบบมีข้อผิดพลาด");
    },
  });
}


$(document).ready(function () {

//var jqueryarray = <?PHP echo json_encode($deptArr); ?>;
//var statusArr_js = <?PHP echo json_encode($statusArr); ?>;
  

  /*โหลดรายการ เมื่อมีการเข้ามาที่หน้านี้*/
   func_getDatalist();


  $('#menu_code').bind('keydown', function(event) {
  var key = event.which;
  if (key >=48 && key <= 57) {
    event.preventDefault();
  }
  });

  // add/edit user
  $(document).on("submit", ".addform", function (event) {
    event.preventDefault();  
    var level_menu = $("input:radio[name=level_menu]:checked").val();
    var chk_subMenu = $("#ref_id_menu :checked").val();
    if(level_menu=="2" && chk_subMenu=="0"){
      sweetAlert("ผิดพลาด..", "กรุณาเลือกหมวดหลัก", "warning"); return false;
    }    
    if($('#menu_code').val()!=($('#menu_code').val().toUpperCase())){
      sweetAlert("ผิดพลาด..", "อักษรภาษาอังกฤษ ตัวพิมพ์ใหญ่เท่านั้น", "warning"); return false;
    }
    $.ajax({
      url: "module/module_category/ajax_action.php",
      type: "POST",
      dataType: "json",
      data: new FormData(this),
      processData: false,
      contentType: false,
      beforeSend: function () {
        //$("#overlay").fadeIn();
      },
      success: function (response) {
        console.log(response);
        if (response){
          $("#userModal").modal("hide"); $(".modal-backdrop").fadeOut();
          $(".addform")[0].reset();
          func_getDatalist();
          sweetAlert("สำเร็จ..", "บันทึกข้อมูลเรียบร้อยแล้ว", "success"); return false;
          //$("#overlay").fadeOut();
        }
      },
      error: function () {
        console.log("ไม่สำเร็จ! มีบางอย่างผิดพลาด!"+response);
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
      url: "module/module_category/ajax_action.php",
      type: "GET",
      dataType: "json",
      data: { id_row: id_row, action: "getuser" },
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: function (data) {
        if (data) {
          $("#exampleModalLabel").html('แก้ไขหมวดหมู่วัสดุ-อุปกรณ์');
          if(data.level_menu=="หมวดหลัก"){
            $("#mainCate").attr('checked', true);
            $("#mainMenu").addClass("d-none").hide();
          }else{
            $("#subCate").attr('checked', true);
            $("#mainMenu").removeClass("d-none").show();
            $('.ref_id_menu option[value='+data.ref_id_menu+']').attr('selected','selected');
          }
          $(".div_status").removeClass("d-none").show();
          $("#name_menu").val(data.name_menu);
          $("#desc_menu").val(data.desc_menu);
          if(data.status_menu==1){
            $('#status_use').attr("checked",true);
          }else{
            $('#status_hold').attr("checked",true);
          }
          
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
  $(document).on("click", "a.deleteuser", function (e) {
    e.preventDefault();
    var pid = $(this).data("id");
    if (confirm("Are you sure want to delete this?")) {
      $.ajax({
        url: "module/module_category/ajax_action.php",
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

  
  // get profile
  $(document).on("click", "a.profile", function () {
    var id_row = $(this).data("id");
    $.ajax({
      url: "module/module_category/ajax_action.php",
      type: "GET",
      dataType: "json",
      data: { id_row : id_row, action: "getuser" },
      success: function (row) {
        if (row) {
          //id_menu	level_menu  sort_menu   ref_id_menu     ref_id_sub  name_menu       desc_menu   menu_adddate	addmenu_ref_idmem   menu_editdate	editmenu_ref_idmem	status_menu        
          row.edit_fullname==null ? row.edit_fullname='-': row.edit_fullname=row.edit_fullname;
          row.main_name==null ? row.main_name='-': row.main_name=row.main_name; //statusArr_js
          const profile = `<div class="row">
                <div class="col-sm-1 col-md-12">
                  <h4 class="text-primary font-weight-bold">${row.name_menu}</h4>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 d-inline-block">สถานะ:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6  d-inline-block">${statusArr_js[row.status_menu]}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 d-inline-block">ชื่อหมวด:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6  d-inline-block">${row.name_menu}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 d-inline-block">ประเภทหมวด:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6  d-inline-block">${row.level_menu}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 d-inline-block">หมวดหลัก:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6   d-inline-block">${row.main_name}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 d-inline-block">หมายเหตุ:</p>
                  <span class="text-md-start p-1 m-0 col-sm-8  d-inline-block">${row.desc_menu}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 d-inline-block">วันที่เพิ่มข้อมูล:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6  d-inline-block">${row.menu_adddate}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 d-inline-block">เพิ่มโดย:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6  d-inline-block">${row.add_fullname}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 d-inline-block">แก้ไขล่าสุด:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6  d-inline-block">${row.menu_editdate}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 d-inline-block">แก้ไขโดย:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6  d-inline-block">${row.edit_fullname}</span>
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
        url: "module/module_category/ajax_action.php",
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