<script type="text/javascript">  

</script> 

<style type="text/css">
.text-size-1{
 font-size:0.90rem;
}
</style>

<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> ตัวอย่าง.ฟอร์มเปล่า Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body p-0 py-2">

        <!--FORM 1-->
        <form id="needs-validation" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
        <div class="container">
            <div class="row">


            <div class="offset-md-0 col-md-12 offset-md-0">  
                <div class="card">  
                    <div class="card-header bg-primary text-white p-2"><p class="card-title text-size-1">กรอกรายละเอียด</p></div>
                    <div class="card-body p-3"> 

                        <div class="row row-1">
                        <div class="col-sm-12 col-md-12 col-xs-12">  
                            <div class="form-group mb-2">
                                <label>สถานะการใช้งาน: </label> 
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="status_use" name="status_location" value="1" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-success" for="status_use">ใช้งาน</label></div></div>
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="status_hold" name="status_location" value="2" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-danger w-auto d-inline" for="status_hold">ระงับใช้งาน</label><div class="invalid-feedback float-right w-auto pl-3">เลือกสถานะการใช้งาน</div></div></div>
                            </div>
                        </div>  
                        </div><!--row-1-->

                        <div class="row row-2">
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            <div class="form-group mb-2">
                                <div class="form-group m-0"><label>สถานะการใช้งาน: </label></div>
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="test_use" name="test_use" value="1" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-success" for="test_use">ใช้งาน</label></div></div>
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="test_hold" name="test_use" value="2" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-danger" for="test_hold">ระงับใช้งาน</label><div class="invalid-feedback float-right w-auto pl-3">เลือกสถานะการใช้งาน</div></div></div>
                            </div>                                
                        </div>  
                        </div><!--row-2-->

                        <div class="row row-3">
                            <div class="col-sm-4 col-md-4 col-xs-4">  
                                <div class="form-group">  
                                    <label for="firstname">TextBOX</label>  
                                    <input type="text" id="text1" name="text1" placeholder="TextBOX" class="form-control" aria-describedby="inputGroupPrepend" />
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-xs-4">  
                                <div class="form-group">  
                                    <label for="firstname">TextBOX</label>  
                                    <input type="text" id="text2" name="text1" placeholder="TextBOX" class="form-control" aria-describedby="inputGroupPrepend" />
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-xs-4">  
                                <div class="form-group">  
                                    <label for="firstname">TextBOX</label>  
                                    <input type="text" id="text3" name="text3" placeholder="TextBOX" class="form-control" aria-describedby="inputGroupPrepend" />
                                </div>
                            </div>
                        </div><!--row-3-->

                        <div class="row row-4">
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">TextBOX</label>  
                                    <input type="text" id="text4" name="text4" placeholder="TextBOX" class="form-control" aria-describedby="inputGroupPrepend" />
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname">TextBOX</label>  
                                    <input type="text" id="text5" name="text5" placeholder="TextBOX" class="form-control" aria-describedby="inputGroupPrepend" required />
                                    <div class="invalid-feedback">Required textbox</div>
                                </div>
                            </div>
                        </div><!--row-4-->

                        <div class="row row-5">
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="txt_ref_id_menu">SelectBox</label>  
                                        <select class="custom-select" name="slt1" id="slt1" required>
                                            <option value="1">Option 1</option>
                                            <option value="2">Option 2</option>
                                            <option value="3">Option 3</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="txt_ref_id_menu">SelectBox</label>  
                                        <select class="custom-select" name="slt2" id="slt2" required>
                                            <option value="">Select value</option>
                                            <option value="1">Option 1</option>
                                            <option value="2">Option 2</option>
                                            <option value="3">Option 3</option>
                                        </select>
                                        <div class="invalid-feedback">Required textbox</div>
                                </div>
                            </div>
                        </div><!--row-5-->


                    </div><!--card-body-->
                </div><!--card-->
            </div>                

            </div><!--row-->
        </div><!--container-->
        </form>
        <!--FORM 1-->

    </div><!--modal-body-->
    <div class="modal-footer justify-content-between">
        <input type="submit" class="btn btn-primary btn-submit btn-success" value="บันทึก" />
        <input type="reset" class="btn btn-cancel btn-danger" data-dismiss="modal" value="ยกเลิก" />
    </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal-default -->

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
            url: "module/module_demo/ajax_action.php",
            type: "POST",
            data:{"data":frmData},
            beforeSend: function () {
            },
            success: function (data) {
            //console.log(data);
            $('#example1').DataTable().ajax.reload();
            $("#modal-default").modal("hide"); 
            $(".modal-backdrop").hide().fadeOut();
            sweetAlert("สำเร็จ...", "บันทึกข้อมูลเรียบร้อยแล้ว", "success"); //The error will display
            $('body').find('.was-validated').removeClass();
            $('form').each(function() { this.reset() });
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