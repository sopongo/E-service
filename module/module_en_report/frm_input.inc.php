<script type="text/javascript">  

</script> 

<style type="text/css">
.text-size-1{
 font-size:0.90rem;
}
</style>


<div class="modal modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header">
        <p class="modal-title" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>กรอกข้อมูล</span></p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body p-0 py-2">

        <!--FORM 1-->
        <form id="needs-validation" class="addform" name="addform" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="">
        <div class="container">
            <div class="row">
            <button type="button" class="btn btn-block numpad bg-light btn-flat">7</button>
            <button type="button" class="btn btn-block numpad bg-light btn-flat">8</button>
            <button type="button" class="btn btn-block numpad bg-light btn-flat">9</button>
            <button type="button" class="btn btn-block numpad bg-light btn-flat">4</button>
            <button type="button" class="btn btn-block numpad bg-light btn-flat">5</button>
            <button type="button" class="btn btn-block numpad bg-light btn-flat">6</button>
            <button type="button" class="btn btn-block numpad bg-light btn-flat">1</button>
            <button type="button" class="btn btn-block numpad bg-light btn-flat">2</button>
            <button type="button" class="btn btn-block numpad bg-light btn-flat">3</button>
            <button type="button" class="btn btn-block numpad bg-light btn-flat">0</button>
            <button type="button" class="btn btn-block numpad bg-danger btn-flat"><i class="fas fa-arrow-left"></i></button>
            <button type="button" class="btn btn-block numpad bg-success btn-flat">OK</button>
            <button type="button" class="btn btn-block numpad btn-cel bg-warning btn-flat">-/+ °C</button>
            <button type="button" class="btn btn-block numpad bg-danger btn-flat">STOP</button>
            
            </div><!--row-->
        </div><!--container-->
            <input type="hidden" value="" name="id_row" id="id_row" />
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