<!-- profile modal start -->
<div class="modal fade" id="userViewModal" tabindex="-1" role="dialog" aria-labelledby="userViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-circle"></i> ใบเบิกเลขที่: <span class="title-req_no"></span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
        <div class="container" id="profile"><!-- id profile -->


        

<div class="invoice p-3 pt-0 mb-3">

<div class="row">
<div class="col-12 mt-0">
<h4>
<img src="dist/img/logo_2.png" alt="JWD Logo" class="brand-image" width="120" /> <strong>ใบเบิกวัสดุ-อุปกรณ์สำนักงาน</strong><small class="float-right txt-approve"><strong></strong></small>
</h4>
</div>

</div>



<div class="row invoice-info mt-4"><!--invoice-info-->

</div><!--invoice-info end-->


<div class="row">
<div class="col-12 table-responsive">
<table class="table table-striped" id="table-req">
<thead>
<tr>
<th>#</th>
<th>รหัสวัสดุอุปกรณ์</th>
<th>รูป</th>
<th>ชื่อวัสดุอุปกรณ์</th>
<th>จำนวนที่เบิก</th>
<th>จ่ายแล้ว</th>
<th>จ่าย</th>
</tr>
</thead>

<tbody><!-- row item -->
</tbody><!-- row item end-->
</table>
<hr />
</div><!-- col-12 table-responsive end -->
</div><!-- row end -->

<div class="row row-footer"><!-- row-footer -->
</div><!-- row-footer end -->


<div class="row no-print mt-3">
<div class="col-12">
<a rel="noopener" target="_blank" href="#" id="print-req" class="btn btn-default"><i class="fas fa-print"></i> พิมพ์</a>
</div>
</div>
</div>



        </div><!-- id profile end -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- profile modal end -->


      <!-- cutitem modal start -->
      <div class="modal fade" id="cutViewModal" tabindex="-1" role="dialog" aria-labelledby="userViewModalLabel" aria-hidden="true" style="margin-top:80px;">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-circle"></i> ตัดจ่าย วัสดุ-อุปกรณ์</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container" id="profile">

             
            <div class="container bg-light p-1 detail-req" style="line-height:1.2rem;">

            </div><!--detail-req end-->

                <!-- table total balance -->
                <div class="table-responsive">
                <table class="table table-bordered table-hover table-md text-nowrap table-fixed" id="lottable">
                <colgroup>
                  <col style="width:5%;">
                  <col style="width:15%;">
                  <col style="width:20%;">
                  <col style="width:25%;">
                  <col style="width:15%;">
                  <col style="width:30%;">
                </colgroup>            
                <thead class="thead-light">                
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">วันที่รับเข้า</th>
                    <th scope="col">เลขที่ PO</th>
                    <th scope="col">ลอต</th>
                    <th scope="col">คงเหลือ</th>
                    <th scope="col">จ่าย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
                </table>
                </div><!-- table total balance -->  
                  <p class="text-danger">- กรอกตัวเลขจำนวนที่ต้องการตัดจ่าย ลงในลอตที่ต้องการจากนั้นกด "จ่าย"<br />
                  - เมื่อจ่ายครบตามจำนวนแล้ว จะไม่สามารถตัดจ่ายซ้ำอีกได้<br />
                </p>
              </div><!--profile end-->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- profile modal end -->