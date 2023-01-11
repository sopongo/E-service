
<style type="text/css">

.ml20{ margin-left:-25px;}
</style>


<script src="plugins/autoNumeric/autoNumeric.js"></script>


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
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">เพิ่มหน่วยนับ<i class="fa fa-user-circle-o" aria-hidden="true"></i></h5>
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
                                        <div class="form-check-inline"><div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="status_use" name="status_unit" value="1" aria-describedby="inputGroupPrepend" required>
                                            <label class="custom-control-label text-success" for="status_use">ใช้งาน</label>                                   
                                        <div class="custom-control custom-radio d-inline">
                                            <input type="radio" class="custom-control-input" id="status_hold" name="status_unit" value="2" aria-describedby="inputGroupPrepend" required>
                                            <label class="custom-control-label text-danger" for="status_hold">ระงับใช้งาน</label>
                                            <div class="invalid-feedback ml20">กรอกชื่อไซต์งาน</div>
                                        </div></div>
                                    </div>
                                        
                                    </div>  
                                </div>  

                                <div class="col-sm-4 col-md-4 col-xs-4">  
                                    <div class="form-group">  
                                        <label for="firstname">ชื่อหน่วยนับ</label>  
                                        <input type="text" id="unit_name" name="unit_name" placeholder="ชื่อหน่วยนับ" class="form-control" aria-describedby="inputGroupPrepend" required />
                                        <div class="invalid-feedback">กรอกชื่อหน่วยนับ</div>
                                    </div>  
                                    </div>
                               </div>

                               <div class="row">  
                                <div class="col-sm-12 col-md-12 col-xs-12 mt-1">  
                                    <div class="form-group">  
                                        <label for="address">หมายเหตุ (ถ้ามี)</label>  
                                        <textarea class="form-control" rows="3" id="unit_remark" name="unit_remark" aria-describedby="inputGroupPrepend"></textarea>  
                                    </div>  
                                </div>  
                                </div>


                            <div class="row">  
                                <div class="col-sm-12 col-md-12 col-xs-12">  
                                    <div class="float-right">  
                                        <button type="button" class="btn btn-danger btn-close" data-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-success" id="addButton">บันทึก</button>
                                        <input type="hidden" name="action" value="addData">
                                        <input type="hidden" name="id_unit" id="id_unit" value="">
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
