<?php
class WebsiteDatabase extends SQLite3
{
   function __construct()
   {
      $this->open('data/database.db');
   }

   function checkTableExists($table_name) {
      $sql = sprintf("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='%s'", $table_name);

      $ret = $this->query($sql);
      echo "<br>";
      echo print_r($ret, $return=true);
      echo "<br>";
      if ($ret) {
         $ary = $ret->fetchArray(SQLITE3_NUM);
         if ($ary[0] > 0) {
            return True;
         } else {
            return False;
         }
      }
   }
}


function object_to_string($obj) {
   return print_r($obj, $return=true);
}

function databaseDebug($db, $ret, $msg) {
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo $msg."\n";
   }
}




function openDatabase() {
      $db = new WebsiteDatabase();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n";
   }

   //check to see if the product inventory table already exists
   echo "Checking table exists";
   if (!$db->checkTableExists("PRODUCT_INVENTORY")) {
      $sql =<<<EOF
      CREATE TABLE PRODUCT_INVENTORY
      (ID INT PRIMARY KEY     NOT NULL,
      NAME            TEXT    NOT NULL,
      COST_PRICE      REAL    NOT NULL,
      SALE_PRICE      REAL    NOT NULL,
      STOCK_LEVEL     INTEGER NOT NULL,
      DESCRIPTION     TEXT);
EOF;
      $ret = $db->exec($sql);
      databaseDebug($db, $ret, "Created product inventory table");
   } else {
      echo "table already exists, not creating";
   }

      
   return $db;
}


   
// 
?>