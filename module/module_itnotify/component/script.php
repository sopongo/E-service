<!-- jQuery jQuery v3.6.0 -->
<script src="../../plugins/jquery/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script> $.widget.bridge('uibutton', $.ui.button) </script>

<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>

<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>

<script src="../../dist/js/pcs_demo.js"></script>

<script src="../../dist/js/script.js"></script>

<script src="../../plugins/sweetalert/sweetalert.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- bootstrap color picker -->
<script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

        var Donutdata = google.visualization.arrayToDataTable([
            ['สถานะใบแจ้งซ่อม', 'จำนวนใบแจ้งซ่อม'],
            ['ไม่มีข้อมูล',    75],
        ]);

        var Donutoptions = {
            chartArea: {'width': '99%', 'height': '99%'},
            pieSliceText: 'none',
            tooltip: { trigger: 'none' },
            slices: {
              0: { color: 'grey' },
            },
            pieHole: 0.35,
            legend: 'none',
          };

          var donutchart = new google.visualization.PieChart(document.getElementById('donutchart'));
          google.visualization.events.addListener(donutchart, 'ready', function () {
            function adjustTextSize() {

              var svgElement = document.querySelector('#donutchart svg');
              var chartWidth = svgElement.clientWidth;
              var chartHeight = svgElement.clientHeight;
              var totalSumText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
              var fontSize = Math.min(chartWidth, chartHeight) * 0.1;
              var fontSize2 = Math.min(chartWidth, chartHeight) * 0.05;

              totalSumText.setAttribute('x', '50%');
              totalSumText.setAttribute('y', '45%');
              totalSumText.setAttribute('text-anchor', 'middle');
              totalSumText.setAttribute('dominant-baseline', 'central');
              totalSumText.setAttribute('font-size', fontSize);
              totalSumText.setAttribute('font-weight', 'bold');
              totalSumText.textContent = 0;
              svgElement.appendChild(totalSumText);

              var totalText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
              totalText.setAttribute('x', '50%');
              totalText.setAttribute('y', '55%');
              totalText.setAttribute('text-anchor', 'middle');
              totalText.setAttribute('dominant-baseline', 'middle');
              totalText.setAttribute('font-size', fontSize2);
              totalText.textContent = 'ทั้งหมด';
              svgElement.appendChild(totalText);
            }

          adjustTextSize();
          
         // Add an event listener to recalculate font size on window resize
         window.addEventListener('resize', function () {
            var svgElement = document.querySelector('#donutchart svg');
            svgElement.removeChild(svgElement.lastChild); // Remove the existing text
            adjustTextSize();
          });

          });
          donutchart.draw(Donutdata, Donutoptions);
        }
    </script> -->

