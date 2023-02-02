<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


<!-- SELECT2 EXAMPLE -->
<div class="card card-default">
    <div class="card-header">
    <h3 class="card-title">Select2 (Default Theme)</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
            <label>Minimal</label>
            <select class="form-control select2" style="width: 100%;">
            <option selected="selected">Alabama</option>
            <option>Alaska</option>
            <option>California</option>
            <option>Delaware</option>
            <option>Tennessee</option>
            <option>Texas</option>
            <option>Washington</option>
            </select>
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label>Disabled</label>
            <select class="form-control select2" disabled="disabled" style="width: 100%;">
            <option selected="selected">Alabama</option>
            <option>Alaska</option>
            <option>California</option>
            <option>Delaware</option>
            <option>Tennessee</option>
            <option>Texas</option>
            <option>Washington</option>
            </select>
        </div>
        <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
        <div class="form-group">
            <label>Multiple</label>
            <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
            <option>Alabama</option>
            <option>Alaska</option>
            <option>California</option>
            <option>Delaware</option>
            <option>Tennessee</option>
            <option>Texas</option>
            <option>Washington</option>
            </select>
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label>Disabled Result</label>
            <select class="form-control select2" style="width: 100%;">
            <option selected="selected">Alabama</option>
            <option>Alaska</option>
            <option disabled="disabled">California (disabled)</option>
            <option>Delaware</option>
            <option>Tennessee</option>
            <option>Texas</option>
            <option>Washington</option>
            </select>
        </div>
        <!-- /.form-group -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <h5>Custom Color Variants</h5>
    <div class="row">
        <div class="col-12 col-sm-6">
        <div class="form-group">
            <label>Minimal (.select2-danger)</label>
            <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
            <option selected="selected">Alabama</option>
            <option>Alaska</option>
            <option>California</option>
            <option>Delaware</option>
            <option>Tennessee</option>
            <option>Texas</option>
            <option>Washington</option>
            </select>
        </div>
        <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6">
        <div class="form-group">
            <label>Multiple (.select2-purple)</label>
            <div class="select2-purple">
            <select class="select2" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                <option>Alabama</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
            </select>
            </div>
        </div>
        <!-- /.form-group -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.card-body -->

</div>
<!-- /.card -->


<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
    });

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });
</script>

