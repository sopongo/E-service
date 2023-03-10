<?PHP
?>
<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<style type="text/css"> 
.MultiFile-label{background:#fff /*EB2B2B*/; padding:6px; width:100%; margin-right:5px; margin-top:10px;  }
.MultiFile-list{ background:#eee; margin:3px; padding:5px; width: 100%; }
.MultiFile-title{ width:100%; font-size:0.80rem;  padding: 4px; background:#fff;}
.MultiFile-remove{ background:#fff;}
img.MultiFile-preview{ display:block; padding:6px; border:1px solid #ccc; margin-top:10px; width:100px; height:100px;}

.newscan{ cursor:pointer;}

.select2-container .select2-selection--single {
    height: 38px;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    box-shadow: inset 0 1px 2px rgb(0 0 0 / 8%);
    width:100%;
}

#select2-slt_machine-container{ font-size:0.90rem; }
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

<div class="card-body p-2 m-0">

        <!--FORM 1-->
        <form id="needs-validation" class="addform " name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
        <div class="containers p-0 m-0 w-100">
            <div class="rows p-0 m-0">

            <div class="offset-md-12 col-md-12 offset-md-12 w-100">  
                <div class="card w-100">  
                    <div class="card-header bg-primary text-white p-2"><p class="card-title text-size-1">กรอกรายละเอียด</p></div>
                    <div class="card-body p-3"> 

                    <div class="row row-1">
                        <div class="col-sm-4 col-md-4 col-xs-4">  
                            <div class="form-group">
                                    <div id="qr-reader" style="width:100%"></div>
                                    <div id="qr-reader-results"></div>
                                    <div class="m-auto bg-gray text-center py-1 newscan"><i class="fas fa-qrcode fa-1x"></i> คลิก สแกนอีกครั้ง</div>
                            </div>
                        </div>
                    </div><!--row-1 -->

                    <div class="row row-2 d-block">
                            <div class="col-sm-4 col-md-4 col-xs-4 p-0 m-0">  
                            <div class="form-group">
                                <label for="ref_id_dept"><span class="text-danger">**</span> แจ้งซ่อมไปที่แผนก: </label> 
                                <select class="custom-select" name="ref_id_dept" id="ref_id_dept" style="width:100%; font-size:0.85rem;" required>  
                                    <?PHP
                                    //id_menu name_menu
                                    $rowData = $obj->fetchRows("SELECT * FROM tb_dept WHERE mt_request_manage=1 AND dept_status=1 ORDER BY id_dept ASC");
                                    if (count($rowData)!=0) {
                                        echo '<option value="" disabled selected>เลือกแผนกที่รับผิดชอบ</option>';
                                        foreach($rowData as $key => $value) {
                                            echo '<option value="'.$rowData[$key]['id_dept'].'">'.$rowData[$key]['dept_initialname'].' - '.$rowData[$key]['dept_name'].'</option>';
                                        }
                                    } else {
                                        echo '<option disabled selected value="" >เลือกแผนกที่รับผิดชอบ</option>  ';
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">เลือกแผนกที่รับผิดชอบ</div>
                            </div>
                        </div><!--row-2-->

                    <div class="row row-2">
                            <div class="col-sm-4 col-md-4 col-xs-4">  
                                <div class="form-group">
                                <label for="slt_machine"><span class="text-red font-size-sm">**</span> เครื่องจักร/อุปกรณ์ (ใส่รหัสหรือชื่อเครื่องจักร)</label>  
                                <select id="slt_machine" class="select2 custom-select pb-5" style="width: 100%;" required>
                                <option disable selected>เลือกแผนกที่รับผิดชอบก่อน</option>
                                </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                    </div><!--row-2 -->

                        <div class="row row-4">
                            <div class="col-sm-4 col-md-4 col-xs-4">  
                                <div class="form-group">  
                                    <label for="problem_statement"><span class="text-red font-size-sm">**</span> อาการเสีย/ปัญหาที่พบ:</label>  
                                    <textarea class="form-control" rows="5" id="problem_statement" name="problem_statement" placeholder="Enter ..." required></textarea>
                                    <div class="invalid-feedback">กรอกอาการเสีย/ปัญหาที่พบ</div>
                                </div>
                            </div>
                        </div><!--row-4-->

                        <div class="row row-4">
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="machine_image"><span class="text-red font-size-sm">**</span> ภาพถ่ายอาการเสีย / ปัญหาที่พบ:</label>  
			<div class="row-fluid">
				<div class="col-md-8">
					<input name="files[]" type="file" multiple="multiple" data-maxsize="6000" maxlength="6" id="our-test" class="border  p-1 multi with-preview w-auto" />
                    <span class="text-red font-size-sm mt-2 d-block w-100">** ไม่เกิน 6 รูป / ไฟล์ไซต์ไม่เกิน 6 เมกะไบต์ต่อรูป</span> 
				</div>
			</div>
                                </div>
                            </div>
                        </div><!--row-4-->                        

                        <div class="row row-7 mt-2">
                            <div class="col-sm-12 col-md-12 col-xs-12">
                                    <label for="ref_id_job_type">ประเภทงานซ่อม:</label>  <br />
                                    <div class="icheck-danger d-inline">
                                    <input type="radio" id="radioPrimary1" name="ref_id_job_type" value="1" checked>
                                    <label for="radioPrimary1">แจ้งช่างซ่อม</label>
                                    </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-xs-12 mt-2">
                            <div class="icheck-info d-inline">
                                    <input type="radio" id="radioPrimary3" name="ref_id_job_type" value="4">
                                    <label for="radioPrimary3">แจ้งช่างสร้าง</label>
                                    </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-xs-12 mt-2">
                            <div class="icheck-success d-inline">
                                    <input type="radio" id="radioPrimary2" name="ref_id_job_type" value="2">
                                    <label for="radioPrimary2">ช่างแจ้งซ่อมเอง</label>
                                    </div>
                            </div>
                        </div><!--row-7-->


                        <div class="row row-5 mt-3">
                            <div class="col-sm-5 col-md-5 col-xs-5">
                                    <label for="firstname">เกี่ยวกับความปลอดภัย:</label>  <br />
                                    <div class="icheck-danger d-inline">
                        <input type="checkbox"  id="related_to_safty">
                        <label for="related_to_safty">แจ้ง จป. เพื่อตรวจสอบก่อนและหลังแก้ไข</label>
                      </div>                                    
                            </div>
                        </div><!--row-5-->

                        <div class="row row-1 mt-3">
                        <div class="col-sm-12 col-md-12 col-xs-12">  
                            <div class="form-group mb-2">
                                <label class="d-block">ความเร่งด่วน: </label> 
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="status_normal" name="urgent_type" value="1" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-success" for="status_normal">ไม่เร่งด่วน</label></div></div>
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="status_urgent" name="urgent_type" value="2" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-danger w-auto d-inline" for="status_urgent">ด่วน</label><div class="invalid-feedback float-right w-auto pl-3">เลือกสถานะการใช้งาน</div></div></div>
                            </div>
                        </div>  
                        </div><!--row-1-->

                        <div class="row row-5 mt-2">
                            <div class="col-sm-3 col-md-3 col-xs-3">
                                <div class="form-group">  
                                    <label for="firstname">ผู้แจ้งซ่อม:</label>  
                                    <input type="text" id="fullnam_request" name="fullnam_request" readonly="true" value="<?PHP echo $_SESSION['sess_fullname']; ?>" class="form-control" aria-describedby="inputGroupPrepend" required />
                                    <div class="invalid-feedback">กรอกชื่อไซต์งาน</div>
                                </div>
                            </div>
                        </div><!--row-5-->

                        <div class="modal-footer justify-content-between">
                            <input type="hidden" name="action" id="action" value="adddata" />
                            <input type="hidden" name="ref_id_machine_site" id="ref_id_machine_site" value="" />
                            <input type="submit" class="fa-user btn btn-primary btn-submit btn-success" value="ส่งใบแจ้งซ่อม" />
                            <input type="reset" class="btn btn-cancel btn-danger" value="ยกเลิก" />
                        </div>

                    </div><!--card-body-->
                </div><!--card-->
            </div>                

            </div><!--row-->
        </div><!--container-->
        </form>
        <!--FORM 1-->

</div><!-- /.card-body -->

</div><!-- /.card -->
</section>
<!-- /.content -->

<script src="plugins/html5-qrcode/html5-qrcode.min.v2.3.4.js"></script>
<!--<script src="https://scanapp.org/assets/js/html5-qrcode.min.v2.3.4.js"></script>-->

<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<!-- Page specific script -->
<script>

  $(function () {

    $('#our-test').MultiFile({
        max: 6,
        onFileChange: function(){
            //console.log('TEST CHANGE:', this, arguments);
        }
    });

    //Initialize Select2 Elements
    $('.select2').select2({
    });

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });

  //select2-search__field
</script>

<script>
$(document).ready(function(){

    $(document).on("click", ".btn-submit", function (event){
        var slt_machine = $("#slt_machine option:selected" ).val();
        //alert($('.select2').select2().val());
        $('#ref_id_machine_site').val($('.select2').select2().val());
        if(slt_machine===null || slt_machine===''){
            sweetAlert("ผิดพลาด!", "เลือกรายการที่ต้องการแจ้งซ่อม", "error");
            return false;
        }
    //$(document).on("submit", "form#needs-validation", function(event){
    //event.preventDefault();
    event.stopPropagation();    
    var formAdd = document.getElementById('needs-validation');  
    //var frmData = $("form#needs-validation").serialize();
    var frm_Data= new FormData($('form#needs-validation')[0]);
    if(formAdd.checkValidity()===false) {  
        event.preventDefault();  
        event.stopPropagation();
    }else{
        swal({
        title: "ยืนยัน ?",   text: "ต้องการส่งใบแจ้งซ่อมนี้หรือไม่.",
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "ตกลง",
        cancelButtonText: "ไม่, ยกเลิก",        
        closeOnConfirm: false 
      }, function(){   
        $.ajax({
            url: "module/module_maintenance_list/send_request.inc.php",
            type: "POST",
            //data:{ "action":"send-req"},
            dataType: "json",
            processData: false,
            contentType: false,
            data: frm_Data, 
            beforeSend: function () {
            },success: function (data) {
                console.log(data); //return false;
                var ref_id = data;
                if(data.error=='over_req'){
                    sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
                    return false;
                }
                swal({
                    title: "ส่งใบแจ้งซ่อมเรียบร้อย!",
                    text: "กรุณารอช่างติดต่อกลับ เพื่อประเมิณการซ่อม",
                    type: "success",
                    //timer: 3000
                }, 
                function(){
                    console.log(data);
                    //event.stopPropagation();
                    //return false();
                    //alert(ref_id);
                    window.location.href = '?module=requestid&id='+data+'';
                })
            },error: function (data) {
                console.log(data);
                sweetAlert("ผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้", "error");
            }
        });
    });
        //event.preventDefault();    
        event.stopPropagation();        
    }
    //alert('Ajax'); return false;
    formAdd.classList.add('was-validated');      
    return false;
    });    


    $(document).on("click", ".select2-container--default ", function (){ 
        var ref_id_dept = $("#ref_id_dept option:selected" ).val();
        //alert(ref_id_dept);
        if(ref_id_dept==''){
            swal("ผิดพลาด!", "เลือกแผนกที่รับผิดชอบก่อน", "error");
            return false;
        }
    });

        $(document).on("click", ".newscan", function (){ 
        window.location.reload();
    });

    $(document).on("change", "#ref_id_dept", function (){ 
        var ref_id_dept = $("#ref_id_dept option:selected" ).val();
        //alert(ref_id_dept);
        if(ref_id_dept==='' || ref_id_dept===null ){
            swal("ผิดพลาด!", "เลือกแผนกที่รับผิดชอบก่อน", "error");
            return false;
        }else{
            $.ajax({
                url: "module/module_maintenance_list/chk_qrcode.inc.php",
                type: "POST",
                data:{"action":"chk_dept","ref_id_dept":ref_id_dept},
                beforeSend: function () {
                },
                success: function (data) {
                    console.log(data);
                    $('#slt_machine').html(data);
                    event.preventDefault();
                },
                    error: function (jXHR, textStatus, errorThrown) {
                    console.log(data);
                    alert(errorThrown);
                }
            });
        }
    });     
});

function docReady(fn) {
    // see if DOM is already available
    if (document.readyState === "complete"
        || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

docReady(function () {
    var resultContainer = document.getElementById('qr-reader-results');
    var lastResult, countResults = 0;
    function onScanSuccess(decodedText, decodedResult) {
        //alert(decodedText); //QR Barcode ที่อ่านได้
        //$('#slt_machine option[value='+decodedText+']').prop('selected', true);
        //$('#slt_machine option[value='+decodedText+']').attr('selected', 'selected');
        $.ajax({
        dataType: "json",
        url: "module/module_maintenance_list/chk_qrcode.inc.php",
        type: "POST",
        data:{"action":"chk_qr","qrcode":decodedText},
        beforeSend: function () {
            $('#select2-slt_machine-container').html(decodedText);
        },
        success: function (data) {
            console.log(data);
            if(data==0){
                $('#select2-slt_machine-container').html('');
                $('#ref_id_dept option:eq(0)').prop('selected', true);
                $('#slt_machine').html('<option value="" selected>เลือกแผนกที่รับผิดชอบก่อน</option>');
                swal("ผิดพลาด!", "ไม่พบข้อมูลตามที่สแกน", "error");
                //html5QrcodeScanner.clear();
                return false;
            }else{
                $('#ref_id_dept option[value='+data.ref_id_dept+']').prop('selected', true);
                $('#slt_machine').html(data.slt_machine);
                html5QrcodeScanner.clear();
            }
            event.preventDefault();
        },
            error: function (jXHR, textStatus, errorThrown) {
            console.log(data);
            alert(errorThrown);
        }
    });          

        //html5QrcodeScanner.clear();
        if (decodedText !== lastResult) {
            //++countResults;
            //lastResult = decodedText;
            // Handle on success condition with the decoded message.
            //console.log(`Scan result ${decodedText}`, decodedResult);
            //resultContainer.innerHTML += `<div>[${countResults}] - ${decodedText}</div>`;        
            // Optional: To close the QR code scannign after the result is found
            //html5QrcodeScanner.clear();            
        }
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", { 
            fps:80, qrbox:220, disableFlip:true,
            useBarCodeDetectorIfSupported: true,
            rememberLastUsedCamera: true,
            aspectRatio: 4/3,
            //showTorchButtonIfSupported: true,
            //showZoomSliderIfSupported: true,
            //defaultZoomValueIfSupported: 2
        });
    html5QrcodeScanner.render(onScanSuccess);
});    
</script>

<script src='plugins/multifile/jquery.MultiFile.js'></script>