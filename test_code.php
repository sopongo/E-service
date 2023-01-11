/*ปุ่ม ADD Recive รับวัสดุเข้าระบบ*/
  $(document).on("submit", ".addrcv", function (event) {//event
    event.preventDefault();
    var alertmsg =
      $("#id_offsupp").val().length > 0
        ? "เพิ่มรายการรับเข้าเรียบร้อยแล้ว"
        : "เพิ่มข้อมูลเรียบร้อยแล้ว";
        //alert(alertmsg); return false;        
    $.ajax({
      url: "module/module_warehouse/ajax_inven_action.php",
      type: "POST",
      dataType: "json",
      data: new FormData(this),
      processData: false,
      contentType: false,      
      beforeSend: function () {
        //$("#overlay").fadeIn();
      },
      success: function (row) {
        console.log(row);
          //return false;
          //$("#rcvModal").modal("hide"); 
          //$(".modal-backdrop").hide().fadeOut();
          //$("#overlay").fadeOut();
          //sweetAlert("สำเร็จ...", "รับวัสดุเข้าเรียบร้อยแล้ว", "success"); //The error will display
          func_getDatalist();
          //$('body').find('.was-validated').removeClass();
          //$('form').each(function() { this.reset() });
      },
      error: function () {
        console.log(row);
        console.log("ไม่สำเร็จ! มีบางอย่างผิดพลาด!");
      },
    });
  });