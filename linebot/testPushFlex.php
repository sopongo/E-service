<?PHP
date_default_timezone_set('Asia/Bangkok');	
session_start();
require_once ('sendMessage.php');
require_once ('../include/connect_db.inc.php');
require_once ('../include/function.inc.php');
require_once ('../include/setting.inc.php');
require_once ('../include/class_crud.inc.php');

$obj = new CRUD(); ##สร้างออปเจค $obj เพื่อเรียกใช้งานคลาส,ฟังก์ชั่นต่างๆ

	$nowDate = date("d-m-Y h:i:s");
	$data = file_get_contents('php://input');

	//if ($data == '') return;
	//file_put_contents('chkData.txt', $data . PHP_EOL, FILE_APPEND);
	//return;
	$data = json_decode($data, true);

	/*******************************/
	/*
	$data['events'][0]['source']['type'] = 'user'; //group user
	$data['events'][0]['replyToken'] = '';
	$data['events'][0]['message']['type'] ='text';	
	$data['events'][0]['source']['groupId'] = 'C775cbbbfe90cfad4c94945d03c5e7759';
	$data['events'][0]['source']['userId'] = 'Uf14e2ebc73e0510f21574d31797ebc1a';
	$data['events'][0]['message']['text'] ='fol';
	//$data['events'][0]['message']['text'] = 'ลงทะเบียน sopon.g@jwdcoldchain.com';
	*/
	/*******************************/

	if(is_null($data)){ return;	}
	
	//$userId = 'Uf14e2ebc73e0510f21574d31797ebc1a'; //userId ของผู้ใช้ที่เราต้องการส่งข้อความไปแสดง **บรรทัดนี้ไอดีบ๊วยครับ
	//$userId = $data['events'][0]['source']['userId']; //userId ของผู้ใช้ที่เราต้องการส่งข้อความไปแสดง
	//$groupId = $data['events'][0]['source']['groupId']; //groupId ของกรุ๊ปที่เราต้องการส่งข้อความไปแสดง
	//$roomId = $data['events'][0]['source']['roomId']; //groupId ของกรุ๊ปที่เราต้องการส่งข้อความไปแสดง	

	//รับ id ว่ามาจากไหน
	if(isset($data['events'][0]['source']['userId'])){
		$to_id = $data['events'][0]['source']['userId'];
	}else if(isset($data['events'][0]['source']['groupId'])){
		$to_id = $data['events'][0]['source']['groupId'];
	}else if(isset($data['events'][0]['source']['room'])){
		$to_id = $data['events'][0]['source']['room'];
	}
	$replyToken = $data['events'][0]['replyToken'];
	$messageType = $data['events'][0]['message']['type'];	

	switch($messageType){
		case 'text': //text
			$userMessage = $data['events'][0]['message']['text'];
			$userMessage = strtolower($userMessage);
		   	$result = explode(' ', $userMessage);	

		   switch($result[0]){
			case 'gid'; // ถ้าพิมพ์เข้ามาแล้ว $groupId ไม่เท่ากับค่าว่าง แสดงว่าพิมพ์มาจากไลน์กรุ๊ป
				$groupId!='' ? $to_id = $groupId : exit;  //ถ้าเช็คแล้วส่งมาจากกรุ๊ปให้เปลี่ยนค่า userId เป็น groupId
				$typeMsg = 0;
				$flexDataJson = '{
					"type": "text",
					"text": "groupId นี้คือ--> '.$data['events'][0]['source']['groupId'].(!empty($data['events'][0]['source']['userId']) ? ' userId ผู้พิมพ์คำสั่ง-->'.$data['events'][0]['source']['userId'] : '').'----'.$data['events'][0]['source']['userId'].'-|-'.$data['events'][0]['source']['groupId'].'-|-'.$data['events'][0]['source']['room'].'"
				}';
				//$userId = $data['events'][0]['source']['groupId'];
			break;

			case 'ลงทะเบียน';
				if($data['events'][0]['source']['groupId']!=''){//ถ้าลงทะเบียนมาในไลน์กลุ่ม
					$typeMsg = 0;
					$flexDataJson = '{
						"type": "text",
						"text": "คุณต้องลงทะเบียนที่แชทไลน์ E-service เท่านั้น"
					}';
					$to_id = $data['events'][0]['source']['groupId'];
				}else{
					if(filter_var($result[1], FILTER_VALIDATE_EMAIL)) {
						$to_id = $userId;
						$rowData = $obj->customSelect("SELECT id_user, email, line_token, status_user FROM tb_user WHERE email='".$result[1]."' AND status_user=1");
						if($rowData['email']==$result[1] && is_null($rowData['line_token'])){
							$updateRow = [
							  'line_token' => $data['events'][0]['source']['userId'],
							];
							$obj->update($updateRow, "id_user=".$rowData['id_user']."", "tb_user");
							$typeMsg = 0;
							$flexDataJson = '{
							  "type": "text",
							  "text": "อีเมล์ของคุณคือ: '.$result[1].' ระบบลงทะเบียนเรียบร้อยแล้ว คุณสามารถรับการแจ้งเตือนใบแจ้งซ่อมผ่านทางไลน์นี้, หรือไลน์กลุ่มของคุณ"
							}';
						  }else if($rowData['email']==$result[1] && !is_null($rowData['line_token'])){
							$typeMsg = 0;
							$flexDataJson = '{
							  "type": "text",
							  "text": "อีเมล์: '.$result[1].' นี้ถูกใช้ลงทะเบียนแล้ว หากมีข้อสงสัยกรุณาติดต่อฝ่าย IT (PCS) ครับ"
							}';
						  }else{
							$typeMsg = 0;
							$flexDataJson = '{
							  "type": "text",
							  "text": "ไม่พบอีเมล์นี้หรืออาจจะมีการลงทะเบียนอีเมล์นี้ในระบบแล้ว กรุณาติดต่อฝ่าย IT (PCS) ครับ"
							}';
						  }
					}else{
						$typeMsg = 0;
						$flexDataJson = '{
							"type": "text",
							"text": "รูปแบบอีเมล์ไม่ถูกต้องพิมพ์อีเมล์ของคุณอีกครั้ง: '.$result[1].'"
						}';
					}
				}
			break;

			case 'req':
				//strlen($groupId)>1 ? $to_id = $groupId : $to_id = $userId;
				$typeMsg = '';
				$flexDataJson = '{
					"type": "flex",
					"altText": "Open Ticket: เปิดใบแจ้งซ่อม: PCS-XXX-XXXX-XXXX",
					"contents": {
					  "type": "carousel",
					  "contents": [
						{
						  "type": "bubble",
						  "hero": {
							"type": "image",
							"url": "https://ebooking.jwdcoldchain.com/sopon_test/linebot/eservice_carousel.png", 
							"size": "full",
							"aspectRatio": "20:6",
							"aspectMode": "cover"
						  },
						  "body": {
							  "type": "box",
							  "layout": "vertical",
							  "contents": [
								{
								  "type": "text",
								  "text": "Open Ticket",
								  "weight": "bold",
								  "size": "xl"
								},
								{
								  "type": "text",
								  "text": "PCS-XX-0000-0000",
								  "size": "lg",
								  "color": "#1C3379",
								  "weight": "bold",
								  "decoration": "none",
								  "align": "start",
								  "gravity": "bottom"
								},
								{
								  "type": "text",
								  "text": "คุณได้เปิดแจ้งซ่อมผ่านระบบ E-service",
								  "size": "xs",
								  "color": "#000000"
								},
								{
								  "type": "separator"
								},
								{
								  "type": "box",
								  "layout": "vertical",
								  "margin": "lg",
								  "spacing": "sm",
								  "contents": [
									{
									  "type": "box",
									  "layout": "baseline",
									  "spacing": "sm",
									  "contents": [
										{
										  "type": "text",
										  "text": "แจ้งเมื่อ:",
										  "color": "#333333",
										  "size": "xs",
										  "flex": 4,
										  "margin": "xs"
										},
										{
										  "type": "text",
										  "text": "00/00/00 00:00:00",
										  "wrap": true,
										  "color": "#666666",
										  "size": "xs",
										  "flex": 5
										}
									  ]
									},
									{
										"type": "box",
										"layout": "baseline",
										"spacing": "sm",
										"contents": [
										  {
											"type": "text",
											"text": "ไซต์งาน:",
											"color": "#333333",
											"size": "xs",
											"flex": 4
										  },
										  {
											"type": "text",
											"text": "xxxxxxxxxx",
											"wrap": true,
											"color": "#666666",
											"size": "xs",
											"flex": 5,
											"margin": "xs"
										  }
										]
									  },									
									{
									  "type": "box",
									  "layout": "baseline",
									  "spacing": "sm",
									  "contents": [
										{
										  "type": "text",
										  "text": "รหัสเครื่องจักร-อุปกรณ์:",
										  "color": "#333333",
										  "size": "xs",
										  "flex": 4
										},
										{
										  "type": "text",
										  "text": "xxxxxxxxxx",
										  "wrap": true,
										  "color": "#666666",
										  "size": "xs",
										  "flex": 5,
										  "margin": "xs"
										}
									  ]
									},
									{
									  "type": "box",
									  "layout": "baseline",
									  "spacing": "sm",
									  "contents": [
										{
										  "type": "text",
										  "text": "ชื่อเครื่องจักร-อุปกรณ์:",
										  "color": "#333333",
										  "size": "xs",
										  "flex": 4
										},
										{
										  "type": "text",
										  "text": "xxxxxxxxxx",
										  "wrap": true,
										  "color": "#666666",
										  "size": "xs",
										  "flex": 5,
										  "margin": "xs"
										}
									  ]
									},
									{
									  "type": "box",
									  "layout": "baseline",
									  "spacing": "sm",
									  "contents": [
										{
										  "type": "text",
										  "color": "#333333",
										  "size": "xs",
										  "flex": 4,
										  "text": "อาคาร:"
										},
										{
										  "type": "text",
										  "text": "xxxxxxxxxx",
										  "wrap": true,
										  "color": "#666666",
										  "size": "xs",
										  "flex": 5,
										  "margin": "xs"
										}
									  ]
									}
								  ]
								},
								{
								  "type": "box",
								  "layout": "baseline",
								  "spacing": "sm",
								  "contents": [
									{
									  "type": "text",
									  "text": "สถานที่:",
									  "color": "#333333",
									  "size": "xs",
									  "flex": 4
									},
									{
									  "type": "text",
									  "text": "xxxxxxxxxx",
									  "wrap": true,
									  "color": "#666666",
									  "size": "xs",
									  "flex": 5,
									  "margin": "xs"
									}
								  ]
								},
								{
								  "type": "box",
								  "layout": "vertical",
								  "spacing": "sm",
								  "contents": [
									{
									  "type": "text",
									  "text": "อาการเสีย-ปัญหาที่พบ:",
									  "color": "#333333",
									  "size": "xs",
									  "flex": 4,
									  "margin": "md"
									},
									{
									  "type": "text",
									  "text": "xxxxxxxxxx xxx x x x xxxxxxxxxxx xxx x x x xxxxxxxxxxx xxx x x x xxxxxxxxxxx xxx x x x xxxxxxxxxxx xxx x x x x"'.'----'.$data['events'][0]['source']['userId'].'-|-'.$data['events'][0]['source']['groupId'].'-|-'.$data['events'][0]['source']['room'].'",
									  "wrap": true,
									  "color": "#666666",
									  "size": "xs",
									  "flex": 5,
									  "margin": "xs",
									  "maxLines": 5
									}
								  ]
								},
								{
								  "type": "separator"
								}
							  ]
						  },
						  "footer": {
							  "type": "box",
							  "layout": "vertical",
							  "spacing": "sm",
							  "contents": [
								{
								  "type": "text",
								  "text": "โปรดรอแผนก XXXXXX ดำเนินการอนุมัติ",
								  "size": "xs",
								  "margin": "xs",
								  "align": "center",
								  "color": "#1C3379",
								  "gravity": "top"
								}
							  ],
							  "flex": 0
						  }
						}
					  ]
					}
				  }';
			break;

			case 'sreq':
				//strlen($groupId)>1 ? $to_id = $groupId : $to_id = $userId;
				//$to_id = $groupId;
				$typeMsg = '';
				$flexDataJson = '{
					"type": "flex",
					"altText": "Open Ticket: เปิดใบแจ้งซ่อม: PCS-XXX-XXXX-XXXX",
					"contents": {
					  "type": "carousel",
					  "contents": [
						{
						  "type": "bubble",
						  "hero": {
							"type": "image",
							"url": "https://ebooking.jwdcoldchain.com/sopon_test/linebot/eservice_carousel.png", 
							"size": "full",
							"aspectRatio": "20:6",
							"aspectMode": "cover"
						  },
						  "body": {
							  "type": "box",
							  "layout": "vertical",
							  "contents": [
								{
								  "type": "text",
								  "text": "Open Ticket",
								  "weight": "bold",
								  "size": "xl"
								},
								{
								  "type": "text",
								  "text": "PCS-XX-0000-0000",
								  "size": "lg",
								  "color": "#1C3379",
								  "weight": "bold",
								  "decoration": "none",
								  "align": "start",
								  "gravity": "bottom"
								},
								{
								  "type": "text",
								  "text": "มีผู้ใช้งานแจ้งซ่อมผ่านระบบ E-service",
								  "size": "xs",
								  "color": "#000000"
								},
								{
								  "type": "separator"
								},
								{
								  "type": "box",
								  "layout": "vertical",
								  "margin": "lg",
								  "spacing": "sm",
								  "contents": [
									{
									  "type": "box",
									  "layout": "baseline",
									  "spacing": "sm",
									  "contents": [
										{
										  "type": "text",
										  "text": "แจ้งเมื่อ:",
										  "color": "#333333",
										  "size": "xs",
										  "flex": 4,
										  "margin": "xs"
										},
										{
										  "type": "text",
										  "text": "00/00/00 00:00:00",
										  "wrap": true,
										  "color": "#666666",
										  "size": "xs",
										  "flex": 5
										}
									  ]
									},
									{
										"type": "box",
										"layout": "baseline",
										"spacing": "sm",
										"contents": [
										  {
											"type": "text",
											"text": "ไซต์งาน:",
											"color": "#333333",
											"size": "xs",
											"flex": 4
										  },
										  {
											"type": "text",
											"text": "xxxxxxxxxx",
											"wrap": true,
											"color": "#666666",
											"size": "xs",
											"flex": 5,
											"margin": "xs"
										  }
										]
									  },									
									{
									  "type": "box",
									  "layout": "baseline",
									  "spacing": "sm",
									  "contents": [
										{
										  "type": "text",
										  "text": "รหัสเครื่องจักร-อุปกรณ์:",
										  "color": "#333333",
										  "size": "xs",
										  "flex": 4
										},
										{
										  "type": "text",
										  "text": "xxxxxxxxxx",
										  "wrap": true,
										  "color": "#666666",
										  "size": "xs",
										  "flex": 5,
										  "margin": "xs"
										}
									  ]
									},
									{
									  "type": "box",
									  "layout": "baseline",
									  "spacing": "sm",
									  "contents": [
										{
										  "type": "text",
										  "text": "ชื่อเครื่องจักร-อุปกรณ์:",
										  "color": "#333333",
										  "size": "xs",
										  "flex": 4
										},
										{
										  "type": "text",
										  "text": "xxxxxxxxxx",
										  "wrap": true,
										  "color": "#666666",
										  "size": "xs",
										  "flex": 5,
										  "margin": "xs"
										}
									  ]
									},
									{
									  "type": "box",
									  "layout": "baseline",
									  "spacing": "sm",
									  "contents": [
										{
										  "type": "text",
										  "color": "#333333",
										  "size": "xs",
										  "flex": 4,
										  "text": "อาคาร:"
										},
										{
										  "type": "text",
										  "text": "xxxxxxxxxx",
										  "wrap": true,
										  "color": "#666666",
										  "size": "xs",
										  "flex": 5,
										  "margin": "xs"
										}
									  ]
									}
								  ]
								},
								{
								  "type": "box",
								  "layout": "baseline",
								  "spacing": "sm",
								  "contents": [
									{
									  "type": "text",
									  "text": "สถานที่:",
									  "color": "#333333",
									  "size": "xs",
									  "flex": 4
									},
									{
									  "type": "text",
									  "text": "xxxxxxxxxx",
									  "wrap": true,
									  "color": "#666666",
									  "size": "xs",
									  "flex": 5,
									  "margin": "xs"
									}
								  ]
								},
								{
								  "type": "box",
								  "layout": "vertical",
								  "spacing": "sm",
								  "contents": [
									{
									  "type": "text",
									  "text": "อาการเสีย-ปัญหาที่พบ:",
									  "color": "#333333",
									  "size": "xs",
									  "flex": 4,
									  "margin": "md"
									},
									{
									  "type": "text",
									  "text": "xxxxxxxxxx xxx x x x xxxxxxxxxxx xxx x x x xxxxxxxxxxx xxx x x x xxxxxxxxxxx xxx x x x xxxxxxxxxxx xxx x x x x"'.'----'.$data['events'][0]['source']['userId'].'-|-'.$data['events'][0]['source']['groupId'].'-|-'.$data['events'][0]['source']['room'].'",
									  "wrap": true,
									  "color": "#666666",
									  "size": "xs",
									  "flex": 5,
									  "margin": "xs",
									  "maxLines": 5
									}
								  ]
								},
								{
								  "type": "separator"
								}
							  ]
						  },
						  "footer": {
							  "type": "box",
							  "layout": "vertical",
							  "spacing": "sm",
							  "contents": [
								{
								  "type": "text",
								  "text": "เข้าสู่ระบบ E-service เพื่อดูรายละเอียดใบแจ้งซ่อม",
								  "size": "xs",
								  "margin": "xs",
								  "align": "center",
								  "color": "#1C3379",
								  "gravity": "top"
								}
							  ],
							  "flex": 0
						  }
						}
					  ]
					}
				  }';
			break;

			case 'fol':
				//strlen($groupId)>1 ? $to_id = $groupId : $to_id = $userId;
				//$to_id = $groupId;		
				$typeMsg = '';
				$flexDataJson = '{
					"type": "flex",
					"altText": "Follow UP: ติดตามใบแจ้งซ่อม: PCS-XXX-XXXX-XXXX",
					"contents": {
					  "type": "carousel",
					  "contents": [
						{
						  "type": "bubble",
						  "hero": {
							"type": "image",
							"url": "https://ebooking.jwdcoldchain.com/sopon_test/linebot/eservice_carousel.png", 
							"size": "full",
							"aspectRatio": "20:6",
							"aspectMode": "cover"
						  },
						  "body": {
							  "type": "box",
							  "layout": "vertical",
							  "contents": [
								{
								  "type": "text",
								  "text": "Follow UP ติดตามงานซ่อม",
								  "color": "#E72900",
								  "weight": "bold",
								  "size": "xl"
								},
								{
								  "type": "text",
								  "text": "PCS-XX-0000-0000",
								  "size": "lg",
								  "color": "#1C3379",
								  "weight": "bold",
								  "decoration": "none",
								  "align": "start",
								  "gravity": "bottom"
								},
								{
								  "type": "text",
								  "text": "ติดตามใบแจ้งซ่อมผ่านระบบ E-service",
								  "size": "xs",
								  "color": "#000000"
								},
								{
								  "type": "separator"
								},
								{
								  "type": "box",
								  "layout": "vertical",
								  "margin": "lg",
								  "spacing": "sm",
								  "contents": [
									{
									  "type": "box",
									  "layout": "baseline",
									  "spacing": "sm",
									  "contents": [
										{
										  "type": "text",
										  "text": "แจ้งซ่อมเมื่อ:",
										  "color": "#333333",
										  "size": "xs",
										  "flex": 4,
										  "margin": "xs"
										},
										{
										  "type": "text",
										  "text": "00/00/00 00:00:00",
										  "wrap": true,
										  "color": "#666666",
										  "size": "xs",
										  "flex": 5
										}
									  ]
									},
									{
										"type": "box",
										"layout": "baseline",
										"spacing": "sm",
										"contents": [
										  {
											"type": "text",
											"text": "ไซต์งาน:",
											"color": "#333333",
											"size": "xs",
											"flex": 4
										  },
										  {
											"type": "text",
											"text": "xxxxxxxxxx",
											"wrap": true,
											"color": "#666666",
											"size": "xs",
											"flex": 5,
											"margin": "xs"
										  }
										]
									  },									
									{
									  "type": "box",
									  "layout": "baseline",
									  "spacing": "sm",
									  "contents": [
										{
										  "type": "text",
										  "text": "รหัสเครื่องจักร-อุปกรณ์:",
										  "color": "#333333",
										  "size": "xs",
										  "flex": 4
										},
										{
										  "type": "text",
										  "text": "xxxxxxxxxx",
										  "wrap": true,
										  "color": "#666666",
										  "size": "xs",
										  "flex": 5,
										  "margin": "xs"
										}
									  ]
									},
									{
									  "type": "box",
									  "layout": "baseline",
									  "spacing": "sm",
									  "contents": [
										{
										  "type": "text",
										  "text": "ชื่อเครื่องจักร-อุปกรณ์:",
										  "color": "#333333",
										  "size": "xs",
										  "flex": 4
										},
										{
										  "type": "text",
										  "text": "xxxxxxxxxx",
										  "wrap": true,
										  "color": "#666666",
										  "size": "xs",
										  "flex": 5,
										  "margin": "xs"
										}
									  ]
									},
									{
									  "type": "box",
									  "layout": "baseline",
									  "spacing": "sm",
									  "contents": [
										{
										  "type": "text",
										  "color": "#333333",
										  "size": "xs",
										  "flex": 4,
										  "text": "อาคาร:"
										},
										{
										  "type": "text",
										  "text": "xxxxxxxxxx",
										  "wrap": true,
										  "color": "#666666",
										  "size": "xs",
										  "flex": 5,
										  "margin": "xs"
										}
									  ]
									}
								  ]
								},
								{
								  "type": "box",
								  "layout": "baseline",
								  "spacing": "sm",
								  "contents": [
									{
									  "type": "text",
									  "text": "สถานที่:",
									  "color": "#333333",
									  "size": "xs",
									  "flex": 4
									},
									{
									  "type": "text",
									  "text": "xxxxxxxxxx",
									  "wrap": true,
									  "color": "#666666",
									  "size": "xs",
									  "flex": 5,
									  "margin": "xs"
									}
								  ]
								},
								{
								  "type": "box",
								  "layout": "vertical",
								  "spacing": "sm",
								  "contents": [
									{
									  "type": "text",
									  "text": "อาการเสีย-ปัญหาที่พบ:",
									  "color": "#333333",
									  "size": "xs",
									  "flex": 4,
									  "margin": "md"
									},
									{
									  "type": "text",
									  "text": "xxxxxxxxxx xxx x x x xxxxxxxxxxx xxx x x x xxxxxxxxxxx xxx x x x xxxxxxxxxxx xxx x x x xxxxxxxxxxx xxx x x x x"'.'----'.$data['events'][0]['source']['userId'].'-|-'.$data['events'][0]['source']['groupId'].'-|-'.$data['events'][0]['source']['room'].'",
									  "wrap": true,
									  "color": "#666666",
									  "size": "xs",
									  "flex": 5,
									  "margin": "xs",
									  "maxLines": 5
									}
								  ]
								},
								{
									"type": "box",
									"layout": "vertical",
									"spacing": "sm",
									"contents": [
									  {
										"type": "text",
										"text": "ข้อความ,ติดตามความคืบหน้า:",
										"color": "#E72900",
										"size": "xs",
										"flex": 4,
										"margin": "md"
									  },
									  {
										"type": "text",
										"text": "ตอนนี้ซ่อมถึงไหนแล้วครับ รีบดำเนินการด้วยครับ",
										"wrap": true,
										"color": "#E72900",
										"size": "lg",
										"flex": 5,
										"margin": "xs",
										"maxLines": 5
									  }
									]
								  },								
								{
								  "type": "separator"
								}
							  ]
						  },
						  "footer": {
							  "type": "box",
							  "layout": "vertical",
							  "spacing": "sm",
							  "contents": [
								{
								  "type": "text",
								  "text": "เข้าสู่ระบบ E-service เพื่อดูรายละเอียดใบแจ้งซ่อม",
								  "size": "xs",
								  "margin": "xs",
								  "align": "center",
								  "color": "#1C3379",
								  "gravity": "top"
								}
							  ],
							  "flex": 0
						  }
						}
					  ]
					}
				  }';
			break;			

			default:
				return;
		  	break;
		   }//end $result[0]
		break;

		default: // not found type message
			$typeMsg = '';
			return;
		break;
	}//end messageType

	$flexDataJsonDeCode = json_decode($flexDataJson,true);
	$datas['url'] = "https://api.line.me/v2/bot/message/push"; //https://api.line.me/v2/bot/message/reply //https://api.line.me/v2/bot/message/push
	$datas['token'] = "vlyHEJbLorZxAFI50gm7BS4K4ae2TLUwJdReRsed/ce4XPdWT63R634iq8U4LQMI9Ka4h0EcpnfVMMWhiWCQT60l5q7hHx4QoTblP3gsmrZcxj8lFxts7AB4byB/cYBEBmYb36X/basqyoRKiryalwdB04t89/1O/w1cDnyilFU=";//<access token>
	$messages['to'] = $to_id; //<user id>, <group id>,
	$messages['messages'][$typeMsg] = $flexDataJsonDeCode;
	$encodeJson = json_encode($messages);
	
	sentMessage($encodeJson,$datas);
?>