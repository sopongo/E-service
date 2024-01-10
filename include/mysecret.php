<?php
class MySecret
{
    public static $conNow = 'local'; // local , db
    public static $dbDatabase = 'db_eservice_new'; 
    // public static $dbDatabaseLogin = 'db_eservice_new';  ไม่ได้ใส่ฟังก์ชันใน crud ใช้เชื่อม db อื่นไม่ได้นะจ๊ะ
    public static $dbUser = 'itpcs';
    public static $dbPass = 'Pcs@1234';
    public static $dbServer = 'mail.cc.pcs-plp.com'; 
    public static $dbPort = '3306';

    public static $LocalDatabase = 'db_eservice_new';
    // public static $LocalDatabaseLogin = 'db_eservice_new'; ไม่ได้ใส่ ใช้เชื่อม db อื่นไม่ได้นะจ๊ะ
    public static $LocalUser = 'root';
    public static $LocalPass = '';
    public static $LocalServer = 'localhost';
    public static $LocalPort = '';
}