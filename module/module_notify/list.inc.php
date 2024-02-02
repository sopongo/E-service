<?PHP
require_once __DIR__ . "/component/link.php";
require_once __DIR__ . "/component/style.php";

require_once __DIR__ . "/frame/v-modal.php";

?>

<!-- Main content -->
<div class="chk_chk"></div>
<section class="content">

    <!-- Default box -->
    <div class="card">
    
    <div class="card-header">
    <h6 class="display-8 d-inline-block font-weight-bold"><i class="fas fa-angle-double-right"></i> <?PHP echo $title_act;?></h6>
    <div class="card-tools">
    <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><?PHP echo $breadcrumb_txt;?></li>
    </ol>
    </div>
    </div>


    <div class="card-body">
      <div class="row">
      <div class="col-sm-12 p-0 m-0">

    <!--<a id="some_button" class="btn btn-danger">refesh</a>-->
    
    <table id="notifyTable" class="table table-bordered table-hover dataTable dtr-inline">
      <thead>
      <tr class="bg-light text-center">
        <th class="sorting_disabled" style="width:2%;">No</th>
        <th style="width:2%;">ชื่อย่อแผนก</th>
        <th style="width:10%;">ชื่อแผนก</th>
        <th style="width:2%;">ไซต์งาน</th>
        <th style="width:2%;">สถานะ</th>
        <th style="width:2%;">จัดการ</th>
      </tr>
      </thead>
      <tbody>
      </tbody>
    </table>

    </div>
    </div><!-- /.row -->

    </div><!-- /.card-body -->

    </div><!-- /.card -->   

</section>
<!-- /.content -->

<?PHP
require_once __DIR__ . "/component/script.php";
require_once __DIR__ . "/component/script_dataTable.php";
?>