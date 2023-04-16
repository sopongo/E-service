<?PHP

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>QR code Generator</title>
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<style>
  @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@400&display=swap');
</style>
<style type="text/css">
  body{
      font-size:0.85rem;
      /*font-family: "Noto Sans Thai",sans-serif;*/
      font-family: 'Sarabun', sans-serif;
      font-style: normal;
      font-weight:500;
  }
  .ul_label{ width: 100%; padding:none; margin:none; }
  .ul_label li{ width: 28%; border: solid 1px #000000; list-style:none; display:inline-block; margin-right:20px; margin-bottom:20px;
    padding:5px 5px; text-align:center; font-size:1.0rem; height:340px; overflow:hidden;  background:#FFF; vertical-align:top;
 }
 .title{ width: 100%; background:#EAEAEA; text-align:center; padding:10px 0px; margin:0px;}
 .ul_label li img{ display:block; margin:auto;}
  
@page {
    size:    A4 portrait;
  margin:10mm;
}
@media print {
  html, body {
    width:   210mm;
  height:  297mm;
  }
}  

@media all {
    .page-break { display: none; }
}

@media print {
    .page-break { display: block; page-break-before: always; }
}
</style>
</head>

<body>
<?PHP
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'upload-qrcode'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'upload-qrcode/';

    include "php_qrcode/qrlib.php";    
    //echo "<pre>"; print_r($_POST); echo "</pre>";
    //echo "<pre>";        print_r($_POST['gen_qrcode']);        echo "</pre>";
    /*
Array
(
    [example1_length] => 10
    [search] => 
    [gen_qrcode_all] => gen_qrcode_all
    [gen_qrcode] => Array
        (
            [0] => 1775
            [1] => 1773
            [2] => 1772
            [3] => 1771
            [4] => 1770
            [5] => 1769
            [6] => 1768
            [7] => 1767
            [8] => 1766
            [9] => 1765
        )

)
Array
(
    [0] => 1775
    [1] => 1773
    [2] => 1772
    [3] => 1771
    [4] => 1770
    [5] => 1769
    [6] => 1768
    [7] => 1767
    [8] => 1766
    [9] => 1765
)
    */

    $errorCorrectionLevel = 'L';
    $_REQUEST['level'] = 'L';
    $matrixPointSize = 5;

$i = 1;
foreach($_POST['gen_qrcode'] as $key=>$value){
    if($i==1){
        echo '<ul class="ul_label">';
    }
    //echo $value."<hr />";
    $rowData = $obj->customSelect("SELECT tb_machine_site.*, tb_machine_master.* FROM tb_machine_site 
    LEFT JOIN tb_machine_master ON(tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
    WHERE tb_machine_site.id_machine_site=".$value."");
    echo '<li><h4 class="title">QR Code แจ้งซ่อม (E-Service)</h4>';
    $_REQUEST['data'] = $rowData['code_machine_site'];
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    
    
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);
    
    if (isset($_REQUEST['data'])) { 
    
        //it's very important!
        if (trim($_REQUEST['data']) == '')
            die('data cannot be empty! <a href="?">back</a>');
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
    } else {    
        //default data
        //echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
    }    
        
    //display generated file
    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';  //width="120" height="120" 
    echo 'รหัสเครื่องจักร/อุปกรณ์: <strong>'.$rowData['code_machine_site'].'</strong>';
    echo "<br />";
    echo '('.$rowData['name_machine'].')';    
    echo "<br /><br />แผนกที่รับผิดชอบ: xxxxxxx <br />สอบถามโทร: 1234";
    echo '</li>';
    if($i==9){
        echo '</ul><div class="page-break"></div>';
        $i=1;
    }else{
        $i++;
    }
}

?>
</body>
</html>

