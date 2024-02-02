<div class="modal fade" id="modal-notify" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>แก้ไขการแจ้งเตือน (Line Notify)</span></h5>
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
                    <div class="card-header bg-primary text-white p-2"><p class="card-title text-size-1">การแจ้งเตือนสรุปงานแจ้งซ่อม</p></div>
                    <div class="card-body p-3">

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-xs-12">
                                <div class="form-group">
                                    <label for="reservation_w">การแจ้งเตือน:</label>
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="icheck-success d-inline col-sm-12 col-md-6">
                                                <input type="radio" id="sm_notify1" name="sm_notify" value="1"
                                                    aria-describedby="inputGroupPrepend" required>
                                                <label for="sm_notify1">
                                                    แจ้งเตือนกลุ่มหลัก E-Service และ กลุ่มที่กำหนด
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline col-sm-12 col-md-6">
                                                <input type="radio" id="sm_notify2" name="sm_notify" value="3"
                                                    aria-describedby="inputGroupPrepend" required>
                                                <label for="sm_notify2">
                                                    แจ้งเตือนกลุ่มหลัก E-Service
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline col-sm-12 col-md-6">
                                                <input type="radio" id="sm_notify3" name="sm_notify" value="2"
                                                    aria-describedby="inputGroupPrepend" required>
                                                <label for="sm_notify3">
                                                    แจ้งเตือนกลุ่มที่กำหนด
                                                </label>
                                            </div>
                                            <div class="icheck-danger d-inline col-sm-12 col-md-6">
                                                <input type="radio" id="sm_notify4" name="sm_notify" value="0"
                                                    aria-describedby="inputGroupPrepend" required>
                                                <label for="sm_notify4">
                                                    ปิดการแจ้งเตือน
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--row-1-->

                        <div class="row row-1">
                            <div class="col-sm-12 col-md-12 col-xs-12">
                                <div class="form-group">
                                    <label for="reservation_w">วันที่ต้องการให้แจ้งเตือน: <code>**จะทำการแจ้งเตือนในเวลา 16.30 น.</code></label>
                                    <div class="form-group clearfix">
                                        <div class="row">
                                            <div class="icheck-primary d-inline col-sm-6 col-md-3">
                                                <input type="checkbox" id="sm_date1" name="sm_date" value="7"
                                                    aria-describedby="inputGroupPrepend" required>
                                                <label for="sm_date1">
                                                    อาทิตย์
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline col-sm-6 col-md-3">
                                                <input type="checkbox" id="sm_date2" name="sm_date" value="1"
                                                    aria-describedby="inputGroupPrepend" required>
                                                <label for="sm_date2">
                                                    จันทร์
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline col-sm-6 col-md-3">
                                                <input type="checkbox" id="sm_date3" name="sm_date" value="2"
                                                    aria-describedby="inputGroupPrepend" required>
                                                <label for="sm_date3">
                                                    อังคาร
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline col-sm-6 col-md-3">
                                                <input type="checkbox" id="sm_date4" name="sm_date" value="3"
                                                    aria-describedby="inputGroupPrepend" required>
                                                <label for="sm_date4">
                                                    พุธ
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline col-sm-6 col-md-3">
                                                <input type="checkbox" id="sm_date5" name="sm_date" value="4"
                                                    aria-describedby="inputGroupPrepend" required>
                                                <label for="sm_date5">
                                                    พฤหัส
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline col-sm-6 col-md-3">
                                                <input type="checkbox" id="sm_date6" name="sm_date" value="5"
                                                    aria-describedby="inputGroupPrepend" required>
                                                <label for="sm_date6">
                                                    ศุกร์
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline col-sm-6 col-md-3">
                                                <input type="checkbox" id="sm_date7" name="sm_date" value="6"
                                                    aria-describedby="inputGroupPrepend" required>
                                                <label for="sm_date7">
                                                    เสาร์
                                                </label>
                                            </div>

                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--row-1-->

                        <div class="row ">
                            <div class="col-sm-6 col-md-6 col-xs-6">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="sm_token" name="sm_token"
                                        placeholder="Line Access Token..." value="<?php echo "sadsadsadasd"?>"
                                        aria-describedby="inputGroupPrepend" autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary form-control" type="button" id="toggleVisibilityBtn">
                                            <i class="fa fa-eye-slash justify-content-center align-middle pb-2" id="eyeIcon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div><!--row-4-->

                    </div><!--card-body id_mt_type, name_mt_type, ref_id_dept, mt_type_remark, status_mt_type-->
                </div><!--card-->

            </div>                

            </div><!--row-->
        </div><!--container-->
            <input type="hidden" value="" name="id_vehicle_driver" id="id_vehicle_driver" />
        </form>
        <!--FORM 1-->

    </div><!--modal-body-->
    <div class="modal-footer justify-content-between">
        <input type="submit" class="btn btn-primary btn-submit-vehicle_driver btn-success" value="บันทึก" />
        <input type="reset" class="btn btn-cancel btn-danger" data-dismiss="modal" value="ยกเลิก" />
    </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal-default -->
