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
         (ID INTEGER PRIMARY KEY AUTOINCREMENT,
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
      if ($this->checkTableExists("PRODUCT_INVENTORY")) {
         $sql =<<<EOF
         INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) 
                                VALUES ('Revolon starter kit', 10.55, 15.99, 50, 'Revolon eyelashes starter kit');
         INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) 
                                VALUES ('Sukin Cleanser', 6.55, 12.99, 102, 'Sukin Oil balancing GEL cleanser');
         INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) 
                                VALUES ('Tom Ford Black Orchid', 80.50, 129.00, 15, 'Tom Ford Black Orchid 50ml fragrance');
         INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) 
                                VALUES ('Dior j'adore', 111.25, 149.00, 4, 'Dior J'adore 75ml fragrance');
         INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) 
                                VALUES ('Strepsils', 1.29, 4.55, 201, 'Strepsils 12 pack');
         INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) 
                                VALUES ('Swisspers Cotton Tips', 2.95, 4.60, 2012, '400 cotton tips in box');
         INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) 
                                VALUES ('Radox Shower Gel', 1.12, 3.00, 23, 'Radox uplifted shower GEL 250ml');
         INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) 
                                VALUES ('Dove go fresh', 3.10, 5.10, 34, 'Dove go fresh deodorant');
         INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) 
                                VALUES ('Gilette Mach3', 4.41, 6.80, 44, 'Gillette mach3 blade and razor');
         INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) 
                                VALUES ('Just For Men', 7.12, 10.20, 32, 'Just for men hair colour range blue');
         INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) 
                                VALUES ('Oral B Toothbrush', 2.29, 4.79, 10, 'Orab-B toothbrush SOFT');
         INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) 
                                VALUES ('iWhite instant', 24.49, 35.95, 11, 'Teeth whitening kit');
         INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) 
                                VALUES ('Sensodyne repair', 1.20, 3.19, 2, 'Tooth paste to repair and protect teeth');
EOF;
         $this->exec($sql);
      } else {
         //echo "If table doesn't exist, do nothing.";
      }
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