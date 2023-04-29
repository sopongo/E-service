<script src="plugins/autoNumeric/autoNumeric.js"></script>
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
ul.numpad li{  width:29% ; padding:5px 5px; line-height:2.5rem; margin:5px 5px; text-align:left;  font-size:2rem; display:inline-block; 
    -webkit-border-radius:6px;
-moz-border-radius: 6px;
border-radius: 6px;
border:none; text-indent:10px;
background:#eaeaea; 
vertical-align:top;
}

ul.numpad li:hover{ background:#ddd; cursor: pointer;}
ul.numpad li.display_num{ width: 100%; margin: auto; }

ul.numpad li.btn_cel{ font-size:1.5rem; width: 31%; }
ul.numpad li.btn_stop, ul.numpad li.btn_start, ul.numpad li.btn_clear{ font-size:1.2rem;  width: 29%; }
ul.numpad li.btn_ok{ font-size:1.5rem;  width: 60%; }

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
                            <li class="bg-success no-select btn_ok">OK &crarr;</li>
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
/* เช็คแพทเทินค่าที่กรอกเข้ามา ไม่ให้มีตัวอักษร */
function validateStrings(string) {
	var pattern = /^[-0-9.]+$/;
	return $.trim(string).match(pattern) ? string : ''; //true false
}

$(document).ready(function(){
    
    $(document).keydown(function (event) {            
            var value = String.fromCharCode(event.which);
            var display_num = $('#display_num').val();
            var col_name = $('#col_name').val();
            if (event.which===8) {
                $('#display_num').val(display_num.slice(0,-1));
            }
            if (event.which===46) {
                $('#display_num').val('');
            }            
            if(event.which===13){
                if($.isNumeric(display_num)){
                    event.stopPropagation();
                    $('#'+col_name+'').val(display_num);
                    $('form#frm_input').trigger("reset");
                    $("#modal-default").modal("hide");  
                }else{
                    $('#'+col_name+'').val('');                    
                    sweetAlert("แจ้งเตือน", "กรอกค่าไม่ถูกต้อง", "warning");
                    return false;
                }
            }else{
                return true;
                //alert($(this).text());
            }
    });    

    $(document).keypress(function (event) {
        var value = validateStrings(String.fromCharCode(event.which));           
        var display_num = $('#display_num').val();
        //$('#display_num').val(event.which+'---'+value);
        event.preventDefault();
        if(display_num.length>=6 && event.which!=8){
            return false;
        }else{
            if (event.which===8) {
                $('#display_num').val(display_num.slice(0,-1));
            }else{
                $('#display_num').val(display_num+value);
                //alert($(this).text());
            }
        }
    });

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

        var btn_reset = '<button type="button" class="btn btn-success btn-sm btn-reset-stop" title="เคลียร์ค่า STOP"><i class="fa fa-xs fa-undo"></i></button>';

        $(document).on('click','.btn-reset-stop',function(e){ 
            var col_name = $('#col_name').val();
            var chk_col_name = col_name.slice(0,10);
            $('#'+col_name+'').closest('tr').find('td[class^='+chk_col_name+'] input').val('').show();

            if(chk_col_name=='col_com_29'){
                $('#'+col_name+'').closest('tr td:nth-child(2)').find('button.btn-reset-stop').remove();
            }else{
                $('#'+col_name+'').closest('tr td:nth-child(15)').find('button.btn-reset-stop').remove();
            }
            $('#'+col_name+'').closest('tr').find('td[class^='+chk_col_name+']').removeClass('td_stop');
        });

        $(document).on('click','.btn_stop',function(e){ 
            var col_name = $('#col_name').val();
            var chk_col_name = col_name.slice(0,10);
            $('#'+col_name+'').closest('tr').find('td[class^='+chk_col_name+'] input').val('').hide();
            if(chk_col_name=='col_com_29'){
                $('#'+col_name+'').closest('tr').find('td:nth-child(2)').append(btn_reset);
            }else{
                $('#'+col_name+'').closest('tr').find('td:nth-child(15)').append(btn_reset);
            }
            $('#'+col_name+'').closest('tr').find('td[class^='+chk_col_name+']').addClass('td_stop');
            $('#display_num').val('');
            $("#modal-default").modal("hide");
        });


        $(document).on('click','.btn_clear',function(e){ 
            var col_name = $('#col_name').val();
            //alert('xxxxx---'+col_name);
            e.stopPropagation();
            $('#display_num').val('');
            $('#'+col_name+'').val('');
            //$('form#frm_input').trigger("reset");
            //$("#modal-default").modal("hide");
        });                

        $(document).on('click','.btn_ok',function(e){ 
            e.stopPropagation();
            var col_name = $('#col_name').val();
            var display_num = $('#display_num').val();
            if($.isNumeric(display_num)){
                event.stopPropagation();
                $('#'+col_name+'').val(display_num);
                $('form#frm_input').trigger("reset");
                $("#modal-default").modal("hide");  
            }else{
                $('#'+col_name+'').val('');                    
                sweetAlert("แจ้งเตือน", "กรอกค่าไม่ถูกต้อง", "warning");
                return false;
            }
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
        

});//document
</script>