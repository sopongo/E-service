<?PHP

/*$result = mb_substr('อีเมล์ sopongo@gmail.com', 0, 6);
echo $result;
return;
*/
?>
<style type="text/css">
.p-howto{  font-size:0.90rem;  }
.card-info{ cursor: pointer;}
.ul_style_1{}
.ul_style_1 li{ line-height:1.95rem;}
.ul_style_1 li.m20{ margin-left:20px; list-style: none; color:#000 ; }
.ul_style_1 li.m20::before {
  content: "•"; /* Insert content that looks like bullets */
  padding-right:10px;
  font-size:20px;
  color:#000 ; /* Or a color you prefer */
}

.howto-style-none{}
.howto-style-none li{list-style-type: none; line-height:1.95rem;}

.a-howto{ width: 100%; margin:auto; text-align:center; display:block;}
.a-howto-2{ width:auto;  display:block; }
img.howto{ width: auto; margin:auto; text-align:center;}
img.howto-2{ width: 100%; }

.show_content{ display:inline-block;}
</style>

<div class="card-body">

<!-- Howto 1 -->
<div class="card collapsed-card">
<div class="card-header card-info" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
  <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> อธิบายโปรแกรมแจ้งซ่อมออนไลน์</strong></span></a>
  <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
</div>
<div class="card-body p-howto">
  โปรแกรมแจ้งซ่อมออนไลน์ เฟส 1 ใช้สำหรับแจ้งซ่อม,แจ้งสร้างภายในบริษัทเพื่อให้แผนกที่รับผิดชอบเครื่องจักรหรืออุปกรณ์รับทราบและซ่อมแซมตามที่ได้รับแจ้ง
  <strong class="d-block mt-2 mb-2">ความสามารถของระบบแจ้งซ่อม เฟส 1</strong>
  <ul class="ul_style_1">
      <li>สามารแจ้งซ่อมผ่านทางคอมพิวเตอร์ หรือ โทรศัพท์มือถือได้ (Web Application)</li>
      <li>สแกนรหัสเครื่องจักร-อุปกรณ์ ผ่าน QR CODE เพื่อแจ้งซ่อมได้</li>
      <li>ระบบจัดการสามารถใช้งานได้ดังนี้</li>
      <li class="m20"><strong>ระบบ Master Data เครื่องจักร-อุปกรณ์</strong> <i class="fas fa-angle-double-right"></i> เพิ่ม, ลบ, แก้ไข, ค้นหา, ระงับใช้งานได้</li>
      <li class="m20"><strong>ตั้งค่าใบแจ้งซ่อม</strong> <i class="fas fa-angle-double-right"></i> สามารถกำหนดตัวเลือกในหัวข้อ
     ประเภทใบแจ้งซ่อม, รหัสอาการเสีย, รหัสสาเหตุการเสีย, รหัสการซ่อม,วิธีซ่อม, สาเหตุการปฏิเสธงานซ่อม</li>
     <li class="m20"><strong>ประเภทเครื่องจักร-อุปกรณ์</strong> <i class="fas fa-angle-double-right"></i> เพิ่ม, ลบ, แก้ไข, ค้นหา, ระงับใช้งานได้</li>
      <li class="m20"><strong>ข่าวประกาศ</strong> <i class="fas fa-angle-double-right"></i> เพิ่ม, ลบ, แก้ไข, ค้นหา, ปักหมุด, ระงับใช้งานได้</li>

      <li class="m20"><strong>ผู้ใช้งาน</strong> <i class="fas fa-angle-double-right"></i> เพิ่ม, ลบ, แก้ไข, ค้นหา, ระงับใช้งานได้</li>
      <li class="m20"><strong>สิทธิ์การใช้งาน</strong> <i class="fas fa-angle-double-right"></i> แก้ไขสิทธิ์การใช้งานได้</li>
      <li class="m20"><strong>ไซต์งาน</strong> <i class="fas fa-angle-double-right"></i> เพิ่ม, ลบ, แก้ไข, ค้นหา, ระงับใช้งานได้</li>
      <li class="m20"><strong>อาคาร</strong> <i class="fas fa-angle-double-right"></i> เพิ่ม, ลบ, แก้ไข, ค้นหา, ระงับใช้งานได้</li>
      <li class="m20"><strong>สถานที่</strong> <i class="fas fa-angle-double-right"></i> เพิ่ม, ลบ, แก้ไข, ค้นหา, ระงับใช้งานได้</li>
      <li class="m20"><strong>แผนก</strong> <i class="fas fa-angle-double-right"></i> เพิ่ม, ลบ, แก้ไข, ค้นหา, ระงับใช้งานได้</li>
      <li class="m20"><strong>หน่วยนับ</strong> <i class="fas fa-angle-double-right"></i> เพิ่ม, ลบ, แก้ไข, ค้นหา, ระงับใช้งานได้</li>
      <li class="m20"><strong>แบรนด์</strong> <i class="fas fa-angle-double-right"></i> เพิ่ม, ลบ, แก้ไข, ค้นหา, ระงับใช้งานได้</li>

      <li>ใบแจ้งซ่อมสามารถใช้งานได้หัวข้อต่างๆได้ ดังนี้</li>
      <li class="m20">แสดงรายละเอียดใบแจ้งซ่อม</li>
      <li class="m20"><strong>ประเภทใบแจ้งซ่อมได้</strong> <i class="fas fa-angle-double-right"></i> สามารถอัพเดท แก้ไขข้อมูลได้</li>
      <li class="m20"><strong>ผู้รับผิดชอบงานซ่อม</strong> <i class="fas fa-angle-double-right"></i> สามารถอัพเดท แก้ไขกรณีต้องการเพิ่มข้อมูลได้</li>
      <li class="m20"><strong>อาการเสีย/ปัญหาที่พบ</strong> <i class="fas fa-angle-double-right"></i> สามารถอัพเดท แก้ไขกรณีต้องการเพิ่มข้อมูลได้</li>
      <li class="m20"><strong>ภาพถ่ายอาการเสีย</strong> <i class="fas fa-angle-double-right"></i> สามารถลบรูปได้ กรณีผู้แจ้งซ่อมอัพโหลดรูปผิด (ลบโดย หัวหน้าช่าง)</li>
      <li class="m20"><strong>สรุปผลการซ่อม</strong> <i class="fas fa-angle-double-right"></i> สามารถอัพเดท, แก้ไขข้อมูลได้</li>
      <li class="m20"><strong>ส่งซ่อมภายนอก</strong> <i class="fas fa-angle-double-right"></i> สามารถอัพเดท, แก้ไขข้อมูลได้</li>
      <li class="m20"><strong>รายการอะไหล่ที่เปลี่ยน</strong> <i class="fas fa-angle-double-right"></i> สามารถอัพเดท, แก้ไขข้อมูลได้</li>
      <li class="m20"><strong>ภาพถ่ายหลังซ่อม</strong> <i class="fas fa-angle-double-right"></i> สามารถเพิ่มรูปหลังซ่อมได้</li>
      <li class="m20"><strong>ประเมินผลการซ่อม</strong> <i class="fas fa-angle-double-right"></i> ผู้แจ้งซ่อมสามารถประเมิณผลการซ่อมได้</li>
  </ul>
  <br />
  <a class="a-howto" href="dist/img_howto/howto-1/screencapture-1.png" class="m-auto w-75 bg-danger d-block" data-toggle="lightbox" data-title="โปรแกรมแจ้งซ่อมออนไลน์ เฟส 1"><img src="dist/img_howto/howto-1/screencapture-1.png" class="howto w-75 mb-2 " /><p>คลิกเพื่อดูรูปขนาดใหญ่</p></a>
</div>
<!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 1 -->


<!-- Howto 2 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> อธิบายเมนูหลักต่างๆ ของโปรแกรม</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">
    การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้
  </p>
    <ul class="howto-style-none">
      <li><strong>1.รายละเอียดของผู้ใช้งาน</strong> จะแสดงรายละเอียดของคุณ และใช้สำหรับแก้ไขข้อมูลส่วนตัว, รหัสผ่านของคุณ</li>
      <li><strong>2.เมนูหลัก</strong> เมนูใช้งานส่วนต่างๆในระบบ เช่น แจ้งซ่อม, ติดตามงานซ่อม</li>
      <li><strong>3.จัดการระบบ</strong> สำหรับ ช่าง, หัวหน้าช่าง, ผู้จัดการระบบ จัดการข้อมูลต่างๆในระบบ เช่น ข้อมูลเครื่องจักร, ข้อมูลผู้ใช้งาน</li>
      <li><strong>4.ข่าวประกาศ</strong> แสดงรายข่าวประกาศจากแผนกผู้ซ่อม</li>
      <li><strong>5.แดชบอร์ด</strong> แสดงรายละเอียดจำนวนใบแจ้งซ่อมของคุณ</li>
      <li><strong>6.ติดตาม-ประเมิน</strong> แสดง 5 ใบแจ้งซ่อมล่าสุด</li>
      <br /><a class="a-howto" href="dist/img_howto/howto-2/screencapture-2-1.png" class="m-auto w-75 bg-danger d-block" data-toggle="lightbox" data-title="โปรแกรมแจ้งซ่อมออนไลน์ เฟส 1"><img src="dist/img_howto/howto-2/screencapture-2-1.png" class="howto w-75 mb-2 " /><p>คลิกเพื่อดูรูปขนาดใหญ่</p></a>      
    </ul>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 2 -->

<!-- Howto 3 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> วิธีแจ้งซ่อม บนคอมพิวเตอร์</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body"><!--style="display:block;"-->
  <p class="p-howto">วิธีแจ้งซ่อมด้วยคอมพิวเตอร์ (<strong>PC-Notebook</strong>) มีวิธีการดังนี้</p>
    <ul class="howto-style-none">
      <li>1.คลิกที่เมนู "<strong>แจ้งซ่อม</strong>"
      <a class="a-howto-2" href="dist/img_howto/howto-3/screencapture-3-0.png" class="m-auto w-75 bg-danger d-block" data-toggle="lightbox" data-title="วิธีแจ้งซ่อม บนคอมพิวเตอร์"><img src="dist/img_howto/howto-3/screencapture-3-0.png" class="howto-2 w-50 mb-2 " /><p>คลิกเพื่อดูรูปขนาดใหญ่</p></a>
      </li>
      <li><strong>2.ระบบจะเข้าสู่หน้าจอแจ้งซ่อม</strong> 
      <a class="a-howto-2" href="dist/img_howto/howto-3/screencapture-3-1.png" class="m-auto w-75 bg-danger d-block" data-toggle="lightbox" data-title="วิธีแจ้งซ่อม บนคอมพิวเตอร์"><img src="dist/img_howto/howto-3/screencapture-3-1.png" class="howto-2 w-50 mb-2 " /><p>คลิกเพื่อดูรูปขนาดใหญ่</p></a>
    </li>
      <li><strong>กรอกรายละเอียด<br /></strong>
      <strong>1.</strong>เลือกแผนกที่คุณต้องการส่งใบแจ้งซ่อม<br />
      <strong>2.</strong>คลิกเลือกเครื่องจักร-อุปกรณ์<br />
      <strong>3.</strong>ในช่องค้นหา คุณสามารถพิมพ์ค้นหาเครื่องจักรจากชื่อ หรือ รหัสเครื่องจักรได้<br />
      <a class="a-howto-2" href="dist/img_howto/howto-3/screencapture-3-2.png" class="m-auto w-75 bg-danger d-block" data-toggle="lightbox" data-title="วิธีแจ้งซ่อม บนคอมพิวเตอร์"><img src="dist/img_howto/howto-3/screencapture-3-2.png" class="howto-2 w-25 mb-2 " /><p>คลิกเพื่อดูรูปขนาดใหญ่</p></a>
    </li>

    <li><strong>4.</strong>กรอกอาการเสีย/ปัญหาที่พบ<br />
    <strong>5.</strong>คลิกเลือกรูปภาพปัญหาที่พบ สามารถแนบไฟล์รูปภาพได้สูงสุด 6 ภาพ ขนาดไฟล์ไม่เกิน 3 เมกะไบต์ต่อรูป<br />
    <strong>6.</strong>เลือกประเภทงานซ่อม:<br />
    <strong>7.</strong>หากเกี่ยวกับความปลอดภัยให้คลิกเลือก แจ้ง จป.เพื่อตรวจสอบก่อนและหลังแก้ไข<br />
    <strong>8.</strong>เลือกความเร่งด่วน<br />
    <strong>9.</strong>คลิก ส่งใบแจ้งซ่อม<br />
    <span class="pl-5">จากนั้นระบบจะบันทึกข้อมูล และแสดงรายละเอียดใบแจ้งซ่อมของคุณ</span>
      <a class="a-howto-2" href="dist/img_howto/howto-3/screencapture-3-3.png" class="m-auto w-75 bg-danger d-block" data-toggle="lightbox" data-title="วิธีแจ้งซ่อม บนคอมพิวเตอร์"><img src="dist/img_howto/howto-3/screencapture-3-3.png" class="howto-2 w-25 mb-2 " /><p>คลิกเพื่อดูรูปขนาดใหญ่</p></a>
    </li>    
    </ul>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 3 -->

<!-- Howto 4 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> วิธีแจ้งซ่อม ผ่านโทรศัพท์มือถือ</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">
    การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้
  </p>
    <ul class="howto-style-none">
      <li><strong>1.รายละเอียดของผู้ใช้งาน</strong> จะแสดงรายละเอียดของคุณ และใช้สำหรับแก้ไขข้อมูลส่วนตัว, รหัสผ่านของคุณ</li>
      <li><strong>2.เมนูหลัก</strong> เมนูใช้งานส่วนต่างๆในระบบ เช่น แจ้งซ่อม, ติดตามงานซ่อม</li>
      <li><strong>3.จัดการระบบ</strong> สำหรับ ช่าง, หัวหน้าช่าง, ผู้จัดการระบบ จัดการข้อมูลต่างๆในระบบ เช่น ข้อมูลเครื่องจักร, ข้อมูลผู้ใช้งาน</li>
      <li><strong>4.ข่าวประกาศ</strong> แสดงรายข่าวประกาศจากแผนกผู้ซ่อม</li>
      <li><strong>5.แดชบอร์ด</strong> แสดงรายละเอียดจำนวนใบแจ้งซ่อมของคุณ</li>
      <li><strong>6.ติดตาม-ประเมิน</strong> แสดง 5 ใบแจ้งซ่อมล่าสุด</li>
      <br /><a class="a-howto" href="dist/img_howto/howto-2/screencapture-2-1.png" class="m-auto w-75 bg-danger d-block" data-toggle="lightbox" data-title="โปรแกรมแจ้งซ่อมออนไลน์ เฟส 1"><img src="dist/img_howto/howto-2/screencapture-2-1.png" class="howto w-75 mb-2 " /><p>คลิกเพื่อดูรูปขนาดใหญ่</p></a>      
    </ul>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 4 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i>  ตั้งค่าใบแจ้งซ่อม (ประเภทใบแจ้งซ่อม, รหัสอาการเสีย, รหัสสาเหตุการเสีย, รหัสการซ่อม,วิธีซ่อม, สาเหตุการปฏิเสธงานซ่อม)</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i>  วิธีเพิ่มข้อมูลซัพพลายเออร์</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i>  วิธีเพิ่มข้อมูลแบรนด์, ยี่ห้อ</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i>  วิธีเพิ่มข้อมูลหน่วยนับ</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i>  วิธีเพิ่มข้อมูลแผนก</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i>  วิธีเพิ่มข้อมูลไซต์งาน</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i>  วิธีเพิ่มข้อมูลอาคาร</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i>  วิธีเพิ่มข้อมูลสถานที่</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i>  วิธีเพิ่มข้อมูลผู้ใช้งาน</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i>  วิธีเพิ่มข่าวประกาศ</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i>  วิธีเพิ่มประเภทเครื่องจักร-อุปกรณ์ (หมวดหมู่)</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i>  วิธีเพิ่มข้อมูล Master Data เครื่องจักร-อุปกรณ์</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i>  วิธีเพิ่มข้อมูลเครื่องจักร-อุปกรณ์รายไซต์</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i>  วิธีพิมพ์ QR Code เครื่องจักร-อุปกรณ์</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->


<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i>  อธิบายเมนู ส่วนของหัวหน้าช่าง</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i>  อธิบายเมนู ส่วนของช่างซ่อม</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 5 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> [ <i class="fas fa-user-tie"></i> หัวหน้าช่าง] วิธีอนุมัติ, ไม่อนุมัติใบแจ้งซ่อม และการจ่ายงานให้ช่าง</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">
    การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้
  </p>
    <ul class="howto-style-none">
      <li><strong>1.รายละเอียดของผู้ใช้งาน</strong> จะแสดงรายละเอียดของคุณ และใช้สำหรับแก้ไขข้อมูลส่วนตัว, รหัสผ่านของคุณ</li>
      <li><strong>2.เมนูหลัก</strong> เมนูใช้งานส่วนต่างๆในระบบ เช่น แจ้งซ่อม, ติดตามงานซ่อม</li>
      <li><strong>3.จัดการระบบ</strong> สำหรับ ช่าง, หัวหน้าช่าง, ผู้จัดการระบบ จัดการข้อมูลต่างๆในระบบ เช่น ข้อมูลเครื่องจักร, ข้อมูลผู้ใช้งาน</li>
      <li><strong>4.ข่าวประกาศ</strong> แสดงรายข่าวประกาศจากแผนกผู้ซ่อม</li>
      <li><strong>5.แดชบอร์ด</strong> แสดงรายละเอียดจำนวนใบแจ้งซ่อมของคุณ</li>
      <li><strong>6.ติดตาม-ประเมิน</strong> แสดง 5 ใบแจ้งซ่อมล่าสุด</li>
      <br /><a class="a-howto" href="dist/img_howto/howto-2/screencapture-2-1.png" class="m-auto w-75 bg-danger d-block" data-toggle="lightbox" data-title="โปรแกรมแจ้งซ่อมออนไลน์ เฟส 1"><img src="dist/img_howto/howto-2/screencapture-2-1.png" class="howto w-75 mb-2 " /><p>คลิกเพื่อดูรูปขนาดใหญ่</p></a>      
    </ul>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 5 -->

<!-- Howto 5 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> [ <i class="fas fa-user-tie"></i> หัวหน้าช่าง] วิธีเพิ่มหรือเปลี่ยนช่างซ่อม</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">
    การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้
  </p>
    <ul class="howto-style-none">
      <li><strong>1.รายละเอียดของผู้ใช้งาน</strong> จะแสดงรายละเอียดของคุณ และใช้สำหรับแก้ไขข้อมูลส่วนตัว, รหัสผ่านของคุณ</li>
      <li><strong>2.เมนูหลัก</strong> เมนูใช้งานส่วนต่างๆในระบบ เช่น แจ้งซ่อม, ติดตามงานซ่อม</li>
      <li><strong>3.จัดการระบบ</strong> สำหรับ ช่าง, หัวหน้าช่าง, ผู้จัดการระบบ จัดการข้อมูลต่างๆในระบบ เช่น ข้อมูลเครื่องจักร, ข้อมูลผู้ใช้งาน</li>
      <li><strong>4.ข่าวประกาศ</strong> แสดงรายข่าวประกาศจากแผนกผู้ซ่อม</li>
      <li><strong>5.แดชบอร์ด</strong> แสดงรายละเอียดจำนวนใบแจ้งซ่อมของคุณ</li>
      <li><strong>6.ติดตาม-ประเมิน</strong> แสดง 5 ใบแจ้งซ่อมล่าสุด</li>
      <br /><a class="a-howto" href="dist/img_howto/howto-2/screencapture-2-1.png" class="m-auto w-75 bg-danger d-block" data-toggle="lightbox" data-title="โปรแกรมแจ้งซ่อมออนไลน์ เฟส 1"><img src="dist/img_howto/howto-2/screencapture-2-1.png" class="howto w-75 mb-2 " /><p>คลิกเพื่อดูรูปขนาดใหญ่</p></a>      
    </ul>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 5 -->

<!-- Howto 6 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> [ <i class="fas fa-user-tie"></i> หัวหน้าช่าง] วิธีอัพเดทประเภทใบแจ้งซ่อม</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">
    การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้
  </p>
    <ul class="howto-style-none">
      <li><strong>1.รายละเอียดของผู้ใช้งาน</strong> จะแสดงรายละเอียดของคุณ และใช้สำหรับแก้ไขข้อมูลส่วนตัว, รหัสผ่านของคุณ</li>
      <li><strong>2.เมนูหลัก</strong> เมนูใช้งานส่วนต่างๆในระบบ เช่น แจ้งซ่อม, ติดตามงานซ่อม</li>
      <li><strong>3.จัดการระบบ</strong> สำหรับ ช่าง, หัวหน้าช่าง, ผู้จัดการระบบ จัดการข้อมูลต่างๆในระบบ เช่น ข้อมูลเครื่องจักร, ข้อมูลผู้ใช้งาน</li>
      <li><strong>4.ข่าวประกาศ</strong> แสดงรายข่าวประกาศจากแผนกผู้ซ่อม</li>
      <li><strong>5.แดชบอร์ด</strong> แสดงรายละเอียดจำนวนใบแจ้งซ่อมของคุณ</li>
      <li><strong>6.ติดตาม-ประเมิน</strong> แสดง 5 ใบแจ้งซ่อมล่าสุด</li>
      <br /><a class="a-howto" href="dist/img_howto/howto-2/screencapture-2-1.png" class="m-auto w-75 bg-danger d-block" data-toggle="lightbox" data-title="โปรแกรมแจ้งซ่อมออนไลน์ เฟส 1"><img src="dist/img_howto/howto-2/screencapture-2-1.png" class="howto w-75 mb-2 " /><p>คลิกเพื่อดูรูปขนาดใหญ่</p></a>      
    </ul>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 6 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> [ <i class="fas fa-user-tie"></i> หัวหน้าช่าง] วิธียกเลิกใบแจ้งซ่อม</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">
    การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้
  </p>
    <ul class="howto-style-none">
      <li><strong>1.รายละเอียดของผู้ใช้งาน</strong> จะแสดงรายละเอียดของคุณ และใช้สำหรับแก้ไขข้อมูลส่วนตัว, รหัสผ่านของคุณ</li>
      <li><strong>2.เมนูหลัก</strong> เมนูใช้งานส่วนต่างๆในระบบ เช่น แจ้งซ่อม, ติดตามงานซ่อม</li>
      <li><strong>3.จัดการระบบ</strong> สำหรับ ช่าง, หัวหน้าช่าง, ผู้จัดการระบบ จัดการข้อมูลต่างๆในระบบ เช่น ข้อมูลเครื่องจักร, ข้อมูลผู้ใช้งาน</li>
      <li><strong>4.ข่าวประกาศ</strong> แสดงรายข่าวประกาศจากแผนกผู้ซ่อม</li>
      <li><strong>5.แดชบอร์ด</strong> แสดงรายละเอียดจำนวนใบแจ้งซ่อมของคุณ</li>
      <li><strong>6.ติดตาม-ประเมิน</strong> แสดง 5 ใบแจ้งซ่อมล่าสุด</li>
      <br /><a class="a-howto" href="dist/img_howto/howto-2/screencapture-2-1.png" class="m-auto w-75 bg-danger d-block" data-toggle="lightbox" data-title="โปรแกรมแจ้งซ่อมออนไลน์ เฟส 1"><img src="dist/img_howto/howto-2/screencapture-2-1.png" class="howto w-75 mb-2 " /><p>คลิกเพื่อดูรูปขนาดใหญ่</p></a>      
    </ul>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> [ <i class="fas fa-user-tie"></i> หัวหน้าช่าง] วิธีแก้ไขอาการเสีย/ปัญหาที่พบ</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">
    การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้
  </p>
    <ul class="howto-style-none">
      <li><strong>1.รายละเอียดของผู้ใช้งาน</strong> จะแสดงรายละเอียดของคุณ และใช้สำหรับแก้ไขข้อมูลส่วนตัว, รหัสผ่านของคุณ</li>
      <li><strong>2.เมนูหลัก</strong> เมนูใช้งานส่วนต่างๆในระบบ เช่น แจ้งซ่อม, ติดตามงานซ่อม</li>
      <li><strong>3.จัดการระบบ</strong> สำหรับ ช่าง, หัวหน้าช่าง, ผู้จัดการระบบ จัดการข้อมูลต่างๆในระบบ เช่น ข้อมูลเครื่องจักร, ข้อมูลผู้ใช้งาน</li>
      <li><strong>4.ข่าวประกาศ</strong> แสดงรายข่าวประกาศจากแผนกผู้ซ่อม</li>
      <li><strong>5.แดชบอร์ด</strong> แสดงรายละเอียดจำนวนใบแจ้งซ่อมของคุณ</li>
      <li><strong>6.ติดตาม-ประเมิน</strong> แสดง 5 ใบแจ้งซ่อมล่าสุด</li>
      <br /><a class="a-howto" href="dist/img_howto/howto-2/screencapture-2-1.png" class="m-auto w-75 bg-danger d-block" data-toggle="lightbox" data-title="โปรแกรมแจ้งซ่อมออนไลน์ เฟส 1"><img src="dist/img_howto/howto-2/screencapture-2-1.png" class="howto w-75 mb-2 " /><p>คลิกเพื่อดูรูปขนาดใหญ่</p></a>      
    </ul>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> [ <i class="fas fa-user-tie"></i> หัวหน้าช่าง] วิธีลบรูปภาพถ่ายอาการเสีย / ปัญหาที่พบ</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">
    การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้
  </p>
    <ul class="howto-style-none">
      <li><strong>1.รายละเอียดของผู้ใช้งาน</strong> จะแสดงรายละเอียดของคุณ และใช้สำหรับแก้ไขข้อมูลส่วนตัว, รหัสผ่านของคุณ</li>
      <li><strong>2.เมนูหลัก</strong> เมนูใช้งานส่วนต่างๆในระบบ เช่น แจ้งซ่อม, ติดตามงานซ่อม</li>
      <li><strong>3.จัดการระบบ</strong> สำหรับ ช่าง, หัวหน้าช่าง, ผู้จัดการระบบ จัดการข้อมูลต่างๆในระบบ เช่น ข้อมูลเครื่องจักร, ข้อมูลผู้ใช้งาน</li>
      <li><strong>4.ข่าวประกาศ</strong> แสดงรายข่าวประกาศจากแผนกผู้ซ่อม</li>
      <li><strong>5.แดชบอร์ด</strong> แสดงรายละเอียดจำนวนใบแจ้งซ่อมของคุณ</li>
      <li><strong>6.ติดตาม-ประเมิน</strong> แสดง 5 ใบแจ้งซ่อมล่าสุด</li>
      <br /><a class="a-howto" href="dist/img_howto/howto-2/screencapture-2-1.png" class="m-auto w-75 bg-danger d-block" data-toggle="lightbox" data-title="โปรแกรมแจ้งซ่อมออนไลน์ เฟส 1"><img src="dist/img_howto/howto-2/screencapture-2-1.png" class="howto w-75 mb-2 " /><p>คลิกเพื่อดูรูปขนาดใหญ่</p></a>      
    </ul>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> [ <i class="fas fa-user-tie"></i> หัวหน้าช่าง] วิธีสรุปผลการซ่อม</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">
    การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้
  </p>
    <ul class="howto-style-none">
      <li><strong>1.รายละเอียดของผู้ใช้งาน</strong> จะแสดงรายละเอียดของคุณ และใช้สำหรับแก้ไขข้อมูลส่วนตัว, รหัสผ่านของคุณ</li>
      <li><strong>2.เมนูหลัก</strong> เมนูใช้งานส่วนต่างๆในระบบ เช่น แจ้งซ่อม, ติดตามงานซ่อม</li>
      <li><strong>3.จัดการระบบ</strong> สำหรับ ช่าง, หัวหน้าช่าง, ผู้จัดการระบบ จัดการข้อมูลต่างๆในระบบ เช่น ข้อมูลเครื่องจักร, ข้อมูลผู้ใช้งาน</li>
      <li><strong>4.ข่าวประกาศ</strong> แสดงรายข่าวประกาศจากแผนกผู้ซ่อม</li>
      <li><strong>5.แดชบอร์ด</strong> แสดงรายละเอียดจำนวนใบแจ้งซ่อมของคุณ</li>
      <li><strong>6.ติดตาม-ประเมิน</strong> แสดง 5 ใบแจ้งซ่อมล่าสุด</li>
      <br /><a class="a-howto" href="dist/img_howto/howto-2/screencapture-2-1.png" class="m-auto w-75 bg-danger d-block" data-toggle="lightbox" data-title="โปรแกรมแจ้งซ่อมออนไลน์ เฟส 1"><img src="dist/img_howto/howto-2/screencapture-2-1.png" class="howto w-75 mb-2 " /><p>คลิกเพื่อดูรูปขนาดใหญ่</p></a>      
    </ul>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> [ <i class="fas fa-user-tie"></i> หัวหน้าช่าง] วิธีบันทึกข้อมูลส่งซ่อมภายนอก</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">
    การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้
  </p>
    <ul class="howto-style-none">
      <li><strong>1.รายละเอียดของผู้ใช้งาน</strong> จะแสดงรายละเอียดของคุณ และใช้สำหรับแก้ไขข้อมูลส่วนตัว, รหัสผ่านของคุณ</li>
      <li><strong>2.เมนูหลัก</strong> เมนูใช้งานส่วนต่างๆในระบบ เช่น แจ้งซ่อม, ติดตามงานซ่อม</li>
      <li><strong>3.จัดการระบบ</strong> สำหรับ ช่าง, หัวหน้าช่าง, ผู้จัดการระบบ จัดการข้อมูลต่างๆในระบบ เช่น ข้อมูลเครื่องจักร, ข้อมูลผู้ใช้งาน</li>
      <li><strong>4.ข่าวประกาศ</strong> แสดงรายข่าวประกาศจากแผนกผู้ซ่อม</li>
      <li><strong>5.แดชบอร์ด</strong> แสดงรายละเอียดจำนวนใบแจ้งซ่อมของคุณ</li>
      <li><strong>6.ติดตาม-ประเมิน</strong> แสดง 5 ใบแจ้งซ่อมล่าสุด</li>
      <br /><a class="a-howto" href="dist/img_howto/howto-2/screencapture-2-1.png" class="m-auto w-75 bg-danger d-block" data-toggle="lightbox" data-title="โปรแกรมแจ้งซ่อมออนไลน์ เฟส 1"><img src="dist/img_howto/howto-2/screencapture-2-1.png" class="howto w-75 mb-2 " /><p>คลิกเพื่อดูรูปขนาดใหญ่</p></a>      
    </ul>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> [ <i class="fas fa-user-tie"></i> หัวหน้าช่าง] วิธีบันทึกรายการอะไหล่ที่เปลี่ยน</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> [ <i class="fas fa-user-tie"></i> หัวหน้าช่าง]  วิธีอัพโหลดภาพถ่ายหลังซ่อม:</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">
    การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้
  </p>
    <ul class="howto-style-none">
      <li><strong>1.รายละเอียดของผู้ใช้งาน</strong> จะแสดงรายละเอียดของคุณ และใช้สำหรับแก้ไขข้อมูลส่วนตัว, รหัสผ่านของคุณ</li>
      <li><strong>2.เมนูหลัก</strong> เมนูใช้งานส่วนต่างๆในระบบ เช่น แจ้งซ่อม, ติดตามงานซ่อม</li>
      <li><strong>3.จัดการระบบ</strong> สำหรับ ช่าง, หัวหน้าช่าง, ผู้จัดการระบบ จัดการข้อมูลต่างๆในระบบ เช่น ข้อมูลเครื่องจักร, ข้อมูลผู้ใช้งาน</li>
      <li><strong>4.ข่าวประกาศ</strong> แสดงรายข่าวประกาศจากแผนกผู้ซ่อม</li>
      <li><strong>5.แดชบอร์ด</strong> แสดงรายละเอียดจำนวนใบแจ้งซ่อมของคุณ</li>
      <li><strong>6.ติดตาม-ประเมิน</strong> แสดง 5 ใบแจ้งซ่อมล่าสุด</li>
      <br /><a class="a-howto" href="dist/img_howto/howto-2/screencapture-2-1.png" class="m-auto w-75 bg-danger d-block" data-toggle="lightbox" data-title="โปรแกรมแจ้งซ่อมออนไลน์ เฟส 1"><img src="dist/img_howto/howto-2/screencapture-2-1.png" class="howto w-75 mb-2 " /><p>คลิกเพื่อดูรูปขนาดใหญ่</p></a>      
    </ul>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="link-info"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> [ <i class="fas fa-user-tie"></i> หัวหน้าช่าง] วิธีส่งมอบงานให้ผู้แจ้งซ่อม, ยกเลิกการส่งมอบ</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">
    การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้
  </p>
    <ul class="howto-style-none">
      <li><strong>1.รายละเอียดของผู้ใช้งาน</strong> จะแสดงรายละเอียดของคุณ และใช้สำหรับแก้ไขข้อมูลส่วนตัว, รหัสผ่านของคุณ</li>
      <li><strong>2.เมนูหลัก</strong> เมนูใช้งานส่วนต่างๆในระบบ เช่น แจ้งซ่อม, ติดตามงานซ่อม</li>
      <li><strong>3.จัดการระบบ</strong> สำหรับ ช่าง, หัวหน้าช่าง, ผู้จัดการระบบ จัดการข้อมูลต่างๆในระบบ เช่น ข้อมูลเครื่องจักร, ข้อมูลผู้ใช้งาน</li>
      <li><strong>4.ข่าวประกาศ</strong> แสดงรายข่าวประกาศจากแผนกผู้ซ่อม</li>
      <li><strong>5.แดชบอร์ด</strong> แสดงรายละเอียดจำนวนใบแจ้งซ่อมของคุณ</li>
      <li><strong>6.ติดตาม-ประเมิน</strong> แสดง 5 ใบแจ้งซ่อมล่าสุด</li>
      <br /><a class="a-howto" href="dist/img_howto/howto-2/screencapture-2-1.png" class="m-auto w-75 bg-danger d-block" data-toggle="lightbox" data-title="โปรแกรมแจ้งซ่อมออนไลน์ เฟส 1"><img src="dist/img_howto/howto-2/screencapture-2-1.png" class="howto w-75 mb-2 " /><p>คลิกเพื่อดูรูปขนาดใหญ่</p></a>      
    </ul>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="text-danger"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> [ <i class="fas fa-users"></i> ช่างซ่อม] วิธีรับงานซ่อม หรือ ปฎิเสธรับงานซ่อม</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="text-danger"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> [ <i class="fas fa-users"></i> ช่างซ่อม] วิธีการกดเริ่มซ่อม เพื่อบันทึกเวลาซ่อม</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->

<!-- Howto 7 -->
<div class="card collapsed-card">
  <div class="card-header" data-card-widget="collapse" title="อ่านวิธีใช้งาน">
    <a href="#" class="text-danger"><span class="card-title text-sm"><strong><i class="fas fa-info-circle"></i> [ <i class="fas fa-users"></i> ช่างซ่อม] วิธีปิดงานซ่อมเมื่อซ่อมเสร็จ</strong></span></a>
    <div class="card-tools"><button type="button" class="btn btn-tool">คลิกอ่าน</button></div>
  </div>
  <div class="card-body">
  <p class="p-howto">การใช้งานโปรแกรมแจ้งซ่อมมีเมนู ที่ใช้งานหลักๆ ดังนี้</p>
  </div><!-- /.card-body -->
</div><!-- /.card collapsed-card -->
<!-- End Howto 7 -->


</div><!-- /.card-body -->