
  <!-- Ekko Lightbox -->
  <script src="plugins/ekko-lightbox/ekko-lightbox.js"></script>  

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

.pagination-input{ display:none;}




.ui-w-40 {
    width:80px !important;
    height: auto;
}
.mr-4, .mx-4 {
    margin-right: 1.5rem!important;
}

</style>

<?PHP
$obj = new CRUD();
$numRow_player = $obj->getCount("SELECT count(id_offsupp) AS total_row FROM tb_office_supplies");
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
              <li class="breadcrumb-item active">เบิกวัสดุอุปกรณ์</li>
            </ol>
          </div>
        </div>


        <div class="card-body">

        <div class="row">  
          

          <div class="card-body pt-0 mt-0">  
            <form id="needs-validation" class="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate>

            <div class="row rounded-lg bg-warning bg-gradient">

            <div class="offset-md-0 col-md-12 offset-md-0 pt-2 pb-2"><!--00--><h4 class="card-title font-weight-bold">ค้นหาวัสดุอุปกรณ์ที่ต้องการ</h4></div><!--00-->  

                                <div class="col-sm-2 col-md-2 col-xs-2" id="mainMenu">
                                    <div class="form-group">  
                                        <label for="ref_dept">หมวดหลัก</label>  
                                        <select class="custom-select ref_id_menu" name="ref_id_menu" id="ref_id_menu">  
                                            <?PHP
                                                //id_menu name_menu
                                                $rowData = $obj->fetchRows("SELECT id_menu, name_menu FROM tb_category WHERE level_menu=1 ORDER BY id_menu ASC");
                                                if (count($rowData)!=0) {
                                                    echo '<option value="0" selected>เลือกหมวดหลัก</option>';
                                                    foreach($rowData as $key => $value) {
                                                        echo '<option value="'.($key+1).'">'.$rowData[$key]['name_menu'].'</option>';
                                                    }
                                                } else {
                                                    echo '<option value="0" selected>เลือกหมวดหลัก</option>  ';
                                                }
                                            ?>
                                        </select>  
                                        <div class="invalid-feedback">เลือกหมวดย่อย</div>  
                                    </div>  
                                </div>

                                <div class="col-sm-2 col-md-2 col-xs-2" id="mainMenu">
                                    <div class="form-group">  
                                        <label for="ref_dept">หมวดย่อย</label>  
                                        <select class="custom-select ref_id_menu" name="ref_id_menu" id="ref_id_menu">  
                                            <?PHP
                                                //id_menu name_menu
                                                $rowData = $obj->fetchRows("SELECT id_menu, name_menu FROM tb_category WHERE level_menu=1 ORDER BY id_menu ASC");
                                                if (count($rowData)!=0) {
                                                    echo '<option value="0" selected>เลือกหมวดหลักก่อน</option>';
                                                    foreach($rowData as $key => $value) {
                                                        echo '<option value="'.($key+1).'">'.$rowData[$key]['name_menu'].'</option>';
                                                    }
                                                } else {
                                                    echo '<option value="0" selected>เลือกหมวดหลัก</option>  ';
                                                }
                                            ?>
                                        </select>  
                                    </div>  
                                </div>  

                                <div class="col-sm-2 col-md-2 col-xs-2">  
                                    <div class="form-group">  
                                        <label for="firstname">คำค้นหา</label>  
                                        <input type="text" id="name_menu" name="name_menu" placeholder="กรอกคำค้นหาที่ต้องการ" class="form-control" aria-describedby="inputGroupPrepend" />
                                    </div>  
                                </div>  
            </form>
          </div>

          

      <!-- table -->
      <div class="table-responsive mt-2"><!-- col-sm-10 m-auto-->
      <table class="table table-bordered table-hover table-md text-nowrap table-fixed" id="userstable">
      <colgroup>
        <col style="width:5%;">
        <col style="width:3%;">
        <col style="width:8%;">
        <col style="width:40%;">
        <col style="width:10%;">
        <col style="width:10%;">
        <col style="width:15%;">
      </colgroup>            
              <thead class="thead-light">                
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">รูป</th>
                  <th scope="col">รหัสวัสดุอุปกรณ์</th>
                  <th scope="col">ชื่อวัสดุอุปกรณ์</th>
                  <th scope="col">หมวดวัสดุอุปกรณ์</th>
                  <th scope="col" class="text-right">คงเหลือในระบบ</th>
                  <th scope="col">เบิก</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            </div>
            <!-- table -->

            
            <hr style="width:98%; margin:auto;" />
        <div id="pagination-1" class="d-block" style="overflow:auto; width:98%; margin:auto; margin-top:15px;" ></div>
        <hr style="width:98%; margin:auto;" />

        <input type="hidden" name="currentpage" id="currentpage" value="1" />
        <input type="hidden" name="limit_perPage" id="limit_perPage" value="<?PHP echo $limit_perPage; ?>" />            
            
          </div>


          
        </div><!--row-->



