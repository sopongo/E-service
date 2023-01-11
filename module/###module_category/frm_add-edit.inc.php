
<script src="plugins/autoNumeric/autoNumeric.js"></script>

<script type="text/javascript">  
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
</script> 

<script type="text/javascript"> 
  $(document).ready(function(){
   
    $(document).on('change keyup blur','input:radio[name=level_menu]',function(){ /*เช็คหมวดหลัก-ย่อย*/
	    var level_menu = $("input:radio[name=level_menu]:checked").val();
	    if(level_menu==2){
            $("#mainMenu").removeClass("d-none").show();
        }else{
            $("#mainMenu").addClass("d-none").hide();
        }
    });    

  });//document
</script>

<!-- add/edit form modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">เพิ่มหมวดวัสดุ-อุปกรณ์<i class="fa fa-user-circle-o" aria-hidden="true"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


    <!--FORM 1-->
    <div class="container py-1">
        <div class="row">  
            <div class="offset-md-0 col-md-12 offset-md-0">  
                <div class="card">  
                    <div class="card-header bg-primary text-white">  
                        <h4 class="card-title text-uppercase">กรอกรายละเอียด</h4>  
                    </div>  
                    <div class="card-body">  
                        <form id="needs-validation" class="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate>

                               <div class="row div_status">
                                <div class="col-sm-12 col-md-12 col-xs-12 mt-1">  
                                    <div class="form-group">  
                                        <div class="form-group m-0 p-0"><label>สถานะการใช้งาน</label></div>                                        
                                        <div class="form-check-inline"><div class="custom-control custom-radio "><input type="radio" class="custom-control-input" id="status_use" name="status_menu" value="1" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-success" for="status_use">ใช้งาน</label><div class="invalid-feedback">เลือกสถานะการใช้งาน</div></div></div>
                                        <div class="form-check-inline"><div class="custom-control custom-radio "><input type="radio" class="custom-control-input" id="status_hold" name="status_menu" value="2" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-danger" for="status_hold">ระงับใช้งาน</label></div></div>
                                    </div>
                                </div>  
                               </div>


                                <div class="row">  
                                <div class="col-sm-6 col-md-6 col-xs-6">  
                                    <div class="form-group">  
                                        <label for="firstname">ชื่อหมวด</label>  
                                        <input type="text" id="name_menu" name="name_menu" placeholder="ชื่อหมวด" class="form-control input" aria-describedby="inputGroupPrepend" required />
                                        <div class="invalid-feedback">กรอกชื่อหมวด</div>
                                    </div>  
                                </div>

                                <div class="col-sm-5 col-md-5 col-xs-5">  
                                    <div class="form-group">  
                                        <label for="firstname">ชื่อย่อหมวด (ภาษาอังกฤษพิมพ์ใหญ่ [A-Z] 3 ตัวอักษร)</label>  
                                        <input type="text" id="menu_code" name="menu_code" placeholder="ภาษาอังกฤษ 3 ตัวอักษร" pattern="[A-Z]{3}" class="form-control" aria-describedby="inputGroupPrepend" maxlength="3" required /> <span class="text-danger d-inline w-auto">**ใช้สร้างรหัสสินค้า</span>
                                        <div class="invalid-feedback">กรอกภาษาอังกฤษพิมพ์ใหญ่ [A-Z] 3 ตัวอักษร</div>
                                    </div>  
                                </div>
                                
                                </div>  

                                <div class="row">
                                <div class="col-sm-12 col-md-12 col-xs-12">  
                                    <div class="form-group">  
                                    <div class="form-group m-0 p-0"><label>ประเภทหมวด</label></div>
                                    <div class="form-check-inline"><div class="custom-control custom-radio "><input type="radio" class="custom-control-input" id="mainCate" name="level_menu" value="1" aria-describedby="inputGroupPrepend" required><label class="custom-control-label" for="mainCate">หมวดหลัก</label></div></div>
                                    <div class="form-check-inline"><div class="custom-control custom-radio "><input type="radio" class="custom-control-input" id="subCate" name="level_menu" value="2" aria-describedby="inputGroupPrepend" required><label class="custom-control-label" for="subCate">หมวดย่อย</label></div></div>
                                    <div class="invalid-feedback">เลือกประเภทหมวด</div>
                                    </div>
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-sm-12 col-md-12 col-xs-12 mt-1 d-none" id="mainMenu">
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
                                        <div class="invalid-feedback">เลือกหมวดหลัก</div>  
                                    </div>  
                                </div>
                                </div>


                            <div class="row">  
                                <div class="col-sm-12 col-md-12 col-xs-12 mt-1">  
                                    <div class="form-group">  
                                        <label for="address">หมายเหตุ (ถ้ามี)</label>  
                                        <textarea class="form-control" rows="3" id="desc_menu" name="desc_menu" aria-describedby="inputGroupPrepend"></textarea>  
                                    </div>  
                                </div>  
                            </div>


                            <div class="row">  
                                <div class="col-sm-12 col-md-12 col-xs-12">  
                                    <div class="float-right">  
                                        <button type="button" class="btn btn-danger btn-close" data-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-success" id="addButton">บันทึก</button>
                                        <input type="hidden" name="action" value="addMenu">
                                        <input type="hidden" name="id_menu" id="id_menu" value="">
                                    </div>                            
                                </div>  
                            </div>  
                        </form>  
                    </div>  
                </div>  
            </div>  
        </div>  
    </div>  
    <!--FORM 1-->

  

    </div>
  </div>
</div>
<!-- add/edit form modal end -->
