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
</style>

<script src="plugins/sweetalert/sweetalert.js"></script>

<?PHP
$obj = new CRUD();
$numRow_player = $obj->getCount("SELECT count(id_offsupp) AS total_row FROM tb_office_supplies");


$fetchRow_Lot = $obj->fetchRows("SELECT tb_inven_balance.id_balance, tb_inven_balance.ref_id_rcv, tb_inven_rcv.ref_po_no, tb_inven_rcv.quantity,
 tb_inven_rcv.rcv_date, tb_inven_rcv.rcv_lot, tb_inven_balance.total_balance, tb_inven_rcv.unit_price FROM tb_inven_rcv 
LEFT JOIN tb_inven_balance ON(tb_inven_balance.ref_id_rcv=tb_inven_rcv.id_rcv)
WHERE tb_inven_rcv.ref_id_offsupp=15 AND tb_inven_balance.total_balance!=0 
ORDER BY rcv_date ASC, id_rcv DESC");

            
$table_lot='<table class="table table-bordered table-hover table-md text-nowrap table-fixed"><thead>
<th>ลำดับ</th>
<th>วันที่รับเข้า</th>
<th>เลขที่ PO</th>
<th>ลอต</th>
<th>จำนวนคงเหลือ</th>
<th>ราคาต่อหน่วย</th>
<th>จัดการ</th>
</thead>';
$y = 1; $d=0;
for($no=0;$no<count($fetchRow_Lot);$no++){ //$fetchRow_Lot[1]['rcv_date']; //Ex.
    $table_lot.='<tr>
    <td>'.$y.'</td>
    <td>'.$fetchRow_Lot[$d]['rcv_date'].'</td>
    <td>'.$fetchRow_Lot[$d]['ref_po_no'].'</td>
    <td>'.$fetchRow_Lot[$d]['rcv_lot'].'</td>
    <td><span class="span-quantity d-inline" data-id="'.$fetchRow_Lot[$d]['id_balance'].'">'.$fetchRow_Lot[$d]['quantity'].'</span></td>
    <td>'.number_format($fetchRow_Lot[$d]['unit_price'],2).'</td>
    <td><button type="button" class="btn btn-warning font-weight-bold m-0 btn-adj-balance" data-id="'.$fetchRow_Lot[$d]['id_balance'].'" >ปรับยอดคงเหลือ</button>
    <button type="button" class="btn btn-info font-weight-bold m-0 btn-adj-price">ปรับราคาต่อหน่วย</button></td>
    </tr>';
    $y++; $d++;
}
$table_lot.='</table>';
echo $table_lot;

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
      include_once 'module/module_warehouse/frm_add-edit.inc.php'; //หน้า add/edit
      //include_once 'module/module_warehouse/view.inc.php'; //หน้าดูรายละเอียดราย ID
      include_once 'module/module_warehouse/frm_rcv-cut.inc.php'; //หน้า add/edit
      ?>

      <!-- profile modal start -->
      <div class="modal fade" id="userViewModal" tabindex="-1" role="dialog" aria-labelledby="userViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-user"></i> วัสดุ-อุปกรณ์</h5>
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
        <i class="fas fa-circle"></i> เพิ่มวัสดุ-อุปกรณ์</button>
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
        <col style="width:5%;">
        <col style="width:5%;">
        <col style="width:8%;">
        <col style="width:40%;">
        <col style="width:15%;">
        <col style="width:8%;">
        <col style="width:8%;">
        <col style="width:10%;">
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
  //alert(row['offsupp_name']); return false;
  if (row) {
    const rowphoto = row.photo ? row.photo : "default.png";
     aaa='';
     bbb='';
    //alert(row.SubName);addCommas
    row.SubName==null ? aaa=" ": aaa=' &#187; '+row.SubName;
    //${row.total_balance} = addCommas(row.total_balance);
    DataRow = `<tr>
          <td class="align-middle pt-2 pb-2 pl-1">${numx}.</td>    
          <td class="align-middle pt-2 pb-2 pl-1"><img src="${row.photo_name}" class="w-40" /></td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.location_name}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.offsupp_code}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.offsupp_name}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.mainName} ${aaa}</td>
          <td class="align-middle pt-2 pb-2 pl-1 text-right">${addCommas(row.total_balance)}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.unit_name}</td>
          <td class="align-middle pt-2 pb-2 pl-1 ${row.statusColor}">${row.offsupp_status}</td>
          <td class="align-middle pt-2 pb-2 pl-1">
          <a href="#" class="btn-sm btn-success mr-1 profile" data-toggle="modal" data-target="#userViewModal" title="Prfile" data-id="${row.id_offsupp}">ดูข้อมูล</a>
          <a href="#" class="btn-sm btn-info mr-1 rcv_action" data-toggle="modal" data-target="#rcvModal" title="รับเข้า" data-id="${row.id_offsupp}">รับเข้า</a>
          <a href="#" class="btn-sm btn-secondary mr-1 adj_action" data-toggle="modal" data-target="#adjModal" title="ปรับยอด" data-id="${row.id_offsupp}">ปรับยอด</a>
          <a href="#" class="btn-sm btn-primary mr-1 rtn_action" data-toggle="modal" data-target="#userModalx" title="รับคืน" data-id="${row.id_offsupp}">รับคืน</a>
          <a href="#" class="btn-sm btn-warning mr-1 edit_action" data-toggle="modal" data-target="#userModalx" title="แก้ไข" data-id="${row.id_offsupp}">แก้ไข</a>
          <a href="#" class="btn-sm btn-danger deleteuser" data-userid="14" title="Delete" data-id="${row.id_offsupp}">ลบ</a>
          </td>
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
          if(row.offsupp_status==1){row.statusColor='text-success'}
          if(row.offsupp_status==2){row.statusColor='text-danger'}
          if(row.photo_name==null){
            row.photo_name='<?php echo $pathImgDefault; ?>';
          }else{
            row.photo_name='<?php echo $pathImg; ?>'+row.photo_name;
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
      url: "module/module_warehouse/ajax_action.php",
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


  function isValidDate(dateString) {
    var regEx = /^\d{4}-\d{2}-\d{2}$/;
    return dateString.match(regEx) != null;
  }


    //ADD Off
    $(document).on("submit", ".addform", function (event) {
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
        return false;
        //func_getDatalist();
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

  
  // get profile
  $(document).on("click", "a.profile", function () {
    var id_offsupps = $(this).data("id");
    $.ajax({
      url: "module/module_warehouse/ajax_action.php",
      type: "GET",
      dataType: "json",
      data: { id_offsupps: id_offsupps, action: "getoffsupp" },
      success: function (offsupps) {
        if (offsupps) {
          const offsuppsphoto = offsupps.photo ? offsupps.photo : "default.png";
          const profile = `<div class="row">
                <div class="col-sm-2 col-md-2">
                  <img src="uploads/${offsuppsphoto}" class="rounded responsive" />
                </div>
                <div class="col-sm-2 col-md-8">
                  <h4 class="text-primary">${offsupps.fullname}</h4>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-success d-inline-block">รหัสพนักงาน:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 bg-warning d-inline-block">${offsupps.status_offsupps}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-success d-inline-block">รหัสพนักงาน:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 bg-warning d-inline-block">${offsupps.no_offsupps}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-success d-inline-block">อีเมล์:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6  bg-warning d-inline-block">${offsupps.email}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-success d-inline-block">ส่วนงาน:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 bg-warning d-inline-block">${offsupps.ref_branch}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-success d-inline-block">แผนก:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 bg-warning d-inline-block">${offsupps.ref_dept}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-success d-inline-block">เบอร์โทรศัพท์:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 bg-warning d-inline-block">${offsupps.phone}</span>
                  <p class="font-weight-bold text-sm-right p-1 m-0 col-sm-3 bg-success d-inline-block">ใช้งานล่าสุด:</p>
                  <span class="text-md-start p-1 m-0 col-sm-6 bg-warning d-inline-block">${offsupps.lass_login}</span>
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
        url: "module/module_warehouse/ajax_action.php",
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