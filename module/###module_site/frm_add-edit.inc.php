
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
   
    $(document).on('change keyup blur','input:radio[name=level_menu]',function(){ /*เช็คหมวดหลัก-ย่อย*/
	    var level_menu = $("input:radio[name=level_menu]:checked").val();
	    if(level_menu==2){
            $("#mainMenu").removeClass("d-none").show();
        }else{
            $("#mainMenu").addClass("d-none").hide();
        }
    });    

  });//document
</script>

<!-- add/edit form modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">เพิ่มไซต์งาน<i class="fa fa-user-circle-o" aria-hidden="true"></i></h5>
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

                               <div class="row div_status">
                                <div class="col-sm-12 col-md-12 col-xs-12 mt-1">  
                                    <div class="form-group">  
                                        <div class="form-group m-0 p-0"><label>สถานะการใช้งาน</label></div>                                        
                                        <div class="form-check-inline"><div class="custom-control custom-radio "><input type="radio" class="custom-control-input" id="status_use" name="status_location" value="1" aria-describedby="inputGroupPrepend"><label class="custom-control-label text-success" for="status_use">ใช้งาน</label></div></div>
                                        <div class="form-check-inline"><div class="custom-control custom-radio "><input type="radio" class="custom-control-input" id="status_hold" name="status_location" value="2" aria-describedby="inputGroupPrepend"><label class="custom-control-label text-danger" for="status_hold">ระงับใช้งาน</label></div></div>
                                    </div>  
                                </div>  

                                <div class="col-sm-4 col-md-4 col-xs-4">  
                                    <div class="form-group">  
                                        <label for="firstname">ชื่อไซต์งาน</label>  
                                        <input type="text" id="name_location" name="name_location" placeholder="ชื่อไซต์งาน" class="form-control" aria-describedby="inputGroupPrepend" required />
                                        <div class="invalid-feedback">กรอกชื่อไซต์งาน</div>
                                    </div>  
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-xs-5">  
                                    <div class="form-group">  
                                        <label for="firstname">ชื่อย่อไซต์งาน</label>  
                                        <input type="text" id="location_short" name="location_short" placeholder="ชื่อย่อไซต์งาน" class="form-control" aria-describedby="inputGroupPrepend" required />
                                        <div class="invalid-feedback">กรอกชื่อย่อไซต์งาน</div>
                                    </div>  
                                </div>                                      
                               </div>

                               <div class="row">  
                                <div class="col-sm-12 col-md-12 col-xs-12 mt-1">  
                                    <div class="form-group">  
                                        <label for="address">หมายเหตุ (ถ้ามี)</label>  
                                        <textarea class="form-control" rows="3" id="desc_location" name="desc_location" aria-describedby="inputGroupPrepend"></textarea>  
                                    </div>  
                                </div>  
                                </div>


                            <div class="row">  
                                <div class="col-sm-12 col-md-12 col-xs-12">  
                                    <div class="float-right">  
                                        <button type="button" class="btn btn-danger btn-close" data-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-success" id="addButton">บันทึก</button>
                                        <input type="hidden" name="action" value="addData">
                                        <input type="hidden" name="id_location" id="id_location" value="">
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
