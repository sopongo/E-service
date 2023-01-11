<style type="text/css"> 
</style>


<!-- Main content -->
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

Content

<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default-tab" id="addData" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus-circle"></i> Test Modal TAB</button>

<div class="modal fade" id="modal-default-tab" tabindex="-1" role="dialog" aria-labelledby="dataformLabel" aria-hidden="true">
<div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-angle-double-right"></i> <span>ผู้ใช้งาน</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body p-0 py-2">
        <div class="container">
        <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card card-gray card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-1" data-toggle="pill" href="#custom-tabs-content-1" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Tab-1</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link tab-2" id="custom-tabs-2" data-toggle="pill" href="#custom-tabs-content-2" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Tab-2</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-3" data-toggle="pill" href="#custom-tabs-content-3" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Tab-3</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-4" data-toggle="pill" href="#custom-tabs-content-4" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Tab-4</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade active show" id="custom-tabs-content-1" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                     ...TAB-1
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-content-2" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                     ...TAB-2
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-content-3" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                     ...TAB-3
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-content-4" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                     ...TAB-4
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
        </div>

    </div><!--modal-body-->
    </div><!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal-default -->



</div><!-- /.card-body -->

</div><!-- /.card -->

</section>
<!-- /.content -->

<script>


$(document).on("click", "#custom-tabs-2", function (){    
    $.ajax({
        url: "module/module_user/ajax_action.php",
        type: "POST",
        data:{"action":"getdata"},
        beforeSend: function () {
        },
        success: function (data) {
            console.log(data);
            $('#custom-tabs-content-2').html(data);
            event.preventDefault();
        },
            error: function (jXHR, textStatus, errorThrown) {
            //console.log(data);
            alert(errorThrown);
        }
    });  
});

</script>