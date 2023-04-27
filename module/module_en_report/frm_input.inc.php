<script type="text/javascript">  

</script> 


<style type="text/css">

.no-select {
  -webkit-user-select: none; /* Safari */
  -ms-user-select: none; /* IE 10 and IE 11 */
  user-select: none; /* Standard syntax */
}
.text-size-1{ font-size:0.90rem;}

.display_num:disabled{ background-color:#FFF;}

ul.numpad{ width: 100%; padding: 0; margin: 0; list-style: none;}
ul.numpad li{  width:29% ; padding:7px 5px; margin:5px 5px; text-align:left;  font-size:2rem; display:inline-block;
    -webkit-border-radius:6px;
-moz-border-radius: 6px;
border-radius: 6px;
border:none; text-indent:10px;
background:#eaeaea; 
vertical-align:top;
}

ul.numpad li:hover{ background:#ddd; cursor: pointer;}
ul.numpad li.display_num{ width: 100%; margin: auto; }

ul.numpad li.btn_cel{ font-size:1.5rem; padding:15px 5px;  width: 31%; }
ul.numpad li.btn_stop, ul.numpad li.btn_start, ul.numpad li.btn_clear{ font-size:1.2rem;  width: 29%; padding:15px 5px;}
ul.numpad li.btn_ok{ font-size:1.5rem;  width: 60%; padding:15px 5px;}

ul.numpad li.btn_text{ font-size:1rem; width:97%;}

input.display_num{ font-size:2rem; font-weight:bold; width:100%; display: block; border:1px solid #DDD;  text-align:right; padding-right:8px;
    -webkit-border-radius:6px;
-moz-border-radius: 6px;
border-radius: 6px;
-webkit-user-select: none; /* Safari */
  -ms-user-select: none; /* IE 10 and IE 11 */
  user-select: none; /* Standard syntax */
}
</style>

<div class="modal modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>กรอกข้อมูล</span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body p-0 py-2">

        <!--FORM 1-->
        <form id="frm_input" class="addform" name="frm_input" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xs-12">  
                    <div class="form-group mb-2">
                        <ul class="numpad">
                            <li class="display_num"><input type="text" class="d-block display_num no-select" id="display_num" name="display_num" maxlength="5" readonly disabled value="" /></li>
                            <li class="numpad-7 no-select">7</li>
                            <li class="numpad-8 no-select">8</li>
                            <li class="numpad-9 no-select">9</li>
                            <li class="numpad-4 no-select">4</li>
                            <li class="numpad-5 no-select">5</li>
                            <li class="numpad-6 no-select">6</li>
                            <li class="numpad-1 no-select">1</li>
                            <li class="numpad-2 no-select">2</li>
                            <li class="numpad-3 no-select">3</li>
                            <li class="numpad-0 no-select">0</li>
                            <li class="numpad-dot no-select">.</li>
                            <li class="bg-danger no-select btn_del"><i class="fas fa-arrow-left"></i></li>
                            <li class="bg-warning no-select btn_cel">-/+ °C</li>
                            <li class="bg-success no-select btn_ok">OK</li>
                            <li class="bg-danger btn_stop">STOP</li>
                            <li class="bg-success btn_start">START</li>
                            <li class="bg-warning btn_clear">CLEAR</li>
                            <!--<li class="bg-gray btn_text">พิมพ์ข้อความ</li>-->
                        </ul>
                        <input type="text" name="col_name" id="col_name" value="" />
                    </div>
                </div>
            </div><!--row-->
        </div><!--container-->
        </form>
        <!--FORM 1-->

    </div><!--modal-body-->

    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal-default -->

<script type="text/javascript">

$(document).ready(function(){

        $(document).on('click','li[class^=numpad]',function(e){ 
            e.stopPropagation();
            var display_num = $('#display_num').val();
            if($('#display_num').val().length>5){
                return false;
            }else{
                $('#display_num').val(display_num+$(this).text());
                //alert($(this).text());
            }
        });

        $(document).on('click','.btn_ok',function(e){ 
            var col_name = $('#col_name').val();
            //alert('xxxxx---'+col_name);
            e.stopPropagation();
            var display_num = $('#display_num').val();
            $('form#frm_input').trigger("reset");
            $('#'+col_name+'').val(display_num);
            $("#modal-default").modal("hide");
        });            

        $(document).on('click','.btn_del',function(e){ 
            e.stopPropagation();
            var display_num = $('#display_num').val();
            //display_num = display_num.slice(0,-1);
            $('#display_num').val(display_num.slice(0,-1));
        });    

        $(document).on('click','.btn_cel',function(e){ 
            e.stopPropagation();
            var display_num = $('#display_num').val();
            //alert(display_num.slice(0,1)); return false;
            if(display_num.slice(0,1)=='-'){
                //alert('มีลบ');
                var display_num = display_num.substring(1, display_num.length);
                //display_num = display_num.slice(1,1);
                $('#display_num').val(display_num);
            }else{
                //alert('ไม่มีลบ');
                $('#display_num').val('-'+display_num);
            }
            //display_num = display_num.slice(0,-1);
        });                
        

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
            url: "module/module_site/x_ajax_action.php",
            type: "POST",
            data:{"data":frmData, "action":"adddata"},
            beforeSend: function () {
            },
            success: function (data) {
            console.log(data);
            if(data==1){
                sweetAlert("ผิดพลาด!", "ชื่อย่อไซต์ '"+$("#site_initialname").val()+"' ถูกใช้แล้ว", "error");
                return false;
            }else{
                sweetAlert("สำเร็จ...", "บันทึกข้อมูลเรียบร้อยแล้ว", "success"); //The error will display
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