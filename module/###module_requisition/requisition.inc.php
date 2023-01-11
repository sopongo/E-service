
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
    width:50px !important;
    height: auto;
}
.mr-4, .mx-4 {
    margin-right: 1.5rem!important;
}

.btn-increment, .btn-decrement{ 
  padding:0px 4px 0px 4px; margin:0px;
}

.bg-green-2{ background-color:#DCF8C6;}

</style>

<?PHP
$obj = new CRUD();
$numRow_player = $obj->getCount("SELECT count(id_offsupp_location) AS total_row FROM tb_offsupp_location $class_query");
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

        <div class="table-responsive rounded-lg bg-light p-2"><!--000-->
          <form id="needs-validation" class="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate>
            <div class="offset-md-12 col-md-12 col-sm-12 pt-2 pb-2">
              <div class="form-group">  
                <h4 class="card-title font-weight-bold mb-2"><i class="fas fa-search"></i> ค้นหาวัสดุอุปกรณ์</h4>
              </div>
            </div>

            <div class="card-body">
            <div class="row">

            <div class="col-md-5">
                <div class="form-group"><!-- .form-group -->
                  <label>คำค้นหา:</label>
                  <input class="form-control" type="text" name="searchinput" id="searchinput" placeholder="พิมพ์คำค้นหาที่ต้องการ">
                </div><!-- /.form-group -->
              </div><!-- /.col -->


            <div class="col-md-5">
                <div class="form-group"><!-- .form-group -->
                  <label>ไซต์งาน</label>
                  <select class="slt_location form-control" style="width:100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="slt_location">
                    <option data-id="0" disabled selected>เลือกไซต์งาน</option>
                    <?PHP
                      $_SESSION['sess_class_user']!=4 ? $conditon_query = 'WHERE id_location='.$_SESSION['sess_id_location'].' AND' : $conditon_query = 'WHERE ';
                      $fetchRow = $obj->fetchRows("SELECT tb_location.* FROM tb_location $conditon_query status_location=1 ORDER BY id_location DESC");
                      if (!empty($fetchRow)) {
                        foreach($fetchRow as $key=>$value){
                          echo '<option '.($fetchRow[$key]['id_location']==$_SESSION['sess_id_location'] ? 'selected="selected"' : '').' data-select2-id="'.$fetchRow[$key]['id_location'].'" value="'.$fetchRow[$key]['id_location'].'">'.$fetchRow[$key]['location_short'].'-'.$fetchRow[$key]['location_name'].'</option>';
                        }
                      }                      
                    ?>
                  </select>                                    
                </div>
                <!-- /.form-group -->
              </div><!-- /.col -->
              
              <div class="col-md-5">
                <div class="form-group"><!-- .form-group -->
                  <label>หมวดหลัก</label>
                  <select class="ref_id_menu form-control select2 select2-hidden-accessible" style="width:100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" id="ref_id_menu" name="ref_id_menu">
                    <?PHP
                      $rowData = $obj->fetchRows("SELECT id_menu, menu_code, name_menu FROM tb_category WHERE level_menu=1 ORDER BY id_menu ASC");
                        if (count($rowData)!=0) {
                          echo '<option value="0" disabled selected>เลือกหมวดหลัก</option>';
                          echo '<option value="0">ทุกหมวด</option>  ';                          
                          foreach($rowData as $key => $value) {
                            echo '<option value="'.($rowData[$key]['id_menu']).'">'.$rowData[$key]['menu_code'].' - '.$rowData[$key]['name_menu'].'</option>';
                          }
                        } else {
                          echo '<option value="">เลือกหมวดหลัก</option>  ';
                        }
                    ?>
                  </select>                                    
                </div>
                <!-- /.form-group -->
              </div><!-- /.col -->

              <div class="col-md-5">
                <div class="form-group"><!-- .form-group -->
                  <label>หมวดย่อย</label>
                  <select id="ref_id_menu_sub" class="ref_id_menu_sub form-control select2 select2-hidden-accessible" style="width:100%;" data-id="1" tabindex="-1" aria-hidden="true">
                    <option selected="selected" data-select2-id="3">เลือกหมวดหลักก่อน</option>
                  </select>                                    
                </div>
                <!-- /.form-group -->
              </div><!-- /.col -->              

              <div class="col-md-5">
                <div class="form-group"><!-- .form-group -->
                  <a class="btn btn-success btn-search">ค้นหา</a>
                </div>
                <!-- /.form-group -->
              </div><!-- /.col -->                            


              </div><!-- /.card-body -->
            </div><!-- /.card-body -->

          
          </form>
        </div><!--000-->
          


<?php
//echo '\\$_SESSION["cart_item"]======'.searchArray($_SESSION["cart_item"],'ref_id_offsupp','76');
//echo "<br />";
//echo $search_path = searchForId('76',$_SESSION["cart_item"], array(''));
//print($search_path);
/*if(searchArray($_SESSION["cart_item"],'id_offsupp_location', "1")==1){
  echo "xxxxxxxxxxxxxxxxx";
}*/
?>


      <!-- table -->     
      <div class="table-responsive mt-2"><!-- col-sm-10 m-auto-->
      <table class="table table-bordered table-hover text-nowrap table-fixed" id="userstable">
      <colgroup>
        <col style="width:5%;">
        <col style="width:5%;">
        <col style="width:3%;">
        <col style="width:8%;">
        <col style="width:50%;">
        <col style="width:10%;">
        <col style="width:10%;">
        <col style="width:10%;">
      </colgroup>            
              <thead class="thead-light">                
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">ไซต์งาน</th>
                  <th scope="col">รูป</th>
                  <th scope="col">รหัสวัสดุอุปกรณ์</th>
                  <th scope="col">ชื่อวัสดุอุปกรณ์</th>
                  <th scope="col">หมวดวัสดุอุปกรณ์</th>
                  <th scope="col" class="text-right">จองแล้ว/รอจ่าย</th>
                  <th scope="col" class="text-right">คงเหลือในระบบ</th>
                  <th scope="col">เบิก&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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

<?PHP 

/*
echo '<pre>';
print_r($_SESSION["cart_item"]); 
echo '</pre>';
echo '<hr />';
*/
?>


<!-- CSS table สรุปรายการเบิก -->
<div class="card">
        <div class="card-header bg-light">
            <h4 class="card-title font-weight-bold">สรุปรายการเบิก</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover m-0" id="table-req">
                <thead class="bg-success">
                  <tr>
                    <!-- Set columns width -->
                    <th class="text-center py-3 px-4" style="width: 50px;">ลำดับ</th>                    
                    <th class="text-center py-3 px-4" style="min-width: 400px;">รายการวัสดุอุปกรณ์ที่เบิก &amp; รายละเอียด</th>
                    <th class="text-center py-3 px-4" style="width: 200px;">จำนวนที่เบิก</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">รวม</th>
                    <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="fas fa-trash-alt"></i></a></th>
                  </tr>
                </thead>
                <tbody id="total_req">         
<?PHP 
              $No = 0;        
              if(isset($_SESSION["cart_item"]) && count($_SESSION["cart_item"])>0){
                $No = 0;
                foreach ($_SESSION["cart_item"] as $item){
                  $No++;
                  echo '<tr class="tr_'.$item['itemCode'].'">
                  <td class="text-center td-no">'.$No.'.</td>
                  <td class="p-1">
                    <div class="media align-items-center">
                      <img src="'.$item['image'].'" class="d-block ui-w-40 ui-bordered mr-4 border p-1" alt="">
                      <div class="media-body font-1r">
                        <a href="#" class="d-block text-dark">'.$item['name'].'</a>
                        <small>
                        <span class="text-muted">รหัสวัสดุอุปกรณ์:</span> &nbsp;'.$item['itemCode'].'
                        <span class="text-muted">หมวด: </span> &nbsp; '.$item['cate'].'
                      </small>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle p-1">
                    <div class="btn btn-default btn-decrement d-inline-block"><i class="fas fa-minus-circle"></i></div>
                    <input class="form-control text-center input-quantity col-sm-5 d-inline-block" id="input-qty-'.$item['id_offsupp_location'].'" readonly value="'.number_format($item['quantity'],0).'">
                    <div class="btn btn-default btn-increment d-inline-block"><i class="fas fa-plus-circle"></i></div>
                  </td>
                  <td class="text-right font-weight-semibold align-middle p-1"><span class="input-qty-'.$item['id_offsupp_location'].'">'.number_format($item["quantity"],0).'</span> '.$item['unit'].'</td>
                  <td class="text-center align-middle px-0"><a href="#" class="shop-tooltip close float-none text-danger" title="" data-itemcode="'.$item['itemCode'].'" data-original-title="Remove">×</a></td>
                  </tr>';
                }
              }else{
                echo '<tr class="tr-notfound"><td colspan="5" class="text-center">ยังไม่มีรายการเบิก</td></tr>';
              }
?>
                </tbody>
                <tbody>
                  <tr>
                    <td colspan="3" class="text-right">รวมรายการเบิก:</td>
                    <td class="text-right"><span class="td_total-eq"><?PHP echo number_format($No);?></span> รายการ</td>
                    <td></td>
                  </tr>                                                    

                </tbody>
              </table>
            </div>
            <!-- / จบ CSS table สรุปรายการเบิก -->

            <!-- / CSS table สรุปรายการเบิก 2 -->
            <div class="float-left">
              <button type="button" class="btn bg-danger mt-2 claer-req"><i class="fas fa-trash-alt"></i> ล้างรายการเบิกทั้งหมด</button>
            </div>
            <div class="float-right">
              <button type="button" class="btn btn-warning float-right mt-2" id="btn-checkout"><i class="fas fa-angle-double-right"></i> <strong>คลิก..ขั้นตอนต่อไป</strong></button>
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


  $(document).on("click", ".btn-search", function () {
    var searchinput = $('#searchinput').val();

      alert(searchinput);
      $.ajax({
        url: "module/module_requisition/ajax_action.php",
        type: "GET",
        dataType: "json",
        data: { searchinput: searchinput, action: "search" },
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
        error: function (result) {
          console.log("something went wrong"+result);
        },
      });
  });  

  $(document).on('change','select[id=ref_id_menu]',function(){
    var ref_id_menu = $("#ref_id_menu option:selected" ).val();
    //alert(ref_id_menu);
    //$('#ref_id_menu_sub').html( '<option value="" disabled="" selected="">เลือกหมวดหลักก่อน</option>' );
    func_getDatalist();
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

  
  $(document).on("click", "#btn-checkout", function () {
    var rowCount = $('#table-req tbody tr[class^=tr_]').length;
    //alert(rowCount); return false;
    if(rowCount<=0){
      sweetAlert("ผิดพลาด!", "ยังไม่มีรายการเบิก", "error");
      return false;
    }    
    $(location).attr('href','?module=checkout');
  });

  $(document).on("click", ".btn-decrement", function () {   
    var chk_val = $(this).closest("tr").find('input[id^=input-qty]').val().replace(/,/g, '');
    var itemcode = $(this).closest("tr").find('input[id^=input-qty]').attr("id");    
    var getID = itemcode.replace("input-qty-", "");
    var itemcode = itemcode.replace("input-qty-", "product-");
    var itemcode = $('#'+itemcode).data('code');
    var maxreq = $('#product-'+getID).data('maxreq');
    var unit = $('#product-'+getID).data('unit');

    if(parseInt(chk_val)>parseInt(maxreq)){
      sweetAlert("ผิดพลาด !", "จำกัดการเบิกไม่เกิน: "+maxreq+" "+unit, "warning"); //The error will display      
      $('#qty-'+item_id).val("");
      return false;
    }    
    if(chk_val<2){
      sweetAlert("ผิดพลาด!", "จำนวนเบิกต่ำสุดแล้ว", "error");
    }else{
      $.ajax({
        url: "module/module_requisition/cart_action.php",
        type: "POST",
        dataType: "json",
        data:{itemcode:itemcode, action:"decrement-item"},
        beforeSend: function () {
        },success: function (json) {
          if(json==1){
            console.log(json);
            $('input[id=input-qty-'+getID+']').val(addCommas(parseInt(chk_val)-1));
            $('span[class=input-qty-'+getID+']').html(addCommas(parseInt(chk_val)-1));
          }else{
            console.log(json);
            sweetAlert("ผิดพลาด!", "ไม่สามารถทำรายการได้", "error");
          }
        },error: function (json) {
          console.log(json);
          sweetAlert("ผิดพลาด!", "ไม่สามารถทำรายการได้", "error");
        }
      });
    }
  });
  
  $(document).on("click", ".btn-increment", function (event) {
    var chk_id = $(this).closest("tr").find('input[id^=input-qty]').attr("id");    
    var itemcode = $(this).closest("tr").find('input[id^=input-qty]').attr("id");    
    var getID = itemcode.replace("input-qty-", "");
    var itemcode = itemcode.replace("input-qty-", "product-");
    var itemcode = $('#'+itemcode).data('code');

    var chk_id = chk_id.replace("input-qty-", "balance-");
    var chk_val = $(this).closest("tr").find('input[id^=input-qty]').val();
        chk_val = chk_val.replace(/,/g, '');

    var chk_compare = $('.'+chk_id).html();
        chk_compare = chk_compare.replace(/,/g, '');
    var chk_val = parseInt(chk_val);

    var maxreq = $('#product-'+getID).data('maxreq');
    var unit = $('#product-'+getID).data('unit');
    //alert(maxreq); return false;
    //alert(getID+'-----'+chk_val);
    //alert(chk_compare+'-----'+chk_val);
    //alert(getID); return false;
    if(parseInt(chk_val)>=parseInt(maxreq)){
      sweetAlert("ผิดพลาด !", "จำกัดการเบิกไม่เกิน: "+maxreq+" "+unit, "warning"); //The error will display      
      $('#qty-'+item_id).val("");
      return false;
    }
    if(parseInt(chk_val)>=parseInt(chk_compare)){
      sweetAlert("ผิดพลาด!", "จำนวนคงเหลือไม่พอให้เบิก", "error");  
      return false;
    }else{
      $.ajax({
        url: "module/module_requisition/cart_action.php",
        type: "POST",
        dataType: "json",
        data:{itemcode:itemcode, action:"increment-item"},
        beforeSend: function () {
        },success: function (json) {
          if(json==1){
            console.log(json);
            $('input[id=input-qty-'+getID+']').val(addCommas(parseInt(chk_val)+1));
            $('span[class=input-qty-'+getID+']').html(addCommas(parseInt(chk_val)+1));
          }else{
            console.log(json);
            sweetAlert("ผิดพลาด!", "ไม่สามารถทำรายการได้", "error");
          }
        },error: function (json) {
          console.log(json);
          sweetAlert("ผิดพลาด!", "ไม่สามารถทำรายการได้", "error");
        }
      });
    }

  });  


  $(document).on("click", ".shop-tooltip", function (event) {
    var itemcode = $(this).data('itemcode');
    sweetAlert({
    title: "ยืนยันการลบรายการนี้ ?",
    text: "ต้องการลบรายการนี้หรือไม่!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "ตกลง, ลบข้อมูล!",
    cancelButtonText: "ไม่, ยกเลิก!",
    closeOnConfirm: true,
    closeOnCancel: true
  },
    function (isConfirm) {
      if (isConfirm) {
        //alert(id_row); return false;
        $.ajax({
          url: "module/module_requisition/cart_action.php",
          type: "POST",
          dataType: "json",
          data:{itemcode:itemcode, action:"clear-item"},
          beforeSend: function () {
            $("#overlay").fadeIn();
            //$('button#product-'+item_id).button('loading');
          },success: function (json) {
            //console.log(json); return false;
            if(json==itemcode){
              $('#table-req tbody .tr_'+itemcode).remove();
              //alert($(this).data('itemcode'));
              //alert(json);
              console.log(json);
              $('#table-req tbody tr_'+json).remove();
              $("#overlay").fadeOut();
              var rowCount = $('#table-req tbody tr[class^=tr_]').length;
              var total_req = 0;
              if(rowCount>0){
                $('#table-req tbody#total_req tr[class^=tr_]').each(function(index) {
                  total_req = index+1;
                  $(this).closest("tr").find('td.td-no').html(total_req+'.');
                });
              }else{
                $('#table-req tbody#total_req').html('<tr class="tr-notfound"><td colspan="5" class="text-center">ยังไม่มีรายการเบิก</td></tr>');
              }
              $(".td_total-eq").html(total_req);
              //$('#table-req tbody#total_req').remove();
            }else{
              console.log(json);
              sweetAlert("ผิดพลาด!", "ไม่สามารถลบข้อมูลได้", "error");
            }
          },error: function (data) {
            console.log(json);
            sweetAlert("ผิดพลาด!", "ไม่สามารถลบข้อมูลได้", "error");
          }
        });
      } else {
        sweetAlert.close();
      }
    });
  event.preventDefault();
  return false;
  });  

  

  $(document).on("click", "button.claer-req", function () {
    sweetAlert({
    title: "ยืนยันการลบข้อมูล ?",
    text: "ต้องการลบข้อมูลนี้หรือไม่!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "ตกลง, ลบข้อมูล!",
    cancelButtonText: "ไม่, ยกเลิก!",
    closeOnConfirm: true,
    closeOnCancel: true
  },
    function (isConfirm) {
      if (isConfirm) {
        //alert(id_row); return false;
        $.ajax({
          url: "module/module_requisition/cart_action.php",
          type: "GET",
          dataType: "json",
          data:{action:"clear-cart"},
          beforeSend: function () {
            $("#overlay").fadeIn();
            //$('button#product-'+item_id).button('loading');
          },success: function (json) {
            if(json==1){
              console.log(json);
            $("#overlay").fadeOut();
            $("#total_req").html('<tr><td colspan="5" class="tr-notfound text-center">ยังไม่มีรายการเบิก</td></tr>');
            $(".td_total-eq").html('0');
            }else{
              console.log(json);
              sweetAlert("ผิดพลาด!", "ไม่สามารถลบข้อมูลได้", "error");
            }
          },error: function (data) {
            console.log(json);
            sweetAlert("ผิดพลาด!", "ไม่สามารถลบข้อมูลได้", "error");
          }
        });
      } else {
        sweetAlert.close();
      }
    });
  return false;
  });  



 $(document).on('click', 'button.btnAddAction', function(){
    var item_id = $(this).data('itemid');
    var balance = $(this).data('balance');

    var unit = $(this).data('unit');    
    var maxreq = $(this).data('maxreq');
    //maxreq = maxreq.replace(/,/g, '');
    //alert(maxreq); return false;

    var qty = $('#qty-'+item_id).val().replace(/,/g, '');
    var total_eq = parseInt($(".td_total-eq").html().replace(/,/g, '')); 
    
    var bf_qty = parseInt($('#input-qty-'+item_id).val());  
       
    isNaN(bf_qty) ? bf_qty=0 : bf_qty=bf_qty;
    var balance_qty = parseInt($('.balance-'+item_id).html().replace(/,/g, ''));    

    qty = parseFloat(qty);   
    var code = $(this).data('code');
    var product_name = $(this).data('proname');

    //alert(parseFloat(bf_qty+qty)+'----------'+balance_qty); return false;
    if(parseFloat(bf_qty+qty)>parseFloat(balance_qty)){
      sweetAlert("ผิดพลาด !", "จำนวนคงเหลือไม่พอให้เบิก", "warning"); //The error will display      
      $('#qty-'+item_id).val("");
      return false;
    }

    if(parseFloat(bf_qty+qty)>parseFloat(maxreq)){
      sweetAlert("ผิดพลาด !", "จำกัดการเบิกไม่เกิน: "+maxreq+" "+unit, "warning"); //The error will display      
      $('#qty-'+item_id).val("");
      return false;
    }    

    if(qty<=0 || isNaN(qty)) {
      sweetAlert("ผิดพลาด !", "กรอกจำนวนที่่ต้องการ", "warning"); //The error will display
      $('#qty-'+item_id).val("");
      return false;
    }
    if(qty>balance){
      sweetAlert("ผิดพลาด !", "จำนวนที่เบิกมากกว่าจำนวนคงเหลือ", "warning"); //The error will display
      $('#qty-'+item_id).val("");
      return false;
    }
    
    //alert(item_id+"-----"+qty+"-----"+code+"-----"+product_name); return false;
    $.ajax({
        type:'POST',
        url:'module/module_requisition/cart_action.php',
        data:{item_id:item_id, quantity:qty, item_code:code, action:"additem"},
        dataType:'json',    
        beforeSend: function () {
            //$("#overlay").fadeIn();
            //$('button#product-'+item_id).button('loading');
        },
        complete: function () {
            //$('button#product-'+item_id).button('reset');
        },                
        success: function (json) {
            console.log(json);
            if(json.chk_sesItem==""){
              //alert('ddddddddd'); return false;
              sweetAlert("ผิดพลาด !", "ไม่สามารถทำรายการได้", "warning"); return false; //The error will display
            }
            var trRowCount = $('#total_req >tr').length; //เช็คแถวของ tbody
            if(trRowCount==1){
              $('.tr-notfound').remove();
            }
            //alert(trRowCount);
            //alert(json.chk_sesItem); //chk_sesItem   htmlappend
            //alert(json.htmlappend); //chk_sesItem   htmlappend
            $('#qty-'+item_id).val("");
            if(json.chk_sesItem==1){
              //alert(item_id+'------chk_sesItem=1 ----มีแล้วใน session');
              $('#input-qty-'+item_id).val(addCommas(qty+bf_qty));
              $('.input-qty-'+item_id).html(addCommas(qty+bf_qty));

            }else if(json.chk_sesItem==2){
              //alert('222222-------ของใหม่');
              $("#total_req").append(json.htmlappend);
              $(".td_total-eq").html(addCommas(total_eq+1));
            }else{
              //alert('333333-------ของใหม่และเป็น session แรก');
              $("#total_req").append(json.htmlappend);
              $(".td_total-eq").html(addCommas(total_eq+1));
            }
            //$("#overlay").fadeOut();
          },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
	});  

  
  $('.auto').autoNumeric({aSep: ','});

  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    //$('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  });


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
            showInput: false,
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
     rowphoto = "";
     row.photo_name==null ? rowphoto="<?PHP echo $pathOffsuppDefault;?>" : rowphoto="<?PHP echo $pathOffsupp;?>"+row.photo_name;
    //alert(row.SubName);
    row.SubName==null ? aaa=" ": aaa=' &#187; '+row.SubName;
    row.wait_pay==null ? row.wait_pay = 0 : row.wait_pay;
    row.max_req==null ? row.max_req = 0 : row.max_req;
    DataRow = `<tr>
          <td class="align-middle pt-2 pb-2 pl-1">${numx}.</td>    
          <td class="align-middle pt-2 pb-2 pl-1">${row.location_short}</td>
          <td class="align-middle pt-2 pb-2 pl-1"><a href="${rowphoto}" data-toggle="lightbox" data-title="${row.offsupp_code}<br />${row.offsupp_name}"><img width="40" src="${rowphoto}" class="img-fluid mb-0" alt="black sample" /></a></td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.offsupp_code}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.offsupp_name}</td>
          <td class="align-middle pt-2 pb-2 pl-1">${row.mainName} ${aaa}</td>
          <td class="align-middle pt-2 pb-2 pl-1 text-right bg-light">${addCommas(row.wait_pay)}</td>
          <td class="align-middle pt-2 pb-2 pl-1 text-right bg-green-2"><span class="balance-${row.id_offsupp_location }">${addCommas(row.total_balance-row.wait_pay)}</span> ${row.unit_name}</td>
          <td class="align-middle pt-2 pb-2 pl-1">
          <div class="input-group  m-0 p-0">
          <input type="number" class="auto form-control product-quantity" max="${row.total_balance-row.wait_pay}" id="qty-${row.id_offsupp_location }" name="quantity" onKeyPress="return IsNumeric(event);" autocomplete="off" novalidate value="" />
          <span class="input-group-btn">&nbsp;&nbsp;
          <button type="button" class="btn btn-sm btn-success float-right pt-1 pb-1 mt-0 btnAddAction" data-itemid="${row.id_offsupp_location }" data-unit="${row.unit_name}" data-maxreq="${row.max_req}" data-balance="${row.total_balance-row.wait_pay}" id="product-${row.id_offsupp_location }" data-action="action" data-code="${row.offsupp_code}" data-proname="${row.offsupp_name}"> เบิก</button>
          </span>
          </div>
          </td>
        </tr>`;
  }
  return DataRow;
}


/*ฟังก์ชั่นแบ่งหน้า โดยใช้ ajax-json (แก้ไขสมบรูณ์แล้ว)*/
function func_getDatalist() {
  var limit_perPage = $("#limit_perPage").val();
  var pageno = parseInt($("#currentpage").val());
  var slt_location = $(".slt_location option:selected" ).val();  

  //alert(slt_location); return false;

  var ref_id_menu = $("#ref_id_menu option:selected" ).val();
  var ref_id_menu_sub = $("#ref_id_menu_sub option:selected" ).val();
  //alert(ref_id_menu);
  //return false;
  $.ajax({
    url: "module/module_requisition/ajax_action.php",
    type: "GET",
    dataType: "json",    
    data: { page:pageno, ref_id_menu:ref_id_menu, ref_id_menu_sub:ref_id_menu_sub, slt_location:slt_location, action:"getDataList" },
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
            $('#txt_ref_id_menu_sub').append($('<option>',{value: value.id_menu, text : value.name_menu }
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

    
  // searching
  /*
  $("#searchinput").on("keyup", function () {

    const searchinput = $(this).val();
    if (searchinput.length > 1) {
      $.ajax({
        url: "module/module_requisition/ajax_action.php",
        type: "GET",
        dataType: "json",
        data: { searchinput: searchinput, action: "search" },
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
  */


});
</script>