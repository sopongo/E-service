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
$numRow_player = $obj->getCount("SELECT count(id_user) AS total_row FROM tb_user");
?>    
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
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active">ผู้ใช้งานทั้งหมด</li>
            </ol>
          </div><!-- /.col -->
        </div>


        <div class="card-body">

      <?php
      include_once 'module/module_user/frm_add-edit.inc.php'; //หน้า add/edit
      //include_once 'module/module_user/view.inc.php'; //หน้าดูรายละเอียดราย ID
      ?>

      <!-- profile modal start -->
      <div class="modal fade" id="userViewModal" tabindex="-1" role="dialog" aria-labelledby="userViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-user"></i> ข้อมูลผู้ใช้งาน</h5>
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
        <i class="fas fa-circle"></i> เพิ่มผู้ใช้งาน</button>
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
        <col style="width:8%;">
        <col style="width:8%;">
        <col style="width:8%;">
        <col style="width:8%;">
        <col style="width:25%;">
        <col style="width:25%;">
        <col style="width:8%;">
        <col style="width:10%;">
      </colgroup>            
              <thead class="thead-light">                
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">ระดับผู้ใช้งาน</th>
                  <th scope="col">ไซต์งาน</th>
                  <th scope="col">แผนก</th>
                  <th scope="col">รหัสพนักงาน</th>
                  <th scope="col">ชื่อ-นามสกุล</th>
                  <th scope="col">อีเมล์</th>
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
var statusArr_js = <?PHP echo json_encode($statusArr); ?>;


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
function getplayerrow(user) {
  var userRow = "";
  if (user) {
    const userphoto = user.photo ? user.photo : "default.png";
    userRow = `<tr>
          <td class="align-middle pt-2 pb-2 pl-1">${numx}.</td>    
          <td class="align-middle pt-2 pb-2 pl-1">${user.class_user}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${user.location_short}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${user.dept_name}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${user.no_user}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${user.fullname}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${user.email}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${user.status_user}</td>
          <td class="align-middle pt-2 pb-2 pl-1">
          <a href="#" class="btn-sm btn-success mr-3 profile" data-toggle="modal" data-target="#userViewModal" title="Prfile" data-id="${user.id_user}">ดูข้อมูล</a>
          <a href="#" class="btn-sm btn-warning mr-3 edituser" data-toggle="modal" data-target="#userModal" title="Edit" data-id="${user.id_user}">แก้ไข</a>
          <a href="#" class="btn-sm btn-info mr-3 edituserxxxx" data-toggle="modal" data-target="#userModalxxxx" title="Edit" data-id="${user.id_user}">สิทธิ์ใช้งาน</a>
          <a href="#" class="btn-sm btn-danger deleteuser" data-userid="${user.id_user}" title="Delete" data-id="${user.id_user}">ลบ</a>
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
    url: "module/module_user/ajax_action.php",
    type: "GET",
    dataType: "json",    
    data: { page: pageno, action: "getDataList" },
    beforeSend: function () {
      $("#overlay").fadeIn();
    },
    success: function (rows){
      console.log(rows);
      if (rows.user) {
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

  /*โหลดรายการ เมื่อมีการเข้ามาที่หน้านี้*/
  func_getDatalist();


  // add/edit user
  $(document).on("submit", ".addform", function (event) {
    event.preventDefault();  
    var alertmsg =
      $("#userid").val().length > 0
        ? "อัพเดทข้อมูลผู้ใช้งานเรียบร้อยแล้ว"
        : "เพิ่มข้อมูลผู้ใช้งานเรียบร้อยแล้ว";
    $.ajax({
      url: "module/module_user/ajax_action.php",
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
        if (response) {
          $("body form#needs-validation")[0].reset();
          sweetAlert("สำเร็จ...", alertmsg, "success");
          $("#userModal").modal("hide"); $(".modal-backdrop").fadeOut();
          $("#overlay").fadeOut();
          func_getDatalist();
        }
      },
      error: function () {
        console.log("ไม่สำเร็จ! มีบางอย่างผิดพลาด!");
        sweetAlert("ไม่สำเร็จ!", 'มีบางอย่างผิดพลาด', "error");
        return false;
      },
    });
  });

  
  $(document).on('click',".btn-cancel", function() { //*****ยังไม่เสร็จ */
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

  //get user
  $(document).on("click", "a.edituser", function () {
    var id_user = $(this).data("id");

    $.ajax({
      url: "module/module_user/ajax_action.php",
      type: "GET",
      dataType: "json",
      data: { id_user: id_user, action: "getuser" },
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: function (player) {
        if (player) {
          $("#exampleModalLabel").html('แก้ไขข้อมูลผู้ใช้งาน');
          $("#username").val(player.pname);
          $("#email").val(player.email);
          $("#phone").val(player.phone);
          $("#userid").val(player.id_user);
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
        url: "module/module_user/ajax_action.php",
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
    var id_user = $(this).data("id");
    $.ajax({
      url: "module/module_user/ajax_action.php",
      type: "GET",
      dataType: "json",
      data: { id_user: id_user, action: "getuser" },
      success: function (user) {
        if (user) {
          const userphoto = user.photo ? user.photo : "default.png";
          const profile = `<div class="row">
                <div class="col-sm-2 col-md-2">
                  <img src="uploads/${userphoto}" class="rounded responsive" />
                </div>
                <div class="col-sm-2 col-md-8">
                  <h4 class="text-primary">${user.fullname}</h4>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-success d-inline-block">รหัสพนักงาน:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 bg-warning d-inline-block">${user.status_user}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-success d-inline-block">รหัสพนักงาน:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 bg-warning d-inline-block">${user.no_user}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-success d-inline-block">อีเมล์:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6  bg-warning d-inline-block">${user.email}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-success d-inline-block">ส่วนงาน:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 bg-warning d-inline-block">${user.ref_branch}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-success d-inline-block">แผนก:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 bg-warning d-inline-block">${user.ref_dept}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-success d-inline-block">เบอร์โทรศัพท์:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 bg-warning d-inline-block">${user.phone}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-success d-inline-block">ใช้งานล่าสุด:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 bg-warning d-inline-block">${user.lass_login}</span>
                </div>
                <div style="width:98%" class="mt-1 p-1 bg-info">
                  sfdsfds
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
        url: "module/module_user/ajax_action.php",
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