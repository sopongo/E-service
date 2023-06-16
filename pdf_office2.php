<?PHP
session_start();
//include_once('include/function.inc.php');
//include_once('include/connect.inc.php');
//include_once('include/config.inc.php');
include_once('tcpdf/tcpdf.php');
//include_once('include/system.inc.php');
//include_once('include/language.inc.php');
ob_clean();// ถ้าไม่ใส่จะมีปัญหาการ include_once ไฟล์อื่นเข้ามา

//$fontname = TCPDF_FONTS::addTTFfont('fonts/PSL005_1.TTF', 'TrueTypeUnicode', '', 96);
//$fontname_bold = TCPDF_FONTS::addTTFfont('fonts/PSL005_1.TTF', 'TrueTypeUnicode', 'B', 100,'B');


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
        if ($this->page!=4) {
			global $fontname;
			global $text_ref_abb;
        // Position at 25 mm from bottom

        $this->SetY(-50);
        //Set font
		$this->SetFont('thsarabun', '', 12, '', false);
		$this->setCellHeightRatio(1.2);		
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
		</td>
		<td width="25%" style="text-align:center;">
		<strong>หัวหน้าช่าง, ผู้อนุมัติซ่อม, ส่งมอบงาน:</strong><br />
		<img src="upload-signature/signature.png" width="200" /><br />
		ชื่อ ({data name})<br />
		วันที่ DD/MM/YYYY		
		</td>
		</tr>
		</table><div style="width:100%; display:block; font-size:12px; line-height:14px; text-align:right;">FM-EN-9999/23<br />DOC. DATE.DD/MM/YYYY </div>');
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
$pdf->SetAuthor('Sopon Gomonchonlamas');
$pdf->SetTitle("ใบแจ้งซ่อม {เลขที่ใบแจ้งซ่อม} {ไซต์งาน}");
$pdf->SetSubject('ใบแจ้งซ่อม {เลขที่ใบแจ้งซ่อม}');
$pdf->SetKeywords('PDF, ใบแจ้งซ่อม {เลขที่ใบแจ้งซ่อม}');

// remove default header/footer
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
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
<td width="8%" style="text-align: left; vertical-align:middle; font-weight: bold;"></td>
<td width="30%"></td>
</tr>
</table>';

$html.= '<table width="100%" border="0" cellspacing="0" cellpadding="4"><tr><td bgcolor="#EAEAEA"><strong>::เครื่องจักร-อุปกรณ์ที่แจ้งซ่อม</strong></td></tr></table>';

$html.= '<table width="100%" border="0" cellspacing="3" cellpadding="3">
<tr>
<td colspan="3" width="17%" style="text-align: left; vertical-align:middle; font-weight: bold;">ประเภทเครื่องจักร:</td>
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
</tr>
</table>';

$html.= '<table width="100%" border="0" cellspacing="0" cellpadding="4"><tr><td bgcolor="#EAEAEA"><strong>::อาการเสีย/ปัญหาที่พบ</strong></td></tr></table>';

$html.= '<table width="100%" border="0" cellspacing="3" cellpadding="3"><tr><td>ราวกั้น กันกระแทก น๊อตหลุด บริเวณที่จัดเก็บรางคอนเวเยอร์ อาคาร 8</td></tr></table>';

$html.= '<table width="100%" border="0" cellspacing="0" cellpadding="4"><tr><td bgcolor="#EAEAEA"><strong>:: สรุปผลการซ่อม</strong></td></tr></table>';

$html.= '<table width="100%" border="0" cellspacing="3" cellpadding="3">
<tr>
<td colspan="2" width="14%" style="text-align: left; vertical-align:middle; font-weight: bold;">ประเภทใบแจ้งซ่อม:</td>
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
</tr>
</table>';

$html.= '<table width="100%" border="0" cellspacing="0" cellpadding="4"><tr><td bgcolor="#EAEAEA"><strong>::  ส่งซ่อมภายนอก</strong></td></tr></table>';

$html.= '<table width="100%" border="0" cellspacing="3" cellpadding="3">
<tr>
<td colspan="2" width="13%" style="text-align: left; vertical-align:middle; font-weight: bold;">สาเหตุที่ส่งซ่อม:</td>
<td width="52%">{Detail Detail Detail}</td>
<td colspan="2" width="10%" style="text-align: left; vertical-align:middle; font-weight: bold;">ซัพพลายเออร์:</td>
<td width="25%">{Detail Detail Detail }</td>
</tr>
<tr>
<td colspan="2" width="15%" style="text-align: left; vertical-align:middle; font-weight: bold;">วันที่ส่งซ่อม:</td>
<td width="35%">{Detail Detail Detail}</td>
<td colspan="2" width="15%" style="text-align: left; vertical-align:middle; font-weight: bold;">วันที่ส่งคืน:</td>
<td width="35%">{Detail Detail Detail}</td>
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

//============================================================+
// END OF FILE
/*ต้นฉบับใบเสร็จรับเงิน / ใบกำกับภาษี
สำเนาใบเสร็จรับเงิน / ใบกำกับภาษี
COPY OFFICIAL RECEIPT / COPY TAX INVOICE
ORIGINAL OFFICIAL RECEIPT / ORIGINAL TAX INVOICE*/
//============================================================+