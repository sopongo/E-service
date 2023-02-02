<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="dist/css/jquery.uploader.css?ver=1"  rel="stylesheet" type="text/css">

<style type="text/css"> 

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
                    <div class="card-header bg-primary text-white p-2"><p class="card-title text-size-1 xxxxxxw">กรอกรายละเอียด</p></div>
                    <div class="card-body p-3"> 

                    <div class="row row-1">
                        <div class="col-sm-4 col-md-4 col-xs-4">  
                            <div class="form-group">
                                    <div id="qr-reader" style="width:100%"></div>
                                    <div id="qr-reader-results"></div>
                            </div>
                        </div>
                    </div><!--row-1 -->

                    <div class="row row-2 d-block">
                            <div class="col-sm-4 col-md-4 col-xs-4 p-0 m-0">  
                            <div class="form-group">
                                <label><span class="text-danger">**</span> แจ้งซ่อมไปที่แผนก: </label> 
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
                                <label for="firstname"><span class="text-red font-size-sm">**</span> เครื่องจักร/อุปกรณ์</label>  
                                <select id="slt_machine" class="select2 custom-select pb-5" style="width: 100%;">
                                <option disable selected>เลือกแผนกที่รับผิดชอบก่อน</option>
                                <option>Alabama</option>
                                <option>Alaska</option>
                                <option value="6970701070012">6970701070012</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option value="KERPU023088758 1 1 SAS01">KERPU023088758 1 1 SAS01</option>
                                <option>Texas</option>
                                <option>Washington</option>
                                <option value="P1001812043776">P1001812043776</option>            
                                </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                    </div><!--row-2 -->

                        <div class="row row-4">
                            <div class="col-sm-4 col-md-4 col-xs-4">  
                                <div class="form-group">  
                                    <label for="firstname"><span class="text-red font-size-sm">**</span> อาการเสีย/ปัญหาที่พบ:</label>  
                                    <textarea class="form-control" rows="5" id="site_initialname" name="site_initialname" placeholder="Enter ..." required></textarea>
                                    <div class="invalid-feedback">กรอกชื่อย่อไซต์งาน</div>
                                </div>
                            </div>
                        </div><!--row-4-->

                        <div class="row row-4">
                            <div class="col-sm-6 col-md-6 col-xs-6">  
                                <div class="form-group">  
                                    <label for="firstname"><span class="text-red font-size-sm">**</span> ภาพถ่ายอาการเสีย / ปัญหาที่พบ:</label>  
                                    <ul>
        <li>
            <i>Multiple File Upload</i>
            <input type="text" id="demo1" value="">
        </li>
    </ul>
                                </div>
                            </div>
                        </div><!--row-4-->                        

                        <div class="row row-5 mt-2">
                            <div class="col-sm-5 col-md-5 col-xs-5">
                                    <label for="firstname">เกี่ยวกับความปลอดภัย:</label>  <br />
                                    <div class="icheck-danger d-inline">
                        <input type="checkbox"  id="checkboxDanger3">
                        <label for="checkboxDanger3">แจ้ง จป. เพื่อตรวจสอบก่อนและหลังแก้ไข</label>
                      </div>                                    
                            </div>
                        </div><!--row-5-->

                        <div class="row row-1 mt-3">
                        <div class="col-sm-12 col-md-12 col-xs-12">  
                            <div class="form-group mb-2">
                                <label class="d-block">ความเร่งด่วน: </label> 
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="status_use" name="status_machine" value="1" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-success" for="status_use">ไม่เร่งด่วน</label></div></div>
                                <div class="form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="status_hold" name="status_machine" value="2" aria-describedby="inputGroupPrepend" required><label class="custom-control-label text-danger w-auto d-inline" for="status_hold">ด่วน</label><div class="invalid-feedback float-right w-auto pl-3">เลือกสถานะการใช้งาน</div></div></div>
                            </div>
                        </div>  
                        </div><!--row-1-->

                        <div class="row row-5 mt-2">
                            <div class="col-sm-3 col-md-3 col-xs-3">
                                <div class="form-group">  
                                    <label for="firstname">ผู้แจ้งซ่อม:</label>  
                                    <input type="text" id="site_name" name="site_name" readonly="true" placeholder="ชื่อไซต์งาน" class="form-control" aria-describedby="inputGroupPrepend" required />
                                    <div class="invalid-feedback">กรอกชื่อไซต์งาน</div>
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

</div><!-- /.card-body -->

</div><!-- /.card -->
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</section>
<!-- /.content -->


<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
<script src="plugins/uploader/jquery.uploader.min.js"></script>

<script type="application/javascript">
let ajaxConfig = {
    ajaxRequester: function (config, uploadFile, pCall, sCall, eCall) {
        let progress = 0
        let interval = setInterval(() => {
            progress += 10;
            pCall(progress)
            if (progress >= 100) {
                clearInterval(interval)
                const windowURL = window.URL || window.webkitURL;
                sCall({
                    data: windowURL.createObjectURL(uploadFile.file)
                })
            }
        }, 300)
    }
}
$("#demo1").uploader({
    multiple: true, 
    ajaxConfig: ajaxConfig,
    autoUpload: true
    });
</script>

<script src="plugins/html5-qrcode/html5-qrcode.min.v2.3.4.js"></script>
<!--<script src="https://scanapp.org/assets/js/html5-qrcode.min.v2.3.4.js"></script>-->

<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
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
        $('#slt_machine option[value='+decodedText+']').prop('selected', true);
        $('#slt_machine option[value='+decodedText+']').attr('selected', 'selected');
        $('#select2-slt_machine-container').html(decodedText);
        $.ajax({
        url: "module/module_maintenance_list/chk_qrcode.inc.php",
        type: "POST",
        data:{"action":"chk_qr","qrcode":decodedText},
        beforeSend: function () {
        },
        success: function (data) {
            console.log(data);
            $('#site_name').val(data);
            $('#slt_machine').append(data);
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
        "qr-reader", { fps:80, qrbox:220, disableFlip:true });
    html5QrcodeScanner.render(onScanSuccess);
});    
</script>