    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        
        <div class="card-header">
            <h6 class="display-8 d-inline-block font-weight-bold"><i class="nav-icon fas fa-file-invoice"></i> <?PHP echo $title_act;?></h6>
            <div class="card-tools">
            <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><?PHP echo $breadcrumb_txt;?></li>
            </ol>
            </div>
        </div>


        <div class="card-body p-0 m-0">
        <?PHP
            switch($_SESSION['sess_class_user']){
                case 1:
                default;
                    include_once('module/module_howto/howto_user.inc.php');
                break;

                case 2:
                break;

                case 3:
                break;

                case 4:
                break; 

                case 5:
                break;
            }
        ?>
        </div><!-- /.card-body -->

        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->