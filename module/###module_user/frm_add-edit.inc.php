
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

    $('.numberonly').keypress(function (e) {    
    
    var charCode = (e.which) ? e.which : event.keyCode    

    if (String.fromCharCode(charCode).match(/[^0-9]/g))    

        return false;                        

    }); 



  });//document
</script>

<!-- add/edit form modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลผู้ใช้งาน<i class="fa fa-user-circle-o" aria-hidden="true"></i></h5>
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
                                        <label for="no_user">รหัสพนักงาน</label>  
                                        <input type="text" maxlength="7" id="no_user" name="no_user" placeholder="รหัสพนักงาน" class="numberonly form-control w-10" aria-describedby="inputGroupPrepend" required />  
                                        <div class="invalid-feedback">กรอกรหัสพนักงาน</div>
                                    </div>  
                                </div>  
                                <div class="col-sm-5 col-md-4 col-xs-12">  
                                    <div class="form-group">  
                                        <label for="firstname">ชื่อ-นามสกุลผู้ใช้งาน</label>  
                                        <input type="text" id="fullname" name="fullname" placeholder="ชื่อ-นามสกุล" class="form-control w-100" aria-describedby="inputGroupPrepend" required />
                                        <div class="invalid-feedback">ต้องกรอกชื่อ-นามสกุล</div>
                                    </div>  
                                </div>  
                            </div>  
                            <div class="row">  
                                <div class="col-sm-4 col-md-4 col-xs-12">  
                                    <div class="form-group">  
                                        <label for="Gender">ระดับผู้ใช้งาน</label>  
                                        <select class="custom-select" name="class_user" required>  
                                            <option value="">ระดับผู้ใช้งาน</option>  
                                            <?PHP
                                                foreach($classUserArr as $key => $className) {
                                                    //echo "$key = $className<br>";
                                                    if($key!=0)
                                                    {
                                                      echo "<option value=\"".$key."\">".$className."</option>";
                                                    }
                                                }
                                            ?>
                                        </select>  
                                        <div class="invalid-feedback">เลือกระดับผู้ใช้งาน</div>  
                                    </div>  
                                </div>  
                                <div class="col-sm-4 col-md-4 col-xs-12">  
                                    <div class="form-group">  
                                        <label for="email">อีเมล์</label>  
                                        <input type="email" class="form-control" id="email" name="email" placeholder="email address" aria-describedby="inputGroupPrepend" required>  
                                        <div class="invalid-feedback">กรอกอีเมล์</div>  
                                    </div>  
                                </div>  

                                <div class="col-sm-4 col-md-4 col-xs-12">  
                                    <div class="form-group"><!--pattern="^\d{10}$"-->
                                        <label for="password" class="text-danger">รหัสผ่าน</label>  
                                        <input type="password" maxlength="10" class="form-control" id="password" name="password" placeholder="รหัสผ่าน" aria-describedby="inputGroupPrepend" required>
                                        <div class="invalid-feedback">  กรอกเป็นตัวเลข 10 หลัก</div>  
                                    </div>  
                                </div>                                  

                                <div class="col-sm-4 col-md-4 col-xs-12">  
                                    <div class="form-group">  
                                        <label for="ref_dept">แผนก</label>  
                                        <select class="custom-select" name="ref_dept" required>  
                                            <option value="">เลือกแผนก</option>  
                                            <?PHP
                                                foreach($deptArr as $key => $className) {
                                                    //echo "$key = $className<br>";
                                                    if($key!=0)
                                                    {
                                                      echo "<option value=\"".$key."\">".$className[1]."</option>";
                                                    }
                                                }
                                            ?>
                                        </select>  
                                        <div class="invalid-feedback">เลือกระดับผู้ใช้งาน</div>  
                                    </div>  
                                </div>  

                                <div class="col-sm-4 col-md-4 col-xs-12">  
                                    <div class="form-group">
                                        <label for="phone">เบอร์โทรศัพท์</label>  
                                        <input type="tel" pattern="^\d{10}$" class="form-control" id="phone" name="phone" placeholder="Mobile Number" aria-describedby="inputGroupPrepend" >
                                        <div class="invalid-feedback">  
                                            กรอกเป็นตัวเลข 10 หลัก
                                        </div>  
                                    </div>  
                                </div>  
                            </div>  
                            <div class="row">  
                                <div class="col-sm-5 col-md-12 col-xs-1">  
                                    <div class="form-group m-0 p-0">  
                                        <label>ไซต์งานที่ใช้</label>                                          
                                     </div>  
                                     <?PHP
                                        foreach($branchArr as $key => $branchName)
                                        {
                                        //echo "$key = $branchName<br>";
                                        if($key!=0)
                                        {
                                            echo '<div class="form-check-inline"><div class="custom-control custom-radio ">';
                                            echo '<input type="radio" class="custom-control-input" id="'.$branchName[1].'" name="ref_id_location" value="'.$branchName[0].'" aria-describedby="inputGroupPrepend" required>  
                                            <label class="custom-control-label" for="'.$branchName[1].'">'.$branchName[1].'</label>  ';
                                            //if($key==1){echo '<div class="invalid-feedback">เลือกส่วนงานที่ใช้</div>';}
                                            echo '</div></div>';
                                        }
                                        }
                                         ?>
                                </div>
                            </div>  
                            <div class="row">  
                                <div class="col-sm-0 col-md-0 col-xs-0 w-100 mt-3">
                                    <div class="form-group">  
                                        <label>รูปโปรไฟล์ (ถ้ามี)</label>  
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
                                        foreach($statusUserArr as $key => $statusUser)
                                        {
                                        //echo "$key = $branchName<br>";
                                        if($key!=0)
                                        {
                                            echo '<div class="form-check-inline"><div class="custom-control custom-radio ">';
                                            echo '<input type="radio" class="custom-control-input" id="'.$statusUserArr[$key].'" name="status_user" value="'.$key.'" aria-describedby="inputGroupPrepend" required>  
                                            <label class="custom-control-label '.($key==1 ? 'text-success' : 'text-danger').'" for="'.$statusUserArr[$key].'">'.$statusUserArr[$key].'</label>  ';
                                            //if($key==1){echo '<div class="invalid-feedback">เลือกส่วนงานที่ใช้</div>';}
                                            echo '</div></div>';
                                        }
                                        }
                                         ?>
                                </div>
                            </div>  

                            <div class="row">  
                                <div class="col-sm-12 col-md-12 col-xs-12 mt-3">  
                                    <div class="form-group">  
                                        <label for="address">หมายเหตุ (ถ้ามี)</label>  
                                        <textarea class="form-control" rows="3" id="address" aria-describedby="inputGroupPrepend"></textarea>  
                                        <div class="invalid-feedback">please enter address</div>  
                                    </div>  
                                </div>  
                            </div>  
                            <div class="row">  
                                <div class="col-sm-12 col-md-12 col-xs-12">  
                                    <div class="float-right">  
                                        <input type="hidden" name="line_token" value="">
                                        <input type="hidden" name="sex" value="">
                                        <button type="button" class="btn btn-danger btn-cancel" data-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-success" id="addButton">บันทึก</button>
                                        <input type="hidden" name="action" value="addUser">
                                        <input type="hidden" name="userid" id="userid" value="">
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
