
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
                                <div class="col-sm-4 col-md-4 col-xs-12">  
                                    <div class="form-group">  
                                        <label for="txt_offsupp_code">รหัสวัสดุอุปกรณ์</label>  
                                        <input type="text" maxlength="7" id="txt_offsupp_code" name="txt_offsupp_code" placeholder="รหัสวัสดุอุปกรณ์" class="numberonly form-control w-10" value="ST-" aria-describedby="inputGroupPrepend" readonly />  
                                        <div class="invalid-feedback">กรอกรหัสวัสดุอุปกรณ์</div>
                                    </div>  
                                </div>  
                                <div class="col-sm-5 col-md-4 col-xs-12">
                                <div class="form-group">  
                                        <label for="txt_ref_id_branch">ไซต์งานที่ใช้</label>  
                                        <select class="custom-select" name="txt_ref_id_branch" id="txt_ref_id_branch" xrequiredx>  
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
                                    <label for="txt_ref_id_menu">หมวดหลัก</label>  
                                        <select class="custom-select ref_id_menu" name="txt_ref_id_menu" id="txt_ref_id_menu" xrequiredx>  
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
                                    <label for="txt_ref_id_menu_sub">หมวดย่อย</label>  
                                        <select class="custom-select txt_ref_id_menu_sub" name="txt_ref_id_menu_sub" id="txt_ref_id_menu_sub">  
                                            <option value="" disabled selected>เลือกหมวดหลักก่อน</option>
                                        </select>  
                                        <div class="invalid-feedback">เลือกหมวดย่อย</div>  
                                    </div>
                                </div>  
                               

                                <div class="col-sm-5 col-md-5 col-xs-5">  
                                    <div class="form-group">  
                                        <label for="txt_offsupp_name">ชื่อวัสดุอุปกรณ์</label>  
                                        <input type="text" class="form-control" id="txt_offsupp_name" name="txt_offsupp_name" placeholder="ชื่อวัสดุอุปกรณ์" style="width:100%;" aria-describedby="inputGroupPrepend" xrequiredx>  
                                        <div class="invalid-feedback">กรอกชื่อวัสดุอุปกรณ์</div>  
                                    </div>  
                                </div> 

                                <div class="col-sm-5 col-md-5 col-xs-5">  
                                    <div class="form-group">  
                                        <label for="txt_ref_id_unit">หน่วยนับ</label>  
                                        <select class="custom-select" name="txt_ref_id_unit" id="txt_ref_id_unit" xrequiredx>  
                                            <option value="" disabled selected>เลือกหน่วยนับ</option>  
                                            <?PHP
                                            $rowData = $obj->fetchRows("SELECT * FROM tb_unit WHERE status_unit=1 ORDER BY id_unit ASC");
                                            if (count($rowData)!=0) {
                                                foreach($rowData as $key => $value) {
                                                    echo '<option value="'.($key+1).'">'.$rowData[$key]['unit_name'].'</option>';
                                                }
                                            }
                                            ?>
                                        </select>  
                                        <div class="invalid-feedback">เลือกหน่วยนับ</div>  
                                    </div>  
                                </div>  


                                <div class="col-sm-12 col-md-12 col-xs-12">  
                                    <div class="form-group"><label>รายละเอียด</label><textarea id="txt_offsupp_detail" name="txt_offsupp_detail" class="form-control" rows="3" placeholder="Enter ..."></textarea></div>
                                </div>


                                
                                <div class="col-sm-4 col-md-4 col-xs-4">  
                                    <div class="form-group">
                                        <label for="txt_moq">สั่งซื้อขั้นต่ำ<span class="txt_moq">/??</span></label>  
                                        <input type="text" class="form-control numberonly" id="txt_moq" name="txt_moq" placeholder="MOQ" aria-describedby="inputGroupPrepend" xrequiredx>
                                        <div class="invalid-feedback">  กรอกสั่งซื้อขั้นต่ำ</div>  
                                    </div>  
                                </div>  
                                <div class="col-sm-4 col-md-4 col-xs-4">  
                                    <div class="form-group">
                                        <label for="txt_min_stock">คงเหลือขั้นต่ำ<span class="txt_min_stock">/??</span></label>  
                                        <input type="text" class="form-control numberonly" id="txt_min_stock" name="txt_min_stock" placeholder="Minimum Stock" aria-describedby="inputGroupPrepend" xrequiredx>
                                        <div class="invalid-feedback">  กรอกคงเหลือขั้นต่ำ</div>  
                                    </div>  
                                </div>  
                                <div class="col-sm-4 col-md-4 col-xs-4">  
                                    <div class="form-group"><!--pattern="^\d{10}$"-->
                                        <label for="txt_leadtime">ระยะเวลารอสินค้า/วัน</label>  
                                        <input type="text" class="form-control numberonly" id="txt_leadtime" name="txt_leadtime" placeholder="Leadtime" aria-describedby="inputGroupPrepend" xrequiredx>
                                        <div class="invalid-feedback">  กรอกระยะเวลารอสินค้า/วัน</div>  
                                    </div>  
                                </div>
                            </div>  

                            <div class="row">  
                                <div class="col-sm-0 col-md-0 col-xs-0 w-100 mt-3">
                                    <div class="form-group">  
                                        <label>รูปวัสดุอุปกรณ์ (ถ้ามี)</label>  
                                        <div class="custom-file">  
                                            <input type="file" class="custom-file-input" id="photo" name="photo">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>  
                                            <div class="invalid-feedback">Choose file for upload</div>  
                                        </div>  
                                    </div>                                  
                                </div>  
                            </div>

                            <div class="row">  
                                <div class="col-sm-5 col-md-12 col-xs-0">
                                    <div class="form-group m-0 p-0">  
                                        <label>สถานะการใช้งาน</label>                                          
                                     </div>  
                                     <?PHP
                                        foreach($statusArr as $key => $statusText)
                                        {
                                        //echo "$key = $branchName<br>";
                                        if($key!=0)
                                        {
                                            echo '<div class="form-check-inline"><div class="custom-control custom-radio ">';
                                            echo '<input type="radio" class="custom-control-input" id="status_offsupp_'.$key.'" name="status_offsupp" value="'.$statusArr[$key].'" aria-describedby="inputGroupPrepend" xxrequiredxx>  
                                            <label class="custom-control-label '.($key==1 ? 'text-success' : 'text-danger').'" for="status_offsupp_'.$key.'">'.$statusArr[$key].'</label>  ';
                                            if($key==1){echo '<div class="invalid-feedback">เลือกสถานะการใช้งาน</div>';}
                                            echo '</div></div>';
                                        }
                                        }
                                         ?>
                                         
                                </div>
                            </div>  


                            <div class="row">  
                                <div class="col-sm-12 col-md-12 col-xs-12">  
                                    <div class="float-right">  
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
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