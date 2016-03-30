<?php
   class WebsiteDatabase extends SQLite3
   {
      function __construct()
      {
         $this->open('data/database.db');
      }
   }

   function openDatabase() {
      $db = new WebsiteDatabase();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n";
   }

   $sql =<<<EOF
      CREATE TABLE IF NOT EXISTS PRODUCT_INVENTORY
      (ID INT PRIMARY KEY     NOT NULL,
      NAME            TEXT    NOT NULL,
      COST_PRICE      REAL    NOT NULL,
      SALE_PRICE      REAL    NOT NULL,
      STOCK_LEVEL     INTEGER NOT NULL,
      DESCRIPTION     TEXT);
EOF;
      $ret = $db->exec($sql);
      if(!$ret){
         echo $db->lastErrorMsg();
      } else {
         echo "Table created successfully\n";
      }
      return $db;
   }


?>

   