<!-- CSS table สรุปรายการเบิก -->
<div class="card">
        <div class="card-header bg-light">
            <h4 class="card-title font-weight-bold">สรุปรายการเบิก</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered m-0">
                <thead class="bg-success">
                  <tr>
                    <!-- Set columns width -->
                    <th class="text-center py-3 px-4" style="min-width: 400px;">รายการวัสดุอุปกรณ์ที่เบิก &amp; รายละเอียด</th>
                    <th class="text-center py-3 px-4" style="width: 120px;">จำนวน</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">รวม</th>
                    <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="fas fa-trash-alt"></i></a></th>
                  </tr>
                </thead>
                <tbody>
        
                  <tr>
                    <td class="p-1">
                      <div class="media align-items-center">
                        <img src="http://localhost/central-store/uploads/276669_qtm_rtb_gel_pen_qg580_0.5_gunmetal_001_1.jpg" class="d-block ui-w-40 ui-bordered mr-4 border p-1" alt="">
                        <div class="media-body">
                          <a href="#" class="d-block text-dark">ปากกาลูกลื่นสีแดง (แบบหมุน)	</a>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle p-4"><input type="text" class="form-control text-center" value="2"></td>
                    <td class="text-right font-weight-semibold align-middle p-4">2 แท่ง</td>
                    <td class="text-center align-middle px-0"><a href="#" class="shop-tooltip close float-none text-danger" title="" data-original-title="Remove">×</a></td>
                  </tr>
        
                  <tr>
                    <td class="p-1">
                      <div class="media align-items-center">
                        <img src="http://localhost/central-store/uploads/276669_qtm_rtb_gel_pen_qg580_0.5_gunmetal_001_1.jpg" class="d-block ui-w-40 ui-bordered mr-4 border p-1" alt="">
                        <div class="media-body">
                          <a href="#" class="d-block text-dark">ปากกาลูกลื่นสีน้ำเงิน (แบบหมุน)	</a>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle p-4"><input type="text" class="form-control text-center" value="1"></td>
                    <td class="text-right font-weight-semibold align-middle p-4">1 แท่ง</td>
                    <td class="text-center align-middle px-0"><a href="#" class="shop-tooltip close float-none text-danger" title="" data-original-title="Remove">×</a></td>
                  </tr>
        
                  <tr>
                    <td class="p-1">
                      <div class="media align-items-center">
                        <img src="http://localhost/central-store/uploads/276669_qtm_rtb_gel_pen_qg580_0.5_gunmetal_001_1.jpg" class="d-block ui-w-40 ui-bordered mr-4 border p-1" alt="">
                        <div class="media-body">
                          <a href="#" class="d-block text-dark">ปากกาลูกลื่นสีดำ (แบบหมุน)	</a>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle p-4"><input type="text" class="form-control text-center auto" value="1"></td>
                    <td class="text-right font-weight-semibold align-middle p-4">1 แท่ง</td>
                    <td class="text-center align-middle px-0"><a href="#" class="shop-tooltip close float-none text-danger" title="" data-original-title="Remove">×</a></td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <td colspan="2" class="text-right">รวมรายการเบิก:</td>
                    <td class="text-right">3 รายการ</td>
                    <td></td>
                  </tr>                                                    

                </tbody>
              </table>
            </div>
            <!-- / จบ CSS table สรุปรายการเบิก -->

            <!-- / CSS table สรุปรายการเบิก 2 -->
            <div class="float-right">
              <button type="button" class="btn btn-lg btn-default md-btn-flat mt-2 mr-3">อัพเดทรายการเบิก</button>
              <button type="button" class="btn btn-lg bg-warning mt-2">บันทึก</button>
            </div>
        
          </div>
      </div>
      <!-- / จบ CSS table สรุปรายการเบิก 2 -->        


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

  
  $('.auto').autoNumeric({aSep: ','});

  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })


});
</script>



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
     aaa='';
     bbb='';
     rowphoto = "";
     row.photo_name==null ? rowphoto="<?PHP echo $pathImg;?>default.png" : rowphoto="<?PHP echo $pathImg;?>"+row.photo_name;
    //alert(row.SubName);
    row.SubName==null ? aaa=" ": aaa=' &#187; '+row.SubName;
    DataRow = `<tr>
          <td class="align-middle pt-2 pb-2 pl-1">${numx}.</td>    
          <td class="align-middle pt-2 pb-2 pl-1"><a href="${rowphoto}" data-toggle="lightbox" data-title="${row.offsupp_code}<br />${row.offsupp_name}"><img width="40" src="${rowphoto}" class="img-fluid mb-0" alt="black sample" /></a></td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.offsupp_code}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.offsupp_name}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.mainName} ${aaa}</td>
          <td class="align-middle pt-2 pb-2 pl-1 text-right">${row.total_balance} ${row.unit_name}</td>
          <td class="align-middle pt-2 pb-2 pl-1">
          <input type="text" class="auto form-control input-sm d-inline col-sm-3 product-quantity" id="qty-${row.id_offsupp}" name="quantity" onKeyPress="return IsNumeric(event);" autocomplete="off" novalidate value="" size="2" />
			    <button type="button" class="btn col-sm-3 btn-line bg-success btn-sm btnAddAction" data-itemid="${row.id_offsupp}" id="product-${row.id_offsupp}" data-action="action" data-code="${row.offsupp_code}" data-proname="${row.offsupp_name}"> เบิก</button>
          </td>
        </tr>`;
  }
  return DataRow;
}


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
          //row.status_chk = statusArr_js[row.status_location];          
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
      console.log("ระบบมีข้อผิดพลาด");
    },
  });
}


