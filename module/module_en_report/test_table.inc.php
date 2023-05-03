<style type="text/css">


.table-scroll {
  position: relative;
  width:100%;
  z-index: 1;
  margin: auto;
  overflow: auto;
  height:870px;
  border-top:1px solid #000; border-right:1px solid #000; 
}
.table-scroll table {
  width: 100%;
  min-width:900px;
  margin: auto;
  border-collapse: separate;
  border-spacing: 0;

}
.table-wrap {
  position: relative;
}
.table-scroll th,
.table-scroll td {
  padding: 5px 10px;
  border:none;
  background: #fff;
  vertical-align: top;
  border:1px solid #000; 
}
.table-scroll thead th {
  background: #eee;
  color: #333;
  position: -webkit-sticky;
  position: sticky;
  top: 0;
}

/* safari and ios need the tfoot itself to be position:sticky also */
.table-scroll tfoot,
.table-scroll tfoot th,
.table-scroll tfoot td {
  position: -webkit-sticky;
  position: sticky;
  bottom: 0;
  background: #eee;
  border:1px solid #000; 
  color: #333;
  z-index:4;
}

a:focus {
  background: red;
} /* testing links*/

th:first-child {
  position: -webkit-sticky;
  position: sticky;
  left: 0;
  z-index: 2;
  background: #eee;
  border-left:1px solid #000; border-bottom:1px solid #000;
}
thead th:first-child,
tfoot th:first-child {
  z-index: 5;
}

.main-table tbody tr td{ border-left:1px solid #000; border-bottom:1px solid #000;}


</style>


<!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        
        <div class="card-header">
          <h5 class="display-10 d-inline-block font-weight-bold"><i class="fas fa-tools"></i> <?PHP echo $title_site;?></h5>
          <div class="card-tools">
            <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?PHP echo $breadcrumb_txt; ?></li>
            </ol>
          </div>
        </div>

        <div class="card-body">

<div id="table-scroll" class="table-scroll">
  <table id="main-table" class="main-table" style="width:50%; float:left">

  <thead>
    <tr>
    <th rowspan="2" style="z-index:100">TIME</th>
    <th colspan="13">COMPESSOR 29</th>
    <th colspan="13">COMPESSOR 30</th>
    <th rowspan="2">Copy to</th>    
  </tr>
  <tr>
    <th>SP</th>
    <th>DP</th>
    <th>OP</th>
    <th>AFP</th>
    <th>ST</th>
    <th>DT</th>
    <th>OT</th>
    <th>DOP</th>
    <th>IT</th>
    <th>IP</th>
    <th>SVP</th>
    <th>LSV</th>
    <th>MA</th>
    <th>SP</th>
    <th>DP</th>
    <th>OP</th>
    <th>AFP</th>
    <th>ST</th>
    <th>DT</th>
    <th>OT</th>
    <th>DOP</th>
    <th>IT</th>
    <th>IP</th>
    <th>SVP</th>
    <th>LSV</th>
    <th>MA</th>
  </tr>
    </thead>

    <tbody>

        <?PHP
         for($i=1;$i<=26;$i++){
        ?>    
      <tr>
        <th>00.00</th>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>                
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>        
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>
        <td>00.00</td>        
        <td>00.00</td>        
      </tr>
        <?PHP
         }
        ?>           
    </tbody>
  </table>
</div>


        </div><!-- /.card-body -->
      </div><!-- /.card -->




    </section>
    <!-- /.content -->



<script type="text/javascript">  
</script> 
