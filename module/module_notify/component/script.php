<!-- jQuery jQuery v3.6.0 -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script type="text/javascript"> 


    $(document).on("click", ".close, .btn-cancel", function (e){ /*ถ้าคลิกปุ่ม Close ให้รีเซ็ตฟรอร์ม และเคลียร์ validated*/
        $('body').find('.was-validated').removeClass();
        $('form').each(function() { this.reset() });
    });    

    $(document).ready(function () {
        $("#toggleVisibilityBtn").click(function () {
            var inputPassword = $("#sm_token");
            var eyeIcon = $("#eyeIcon");

            if (inputPassword.attr("type") === "password") {
                inputPassword.attr("type", "text");
                eyeIcon.removeClass("fa-eye-slash").addClass("fa-eye");
            } else {
                inputPassword.attr("type", "password");
                eyeIcon.removeClass("fa-eye").addClass("fa-eye-slash");
            }
        });
    });

</script>