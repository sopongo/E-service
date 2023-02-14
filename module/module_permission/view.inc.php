<style type="text/css"> 
.w-10{ width:100px; text-align:center; margin:auto;}
</style>

<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="card">
<div class="card-header">
    <h6 class="display-8 d-inline-block font-weight-bold"><i class="nav-icon fas fa-file-invoice"></i> <?PHP echo $title_act;?></h6>
    <div class="card-tools">
    <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><?PHP echo $breadcrumb_txt;?></li>
    </ol>
    </div>
</div>
<form id="needs-validation" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
<div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ระดับผู้ใช้งาน / สิทธิ์การใช้งาน</th>
                      <!--value อ้างอิงจากไฟล์ setting.inc.php-->
                      <th class="w-10">ผู้ใช้ระบบ <input type="hidden" name="user" id="user" value="1" /></th>
                      <th class="w-10">ช่าง <input type="hidden" name="technician" id="technician" value="2" /></th>
                      <th class="w-10">หัวหน้าช่าง <input type="hidden" name="supervisor" id="supervisor" value="3" /></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?PHP
                  $keys = array_keys($module_name);
                  //echo $module_name["โมดูลจัดการระบบ"]['detail'];
                  $a = 1;
                  for($i = 0; $i < count($module_name); $i++) {
                  ?>
                    <tr>
                        <td>
                        <strong class="text-blue"><?PHP echo $keys[$i]; ?></strong> <br/>
                        <?PHP 
                            foreach($module_name[$keys[$i]] as $key => $value) {
                                $a>3 ? $a=1 : $a=$a;
                                echo $value;
                                //ref_class_user, module_name
                                //$rowData = $obj->customSelect("SELECT * FROM tb_permission WHERE ref_class_user='".$."' AND module_name=".$i."");
                                $a++;
                            }
                        ?>
                        </td>
                        <td class="text-center"><div class="icheck-success d-inline"><input type="checkbox" value="1" name="checkboxSuccess_1_<?PHP echo $i; ?>" id="checkboxSuccess_1_<?PHP echo $i; ?>"><label for="checkboxSuccess_1_<?PHP echo $i; ?>"></label></div><?PHP echo "<br> SELECT * FROM tb_permission WHERE ref_class_user='1' AND module_name=".$i.""; ?></td>
                        <td class="text-center"><div class="icheck-success d-inline"><input type="checkbox" value="1" name="checkboxSuccess_2_<?PHP echo $i; ?>" id="checkboxSuccess_2_<?PHP echo $i; ?>"><label for="checkboxSuccess_2_<?PHP echo $i; ?>"></label></div><?PHP echo "<br> SELECT * FROM tb_permission WHERE ref_class_user='2' AND module_name=".$i.""; ?></td>
                        <td class="text-center"><div class="icheck-success d-inline"><input type="checkbox" value="1" name="checkboxSuccess_3_<?PHP echo $i; ?>" id="checkboxSuccess_3_<?PHP echo $i; ?>"><label for="checkboxSuccess_3_<?PHP echo $i; ?>"></label></div><?PHP echo "<br> SELECT * FROM tb_permission WHERE ref_class_user='3' AND module_name=".$i.""; ?></td>
                    </tr>
                  <?PHP
                  }
                  ?>
                  </tbody>
                </table>
    <div class="modal-footer justify-content-between">
        <input type="submit" class="btn btn-primary btn-submit btn-success" value="บันทึก" />
    </div>
</div><!-- /.card-body -->
</form>

</div><!-- /.card -->

</section>
<!-- /.content -->

<script type="text/javascript">
$(document).ready(function(){

$(document).on("click", ".close, .btn-cancel", function (e){ /*ถ้าคลิกปุ่ม Close ให้รีเซ็ตฟรอร์ม และเคลียร์ validated*/
    $('body').find('.was-validated').removeClass();
    $('form').each(function() { this.reset() });
});    


/*ปุ่ม ADD Recive รับวัสดุเข้าระบบ <<<<<<<<<< เขียนใหม่ใช้โค๊ดนี้ สมบรูณ์กว่าไม่มีบั๊ครีเฟรชหน้าจอ*/
    $(document).on("click", ".btn-submit", function (event){
    var formAdd = document.getElementById('needs-validation');  

    var frmData = $("form#needs-validation").serialize();
    if(formAdd.checkValidity()===false) {  
        event.preventDefault();  
        event.stopPropagation();
    }else{
        //alert('Send Ajax'); return false;
        $.ajax({
            url: "module/module_permission/ajax_action.php",
            type: "POST",
            data:{"data":frmData, "action":"permission"},
            beforeSend: function () {
            },
            success: function (data) {
            console.log(data);
            if(data==1){
                sweetAlert("ผิดพลาด!", "ชื่อย่อหน่วยนับ '"+$("#unit_name").val()+"' ถูกใช้แล้ว", "error");
                return false;
            }else{
                //sweetAlert("สำเร็จ...", "บันทึกข้อมูลเรียบร้อยแล้ว", "success"); //The error will display
                return false;
                $('#example1').DataTable().ajax.reload();
                $("#modal-default").modal("hide"); 
                $(".modal-backdrop").hide().fadeOut();
                sweetAlert("สำเร็จ...", "บันทึกข้อมูลเรียบร้อยแล้ว", "success"); //The error will display
                $('body').find('.was-validated').removeClass();
                $('form').each(function() { this.reset() });
            }   
                event.preventDefault();
            },
                error: function (jXHR, textStatus, errorThrown) {
                //console.log(data);
                alert(errorThrown);
            }
        });    
        event.preventDefault();    
    }
    //alert('Ajax'); return false;
    formAdd.classList.add('was-validated');      
    return false;
});


});//document
</script>