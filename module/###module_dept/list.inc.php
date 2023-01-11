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
            <h3 class="text-center text-gray"><br /><br /><br /><br /><br /><br /><br />coming soon<br /><br /><br /><br /><br /><br /></h3>
        </div><!-- /.card-body -->


      </div><!-- /.card -->

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