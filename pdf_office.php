<?PHP
session_start();
<<<<<<< Updated upstream
//include_once('include/function.inc.php');
//include_once('include/connect.inc.php');
//include_once('include/config.inc.php');
=======
include_once('include/function.inc.php');
include_once('include/connect.inc.php');
//include_once('include/config.inc.php');
include_once('include/class_crud.inc.php');
include_once('include/setting.inc.php');
>>>>>>> Stashed changes
include_once('tcpdf/tcpdf.php');
//include_once('include/system.inc.php');
//include_once('include/language.inc.php');
ob_clean();// ถ้าไม่ใส่จะมีปัญหาการ include_once ไฟล์อื่นเข้ามา

//$fontname = TCPDF_FONTS::addTTFfont('fonts/PSL005_1.TTF', 'TrueTypeUnicode', '', 96);
//$fontname_bold = TCPDF_FONTS::addTTFfont('fonts/PSL005_1.TTF', 'TrueTypeUnicode', 'B', 100,'B');

<<<<<<< Updated upstream

class MYPDF extends TCPDF {
    //Page header
    public function Header() {
		global $img;		
        // Logo
        //$image_file = 'logo_2.png'; // *** Very IMP: make sure this image is available on given path on your server
		//$img = @imagecreatefrompng($image_file);
        // Set font
		//http://fonts.snm-portal.com/
		
		$this->SetFont('thsarabun', '', 12, '', false);
		$this->setCellHeightRatio(1.1);		
        $this->SetY(5);
        $this->writeHTML('<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
		<tr>
		<td width="70%" style="text-align: left; vertical-align:middle;"><strong style="font-size:22px;"><img src="logo_pdf.jpg" style="border:none; " border="0" width="100" /><br />บริษัท แปซิฟิค ห้องเย็น จำกัด (มหาชัย)</strong>
		<br />47/19 หมู่ 2 ตำบลนาดี อำเภอเมือง จังหวัด สมุทรสาคร 74000 โทร. (+66) 3411-789-9</td>
		<td width="30%" style="text-align:right; vertical-align:middle;"><strong style="font-size:24px;">ใบแจ้งซ่อม แผนก: {data}</strong><br /><span style="font-size:18px;">เลขที่ใบแจ้งซ่อม: xxxxxx<br />วันที่แจ้งซ่อม: DD/MM/YYYY</span>
		<span style="text-align:right; vertical-align:middle;">'.$this->getAliasNumPage().'of'. $this->getAliasNbPages().'</span>
		<div style="font-size:18px;">สถานะใบแจ้งซ่อม: {data status}</div></td>
=======
$id_req = $_GET['idreq'];
$obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ
$rowData = $obj->customSelect("SELECT tb_maintenance_request.*, tb_maintenance_type.name_mt_type, tb_maintenance_request.ref_id_dept_responsibility AS id_dept_responsibility, tb_dept_responsibility.dept_initialname AS dept_responsibility,
tb_user_request.no_user, tb_user_request.email, tb_user_request.fullname, tb_user_request.ref_id_dept AS ref_id_dept_request, tb_user_dept_request.dept_initialname AS dept_user_request,
tb_user_cancel.fullname AS cancel_fullname, tb_user_approved.fullname AS approved_fullname, tb_failure_code.failure_code_th_name, tb_repair_code.repair_code_name, 
tb_repair_result.txt_solution, tb_repair_result.txt_caused_by, tb_repair_result.ref_id_failure_code, tb_repair_result.ref_id_repair_code,
tb_failure_code.id_failure_code, tb_repair_code.id_repair_code, tb_outsite_repair.*, tb_supplier.supplier_name, tb_user_survey.fullname AS fullname_survay,
tb_user_handover.fullname AS fullname_handover, tb_accept_request.fullname AS fullname_accept , tb_site.site_initialname
FROM tb_maintenance_request 
LEFT JOIN tb_maintenance_type ON (tb_maintenance_type.id_mt_type=tb_maintenance_request.ref_id_mt_type)
LEFT JOIN tb_dept AS tb_dept_responsibility ON (tb_dept_responsibility.id_dept=tb_maintenance_request.ref_id_dept_responsibility)
LEFT JOIN tb_user AS tb_user_request ON (tb_user_request.id_user=tb_maintenance_request.ref_id_user_request)    
LEFT JOIN tb_user AS tb_user_cancel ON (tb_user_cancel.id_user=tb_maintenance_request.ref_id_user_cancel)    
LEFT JOIN tb_user AS tb_user_approved ON (tb_user_approved.id_user=tb_maintenance_request.ref_id_user_approver) 
LEFT JOIN tb_user AS tb_user_survey ON (tb_user_survey.id_user=tb_maintenance_request.ref_id_user_survey) 
LEFT JOIN tb_user AS tb_accept_request ON (tb_accept_request.id_user=tb_maintenance_request.ref_user_id_accept_request)      
LEFT JOIN tb_user AS tb_user_handover ON (tb_user_handover.id_user=tb_maintenance_request.ref_id_user_hand_over) 
LEFT JOIN tb_dept AS tb_user_dept_request ON (tb_user_dept_request.id_dept=tb_user_request.ref_id_dept)
LEFT JOIN tb_repair_result ON (tb_repair_result.ref_id_maintenance_request=tb_maintenance_request.id_maintenance_request)
LEFT JOIN tb_failure_code ON (tb_failure_code.id_failure_code=tb_repair_result.ref_id_failure_code)   
LEFT JOIN tb_repair_code ON (tb_repair_code.id_repair_code=tb_repair_result.ref_id_repair_code)   
LEFT JOIN tb_outsite_repair ON (tb_outsite_repair.ref_id_maintenance_request=tb_maintenance_request.id_maintenance_request)   
LEFT JOIN tb_supplier ON (tb_supplier.id_supplier=tb_outsite_repair.ref_id_supplier) 
LEFT JOIN tb_site ON (tb_site.id_site=tb_user_request.ref_id_site)
WHERE tb_maintenance_request.id_maintenance_request=".$id_req." ");

$rowMachine = $obj->customSelect("SELECT tb_machine_site.*, tb_machine_master.*,
tb_site.site_initialname, tb_building.building_name, tb_location.location_name, tb_dept.dept_initialname, tb_category.name_menu  
FROM tb_machine_site
LEFT JOIN tb_machine_master ON (tb_machine_master.id_machine=tb_machine_site.ref_id_machine_master)
LEFT JOIN tb_category ON (tb_category.id_menu=tb_machine_master.ref_id_menu)      
LEFT JOIN tb_site ON (tb_site.id_site=tb_machine_site.ref_id_site) 
LEFT JOIN tb_building ON (tb_building.id_building=tb_machine_site.ref_id_building) 
LEFT JOIN tb_location ON (tb_location.id_location=tb_machine_site.ref_id_location)     
LEFT JOIN tb_dept ON (tb_dept.id_dept=tb_machine_master.ref_id_dept) 
WHERE tb_machine_site.id_machine_site=".$rowData['ref_id_machine_site']." ");

$Rowcount1 =$obj->countAll("SELECT tb_attachment.*
FROM tb_attachment
WHERE (tb_attachment.ref_id_used=".$rowData['id_maintenance_request'].") AND (tb_attachment.image_cate = 3);
");

$Rowcount2 =$obj->countAll("SELECT tb_attachment.*
FROM tb_attachment
WHERE (tb_attachment.ref_id_used=".$rowData['id_maintenance_request'].") AND (tb_attachment.image_cate = 2);
");

$RowcountPart =$obj->countAll("SELECT * 
FROM tb_change_parts 
WHERE ref_id_maintenance_request=".$rowData['id_maintenance_request'].";");

$rowSurvey = $obj->fetchRows("SELECT * FROM tb_satisfaction_survey WHERE ref_id_maintenance_request=".$rowData['id_maintenance_request']." ORDER BY ref_topic_survey ASC");

$rowImg = $obj->fetchRows("SELECT tb_attachment.*
FROM tb_attachment
WHERE (tb_attachment.ref_id_used=".$rowData['id_maintenance_request'].") AND (tb_attachment.image_cate = 2 OR tb_attachment.image_cate = 3); ");

$arrImg = array();
foreach($rowImg as $key => $value) {
	if($rowImg[$key]['image_cate'] == 2){
		$arrImg['before'][]= $rowImg[$key]['path_attachment_name'];
	}else if($rowImg[$key]['image_cate'] == 3){
		$arrImg['after'][]= $rowImg[$key]['path_attachment_name'];
	}
}
if(empty($arrImg['before'])){
	$arrImg['before'] = [];
}
if(empty($arrImg['after'])){
	$arrImg['after'] = [];
}

class MYPDF extends TCPDF {
    //Page header 	
    public function Header() {	

		global $rowData;
		global $Rowcount1;
		global $Rowcount2;
		global $RowcountPart;		

		$mt_req_timestamp = substr($rowData['mt_request_date'],0,10);
		$mt_req_date = date("d-m-Y", strtotime($mt_req_timestamp));  
		
		if($rowData['status_approved']==0 && $rowData['allotted_date']==NULL && $rowData['maintenance_request_status']==1 && $rowData['duration_serv_end']==NULL && $rowData['hand_over_date']==NULL){
            $req_textstatus= '<span class="text-bold text-danger">รออนุมัติ/จ่ายงาน</span>';

        }else if($rowData['status_approved']==2 && $rowData['allotted_date']!='' && $rowData['maintenance_request_status']==1 && $rowData['duration_serv_end']==NULL && $rowData['hand_over_date']==NULL){
            $req_textstatus= '<span class="text-bold text-danger">ไม่อนุมัติ</span>';            
        }else if($rowData['status_approved']==1 && $rowData['allotted_date']!='' && $rowData['maintenance_request_status']==1 && $rowData['duration_serv_end']==NULL && $rowData['hand_over_date']==NULL){
            $req_textstatus= '<span class="text-bold text-danger">รอช่างรับงานซ่อม</span>';
        }else if($rowData['status_approved']==1 && $rowData['allotted_date']!='' && $rowData['maintenance_request_status']==1 && $rowData['duration_serv_end']!=NULL && $rowData['hand_over_date']!=NULL && $rowData['survay_date']==NULL){
            $req_textstatus= '<span class="text-bold text-success">งานรอส่งมอบ</span>';
        }else if($rowData['status_approved']==1 && $rowData['allotted_date']!='' && $rowData['maintenance_request_status']==1 && $rowData['duration_serv_end']!=NULL && $rowData['hand_over_date']!=NULL && $rowData['survay_date']!=NULL){
            $req_textstatus= '<span class="text-bold text-success">ปิดงานและส่งมอบแล้ว</span>';
        }else if($rowData['maintenance_request_status']==2){            
            $req_textstatus= '<span class="text-bold text-gray">ยกเลิกใบแจ้งซ่อม</span>';
        }else{
            $req_textstatus = '-';
        }

		$this->SetFont('thsarabun', '', 12, '', false);

		$this->setCellHeightRatio(1.1);		
        $this->SetY(5);
		$totalPage = 1;
		$PgNo= '';

		if($RowcountPart > 5){
			$totalPage = 2;
			if(($Rowcount1 > 3) || ($Rowcount2 > 3)){
				$totalPage = 3;
			}
		}else if( ($RowcountPart > 2) && ((!empty($Rowcount1)) || (!empty($Rowcount2)) ) ){
			$totalPage = 2;
		}else if( ($RowcountPart != 0) && (($Rowcount1 > 3) || ($Rowcount2 > 3)) ){
			$totalPage = 2;
		}else if(($Rowcount1 > 3) || ($Rowcount2 > 3)) {
			$totalPage = 2;
		}

		if($totalPage > 1){
			$PgNo= " (หน้าที่ " .$this->getPage() . " / ". $totalPage .")";
		}
		
        $this->writeHTML('<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
		<tr><td width="10%" style="align: left; vertical-align:center;"><br><br>
		<img src="dist/img/logo.png" width="150"></td>
		<td width="60%" style="text-align: left; vertical-align:top;">
			<strong style="font-size:22px;"><br>
			 บริษัท แปซิฟิค ห้องเย็น จำกัด (มหาชัย)</strong><br>
			  47/19 หมู่ 2 ตำบลนาดี อำเภอเมือง จังหวัด สมุทรสาคร 74000 โทร. (+66) 3411-789-9</td>
		<td align="right" width="30%" style="text-align:right; vertical-align:middle;">
		<strong style="font-size:24px;">ใบแจ้งซ่อม แผนก: '.$rowData['dept_user_request'].'</strong><br />
		<span style="font-size:18px;float: right;" align="right">เลขที่ใบแจ้งซ่อม: '.$rowData['maintenance_request_no'].'</span><br>
		<span style="font-size:18px;float: right;" align="right">วันที่แจ้งซ่อม: '.$mt_req_date.''.$PgNo.'</span>
		<div style="font-size:18px;">สถานะใบแจ้งซ่อม: '.$req_textstatus.'</div></td>
>>>>>>> Stashed changes
		</tr>
		</table><hr />');
        // We need to adjust the x and y positions of this text ... first two parameters
		// set bacground image
		// restore auto-page-break status
		// set the starting point for the page content
		$this->setPageMark();
    }
	
    // Page footer
    public function Footer() {
<<<<<<< Updated upstream
=======
		
		global $rowData;
		global $arrTopicSurvey;
		global $rowSurvey;

		if (count($rowSurvey)!=0) {
		  $score = 0;
			foreach($rowSurvey as $key => $value) {
				$score+=$rowSurvey[$key]['score_result'];
			}
			$score_result = $score/count($arrTopicSurvey)*100;
		}else{
		  $score_result = 0;
		}

>>>>>>> Stashed changes
        if ($this->page!=4) {
			global $fontname;
			global $text_ref_abb;
        // Position at 25 mm from bottom
<<<<<<< Updated upstream

=======
		
>>>>>>> Stashed changes
        $this->SetY(-50);
        //Set font
		$this->SetFont('thsarabun', '', 12, '', false);
		$this->setCellHeightRatio(1.2);		
<<<<<<< Updated upstream
        //$this->Cell(0, 0, "Authorized by sdfaasfasdf", 0, 0, 'L');
		$this->writeHTML('');		
		$this->writeHTML('<div style="width:100%; display:block; font-size:12px; line-height:14px; ">**หมายเหตุ 1) {data}<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2) {data}</div><table width="100%" border="1" cellspacing="0" cellpadding="5" bordercolor="#ff00ff">
		<tr>
		<td width="25%" style="text-align:center;">
			<strong>ผู้แจ้งซ่อม, ผู้ประเมิณ:</strong><br />
			<img src="upload-signature/signature.png" width="200" /><br />
			ชื่อ ({data name})<br />
			วันที่ DD/MM/YYYY
		</td>
		<td width="25%">ประเมินผลการซ่อม:<br/><strong style="text-align: left; vertical-align:middle; font-size:60px;">100%</strong><br />		วันที่ประเมิน DD/MM/YYYY</td>
		<td width="25%" style="text-align:center;">
		<strong>ช่างซ่อม:</strong>
		<div style="border-bottom:1px solid #333333; padding-bottom:10px; display:block;"><img src="upload-signature/signature.png" width="200" /></div>
		ชื่อ ({data name})<br />
		วันที่ DD/MM/YYYY
=======
        //$this->Cell(0, 0, "Authorized by sdfaasfasdf", 0, 0, 'L');	
		$this->writeHTML('<div style="width:100%; display:block; font-size:12px; line-height:14px; ">**หมายเหตุ 1) {data}<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2) {data}</div>
		<table width="100%" border="1" cellspacing="0" cellpadding="5" bordercolor="#ff00ff">
		<tr>
		<td width="25%" style="text-align:center;">
			<strong>ผู้แจ้งซ่อม, ผู้ประเมิน:</strong><br />
			<img src="upload-signature/signature.png" width="200" /><br />
			ชื่อ ('.($rowData['fullname_survay']!='' ? $rowData['fullname_survay'] : '-').')<br />
			วันที่ '.($rowData['survay_date']!='' ? nowDate($rowData['survay_date']) : '-').'
		</td>
		<td width="25%">ประเมินผลการซ่อม:<br/><strong style="text-align: left; vertical-align:middle; font-size:60px;">'.$score_result.'%</strong><br />		วันที่ประเมิน '.($rowData['survay_date']!='' ? nowDate($rowData['survay_date']) : '-').'</td>
		<td width="25%" style="text-align:center;">
		<strong>ช่างซ่อม:</strong>
		<div style="border-bottom:1px solid #333333; padding-bottom:10px; display:block;"><img src="upload-signature/signature.png" width="200" /></div>
		ชื่อ ('.($rowData['fullname_accept']!='' ? $rowData['fullname_accept'] : '-').')<br />
		วันที่ '.($rowData['allotted_accept_date']!='' ? nowDate($rowData['allotted_accept_date']) : '-').'
>>>>>>> Stashed changes
		</td>
		<td width="25%" style="text-align:center;">
		<strong>หัวหน้าช่าง, ผู้อนุมัติซ่อม, ส่งมอบงาน:</strong><br />
		<img src="upload-signature/signature.png" width="200" /><br />
<<<<<<< Updated upstream
		ชื่อ ({data name})<br />
		วันที่ DD/MM/YYYY		
		</td>
		</tr>
		</table><div style="width:100%; display:block; font-size:12px; line-height:14px; text-align:right;">FM-EN-9999/23<br />DOC. DATE.DD/MM/YYYY </div>');
=======
		ชื่อ ('.($rowData['fullname_handover']!='' ? $rowData['fullname_handover'] : '-').')<br />
		วันที่ '.($rowData['hand_over_date']!='' ? nowDate($rowData['hand_over_date']) : '-').'		
		</td>
		</tr>
		</table>
		<div style="width:100%; display:block; font-size:12px; line-height:14px; text-align:right;">FM-EN-9999/23<br />DOC. DATE.'.date('d/m/Y').' </div>');
>>>>>>> Stashed changes
		//'ไปขวา ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx'
		//$this->Image($img_file, 125, 120, 0, 0, '', '', '', true, 300, '', false, false, 0);
		}
    }
}

//create new PDF document
$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->setViewerPreferences(array('PrintScaling' => 'None'));
$pageDimensions = $pdf->getPageDimensions();
//$yOffset = ceil($pdf->GetY());

// set document information
$pdf->SetCreator(PDF_CREATOR);
<<<<<<< Updated upstream
$pdf->SetAuthor('Sopon Gomonchonlamas');
$pdf->SetTitle("ใบแจ้งซ่อม {เลขที่ใบแจ้งซ่อม} {ไซต์งาน}");
$pdf->SetSubject('ใบแจ้งซ่อม {เลขที่ใบแจ้งซ่อม}');
$pdf->SetKeywords('PDF, ใบแจ้งซ่อม {เลขที่ใบแจ้งซ่อม}');
=======
$pdf->SetAuthor($_SESSION['sess_fullname']);
$pdf->SetTitle("ใบแจ้งซ่อม ".$rowData['maintenance_request_no']." ".$rowData['site_initialname']."");
$pdf->SetSubject('ใบแจ้งซ่อม '.$rowData['maintenance_request_no'].'');
$pdf->SetKeywords('PDF, ใบแจ้งซ่อม '.$rowData['maintenance_request_no'].'');
>>>>>>> Stashed changes

// remove default header/footer
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
<<<<<<< Updated upstream
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
=======
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT, PDF_MARGIN_BOTTOM);
>>>>>>> Stashed changes
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(6, 32, 6, 6); //ซ้าย บน ล่าง ขวา

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 5); //PDF_MARGIN_FOOTER

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
//$pdf->setLanguageArray($l);

$pdf->setJPEGQuality(95);

// set font
//$pdf->SetFont($fontname, '', 14, '', true);
$pdf->SetFont('thsarabun', '', 12, '', true);
$pdf->setCellHeightRatio(1);
// add a page
$pdf->AddPage();

//$pdf->Image('images/invbg.jpg',0,0,220,297,'','');
// define some HTML content with style
// create some HTML content

$stylesheet ='<!-- EXAMPLE OF CSS STYLE -->
<style>
td.td_border{ border: 5px solid red;}
body{
	line-height:3pt;	
}
table tr td{
	line-height:0pt;	
}
strong{
	line-height:24pt;
	font-size:90pt;
}
	h1 {
		color:#000000;
		font-size: 24pt;
	}
	p.first {
		color: #003300;
		font-family: helvetica;
		font-size: 12pt;
	}
	p.first span {
		color: #006600;
		font-style: italic;
	}
	p#second {
		color: rgb(00,63,127);
		font-family: times;
		font-size: 12pt;
		text-align: justify;
	}
	p#second > span {
		background-color: #FFFFAA;
	}
	table.first {
		color: #003300;
		font-family: helvetica;
		font-size: 8pt;
		border-left: 3px solid red;
		border-right: 3px solid #FF00FF;
		border-top: 3px solid green;
		border-bottom: 3px solid blue;
		background-color: #ccffcc;
	}
	td {
		border: 2px solid blue;
		background-color: #ffffee;
	}
	td.second {
		border: 2px dashed green;
	}
	div.test {
		color: #CC0000;
		background-color: #FFFF66;
		font-family: helvetica;
		font-size: 10pt;
		border-style: solid solid solid solid;
		border-width: 2px 2px 2px 2px;
		border-color: green #FF00FF blue red;
		text-align: center;
	}
	.lowercase {
		text-transform: lowercase;
	}
	.uppercase {
		text-transform: uppercase;
	}
	.capitalize {
		text-transform: capitalize;
	}
</style>';

$html = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
<tr>
<td bgcolor="#EAEAEA"><strong>::รายละเอียดผู้แจ้งซ่อม</strong></td>
</tr></table>';

$html.= '<table width="100%" border="0" cellspacing="3" cellpadding="3">
<tr>
<td colspan="2" width="12%" style="text-align: left; vertical-align:middle; font-weight: bold;">รหัสพนักงาน:</td>
<<<<<<< Updated upstream
<td width="10%">{data}</td>
<td colspan="2" width="13%" style="text-align: left; vertical-align:middle; font-weight: bold;">ชื่อผู้แจ้งซ่อม:</td>
<td width="27%">{data}</td>
<td width="8%" style="text-align: left; vertical-align:middle; font-weight: bold;">อีเมล์:</td>
<td width="30%">{data}</td>
</tr>
<tr>
<td colspan="2" width="12%" style="text-align: left; vertical-align:middle; font-weight: bold;">ไซต์งาน:</td>
<td width="15%">{data}</td>
<td colspan="2" width="12%" style="text-align: left; vertical-align:middle; font-weight: bold;">แผนก:</td>
<td width="15%">{data}</td>
=======
<td width="10%">'.($rowData['no_user']).'</td>
<td colspan="2" width="13%" style="text-align: left; vertical-align:middle; font-weight: bold;">ชื่อผู้แจ้งซ่อม:</td>
<td width="27%">'.($rowData['fullname']).'</td>
<td width="8%" style="text-align: left; vertical-align:middle; font-weight: bold;">อีเมล์:</td>
<td width="30%">'.($rowData['email']).'</td>
</tr>
<tr>
<td colspan="2" width="12%" style="text-align: left; vertical-align:middle; font-weight: bold;">ไซต์งาน:</td>
<td width="15%">'.($rowData['site_initialname']).'</td>
<td colspan="2" width="12%" style="text-align: left; vertical-align:middle; font-weight: bold;">แผนก:</td>
<td width="15%">'.($rowData['dept_user_request']).'</td>
>>>>>>> Stashed changes
<td width="8%" style="text-align: left; vertical-align:middle; font-weight: bold;"></td>
<td width="30%"></td>
</tr>
</table>';

$html.= '<table width="100%" border="0" cellspacing="0" cellpadding="4"><tr><td bgcolor="#EAEAEA"><strong>::เครื่องจักร-อุปกรณ์ที่แจ้งซ่อม</strong></td></tr></table>';

$html.= '<table width="100%" border="0" cellspacing="3" cellpadding="3">
<tr>
<td colspan="3" width="17%" style="text-align: left; vertical-align:middle; font-weight: bold;">ประเภทเครื่องจักร:</td>
<<<<<<< Updated upstream
<td width="33%">{data}</td>
<td colspan="3" width="18%" style="text-align: left; vertical-align:middle; font-weight: bold;">ชื่อเครื่องจักร์-อุปกรณ์:</td>
<td width="32%">{data}</td>
</tr>
<tr>
<td colspan="2" width="12%" style="text-align: left; vertical-align:middle; font-weight: bold;">รหัสเครื่องจักร:</td>
<td width="24%">{data}</td>
<td colspan="2" width="13%" style="text-align: left; vertical-align:middle; font-weight: bold;">ซีเรียลนัมเบอร์:</td>
<td width="22%">{data}</td>
<td width="7%" style="text-align: left; vertical-align:middle; font-weight: bold;">ชื่อรุ่น:</td>
<td width="22%">{data}</td>
</tr>
<tr>
<td colspan="2" width="12%" style="text-align: left; vertical-align:middle; font-weight: bold;">ไซต์งาน:</td>
<td width="14%">{data}</td>
<td colspan="2" width="12%" style="text-align: left; vertical-align:middle; font-weight: bold;">อาคาร:</td>
<td width="30%">{data}</td>
<td colspan="2" width="12%" style="text-align: left; vertical-align:middle; font-weight: bold;">สถานที่:</td>
<td width="20%">{data}</td>
=======
<td width="33%">'.(!empty($rowMachine['name_menu']) ? $rowMachine['name_menu'] : '-').'</td>
<td colspan="3" width="18%" style="text-align: left; vertical-align:middle; font-weight: bold;">ชื่อเครื่องจักร-อุปกรณ์:</td>
<td width="32%">'.(!empty($rowMachine['name_machine']) ? $rowMachine['name_machine'] : 'ไม่ทราบชื่อ, ไม่ระบุ').'</td>
</tr>
<tr>
<td colspan="2" width="12%" style="text-align: left; vertical-align:middle; font-weight: bold;">รหัสเครื่องจักร:</td>
<td width="24%">'.(!empty($rowMachine['code_machine_site']) ? $rowMachine['code_machine_site'] : '-').'</td>
<td colspan="2" width="13%" style="text-align: left; vertical-align:middle; font-weight: bold;">ซีเรียลนัมเบอร์:</td>
<td width="22%">'.(!empty($rowMachine['serial_number']) ? $rowMachine['serial_number'] : '-').'</td>
<td width="7%" style="text-align: left; vertical-align:middle; font-weight: bold;">ชื่อรุ่น:</td>
<td width="22%">'.(!empty($rowMachine['model_name']) ? $rowMachine['model_name'] : '-').'</td>
</tr>
<tr>
<td colspan="2" width="12%" style="text-align: left; vertical-align:middle; font-weight: bold;">ไซต์งาน:</td>
<td width="14%">'.(!empty($rowMachine['site_initialname']) ? $rowMachine['site_initialname'] : '-').'</td>
<td colspan="2" width="12%" style="text-align: left; vertical-align:middle; font-weight: bold;">อาคาร:</td>
<td width="30%">'.(!empty($rowMachine['building_name']) ? $rowMachine['building_name'] : '-').'</td>
<td colspan="2" width="12%" style="text-align: left; vertical-align:middle; font-weight: bold;">สถานที่:</td>
<td width="20%">'.(!empty($rowMachine['location_name']) ? $rowMachine['location_name'] : '-').'</td>
>>>>>>> Stashed changes
</tr>
</table>';

$html.= '<table width="100%" border="0" cellspacing="0" cellpadding="4"><tr><td bgcolor="#EAEAEA"><strong>::อาการเสีย/ปัญหาที่พบ</strong></td></tr></table>';

<<<<<<< Updated upstream
$html.= '<table width="100%" border="0" cellspacing="3" cellpadding="3"><tr><td>ราวกั้น กันกระแทก น๊อตหลุด บริเวณที่จัดเก็บรางคอนเวเยอร์ อาคาร 8</td></tr></table>';
=======
$html.= '<table width="100%" border="0" cellspacing="3" cellpadding="3"><tr><td>'.(!empty($rowData['problem_statement']) ? $rowData['problem_statement'] : '-' ).'</td></tr></table>';
>>>>>>> Stashed changes

$html.= '<table width="100%" border="0" cellspacing="0" cellpadding="4"><tr><td bgcolor="#EAEAEA"><strong>:: สรุปผลการซ่อม</strong></td></tr></table>';

$html.= '<table width="100%" border="0" cellspacing="3" cellpadding="3">
<tr>
<td colspan="2" width="14%" style="text-align: left; vertical-align:middle; font-weight: bold;">ประเภทใบแจ้งซ่อม:</td>
<<<<<<< Updated upstream
<td width="36%">{data}</td>
<td colspan="2" width="14%" style="text-align: left; vertical-align:middle; font-weight: bold;">ประเภทงานซ่อม:</td>
<td width="36%">{data}</td>
</tr>
<tr>
<td colspan="2" width="10%" style="text-align: left; vertical-align:middle; font-weight: bold;">วันที่อนุมัติ:</td>
<td width="20%">{DD/MM/YYYY HH:MM:SS}</td>
<td colspan="2" width="12%" style="text-align: left; vertical-align:middle; font-weight: bold;">วันที่ช่างรับงาน:</td>
<td width="20%">{DD/MM/YYYY HH:MM:SS}</td>
<td colspan="2" width="10%" style="text-align: left; vertical-align:middle; font-weight: bold;">วันที่เริ่มซ่อม:</td>
<td width="20%">{DD/MM/YYYY HH:MM:SS}</td>
</tr>
<tr>
<td colspan="2" width="12%" style="text-align: left; vertical-align:middle; font-weight: bold;">วันที่ซ่อมเสร็จ:</td>
<td width="20%">{DD/MM/YYYY HH:MM:SS}</td>
<td colspan="2" width="15%" style="text-align: left; vertical-align:middle; font-weight: bold;">วันที่ส่งมอบงาน:</td>
<td width="18%">{DD/MM/YYYY HH:MM:SS}</td>
<td width="14%" style="text-align: left; vertical-align:middle; font-weight: bold;">รวมเวลาซ่อม:</td>
<td width="18%">{DD/MM/YYYY HH:MM:SS}</td>
</tr>
<tr>
<td colspan="2" width="15%" style="text-align: left; vertical-align:middle; font-weight: bold;">รหัสอาการเสีย:</td>
<td width="35%">{Detail Detail Detail}</td>
<td colspan="2" width="15%" style="text-align: left; vertical-align:middle; font-weight: bold;">สาเหตุของปัญหา:</td>
<td width="35%">{Detail Detail Detail}</td>
</tr>
<tr>
<td colspan="2" width="15%" style="text-align: left; vertical-align:middle; font-weight: bold;">รหัสซ่อม:</td>
<td width="35%">{Detail Detail Detail}</td>
<td colspan="2" width="15%" style="text-align: left; vertical-align:middle; font-weight: bold;">วิธีการแก้ไข:</td>
<td width="35%">{Detail Detail Detail}</td>
=======
<td width="36%">'.($rowData['name_mt_type']!='' ? $rowData['name_mt_type'] : 'ยังไม่ระบุ').'</td>
<td colspan="2" width="14%" style="text-align: left; vertical-align:middle; font-weight: bold;">ประเภทงานซ่อม:</td>
<td width="36%">'.($rowData['ref_id_job_type']!=NULL ? $ref_id_job_typeArr[$rowData['ref_id_job_type']] : '-').'</td>
</tr>
<tr>
<td colspan="2" width="10%" style="text-align: left; vertical-align:middle; font-weight: bold;">วันที่อนุมัติ:</td>
<td width="20%">'.(!empty($rowData['allotted_date']) ? date('d/m/Y H:i:s', strtotime($rowData['allotted_date'])) : '').'</td>
<td colspan="2" width="12%" style="text-align: left; vertical-align:middle; font-weight: bold;">วันที่ช่างรับงาน:</td>
<td width="20%">'.(!empty($rowData['allotted_accept_date']) ? date('d/m/Y H:i:s', strtotime($rowData['allotted_accept_date'])) : '').'</td>
<td colspan="2" width="10%" style="text-align: left; vertical-align:middle; font-weight: bold;">วันที่เริ่มซ่อม:</td>
<td width="20%">'.(!empty($rowData['duration_serv_start']) ? date('d/m/Y H:i:s', strtotime($rowData['duration_serv_start'])) : '').'</td>
</tr>
<tr>
<td colspan="2" width="10%" style="text-align: left; vertical-align:middle; font-weight: bold;">วันที่ซ่อมเสร็จ:</td>
<td width="20%">'.(!empty($rowData['duration_serv_end']) ? date('d/m/Y H:i:s', strtotime($rowData['duration_serv_end'])) : '').'</td>
<td colspan="2" width="12%" style="text-align: left; vertical-align:middle; font-weight: bold;">วันที่ส่งมอบงาน:</td>
<td width="18%">'.(!empty($rowData['hand_over_date']) ? date('d/m/Y H:i:s', strtotime($rowData['hand_over_date'])) : '').'</td>
<td width="14%" style="text-align: left; vertical-align:middle; font-weight: bold;">รวมเวลาซ่อม:</td>
<td width="25%">'.((!empty($rowData['duration_serv_start'])) && (!empty($rowData['duration_serv_end'])) ? duration($rowData['duration_serv_start'], $rowData['duration_serv_end']) : '').'</td>
</tr>
<tr>
<td colspan="2" width="15%" style="text-align: left; vertical-align:middle; font-weight: bold;">รหัสอาการเสีย:</td>
<td width="35%">'.($rowData['failure_code_th_name']=='' ? ($rowData['ref_id_failure_code']=='' ? '-' : $rowData['ref_id_failure_code']) : $rowData['failure_code_th_name']).'</td>
<td colspan="2" width="15%" style="text-align: left; vertical-align:middle; font-weight: bold;">สาเหตุของปัญหา:</td>
<td width="35%">'.($rowData['txt_caused_by']=='' ? '-' : $rowData['txt_caused_by']).'</td>
</tr>
<tr>
<td colspan="2" width="15%" style="text-align: left; vertical-align:middle; font-weight: bold;">รหัสซ่อม:</td>
<td width="35%">'.($rowData['repair_code_name']=='' ? ($rowData['ref_id_repair_code']=='' ? '-' : $rowData['ref_id_repair_code']) : $rowData['repair_code_name']).'</td>
<td colspan="2" width="15%" style="text-align: left; vertical-align:middle; font-weight: bold;">วิธีการแก้ไข:</td>
<td width="35%">'.($rowData['txt_solution']=='' ? '-' : $rowData['txt_solution']).'</td>
>>>>>>> Stashed changes
</tr>
</table>';

$html.= '<table width="100%" border="0" cellspacing="0" cellpadding="4"><tr><td bgcolor="#EAEAEA"><strong>::  ส่งซ่อมภายนอก</strong></td></tr></table>';

$html.= '<table width="100%" border="0" cellspacing="3" cellpadding="3">
<tr>
<td colspan="2" width="13%" style="text-align: left; vertical-align:middle; font-weight: bold;">สาเหตุที่ส่งซ่อม:</td>
<<<<<<< Updated upstream
<td width="52%">{Detail Detail Detail}</td>
<td colspan="2" width="10%" style="text-align: left; vertical-align:middle; font-weight: bold;">ซัพพลายเออร์:</td>
<td width="25%">{Detail Detail Detail }</td>
</tr>
<tr>
<td colspan="2" width="15%" style="text-align: left; vertical-align:middle; font-weight: bold;">วันที่ส่งซ่อม:</td>
<td width="35%">{Detail Detail Detail}</td>
<td colspan="2" width="15%" style="text-align: left; vertical-align:middle; font-weight: bold;">วันที่ส่งคืน:</td>
<td width="35%">{Detail Detail Detail}</td>
=======
<td width="52%">'.($rowData['caused_outsite_repair']=='' ? '-' : $rowData['caused_outsite_repair']).'</td>
<td colspan="2" width="10%" style="text-align: left; vertical-align:middle; font-weight: bold;">ซัพพลายเออร์:</td>
<td width="25%">'.($rowData['supplier_name']=='' ? ($rowData['ref_id_supplier']=='' ? '-' : $rowData['ref_id_supplier']) : $rowData['supplier_name']).'</td>
</tr>
<tr>
<td colspan="2" width="15%" style="text-align: left; vertical-align:middle; font-weight: bold;">วันที่ส่งซ่อม:</td>
<td width="35%">'.($rowData['datesent_repair']=='' ? '-' : nowDateShort($rowData['datesent_repair'])).'</td>
<td colspan="2" width="15%" style="text-align: left; vertical-align:middle; font-weight: bold;">วันที่ส่งคืน:</td>
<td width="35%">'.($rowData['dateresive_repair']=='' ? '-' : nowDateShort($rowData['dateresive_repair'])).'</td>
>>>>>>> Stashed changes
</tr>
</table>';

$html.= '<table width="100%" border="0" cellspacing="0" cellpadding="4"><tr><td bgcolor="#EAEAEA"><strong>::รายการอะไหล่ที่เปลี่ยน</strong></td></tr></table>';

$html.= '<table width="100%" border="0" cellspacing="0" cellpadding="6" bordercolor="#EAEAEA">
<tr bgcolor="#F3F3F3">
<td bordercolor="#EAEAEA" width="4%" style="text-align: left; vertical-align:middle; font-weight: bold;">#</td>
<td bordercolor="#EAEAEA" width="13%" style="text-align: left; vertical-align:middle; font-weight: bold;">S/N No.</td>
<td bordercolor="#EAEAEA" width="26%" style="text-align: left; vertical-align:middle; font-weight: bold;">ชื่ออะไหล่</td>
<td bordercolor="#EAEAEA" width="28%" style="text-align: left; vertical-align:middle; font-weight: bold;">รายละเอียด</td>
<td bordercolor="#EAEAEA" width="10%" style="text-align: right; vertical-align:middle; font-weight: bold;">ราคาบาท/ชิ้น</td>
<td bordercolor="#EAEAEA" width="9%" style="text-align: right; vertical-align:middle; font-weight: bold;">จำนวน/ชิ้น</td>
<td bordercolor="#EAEAEA" width="10%" style="text-align: right; vertical-align:middle; font-weight: bold;">รวม/บาท</td>
</tr>';
<<<<<<< Updated upstream
$html.='
<tr>
<td colspan="7" style="text-align:center; "> {Not found data}</td>
</tr>';
for($i=1;$i<=2;$i++){
$html.='
<tr>
<td style="text-align:right;">'.$i.'.</td>
<td class="td_border"> {data}</td>
<td > {data}</td>
<td > {data}</td>
<td style="text-align:right;">999,999.00.-</td>
<td style="text-align:right;">99</td>
<td style="text-align:right;">999,999.00.-</td>
</tr>';
}
$html.='
<tr bgcolor="#F3F3F3">
<td colspan="5"></td>
<td style="text-align:right;">99</td>
<td style="text-align:right;">999,999</td>
</tr>';
$html.= '</table>** หากรายการอะไหล่มีมากกว่า 2 รายการ ระบบจะพิมพ์แยกหน้ารายการอะไหล่ให้อัตโนมัติ<br /><br />';

$html.= '<table width="100%" border="0" cellspacing="0" cellpadding="4">
<tr>
<td bgcolor="#EAEAEA" width="50%" colspan="3"><strong>::ภายถ่ายอาการเสีย/ปัญหาที่พบ (เฉพาะ 3 แรกที่แนบ)</strong></td>
<td bgcolor="#EAEAEA" width="50%" colspan="3"><strong>::ภายถ่ายหลังซ่อม (เฉพาะ 3 แรกที่แนบ)</strong></td>
</tr>
<tr>
<td><img src="upload-pic-req/0230a8d37e9bab84ff945644b4b1c077.jpg" width="100" /></td>
<td><img src="upload-pic-req/0230a8d37e9bab84ff945644b4b1c077.jpg" width="100" /></td>
<td></td>
<td><img src="upload-pic-req/0230a8d37e9bab84ff945644b4b1c077.jpg" width="100" /></td>
<td><img src="upload-pic-req/0230a8d37e9bab84ff945644b4b1c077.jpg" width="100" /></td>
<td><img src="upload-pic-req/0230a8d37e9bab84ff945644b4b1c077.jpg" width="100" /></td>
</tr>
</table>';

// output the HTML content
$pdf->WriteHTML($stylesheet, 1);
$pdf->writeHTML($html,  true, 0, true, 0);
// Start First Page Group
$pdf->startPageGroup();

/*
// reset pointer to the last page
$pdf->lastPage();

$pdf->AddPage();
// output the HTML content
$pdf->WriteHTML($stylesheet, 1);
// Start First Page Group
$pdf->startPageGroup();
$pdf->writeHTML($html_copy,  true, 0, true, 0);
*/

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output("test.pdf", "I");
=======

$grand_total = 0;
$qty_total = 0;
$rowParts = $obj->fetchRows("SELECT * FROM tb_change_parts WHERE ref_id_maintenance_request=".$rowData['id_maintenance_request']." ORDER BY id_parts ASC");
$i = 1;
$before ='';
$after ='';
$html2 = '';
$html3 = '';
//-------------------เช็คเงื่อนไขเพื่อเข้า Switch Case------------------------
if(count($rowParts) > 5){
	$countPart = '>5'; 
}else if(count($rowParts) > 2){
	$countPart = '>2';
}else if(count($rowParts) != 0){
	$countPart = '!0';
}else{
	$countPart = '0';
}

//----------------------กำหนดตารางอะไหล่------------------------------
if(!empty($countPart)){
	$partTable = '';
	foreach($rowParts as $key => $value) {

		$partTable.='
		<tr class="tr_partid_'.$rowParts[$key]['id_parts'].'">
		<td style="text-align:right;">'.$i.'.</td>
		<td class="td_border">'.$rowParts[$key]['parts_serialno'].'</td>
		<td >'.$rowParts[$key]['parts_name'].'</td>
		<td >'.$rowParts[$key]['parts_description'].'</td>
		<td style="text-align:right;">'.number_format($rowParts[$key]['parts_price'],2).'.-</td>
		<td style="text-align:right;">'.number_format($rowParts[$key]['parts_qty'],0).'</td>
		<td style="text-align:right;">'.(number_format(($rowParts[$key]['parts_price']*$rowParts[$key]['parts_qty']),2)).'.-</td>
		</tr>';
		$i++;
		$qty_total+=$rowParts[$key]['parts_qty'];
		$grand_total+=$rowParts[$key]['parts_price']*$rowParts[$key]['parts_qty'];
	}

	$partTable.='
	<tr bgcolor="#F3F3F3">
	<td colspan="5"></td>
	<td style="text-align:right;">'.$qty_total.'</td>
	<td style="text-align:right;"><u>'.number_format($grand_total,2).'</u></td>
	</tr>';

	$partTable.='</table>';
}

//----------------------กำหนดตารางรูปภาพ------------------------------
if((count($arrImg['before']) > 3) || (count($arrImg['after']) > 3)){

	$imgFullTable = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
	<tr>
	<td bgcolor="#EAEAEA" colspan="3"><strong>::ภาพถ่ายอาการเสีย/ปัญหาที่พบ</strong></td>
	</tr>

	<tr>
	<td align="center">'.(count($arrImg['before']) != 0 ? (!empty($arrImg['before'][0] ) ? '<img src="upload-pic-req/'.$arrImg['before'][0].'" height="200" />' : '') : '').'</td>
	<td align="center">'.(count($arrImg['before']) != 0 ? (!empty($arrImg['before'][1] ) ? '<img src="upload-pic-req/'.$arrImg['before'][1].'" height="200" />' : '') : '').'</td>
	<td align="center">'.(count($arrImg['before']) != 0 ? (!empty($arrImg['before'][2] ) ? '<img src="upload-pic-req/'.$arrImg['before'][2].'" height="200" />' : '') : '').'</td>
	</tr>

	<tr>
	<td align="center">'.(count($arrImg['before']) != 0 ? (!empty($arrImg['before'][3] ) ? '<img src="upload-pic-req/'.$arrImg['before'][3].'" height="200" />' : '') : '').'</td>
	<td align="center">'.(count($arrImg['before']) != 0 ? (!empty($arrImg['before'][4] ) ? '<img src="upload-pic-req/'.$arrImg['before'][4].'" height="200" />' : '') : '').'</td>
	<td align="center">'.(count($arrImg['before']) != 0 ? (!empty($arrImg['before'][5] ) ? '<img src="upload-pic-req/'.$arrImg['before'][5].'" height="200" />' : '') : '').'</td>
	</tr>

	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="4">
	<tr>
	<td bgcolor="#EAEAEA" colspan="3"><strong>::ภาพถ่ายอาการเสีย/ปัญหาที่พบ</strong></td>
	</tr>

	<tr>
	<td align="center">'.(count($arrImg['after']) != 0 ? (!empty($arrImg['after'][0] ) ? '<img src="upload-pic-req/'.$arrImg['after'][0].'" height="200" />' : '') : '').'</td>
	<td align="center">'.(count($arrImg['after']) != 0 ? (!empty($arrImg['after'][1] ) ? '<img src="upload-pic-req/'.$arrImg['after'][1].'" height="200" />' : '') : '').'</td>
	<td align="center">'.(count($arrImg['after']) != 0 ? (!empty($arrImg['after'][2] ) ? '<img src="upload-pic-req/'.$arrImg['after'][2].'" height="200" />' : '') : '').'</td>
	</tr>

	<tr>
	<td align="center">'.(count($arrImg['after']) != 0 ? (!empty($arrImg['after'][3] ) ? '<img src="upload-pic-req/'.$arrImg['after'][3].'" height="200" />' : '') : '').'</td>
	<td align="center">'.(count($arrImg['after']) != 0 ? (!empty($arrImg['after'][4] ) ? '<img src="upload-pic-req/'.$arrImg['after'][4].'" height="200" />' : '') : '').'</td>
	<td align="center">'.(count($arrImg['after']) != 0 ? (!empty($arrImg['after'][5] ) ? '<img src="upload-pic-req/'.$arrImg['after'][5].'" height="200" />' : '') : '').'</td>
	</tr>

	</table>';

	$nextImgtable = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
	<tr>
	<td bgcolor="#EAEAEA" width="50%" colspan="3"><strong>::ภาพถ่ายอาการเสีย/ปัญหาที่พบ</strong></td>
	<td bgcolor="#EAEAEA" width="50%" colspan="3"><strong>::ภาพถ่ายหลังซ่อม</strong></td>
	</tr>
	<tr><td></td></tr>
	<tr>
	<td style="text-align:center" colspan="6"><strong>**ไฟล์แนบรูปภาพอยู่หน้าถัดไป**</strong></td>
	</tr>
	</table>';
}else if((empty($arrImg['before'])) && (empty($arrImg['after']))){

	$noImgTable = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
	<tr>
	<td bgcolor="#EAEAEA" width="50%" colspan="3"><strong>::ภาพถ่ายอาการเสีย/ปัญหาที่พบ</strong></td>
	<td bgcolor="#EAEAEA" width="50%" colspan="3"><strong>::ภาพถ่ายหลังซ่อม</strong></td>
	</tr>
	<tr><td></td></tr>
	<tr class="bg-white"><td colspan="6" style="text-align:center;color:grey;">ไม่มีภาพถ่าย</td></tr>
	</table>';

}else{

	if(!empty($arrImg['before'])){
		if(count($arrImg['before']) == 1){
			foreach($arrImg['before'] as $value) {
				$before.= '<td align="center"><img src="upload-pic-req/'.$value.'" height="120" /></td>';
			}
			$before.= '<td></td>
						<td></td>';
		} else if(count($arrImg['before']) == 2){
			foreach($arrImg['before'] as $value) {
				$before.= '<td align="center"><img src="upload-pic-req/'.$value.'" height="120" /></td>';
			}
			$before.= '
						<td></td>';
		} else if(count($arrImg['before']) == 3){
			foreach($arrImg['before'] as $value) {
				$before.= '<td align="center"><img src="upload-pic-req/'.$value.'" height="120" /></td>';
			}
		}
	} else {
		$before.= '<td></td>
					<td></td>
					<td></td>';
	}

	if(!empty($arrImg['after'])){
		if(count($arrImg['after']) == 1){
			foreach($arrImg['after'] as $value) {
				$after.= '<td align="center"><img src="upload-pic-req/'.$value.'" height="120" /></td>';
			}
			$after.= '<td></td>
						<td></td>';
		} else if(count($arrImg['after']) == 2){
			foreach($arrImg['after'] as $value) {
				$after.= '<td align="center"><img src="upload-pic-req/'.$value.'" height="120" /></td>';
			}
			$after.= '
						<td></td>';
		} else if(count($arrImg['after']) == 3){
			foreach($arrImg['after'] as $value) {
				$after.= '<td align="center"><img src="upload-pic-req/'.$value.'" height="120" /></td>';
			}
		}
	}else {
		$after.= '<td></td>
					<td></td>
					<td></td>';
	}


	$imgTable= '<table width="100%" border="0" cellspacing="0" cellpadding="4">
	<tr>
	<td bgcolor="#EAEAEA" width="50%" colspan="3"><strong>::ภาพถ่ายอาการเสีย/ปัญหาที่พบ</strong></td>
	<td bgcolor="#EAEAEA" width="50%" colspan="3"><strong>::ภาพถ่ายหลังซ่อม</strong></td>
	</tr>
	<tr>
	'.$before.$after.'
	</tr>
	</table>';
}




//----------------------------------Switch Case------------------------------------
switch($countPart){

	case '>5':

		$html.='
		<tr>
		<td style="text-align:center" colspan="7"><strong>**รายการอะไหล่อยู่หน้าถัดไป**</strong></td>
		</tr>';

		$html.= '</table>** หากรายการอะไหล่มีมากกว่า 5 รายการ ระบบจะพิมพ์แยกหน้ารายการอะไหล่ให้อัตโนมัติ<br /><br />';

		$html2.= '<table width="100%" border="0" cellspacing="0" cellpadding="4"><tr><td bgcolor="#EAEAEA"><strong>::รายการอะไหล่ที่เปลี่ยน</strong></td></tr></table>';

		$html2.= '<table width="100%" border="0" cellspacing="0" cellpadding="6" bordercolor="#EAEAEA">
		<tr bgcolor="#F3F3F3">
		<td bordercolor="#EAEAEA" width="4%" style="text-align: left; vertical-align:middle; font-weight: bold;">#</td>
		<td bordercolor="#EAEAEA" width="13%" style="text-align: left; vertical-align:middle; font-weight: bold;">S/N No.</td>
		<td bordercolor="#EAEAEA" width="26%" style="text-align: left; vertical-align:middle; font-weight: bold;">ชื่ออะไหล่</td>
		<td bordercolor="#EAEAEA" width="28%" style="text-align: left; vertical-align:middle; font-weight: bold;">รายละเอียด</td>
		<td bordercolor="#EAEAEA" width="10%" style="text-align: right; vertical-align:middle; font-weight: bold;">ราคาบาท/ชิ้น</td>
		<td bordercolor="#EAEAEA" width="9%" style="text-align: right; vertical-align:middle; font-weight: bold;">จำนวน/ชิ้น</td>
		<td bordercolor="#EAEAEA" width="10%" style="text-align: right; vertical-align:middle; font-weight: bold;">รวม/บาท</td>
		</tr>';

		$html2.= $partTable;

		if((empty($arrImg['before'])) && (empty($arrImg['after']))){

			$html.= $noImgTable;

			$pdf->WriteHTML($stylesheet, 1);
			$pdf->writeHTML($html,  true, 0, true, 0);

			$pdf->AddPage();
			$pdf->SetPrintHeader(true);
			$pdf->SetPrintFooter(false);
			$pdf->writeHTML($html2,  true, 0, true, 0);
			// Start First Page Group
			$pdf->startPageGroup();

		}else {

			if((count($arrImg['before']) > 3) || (count($arrImg['after']) > 3)){

				$html.='<table width="100%" border="0" cellspacing="0" cellpadding="4">
				<tr>
				<td bgcolor="#EAEAEA" width="50%" colspan="3"><strong>::ภาพถ่ายอาการเสีย/ปัญหาที่พบ</strong></td>
				<td bgcolor="#EAEAEA" width="50%" colspan="3"><strong>::ภาพถ่ายหลังซ่อม</strong></td>
				</tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr>
				<td style="text-align:center" colspan="6"><strong>**ไฟล์แนบรูปภาพอยู่หน้าที่ 3**</strong></td>
				</tr>
				</table>';

				$html3 = $imgFullTable;

				

				$pdf->WriteHTML($stylesheet, 1);
				$pdf->writeHTML($html,  true, 0, true, 0);

				$pdf->AddPage();
				$pdf->SetPrintHeader(true);
				$pdf->SetPrintFooter(false);
				$pdf->writeHTML($html2,  true, 0, true, 0);

				$pdf->AddPage();
				$pdf->SetPrintHeader(true);
				$pdf->SetPrintFooter(false);
				$pdf->writeHTML($html3,  true, 0, true, 0);
				
				$pdf->startPageGroup();

			}else{

			$html.=$imgTable;
			
			// output the HTML content
			$pdf->WriteHTML($stylesheet, 1);
			$pdf->writeHTML($html,  true, 0, true, 0);

			$pdf->AddPage();
			$pdf->SetPrintHeader(true);
			$pdf->SetPrintFooter(false);
			$pdf->writeHTML($html2,  true, 0, true, 0);
			// Start First Page Group
			$pdf->startPageGroup();

			}

		}

	break;

	case '>2' :

		$html.=$partTable;
	
		$html.= '** หากรายการอะไหล่มีมากกว่า 5 รายการ ระบบจะพิมพ์แยกหน้ารายการอะไหล่ให้อัตโนมัติ<br /><br />';
	
		$before ='';
		$after ='';

		if((empty($arrImg['before'])) && (empty($arrImg['after']))){
			$html.= $noImgTable;

			$pdf->WriteHTML($stylesheet, 1);
			$pdf->writeHTML($html,  true, 0, true, 0);
			// Start First Page Group
			$pdf->startPageGroup();
		
		}else{

			$html.= $nextImgtable;
			
			$html2 = '';
			
			$html2.= $imgFullTable;
			
				// output the HTML content
			$pdf->WriteHTML($stylesheet, 1);
			$pdf->writeHTML($html,  true, 0, true, 0);
			
			$pdf->AddPage();
			$pdf->SetPrintHeader(true);
			$pdf->SetPrintFooter(false);
			$pdf->writeHTML($html2,  true, 0, true, 0);
			$pdf->startPageGroup();

		}

	break;

	case '!0' :

		$html.=$partTable;

		$html.= '** หากรายการอะไหล่มีมากกว่า 5 รายการ ระบบจะพิมพ์แยกหน้ารายการอะไหล่ให้อัตโนมัติ<br /><br />';

		$before ='';
		$after ='';

		if((empty($arrImg['before'])) && (empty($arrImg['after']))){
			$html.= $noImgTable;
			
			$pdf->WriteHTML($stylesheet, 1);
			$pdf->writeHTML($html,  true, 0, true, 0);
			// Start First Page Group
			$pdf->startPageGroup();
		
		}else{

			if((count($arrImg['before']) > 3) || (count($arrImg['after']) > 3)){
				$html.=$nextImgtable;
	
		$html2 = '';
	
		$html2.= $imgFullTable;
	
			// output the HTML content
		$pdf->WriteHTML($stylesheet, 1);
		$pdf->writeHTML($html,  true, 0, true, 0);
	
		$pdf->AddPage();
		$pdf->SetPrintHeader(true);
		$pdf->SetPrintFooter(false);
		$pdf->writeHTML($html2,  true, 0, true, 0);
		$pdf->startPageGroup();
			}else{
			
				$html.= $imgTable;
			
			// output the HTML content
			$pdf->WriteHTML($stylesheet, 1);
			$pdf->writeHTML($html,  true, 0, true, 0);
			// Start First Page Group
			$pdf->startPageGroup();
			}

		}

	break;

	case '0' :
	
		$html.='<tr class="bg-white"><td colspan="8" style="text-align:center;color:grey;">ไม่มีรายการเปลี่ยนอะไหล่</td></tr>';

		$html.='
		<tr bgcolor="#F3F3F3">
		<td colspan="5"></td>
		<td style="text-align:right;">'.$qty_total.'</td>
		<td style="text-align:right;"><u>'.number_format($grand_total,2).'</u></td>
		</tr>';

		$html.= '</table>** หากรายการอะไหล่มีมากกว่า 5 รายการ ระบบจะพิมพ์แยกหน้ารายการอะไหล่ให้อัตโนมัติ<br /><br />';

		$before ='';
		$after ='';

		if((empty($arrImg['before'])) && (empty($arrImg['after']))){

			$html.= $noImgTable;
			
			$pdf->WriteHTML($stylesheet, 1);
			$pdf->writeHTML($html,  true, 0, true, 0);
			// Start First Page Group
			$pdf->startPageGroup();
		}else{
			
			if((count($arrImg['before']) > 3) || (count($arrImg['after']) > 3)){ //รูปภาพมากกว่า 3 จะขึ้นหน้าใหม่

				$html.=$nextImgtable;
			
				$html2 = '';
			
				$html2.= $imgFullTable;
			
				// output the HTML content
				$pdf->WriteHTML($stylesheet, 1);
				$pdf->writeHTML($html,  true, 0, true, 0);
			
				$pdf->AddPage();
				$pdf->SetPrintHeader(true);
				$pdf->SetPrintFooter(false);
				$pdf->writeHTML($html2,  true, 0, true, 0);
				$pdf->startPageGroup();
			
			}else {	
			
				$html.= $imgTable;
			
			// output the HTML content
			$pdf->WriteHTML($stylesheet, 1);
			$pdf->writeHTML($html,  true, 0, true, 0);
			// Start First Page Group
			$pdf->startPageGroup();

			}

		}
	
	break;

}
//------------เช็คไฟล์ที่ถูกสร้างเกิน1วันจะถูกลบ ลดการเปลืองพื้นที่-----------------------
// $paths = getcwd().'/'.$pathPdf;
// $files = array_diff(scandir($paths), array('.', '..'));
// foreach($files as $key => $value){	
// 	$path = getcwd().'/'.$pathPdf.$files[$key].'';
// 	if ((time()-filectime($path) > 86400)) {  // 86400 = 60*60*24
// 	  unlink($path);
// 	}
// }
//---------------------------------------------------------------------------

//Close and output PDF document

//-------------แสดงผล PDF---------------------------------------------------
$pdf->Output($rowData['maintenance_request_no'].'.pdf', "I");


//-----------------บันทึกเป็นไฟล์ PDF และส่งเลขที่ใบซ่อมไปที่หน้า View---------------------------------------
// $pdf->Output(getcwd().'/'.$pathPdf.$rowData['maintenance_request_no'].'.pdf', "F");
// echo json_encode($rowData['maintenance_request_no']);
// exit();
//--------------------------------------------------------------------------------------------------
>>>>>>> Stashed changes

//============================================================+
// END OF FILE
/*ต้นฉบับใบเสร็จรับเงิน / ใบกำกับภาษี
สำเนาใบเสร็จรับเงิน / ใบกำกับภาษี
COPY OFFICIAL RECEIPT / COPY TAX INVOICE
ORIGINAL OFFICIAL RECEIPT / ORIGINAL TAX INVOICE*/
<<<<<<< Updated upstream
//============================================================+
=======
//============================================================+

//--------------------------Case การแสดงผลหน้า PDFนี้ ------------------------------
// CASE 1 
// อะไหล่ มากกว่า 5 (5++)	 

// อะไหล่ อยู่หน้า 2
// เช็ครูป
// 	ไม่มี - ว่าง มีแค่ 2หน้า
// 	มีน้อยกว่า 3 - อยู่หน้า 1 มีแค่ 2 หน้า
// 	มีมากกว่า 3 - อยู่หน้า 3 มี 3 หน้า

// CASE 2
// อะไหล่ มากกว่า 2 (3++) แต่ไม่มากกว่า 5 (2-5)
// อะไหล่หน้า 1 
// เช็ครูป
// 	ไม่มี - ว่าง มีหน้าเดียว
// 	มี - อยู่หน้า 2

// CASE 3
// อะไหล่ ไม่เท่ากับ0 แต่ไม่มากกว่า 2 (1-2)

// อะไหล่หน้า 1 
// เช็ครูป 
// 	ไม่มี - ว่าง มีหน้าเดียว
// 	มีน้อยกว่า 3 - อยู่หน้า 1
// 	มีมากกว่า 3 - อยู่หน้า 2 

// CASE 4 
// อะไหล่ ไม่มี
// อะไหล่ไม่มี

// เช็ครูป
// 	ไม่มี - ว่าง มีหน้าเดียว
// 	มีน้อยกว่า 3 - อยู่หน้า 1 มี 1 หน้า
// 	มีมากกว่า 3 - อยู่หน้า 2 มี 2 หน้า
//--------------------------------------------------------------------------------
>>>>>>> Stashed changes
