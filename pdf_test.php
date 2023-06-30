<?PHP
session_start();
include_once('include/function.inc.php');
include_once('include/connect.inc.php');
//include_once('include/config.inc.php');
include_once('include/class_crud.inc.php');
include_once('include/setting.inc.php');
include_once('tcpdf/tcpdf.php');
//include_once('include/system.inc.php');
//include_once('include/language.inc.php');
ob_clean();// ถ้าไม่ใส่จะมีปัญหาการ include_once ไฟล์อื่นเข้ามา

//$fontname = TCPDF_FONTS::addTTFfont('fonts/PSL005_1.TTF', 'TrueTypeUnicode', '', 96);
//$fontname_bold = TCPDF_FONTS::addTTFfont('fonts/PSL005_1.TTF', 'TrueTypeUnicode', 'B', 100,'B');


class MYPDF extends TCPDF {
    //Page header 	
    public function Header() {	
		
        $this->writeHTML('');
        // We need to adjust the x and y positions of this text ... first two parameters
		// set bacground image
		// restore auto-page-break status
		// set the starting point for the page content
		$this->setPageMark();
    }
	
    // Page footer
    public function Footer() {
		
		
		$this->writeHTML('');
		//'ไปขวา ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx ,xxx'
		//$this->Image($img_file, 125, 120, 0, 0, '', '', '', true, 300, '', false, false, 0);
		}
    
}

//create new PDF document
$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->setViewerPreferences(array('PrintScaling' => 'None'));
$pageDimensions = $pdf->getPageDimensions();
//$yOffset = ceil($pdf->GetY());

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($_SESSION['sess_fullname']);
$pdf->SetTitle("ใบแจ้งซ่อม ");
$pdf->SetSubject('ใบแจ้งซ่อม ');
$pdf->SetKeywords('PDF, ใบแจ้งซ่อม ');

// remove default header/footer
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT, PDF_MARGIN_BOTTOM);
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

$stylesheet ='';

$html = '';

			
			// output the HTML content
			$pdf->WriteHTML($stylesheet, 1);
			$pdf->writeHTML($html,  true, 0, true, 0);

            $pdf->AddPage();
            $pdf->AddPage();
            $pdf->AddPage();
            
			// Start First Page Group
			$pdf->startPageGroup();

		
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
$pdf->Output('test.pdf', "I");


//-----------------บันทึกเป็นไฟล์ PDF และส่งเลขที่ใบซ่อมไปที่หน้า View---------------------------------------
// $pdf->Output(getcwd().'/'.$pathPdf.$rowData['maintenance_request_no'].'.pdf', "F");
// echo json_encode($rowData['maintenance_request_no']);
// exit();
//--------------------------------------------------------------------------------------------------

//============================================================+
// END OF FILE
/*ต้นฉบับใบเสร็จรับเงิน / ใบกำกับภาษี
สำเนาใบเสร็จรับเงิน / ใบกำกับภาษี
COPY OFFICIAL RECEIPT / COPY TAX INVOICE
ORIGINAL OFFICIAL RECEIPT / ORIGINAL TAX INVOICE*/
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