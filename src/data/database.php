<?php
class WebsiteDatabase extends SQLite3
{

   /** opens database.db or creates a new database file if it doesn't already exist */
   function __construct()
   {
      $this->open('data/database.db');
   }

   /** returns a boolean depending on whether or not the table of $table_name exists
   in this database */
   function checkTableExists($table_name) {
      $sql = sprintf("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='%s'", $table_name);

      $ret = $this->query($sql);
      // echo "<br>";
      // echo print_r($ret, $return=true);
      // echo "<br>";
      if ($ret) {
         $ary = $ret->fetchArray(SQLITE3_NUM);
         if ($ary[0] > 0) {
            return True;
         } else {
            return False;
         }
      }
   }

   /* Create tables if they don't already exist and add necessary items */
   function createTables()
   {
      //check to see if the product inventory table already exists
      //echo "Checking table exists";
      if (!$this->checkTableExists("PRODUCT_INVENTORY")) {
         $sql =<<<EOF
         CREATE TABLE PRODUCT_INVENTORY
         (ID INT PRIMARY KEY     NOT NULL,
         NAME            TEXT    NOT NULL,
         COST_PRICE      REAL    NOT NULL,
         SALE_PRICE      REAL    NOT NULL,
         STOCK_LEVEL     INTEGER NOT NULL,
         DESCRIPTION     TEXT);
EOF;
         $ret = $this->exec($sql);
         //databaseDebug($this, $ret, "Created product inventory table");
      } else {
         //echo "table already exists, not creating";
      }
   }

   /** Populate the database with test data */
   function populateDatabase()
   {
      //Uros you need to do a $this->exec($sql) with a bunch of insert statements, like the statment above, but inserting data
   }


   /**conducts an SQL SELECT on a table using column name and column value.
   returns the selected row in array format

   see here for more details on how to implement:
   http://php.net/manual/en/book.sqlite3.php

   specifically this might be helpful: http://php.net/manual/en/sqlite3.querysingle.php

   */
   function selectRowByColumnValue($table_name, $column_name, $column_value)
   {
      if (checkTableExists($table_name)){
         $sql = sprintf("SELECT %s FROM %s WHERE %s=%s", 
                        $column_name, $table_name, $column_name, $column_value);
      }

      $ret = $this->querySingle($sql, true );
      $ary = $ret->fetchArray(SQLITE3_NUM);
      return $ary;
   }

   /** deletes a row from a table by column value */
   function deleteRowByColumnValue($table_name, $column_name, $column_value)
   {
      if (checkTableExists($table_name)){
         $sql = sprintf("DELETE FROM %s WHERE %s=%s", $table_name, $column_name, $column_value);
         $this->querySingle($sql, false );
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



/** open a new database, and initialize it */
function openDatabase() {
      $db = new WebsiteDatabase();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      //echo "Opened database successfully\n";
   }

   $db->createTables();
      
   return $db;
}


   
// 
?>