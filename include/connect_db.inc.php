<?php
require_once __DIR__ . "/mysecret.php";

class Database
{
    ####localhost
    //private $dbServer = 'mail.cc.pcs-plp.com'; private $dbUser = 'itpcs'; private $dbPassword = 'Pcs@1234'; private $dbName = 'db_eservice_new'; //ON SERVER;
    
    
    ####Server
    //private $dbServer = 'mail.cc.pcs-plp.com'; private $dbUser = 'itpcs2'; private $dbPassword = 'Pcs@1234Pcs@1233'; private $dbName = 'db_centralstore_online';
    //private $dbServer = 'mail.cc.pcs-plp.com'; private $dbUser = 'itpcs'; private $dbPassword = 'Pcs@1234'; private $dbName = 'db_centralstore_online';
    
    protected $conn; //protected public
    public function __construct() //$DBConnect
    {
        switch(MySecret::$conNow){
            case 'db':
                // if($DBConnect == 'e-service' || $DBConnect == 'login')
                //     $Database = MySecret::$dbDatabaseLogin;
                // else
                    $Database = MySecret::$dbDatabase;
                $User     = MySecret::$dbUser;
                $Password = MySecret::$dbPass;
                $Server   = MySecret::$dbServer;
                $Port     = MySecret::$dbPort;
                break;
            case 'local':
                // if($DBConnect == 'e-service' || $DBConnect == 'login')
                //     $Database = MySecret::$LocalDatabaseLogin;
                // else
                    $Database = MySecret::$LocalDatabase;
                $User     = MySecret::$LocalUser;
                $Password = MySecret::$LocalPass;
                $Server   = MySecret::$LocalServer;
                $Port     = MySecret::$LocalPort;
                break;
        }


        try {
            $options  = [
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
              PDO::ATTR_PERSISTENT => true,
              PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'"
            ];
            $db = new PDO(
              "mysql:host=$Server;port=$Port;dbname=$Database;charset=utf8",
              $User,
              $Password,
              $options
            );

            $this->conn = $db;
          } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
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
