<div class="modal fade" id="modal-outsite_repair" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-md">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>ส่งซ่อมภายนอก</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body-outsite_repair p-0 py-1">
    <?PHP
    
    ?>
    </div><!--modal-body-->
    <div class="modal-footer justify-content-between">
        <input type="submit" class="btn btn-primary btn-outsite_repair btn-success" value="บันทึก" />
        <input type="reset" class="btn btn-cancel btn-danger" data-dismiss="modal" value="ยกเลิก" />

        <!--<input type="submit" class="btn btn-block btn-success btn-md w-auto btn_report_result" value="บันทึก" />
        <input type="reset" class="btn btn-approved btn-danger" data-dismiss="modal" value="ยกเลิก" />-->
    </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal-default -->

<script>
$(document).ready(function(){
    $(document).on("click", ".btn_outsite_repair", function (e){ 
    e.stopPropagation();
    });
});
</script>