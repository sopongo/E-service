<?PHP
    date_default_timezone_set('Asia/Bangkok');	
     require_once('include/class.phpmailer.php');//ระบบส่งเมล์
     ##### ส่งอีเมล์แจ้งเตือนหัวหน้าช่าง-ผู้แจ้งซ่อม ######
                                 $mail = new PHPMailer();
                                 $mail->IsSMTP();
                                 $mail->SMTPDebug = 1;
                                 $mail->SMTPAuth = true;
                                 $mail->SMTPSecure = "ssl"; // Enable "tls" encryption, "ssl" also accepted
                                 $mail->Host = "mail.cc.pcs-plp.com"; //$smtp
                                 $mail->Port = 465; //$smtp_port
                                 $mail->CharSet = 'UTF-8';
                                 $mail->Username = "no-reply@cc.pcs-plp.com"; //$noreply_mail
                                 $mail->Password = "Pcs@1234"; //$pass_mail
                                 $mail->SetFrom("no-reply@cc.pcs-plp.com", "E-service (แจ้งซ่อมออนไลน์)");
                                 //$mail->AddBCC("it-support@jwdcoldchain.com", "หัว จม.(เทส ส่งใบแจ้งซ่อมนะต๊ะ) มีผู้แจ้งซ่อมผ่านระบบ E-service เลขที่ใบแจ้งซ่อม");
                                 //$mail->AddAttachment($upload_pdf."invoice_".$inv_no.".pdf");
                                 //$mail->AddReplyTo("youruser@yahoo.com","Mocyc Dot Com");
                                 //$date_now = nowDate(date("Y-m-d H:i:s"));
                                 //$time_now = nowTime(date("Y-m-d H:i:s"));
                                 $mail->Subject = "[แจ้งซ่อม] มีผู้แจ้งซ่อมผ่านระบบ E-service เลขที่ใบแจ้งซ่อม PCS-FM-MT-2303-0012";
                                 $message = '<table style="width:50%;" cellspacing="1" cellpadding="1" border="1">
                                 <tr>
                                   <td>
                                 <table style="width:100%; font-family: Tahoma, serif; font-size:13px; " cellspacing="0" cellpadding="10" border="0">
                                   <tr>
                                     <td colspan="2"><strong>[E-service Alert] มีผู้แจ้งซ่อมผ่านระบบ E-service เลขที่ใบแจ้งซ่อม PCS-FM-MT-2303-0012</strong></td>
                                   </tr>
                                   <tr>
                                     <td colspan="2"><strong>แจ้ง ผจก.แผนก, หัวหน้าส่วน, ผู้มีส่วนเกี่ยวข้อง</strong></td>
                                   </tr>
                                   <tr>
                                     <td colspan="2"><strong>ไซต์งาน:</strong> xxxxxx</td>
                                   </tr>
                                   <tr>
                                     <td colspan="2"><strong>แผนก:</strong> xxxxxx</td>
                                   </tr>    
                                     <tr>
                                     <td colspan="2">มีผู้แจ้งซ่อมเครื่องจักร-อุปกรณ์ เลขที่ใบแจ้งซ่อม: PCS-FM-MT-2303-0012</td>
                                   </tr>
                                   <tr><td width="30%"><strong>ผู้แจ้งซ่อม:</strong></td><td width="70%">xxxxxxx <strong>แผนก:</strong> xxxxxx</td></tr>
                                   <tr><td><strong>วันที่แจ้งซ่อม:</strong></td><td>'.(date('Y-m-d H:i:s')).'</td></tr>
                                   <tr><td><strong>ชื่อเครื่องจักร-อุปกรณ์:</strong></td><td>xxxxxxxxxxxxx:</td></tr>
                                   <tr><td><strong>ไซต์งาน:</strong></td><td>xxxxxxxxxxx</td></tr>
                                   <tr><td><strong>อาคาร:</strong></td><td>xxxxxxx</td></tr>
                                   <tr><td><strong>สถานที่:</strong></td><td>xxxxxxx</td></tr>
                                   <tr><td><strong>อาการเสีย/ปัญหาที่พบ:</strong></td><td></td></tr>
                                   <tr><td colspan="2">xxxxxxx</td></tr>
                                   <tr><td colspan="2"><hr /></td></tr>  
                                   <tr><td colspan="2"><strong>คลิกที่นี่เพื่อเข้าสู่ระบบ E-service</strong></td></tr>  
                                 </table>
                                   </td>
                                 </tr>
                                 </table>';
                                 $mail->MsgHTML($message);
                                 //$mail->AddAttachment("(Windows 7) - Wallpapers4Desktop.com 015.jpg");
                                 $mail->AddAddress("sopon.g@jwdcoldchain.com");//อีเมล์ผู้รับ
                                 $mail->set('X-Priority', '3'); //Priority 1 = High, 3 = Normal, 5 = low
                                 //$mail->Send(); //ส่งเมล์
                                 if(!$mail->Send()){
                                     echo 'ส่งไม่ได้';
                                 }else{
                                     echo 'ส่งแล้วคร้าบบบบบบ';
                                 }
     ##### ส่งอีเมล์แจ้งเตือนหัวหน้าช่าง-ผู้แจ้งซ่อม ######
?>