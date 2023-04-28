<style type="text/css">
html {
  box-sizing: border-box;
}
*,
*:before,
*:after {
  box-sizing: inherit;
}
.intro {
  max-width: 1280px;
  margin: 1em auto;
}
.table-scroll {
  position: relative;
  width:100%;
  z-index: 1;
  margin: auto;
  overflow: auto;
  height:650px;
}
.table-scroll table {
  width: 100%;
  min-width: 1280px;
  margin: auto;
  border-collapse: separate;
  border-spacing: 0;
}
.table-wrap {
  position: relative;
}
.table-scroll th,
.table-scroll td {
  padding: 5px 10px;
  border: 1px solid #000;
  background: #fff;
  vertical-align: top;
}
.table-scroll thead th {
  background: #333;
  color: #fff;
  position: -webkit-sticky;
  position: sticky;
  top: 0;
}
/* safari and ios need the tfoot itself to be position:sticky also */
.table-scroll tfoot,
.table-scroll tfoot th,
.table-scroll tfoot td {
  position: -webkit-sticky;
  position: sticky;
  bottom: 0;
  background: #666;
  color: #fff;
  z-index:4;
}

a:focus {
  /*background: red;*/
} /* testing links*/

th:first-child {
  position: -webkit-sticky;
  position: sticky;
  left: 0;
  z-index: 2;
  background: #ccc;
}
thead th:first-child,
tfoot th:first-child {
  z-index: 5;
}

</style>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
    
    <div class="card-header">
        <h4 class="display-10 d-inline-block font-weight-bold"><?PHP echo $title_act;?></h4>
        <div class="card-tools">
        <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Table</li>
        </ol>
        </div>
    </div>

    <div class="card-body">
    <div class="row">
    <div id="table-scroll" class="table-scroll">
  <table id="main-table" class="main-table">
    <thead>
      <tr>
        <th scope="col">h 1</th>
        <th scope="col">h 2</th>
        <th scope="col">h 3</th>
        <th scope="col">h 4</th>
        <th scope="col">h 5</th>
        <th scope="col">h 6</th>
        <th scope="col">h 7</th>
        <th scope="col">h 8</th>
      </tr>
    </thead>
    <tbody>
      <?PHP
      for($i=1;$i<=25;$i++){
      ?>
      <tr>
        <th>00.00</th>
        <td>Cell content</td>
        <td>Cell content longer</td>
        <td>Cell content</td>
        <td>Cell content</td>
        <td>Cell content</td>
        <td>Cell content</td>
        <td>Cell content</td>
      </tr>
      <?PHP
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th>Footer 1</th>
        <td>Footer 2</td>
        <td>Footer 3</td>
        <td>Footer 4</td>
        <td>Footer 5</td>
        <td>Footer 6</td>
        <td>Footer 7</td>
        <td>Footer 8</td>
      </tr>
    </tfoot>
  </table>
</div>      
    </div><!-- /.row -->

    </div><!-- /.card-body -->
  </div><!-- /.card -->

</section>
<!-- /.content -->

<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script type="text/javascript"> 

  $(document).ready(function () {

    var table = $('#example').DataTable( {
        scrollY: "850px",
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        fixedColumns:   {
            left: 1,
            right: 1
        }
    } );    
    
    //var table = $('#example1').DataTable();
    //var info = table.page.info();

    $('#example1_length').append('<div class="col-10 d-inline"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default" id="addData" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus-circle"></i> เพิ่มข้อมูล</button></div>');
    $('input[type=search]').attr('placeholder', 'Col-3 หรือ Col-4');
    //$('#example1_filter').append('<select class="custom-select dataTables_filter" name="search" id="slt_search" aria-controls="example1"><option value="1">Option 1</option><option value="2">Option 2</option><option value="3">Option 3</option></select>');

    //
    $(document).on('change','.check-status',function(){
      swal({
          title: "ยืนยันการส่งใบเบิก ?",   text: "ต้องการส่งใบเบิกรายการนี้หรือไม่.",
          type: "warning",   
          showCancelButton: true,   
          confirmButtonColor: "#DD6B55",   
          confirmButtonText: "ตกลง, ส่งใบเบิก",
          cancelButtonText: "ไม่, ยกเลิก",        
          closeOnConfirm: false 
        }, function(isConfirm){   

          alert(isConfirm);
          return false;
          $.ajax({
              url: "module/module_requisition/xcart_action.php",
              type: "POST",
              dataType: "json",
              data:{req_remark:req_remark, action:"save-requisition"},
              beforeSend: function () {
                //$("#overlay").fadeIn();
              },success: function (json) {
                console.log(json); 
                if(json.error=='over_req'){
                  sweetAlert("ผิดพลาด!", "รหัส:"+json.offsupps_code+" จำนวนคงเหลือไม่พอให้เบิกแล้ว", "error");
                  return false;
                }
                swal({
                  title: "ส่งใบเบิกเรียบร้อย!",
                  text: "ใบเบิกของคุณอยู่ระหว่างการอนุมัติ.",
                  type: "success",
                  //timer: 3000
                }, 
                function(){
                  //window.location.href = "?module=requisitionlist";
                })
            },error: function (json) {
              console.log(json);
              sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
            }
          });
      });

      if($(this).prop('checked')){
          //alert("Checked Box Selected");
      } else {
          //alert("Checked Box deselect");
      }
    });



  });
  

    /*module/module_demo/datatable_processing.php*/
</script>