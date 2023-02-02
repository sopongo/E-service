<style type="text/css"> 
</style>

<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="card">

<div class="card-header">
    <h5 class="display-10 d-inline-block font-weight-bold"><?PHP echo $title_act;?></h5>
    <div class="card-tools">
    <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard v1</li>
    </ol>
    </div>
</div>


<div class="card-body">


<div id="qr-reader" style="width:100%"></div>
<div id="qr-reader-results"></div>

</div><!-- /.card-body -->

</div><!-- /.card -->

</section>
<!-- /.content -->


<!--<script src="/html5-qrcode.min.js"></script>-->
<script src="plugins/html5-qrcode/html5-qrcode.min.v2.3.4.js"></script>
<!--<script src="https://scanapp.org/assets/js/html5-qrcode.min.v2.3.4.js"></script>-->


<script>
function docReady(fn) {
    // see if DOM is already available
    if (document.readyState === "complete"
        || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

docReady(function () {
    var resultContainer = document.getElementById('qr-reader-results');
    var lastResult, countResults = 0;
    function onScanSuccess(decodedText, decodedResult) {
        if (decodedText !== lastResult) {
            ++countResults;
            lastResult = decodedText;
            // Handle on success condition with the decoded message.
            console.log(`Scan result ${decodedText}`, decodedResult);
            resultContainer.innerHTML += `<div>[${countResults}] - ${decodedText}</div>`;
        
            // Optional: To close the QR code scannign after the result is found
            //html5QrcodeScanner.clear();
        }
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", { fps:80, qrbox:220, disableFlip:true });
    html5QrcodeScanner.render(onScanSuccess);
});    
</script>