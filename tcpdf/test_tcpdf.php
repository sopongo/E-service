<?php

//require_once('../include/config.inc.php');	
require_once('../include/function.inc.php');
require_once ('../include/connect.inc.php');

require_once('./tcpdf.php');
$arr_mouth = array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');	

$id = 111;
$chk_year = 2014;
$chk_month = "07";
	
//create new PDF document

$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
$pdf->setViewerPreferences(array('PrintScaling' => 'None'));
$pageDimensions = $pdf->getPageDimensions();
$yOffset = ceil($pdf->GetY());

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_FOOTER);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// set font
$pdf->SetFont('thsarabun', '', 16);

// add a page
$pdf->AddPage();

$detail_dipositacc = Row("SELECT * FROM tb_member WHERE id_member=$id ");
$fetch_order= Fetch("SELECT * FROM tb_order_complete WHERE ref_id_member=$id AND DATE_FORMAT(odp_adddate,'%Y-%m') = '$chk_year-$chk_month' ORDER BY odp_adddate ASC");
$count_order = count($fetch_order);

// define some HTML content with style

$html='<style>
@page {
	margin-bottom:0.7cm;
	margin-left:1cm;
	margin-right:1cm;
	margin-top:0.7cm;
}
</style>';

// create some HTML content
$html.= "<table>
	<tr>
		<td style=\"width:10%;\"><img src=\"../images/logo-1.png\" width=\"124\" height=\"30\" /></td>	
		<td style=\"font-size:14px; width:55%;\">บริษัท ไทยซอฟท์เทค อินเตอร์กรุ๊ป จำกัด 131 ซอยหมู่บ้านสวนนครินทร์ 1<br /> แขวงหนองบอน  เขตประเวศ กรุงเทพมหานคร 10250 โทรศัพท์ 02-7163565-6 แฟ็กซ์ 02-7163566</td>
		<td style=\"text-align:right; width:35%; margin-bottom:10px;\">รายการยอดสั่งซื้อชำระแล้ว เดือน:".$arr_mouth[6]."<br />$detail_dipositacc[fullname] รหัสหน่วยงาน: $detail_dipositacc[branch_code]</td>		
	</tr>
	</table>";
	
//$pdf->Cell(0, 10, 'รายการสั่งซื้อชำระแล้ว เดือน:', 0, 1, 'L');
$html.= "<table border=\"1\">
	 <thead><tr bgcolor=\"#CCCCCC\">
    	<td style=\"text-align:center; width:6%;\">ลำดับ</td>
    	<td style=\"text-indent:5px; width:13%; \">วันที่ชำระเงิน </td>
    	<td style=\"text-indent:5px; width:13%;\">วันที่รับเอกสาร</td>
    	<td style=\"text-indent:5px; width:18%;\">เลขที่เอกสาร</td>
    	<td style=\"text-align:right; width:35%; padding-right:5px;\">หมายเหตุ&nbsp;&nbsp;&nbsp;</td>
    	<td style=\"text-align:right; width:15%; padding-right:5px; \">จำนวนเงิน / บาท&nbsp;&nbsp;&nbsp;</td>
</tr> </thead>";

if($count_order>0){
	$i = 1;
	foreach($fetch_order as $row){
	$html.= "<tr class=\"tr_detail\">
    	<td style=\"text-align:center; width:6%;\">".$i."</td>
    	<td style=\"text-indent:5px; width:13%;\">".nowDate($row['odp_adddate'])."</td>
    	<td style=\"text-indent:5px; width:13%;\">".nowDate($row['admin_adddate'])."</td>
    	<td style=\"text-indent:5px; width:18%;\">".$row['odp_no']."</td>
    	<td style=\"text-align:right; width:35%; padding-right:5px; \">".$row['odp_remark']."&nbsp;&nbsp;&nbsp;</td>
    	<td style=\"text-align:right; width:15%; padding-right:5px; font-size:18px; font-weight:bold; \">".number_format($row['odp_amount'])."&nbsp;&nbsp;&nbsp;</td>
    </tr>";
		$i++;
		$total_sum_order = $total_sum_order+$row['odp_amount'];
	}//foreach

	$chk_rate = Row("SELECT rate_detail.*, tb_rate.* FROM tb_rate LEFT JOIN tb_rate_detail AS rate_detail ON (tb_rate.id_rate=rate_detail.ref_id_rate) WHERE tb_rate.at_mouth=".intval($chk_month)." AND tb_rate.at_year=".$chk_year." AND ((rate_detail.min_rate<=$total_sum_order AND rate_detail.max_rate>=$total_sum_order) OR (rate_detail.max_rate<$total_sum_order AND rate_detail.upward_rate>=$total_sum_order) ) ORDER BY id_rate_detail ASC LIMIT 1");
	$total_commission = ($total_sum_order*$chk_rate['commis_rate'])/100;
	
	$html.= "
	<tr><td colspan=\"5\" style=\"text-align:right; height:20px; \"><br /><br />ยอดรวมรายการสั่งซื้อชำระแล้ว:&nbsp;&nbsp;</td><td style=\"text-align:right; font-size:18px; font-weight:bold; \"><br /><br />".number_format($total_sum_order,2)."&nbsp;&nbsp;&nbsp;</td></tr>
    <tr><td colspan=\"5\" style=\"text-align:right; height:20px;\"><br /><br />ค่าคอมมิชชั่น:&nbsp;&nbsp;</td><td style=\"text-align:right; font-size:18px; font-weight:bold; \"><br /><br />$chk_rate[commis_rate]%&nbsp;&nbsp;&nbsp;</td></tr>
    <tr><td colspan=\"5\" style=\"text-align:right; height:20px;\"><br /><br />ค่าคอมมิชชั่นสุทธิเดือน xxxx:&nbsp;&nbsp;</td><td style=\"text-align:right; font-size:18px; font-weight:bold; \"><br /><br />".number_format($total_commission,2)." &nbsp;&nbsp;&nbsp;</td></tr>";	
}//if
$html.= '</table>';


// output the HTML content
$pdf->WriteHTML($stylesheet, 1);
// Start First Page Group
$pdf->startPageGroup();
$pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('report_order.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
