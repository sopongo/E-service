    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        
        <div class="card-header">
          <h4 class="display-10 d-inline-block font-weight-bold"><?PHP echo $title_act;?></h4>
          <div class="card-tools">
            <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>
        </div>


        <div class="card-body">
          กำลังจัดทำ 

          <div class="table-responsive">
<table class="table table-bordered text-white text-center table-fixed">
<thead>
<tr>
<th>#</th>
<th>Firstname</th>
<th>Age</th>
<th>Age</th>
<th>City</th>
<th>Country</th>
<th>Sex</th>
<th>City</th>
<th>Country</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<tr>
          <td class="align-middle">24.</td>    
          <td class="align-middle"><img src="uploads-offsupp/c6bb5305e6d3940d84f913de949c7599.jpg" class="w-40"></td>
          <td class="align-middle">PACA</td>
          <td class="align-middle">ST-OTH-0001</td>
          <td class="align-middle">ปลั๊กพ่วง 2ช่อง 16A 3500W  ยาว 10M</td>
          <td class="align-middle">วัสดุ-อุปกรณ์อื่นๆ  » ปลั๊กพ่วง</td>
          <td class="align-middle text-right">2,239</td>
          <td class="align-middle">ตัว</td>
          <td class="align-middle text-success">ใช้งานได้</td>
          <td class="align-middle">
          <div class="btn-group">
                <button type="button" class="btn btn-warning">Action</button>
                <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown"><span class="sr-only">Toggle Dropdown</span></button>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Separated link</a>
            </div>
          </div>
          <!--<a href="#" class="btn-sm btn-success view_offsupps" data-toggle="modal" data-target="#userViewModal" title="ดูข้อมูล" data-id="26">ดูข้อมูล</a>
          <a href="#" class="btn-sm btn-info rcv_action" data-toggle="modal" data-target="#rcvModal" title="รับเข้า" data-id="26">รับเข้า</a>
          <a href="#" class="btn-sm btn-secondary adj_action" data-toggle="modal" data-target="#adjModal" title="ปรับยอด" data-id="26">ปรับยอด</a>
          <a href="#" class="btn-sm btn-primary rtn_action" data-toggle="modal" data-target="#userModalx" title="รับคืน" data-id="26">รับคืน</a>
          <a href="#" class="btn-sm btn-warning edit_action" data-toggle="modal" data-target="#userModalx" title="แก้ไข" data-id="26">โอนย้าย</a>
          <a href="#" class="btn-sm btn-danger deleteuser" title="Delete" data-id="26">ลบ</a>-->
          </td>
        </tr>

</tbody>
</table>
</div>
          <!-- /
          <hr/>
          <a class="testxx">test 1</a>
          <hr/>
          <a class="test2">test 2</a>
          <hr/>
          <a class="test3">test 3</a>
          <hr/>
          <a class="test4">test 4</a>
          <hr/>
          <a class="test5">test 5</a>          
          -->


        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

    <script>
  
  $(document).on('click', '.test5', function () {

  });

    $(document).on('click', 'a.testxx', function(){
      sweetAlert("ผิดพลาด!", "ไม่สามารถลบข้อมูลได้", "error");
    });


    $(document).on('click', '.test2', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    swal({
            title: "Are you sure!",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes!",
            showCancelButton: true,
        },
        function() {
            alert('YESXXXXXXXXXXXXX');
            return false;
            /*$.ajax({
                type: "POST",
                url: "{{url('/destroy')}}",
                data: {id:id},
                success: function (data) {
                              //
                    }         
            });*/
    });
});    


  $(document).on('click', '.test3', function (e) {  
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this imaginary file!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Yes, I am sure!',
      cancelButtonText: "No, cancel it!",
      closeOnConfirm: false,
      closeOnCancel: false
      },
      function(isConfirm){
      //alert(isConfirm);
      if (isConfirm==true){
        swal("Shortlisted!", "Candidates are successfully shortlisted!", "success");
        return false;
        } 
        
        if(isConfirm==false) {
          swal("Cancelled", "Your imaginary file is safe :)", "error");
          e.preventDefault();
        }
    });
  });


  $(document).on('click', '.test4', function (e) {  
    swal({
    title: "An input!",
    text: "Write something interesting:",
    type: "input",
    showCancelButton: true,
    closeOnConfirm: false,
    animation: "slide-from-top",
    inputPlaceholder: "Write something"
    },
    function(inputValue){
      //alert(inputValue.length);
      if(inputValue==false){
        return false;
        e.preventDefault();      
      }
      if(inputValue==='') {
        //alert('xxxxxxx');
        swal.showInputError("You need to write something!");
        //swal("Cancelled", "Your imaginary file is safe :)", "error");
        e.preventDefault();      
        return false;
      }
      swal("Nice!", "You wrote: " + inputValue, "success");
    });
  });  





    </script>