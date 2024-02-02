<script type="text/javascript"> 

  $('#some_button').click(function refreshData() {
    $('#notifyTable').DataTable().ajax.reload();
  });

  $(document).ready(function () {
        
        $('#notifyTable').DataTable({
               "processing": true,
               "serverSide": true,
               "order": [0, 'asc'], //ถ้าโหลดครั้งแรกจะให้เรียงตามคอลัมน์ไหนก็ใส่เลขคอลัมน์ 0,'desc'
               "aoColumnDefs": [{
                       "bSortable": false,
                       "aTargets": [0, 1, 4]
                   }, //คอลัมน์ที่จะไม่ให้ฟังก์ชั่นเรียง
                   {
                       "bSearchable": false,
                       "aTargets": [0]
                   } //คอลัมน์ที่จะไม่ให้เสิร์ช
               ],
               ajax: {
                   beforeSend: function () {
                       //จะให้ทำอะไรก่อนส่งค่าไปหรือไม่
                   },
                   url: 'module/module_notify/function/f-table.php',
                   type: 'POST',
                   data: function (data) {
                       data.formData = $('#ListForm').serialize();
                       data.action = 'list';
                   },
                   async: false,
                   cache: false,
                   error: function (xhr, error, code) {
                       console.log(xhr, code);
                   },
               },
               "paging": true,
               "lengthChange": true, //ออฟชั่นแสดงผลต่อหน้า
               "pagingType": "simple_numbers",
               "pageLength": 10,
               "searching": true,
               "ordering": true,
               "info": true,
               "autoWidth": false,
               "scrollX": true,
               // "responsive": true,
           });
   
       });
</script>