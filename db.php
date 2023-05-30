<?php

class DbConnection {
  
   private $connection;

   function __construct(){
       $this->connection = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=amri");
       if (!$this->connection) {
           die("Failed to connect to PostgreSQL: " . pg_last_error());
       } 
   }

   public function execute_query($sql, $params = array()) {
       $query = pg_prepare($this->connection, "", $sql);

       if ($query) {
           $result = pg_execute($this->connection, "", $params);
           if ($result) {
               return pg_fetch_all($result);
           } else {
               die("Query execution failed: " . pg_last_error());
           }
       } else {
           die("Query preparation failed: " . pg_last_error());
       }
   }

  

   function debug(...$params) {

      foreach ($params as $param){
      
      echo json_encode($param) . "\n";

      die();
      }
  }
}

