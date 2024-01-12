<!-- 
<script>
     $(document).ready(function () {
        html2canvas(document.getElementById("picture")).then(function (canvas) {
            var imgData = canvas.toDataURL("image/png");

            // Send the image data to the server using AJAX with jQuery
            $.ajax({
                type: "POST",
                url: "function/f-saveimg.php",
                data: { imgData: imgData },
                success: function (response) {
                    console.log(response);
                    // console.log("Image saved successfully!");
                },
                error: function (xhr, status, error) {
                    console.error("Error saving image: " + error);
                }
            });
        });
    });
</script> -->