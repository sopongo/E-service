
<style type="text/css">

.ml20{ margin-left:-25px;}
</style>

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


<!-- add/edit form modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-circle"></i> เพิ่มวัสดุ-อุปกรณ์</h5>
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
                            <div class="row">  

                                <div class="col-sm-12 col-md-12 col-xs-12 mt-1">  
                                    <div class="form-group">  
                                        <div class="form-group m-0 p-0"><label>สถานะการใช้งาน</label></div>                                        
                                        <div class="form-check-inline"><div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="status_use" name="status_use" value="1" aria-describedby="inputGroupPrepend" required>
                                            <label class="custom-control-label text-success" for="status_use">ใช้งาน</label>                                   
                                        <div class="custom-control custom-radio d-inline">
                                            <input type="radio" class="custom-control-input" id="status_hold" name="status_use" value="2" aria-describedby="inputGroupPrepend" required>
                                            <label class="custom-control-label text-danger" for="status_hold">ระงับใช้งาน</label>
                                            <div class="invalid-feedback ml20">เลือกสถานะการใช้งาน</div>
                                        </div></div>
                                    </div>
                                        
                                    </div>  
                                </div>  



                                <div class="col-sm-5 col-md-4 col-xs-12">
                                <div class="form-group">  
                                        <label for="ref_id_location">ไซต์งานที่ใช้:</label>  
                                        <select class="custom-select" name="ref_id_location" id="ref_id_location" required>  
                                            <?PHP
                                            //id_menu name_menu
                                            $rowData = $obj->fetchRows("SELECT id_location, location_short FROM tb_location WHERE status_location=1 ORDER BY id_location ASC");
                                            if (count($rowData)!=0) {
                                                echo '<option value="" disabled selected>เลือกไซต์งาน</option>';
                                                foreach($rowData as $key => $value) {
                                                    echo '<option value="'.($key+1).'">'.$rowData[$key]['location_short'].'</option>';
                                                }
                                            } else {
                                                echo '<option value="" >เลือกไซต์งาน</option>  ';
                                            }
                                            ?>
                                        </select>  
                                        <div class="invalid-feedback">เลือกไซต์งาน</div>  
                                    </div>                                      
                                </div>
                             </div>  

                                <div class="row">  
                                    <div class="col-sm-5 col-md-5 col-xs-5">  
                                        <div class="form-group">  
                                        <label for="ref_id_menu">หมวดหลัก:</label>  
                                            <select class="custom-select ref_id_menu" name="ref_id_menu" id="ref_id_menu" required><!--form-control form-control-sm-->
                                                <?PHP
                                                    $rowData = $obj->fetchRows("SELECT id_menu, menu_code, name_menu FROM tb_category WHERE level_menu=1 ORDER BY id_menu ASC");
                                                    if (count($rowData)!=0) {
                                                        echo '<option value="" disabled selected>เลือกหมวดหลัก</option>';
                                                        foreach($rowData as $key => $value) {
                                                            echo '<option value="'.($rowData[$key]['id_menu']).'">'.$rowData[$key]['menu_code'].' - '.$rowData[$key]['name_menu'].'</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="">เลือกหมวดหลัก</option>  ';
                                                    }
                                                ?>
                                            </select>  
                                            <div class="invalid-feedback">เลือกหมวดหลัก</div>  
                                        </div>

                                        </div>

                                      <div class="col-sm-5 col-md-5 col-xs-5">  
                                        <div class="form-group">  
                                        <label for="ref_id_menu_sub">หมวดย่อย:</label>  
                                            <select class="custom-select ref_id_menu_sub" name="ref_id_menu_sub" id="ref_id_menu_sub" required>  
                                                <option value="" disabled selected>เลือกหมวดหลักก่อน</option>
                                            </select>  
                                            <div class="invalid-feedback">เลือกหมวดย่อย</div>  
                                        </div>
                                </div>  
                               

                                <div class="col-sm-10 col-md-10 col-xs-10">  
                                    <div class="form-group">  
                                    <label for="slt_id_offsupps">วัสดุอุปกรณ์:</label>  
                                        <select class="custom-select slt_id_offsupps" name="slt_id_offsupps" id="slt_id_offsupps" required>  
                                            <option value="" disabled selected>เลือกวัสดุอุปกรณ์</option>
                                        </select>  
                                        <div class="invalid-feedback">เลือกวัสดุอุปกรณ์</div>  
                                    </div>  
                                </div> 

                                <div class="col-sm-5 col-md-5 col-xs-5">  
                                    <div class="form-group">  
                                        <label>รูปภาพ:</label>
                                        <p id="img_offsupp"></p>  
                                    </div>

                                </div>

                                <div class="col-sm-5 col-md-5 col-xs-5">  
                                    <div class="form-group">  
                                        <label>รายละเอียด:</label>
                                        <p id="offsupp_detail"></p>  
                                    </div>
                                </div>  


                            </div>  
                            <hr />

                            <div class="row">  
                                <div class="col-sm-12 col-md-12 col-xs-12">  
                                    <div class="float-right">  
                                        <button type="button" class="btn btn-danger btn-reset" data-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-success" id="addButton">บันทึก</button>
                                        <input type="hidden" name="action" value="add_offsupp">
                                        <input type="hidden" name="id_offsupp" id="id_offsupp" value="">
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




<script type="text/javascript"> 
  $(document).ready(function(){

    $('.numberonly').keypress(function (e) {    
    var charCode = (e.which) ? e.which : event.keyCode    
       if (String.fromCharCode(charCode).match(/[^0-9]/g))    
       return false;                        
    }); 
  });//document
</script>