$(document).ready(function () {

  /*โหลดรายการ เมื่อมีการเข้ามาที่หน้านี้*/
  func_getDatalist();



 $(document).on('click', 'button.btnAddAction', function(){
    var item_id = $(this).data('itemid');
    var qty = $('#qty-'+item_id).val();
    qty = parseFloat(qty.replace(/,/g, ''));   
    var code = $(this).data('code');
    var product_name = $(this).data('proname');

    if(isNaN(qty)) {
      sweetAlert("ผิดพลาด !", "กรอกจำนวนที่่ต้องการ", "warning"); //The error will display
      return false;
    }    
    
    alert(item_id+"-----"+qty+"-----"+code+"-----"+product_name); return false;


    $.ajax({
        type:'POST',
        url:'add.php',
        data:{product_id:item_id, quantity:qty, item_code:code},
        dataType:'json',    
        beforeSend: function () {
            //$('button#product-'+item_id).button('loading');
        },
        complete: function () {
            //$('button#product-'+item_id).button('reset');
        },                
        success: function (json) {
            $('#cart-count').html(json.count);
            $("#add-item-bag").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> You have added <strong>'+product_name+'</strong> to your shopping cart!</div>');
          },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
	});  

    $(document).on('change','select[id=txt_ref_id_unit]',function(){
    var txt_ref_id_unit = $("#txt_ref_id_unit option:selected" ).text();    
    $(".txt_moq").html('/'+txt_ref_id_unit);    $(".txt_min_stock").html('/'+txt_ref_id_unit);
    });

  $(document).on('change','select[id=txt_ref_id_menu]',function(){
    var txt_ref_id_menu = $("#txt_ref_id_menu option:selected" ).val();
    $('#txt_ref_id_menu_sub').html( '<option value="" disabled="" selected="">เลือกหมวดหลักก่อน</option>' );
    $.ajax({
      url: "module/module_requisition/ajax_action.php",
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

  // add/edit user
  $(document).on("submit", ".addform", function (event) {
    event.preventDefault();          
    var alertmsg =
      $("#userid").val().length > 0
        ? "อัพเดทข้อมูลเรียบร้อยแล้ว"
        : "เพิ่มข้อมูลเรียบร้อยแล้ว";
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
        if (response) {
          sweetAlert("สำเร็จ...", alertmsg, "success"); //The error will display
          $("#userModal").modal("hide"); $(".modal-backdrop").fadeOut();
          $(".addform")[0].reset();
          func_getDatalist();
          $("#overlay").fadeOut();
        }
      },
      error: function () {
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

  //get user
  $(document).on("click", "a.edituser", function () {
    var id_user = $(this).data("id");

    $.ajax({
      url: "module/module_requisition/ajax_action.php",
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
        url: "module/module_requisition/ajax_action.php",
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
      url: "module/module_requisition/ajax_action.php",
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
        url: "module/module_requisition/ajax_action.php",
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