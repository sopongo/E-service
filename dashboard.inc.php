    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        
        <div class="card-header">
          <h5 class="display-10 d-inline-block font-weight-bold"><i class="fas fa-tools"></i> <?PHP echo $title_site;?></h5>
          <div class="card-tools">
            <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?PHP echo $breadcrumb_txt; ?></li>
            </ol>
          </div>
        </div>



        <div class="card-body">
        <div class="row">

                  
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h5>รออนุมัติ<br /></h5>
                <p>จำนวน ?? รายการ</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-cart"></i>
              </div>
              <a href="?module=requisition" class="small-box-footer">คลิกที่นี่ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h5>กำลังซ่อม<br /></h5>
                <p>จำนวน ?? รายการ</p>
              </div>
              <div class="icon">
                <i class="ion ion-home"></i>
                <ion-icon name="heart"></ion-icon>
              </div>
              <a href="?module=warehouse" class="small-box-footer">คลิกที่นี่ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->          

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>ใบแจ้งซ่อมที่ส่งมอบงานแล้ว</h5>
                <p>จำนวน ?? รายการ</p>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
              <a href="?module=requisitionlist" class="small-box-footer">คลิกที่นี่ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h5>รายการที่ยกเลิก, ปฏิเสธ</h5>
                <p>จำนวน ?? รายการ</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="?module=inventory" class="small-box-footer">คลิกที่นี่ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          </div>

        </div><!-- /.card-body -->
      </div><!-- /.card -->

    </section>
    <!-- /.content -->
