<style type="text/css"> 
</style>


<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="card">

<div class="card-header">
    <h2 class="display-8 d-inline-block font-weight-bold"><?PHP echo $title_act;?></h2>
    <div class="card-tools">
    <ol class="breadcrumb float-sm-right pt-1 pb-1 m-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard v1</li>
    </ol>
    </div>
</div>

<style type="text/css">
table.FM-EN-76-00{border-collapse: collapse; border-spacing:0px; 
    width:1200px;
    table-layout: fixed;
}
table.FM-EN-76-00 thead tr th, table.FM-EN-76-00 tbody tr td{ 
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}
table.FM-EN-76-00 thead tr th{ width:70px; text-align:center; }
table.FM-EN-76-00 thead tr th:first-child{ background-color:#cce7e8; width:5%;}
table.FM-EN-76-00 thead tr th:last-child{ background-color:#cce7e8; width:5%;}
table.FM-EN-76-00 tbody tr td{ padding:2px 2px; }
table.FM-EN-76-00 tbody tr td:nth-child(2){ background-color:#FF0000; width: 120px;} 
table.FM-EN-76-00 tbody tr:hover{ /*background-color:#cce7e8;*/ }
table.FM-EN-76-00 tbody tr td input{ width: 100%; border:none; padding:1px 1px; cursor:pointer; text-align:center; font-size:0.90rem;}
table.FM-EN-76-00 tbody tr td input:focus{ background-color:#cce7e8; border:none; outline: none;}
</style>

<div class="card-body">
<img src="module/module_en_report/img_test/FM-EN-76-00.jpg" class="img" width="1000">

<table class="FM-EN-76-00 table-bordered">
    <thead>
    <tr>
    <th rowspan="2">TIME</th>
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
  foreach($time_schedule as $key=>$value){
    echo '
    <tr>
    <td>'.($value<10 ? 0 : '').number_format($value,2).'</td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <td><input type="text" name="col_com_29_sp" id="col_com_29_sp" maxlength="10" class="xxxx"></td>
    <th>xxxxx</th>
  </tr>
    ';
  }
  ?>
    </tbody>
</table>

</div><!-- /.card-body -->

</div><!-- /.card -->

</section>
<!-- /.content -->

<script>
    
</script>