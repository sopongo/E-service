<?php

class Database
{
    ####localhost 
    private $dbServer = 'localhost'; private $dbUser = 'root'; private $dbPassword = ''; private $dbName = 'db_eservice';
    //private $dbServer = 'mail.cc.pcs-plp.com'; private $dbUser = 'itpcs'; private $dbPassword = 'Pcs@1234'; private $dbName = 'db_eservice_new'; //ON SERVER;
    
    
    //private $dbServer = '127.0.0.1:3306'; private $dbUser = 'eioc'; private $dbPassword = 'l;ylfu8iy['; private $dbName = 'mqtteioc';
/*
		172.16.61.38			
mqtt.jwdcoldchain.com				mqtteioc
MIS	HV02	itpcs	Pcs@1234		
Ubuntu 2004 with mosquito / pass for mosq (admin:admin1234. , eioc:abcd@cc)			MySql HostName	user  =  eioc	pass  =  l;ylfu8iy[
*/    

    ####Server
    //private $dbServer = 'mail.cc.pcs-plp.com'; private $dbUser = 'itpcs2'; private $dbPassword = 'Pcs@1234Pcs@1233'; private $dbName = 'db_centralstore_online';
    //private $dbServer = 'mail.cc.pcs-plp.com'; private $dbUser = 'itpcs'; private $dbPassword = 'Pcs@1234'; private $dbName = 'db_centralstore_online';
    
    protected $conn; //protected public
    public function __construct()
    {
        try {
            $dsn = "mysql:host={$this->dbServer}; dbname={$this->dbName}; charset=utf8";
            $options = array(PDO::ATTR_PERSISTENT);
            $this->conn = new PDO($dsn, $this->dbUser, $this->dbPassword, $options);
            //echo "ok"; die;
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }
}


/*
//db_requisition
$serverName ='localhost';
$dbName ='db_requisition';
$userName ='root';
$userPassword ='';

try {
  $conn = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $userPassword);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
*/


?>    
