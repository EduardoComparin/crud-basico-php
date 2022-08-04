<?php
class MySQL {
   private $user;
   private $password;
   private $database;
   private $host;

   public function __construct($user = "root", $password="", $database="desafio", $host="localhost"){
       $this->user     =   $user;
       $this->password =   $password;
       $this->database =   $database;
       $this->host     =   $host;

       $this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->database);
       if (mysqli_connect_errno()) {
           die('FATAL ERROR: Can not connect to SQL Server.');
           exit();
       }
   }

   public function _query($qr){
       $this->result = $this->mysqli->query($qr);
       return $this->result;
   }

   public function _close(){
       $this->mysqli->close();
   }
}
?>