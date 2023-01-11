<style type="text/css">

.img-thumbnail {
    width:auto;
    height:30px;
}


#userstable{ width: 100%;}
#userstable th{ background-color:#DDD;}
#userstable th,
#userstable td {
  /*font-family: "Noto Sans Thai",sans-serif;*/
  font-style: normal;
  font-weight: 500;
  padding: 0.25rem; font-size:0.90rem;

}

#userstable td a.btn { font-size:0.80rem; }
</style>

<script src="plugins/sweetalert/sweetalert.min.js"></script>

<?PHP


$obj = new CRUD();

$numRow_player = $obj->getCount("SELECT count(id_user) AS total_row FROM tb_user");

?>    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><?PHP echo $title_act;?></h3>

          <!--<div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>-->
        </div>


        <div class="card-body">

      <?php
      include_once 'module/module_branch/frm_add-edit.inc.php'; //หน้า add/edit
      include_once 'module/module_branch/view.inc.php'; //หน้าดูรายละเอียดราย ID
      ?>
      
      <div class="row mb-3">
      <div class="col-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userModal,.modal-lg" id="addnewbtn" data-backdrop="static" data-keyboard="false"><i class="fa fa-user-circle-o"></i> เพิ่มข้อมูลพนักงาน</button>
      </div>
      <div class="col-9">
        <div class="input-group input-group-lg">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
          </div>
          <input type="text" class="form-control" aria-label="Sizing example input"
            aria-describedby="inputGroup-sizing-lg" placeholder="ค้นหา..." id="searchinput">

        </div>
      </div>
    </div>  

      <samp>
        <span>จำนวนผู้ใช้งานทั้งหมด: <span id="totalRows"></span> รายการ</span>
       <span>แสดงผลหน้าที่:</span>
       <span id="page-number-1">1</span>
        <span>จาก: <span id="totalpages"></span> หน้า</span>
     </samp>
    

    <div id="chk_json"></div>
    
            <!-- table -->
            <table class="table-sm table-bordered table-hover table-responsive-sm" id="userstable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">บริษัท, ชื่อส่วนงาน</th>
                  <th scope="col">แผนก</th>
                  <th scope="col">รหัสพนักงาน</th>
                  <th scope="col">อีเมล์</th>
                  <th scope="col">สถานะ</th>
                  <th scope="col">จัดการ</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <!-- table -->
        </div>
        <!-- /.card-body -->

        <hr /><div id="pagination-1"></div><hr />
        <nav id="pagination"></nav>

        <input type="hidden" name="currentpage" id="currentpage" value="1" />
        <input type="hidden" name="limit_perPage" id="limit_perPage" value="<?PHP echo $limit_perPage; ?>" />
        </div>


  <div id="overlay" style="display:none;">
    <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;"></div>
    <br />
    Loading...
  </div>

        <div class="card-footer">
          Footer
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
function getplayerrow(user) {
  var userRow = "";
  if (user) {
    const userphoto = user.photo ? user.photo : "default.png";
    userRow = `<tr>
          <td class="align-middle">${numx}.</td>    
          <td class="align-middle"><img src="uploads/${userphoto}" class="img-thumbnail rounded float-left img-fluid"></td>
          <td class="align-middle">${user.username}</td>
          <td class="align-middle">${user.email}</td>
          <td class="align-middle">${user.phone}</td>
          <td class="align-middle">${user.phone}</td>
          <td class="align-middle">
          <a href="#" class="btn-sm btn-success mr-3 profile" data-toggle="modal" data-target="#userViewModal" title="Prfile" data-id="${user.id_user}"><i class="fa fa-address-card"></i></a>
          <a href="#" class="btn-sm btn-warning mr-3 edituser" data-toggle="modal" data-target="#userModal" title="Edit" data-id="${user.id_user}"><i class="fa fa-edit"></i></a>
          <a href="#" class="btn-sm btn-info mr-3 edituser" data-toggle="modal" data-target="#userModal" title="Edit" data-id="${user.id_user}"><i class="fa fa-th-list fa-lg"></i></a>
          <a href="#" class="btn-sm btn-danger deleteuser" data-userid="14" title="Delete" data-id="${user.id_user}"><i class="fa fa-trash-alt"></i></a>
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
    url: "module/module_branch/ajax_action.php",
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
  $(document).on("submit", "#addform", function (event) {
    event.preventDefault();  
    var alertmsg =
      $("#userid").val().length > 0
        ? "อัพเดทข้อมูลผู้ใช้งานเรียบร้อยแล้ว"
        : "เพิ่มข้อมูลผู้ใช้งานเรียบร้อยแล้ว";
    $.ajax({
      url: "module/module_branch/ajax_action.php",
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
        if (response) {
          $("#userModal").modal("hide");
          $("#addform")[0].reset();
          //$(".message").html(alertmsg).fadeIn().delay(3000).fadeOut();
          //sweetAlert("สำเร็จ...", alertmsg, "success"); //The error will display
          func_getDatalist();
          $("#overlay").fadeOut();
        }
      },
      error: function () {
        console.log("Oops! Something went wrong!");
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
    //alert("xxxx");
    var $this = $(this);
    const pagenum = $this.data("page-number");
    //const pagenum = $this.data("page");//ของเก่าใช้ data นี้
    $("#currentpage").val(pagenum);
    //alert(pagenum);
    func_getDatalist();
    $this.parent().siblings().removeClass("active");
    $this.parent().addClass("active");
  });

  // form reset on new button
  $("#addnewbtn").on("click", function () {
    $("#addform")[0].reset();
    $("#userid").val("");
  });

  //get user
  $(document).on("click", "a.edituser", function () {
    var pid = $(this).data("id");

    $.ajax({
      url: "module/module_branch/ajax_action.php",
      type: "GET",
      dataType: "json",
      data: { id: pid, action: "getuser" },
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: function (player) {
        if (player) {
          $("#username").val(player.pname);
          $("#email").val(player.email);
          $("#phone").val(player.phone);
          $("#userid").val(player.id);
        }
        $("#overlay").fadeOut();
      },
      error: function () {
        console.log("something went wrong");
      },
    });
  });

  // delete user
  $(document).on("click", "a.deleteuser", function (e) {
    e.preventDefault();
    var pid = $(this).data("id");
    if (confirm("Are you sure want to delete this?")) {
      $.ajax({
        url: "module/module_branch/ajax_action.php",
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
    var pid = $(this).data("id");
    $.ajax({
      url: "module/module_branch/ajax_action.php",
      type: "GET",
      dataType: "json",
      data: { id: pid, action: "getuser" },
      success: function (player) {
        if (player) {
          const userphoto = player.photo ? player.photo : "default.png";
          const profile = `<div class="row">
                <div class="col-sm-6 col-md-4">
                  <img src="uploads/${userphoto}" class="rounded responsive" />
                </div>
                <div class="col-sm-6 col-md-8">
                  <h4 class="text-primary">${player.pname}</h4>
                  <p class="text-secondary">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i> ${player.email}
                    <br />
                    <i class="fa fa-phone" aria-hidden="true"></i> ${player.phone}
                  </p>
                </div>
              </div>`;
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
        url: "module/module_branch/ajax_action.php",
        type: "GET",
        dataType: "json",
        data: { searchQuery: searchText, action: "search" },
        success: function (players) {
          if (players) {
            var playerslist = "";
            $.each(players, function (index, player) {
              playerslist += getplayerrow(player);
            });
            $("#userstable tbody").html(playerslist);
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