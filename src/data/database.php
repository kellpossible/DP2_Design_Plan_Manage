<?php
class WebsiteDatabase extends SQLite3
{

   /** opens database.db or creates a new database file if it doesn't already exist */
   function __construct($file_path)
   {
      $this->open($file_path);
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
         $this->populateDatabase();
         //databaseDebug($this, $ret, "Created product inventory table");
      } else {
         //echo "table already exists, not creating";
      }
   }

   /** Populate the database with test data */
   function populateDatabase()
   {
      $sql =<<<EOF
INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) VALUES ("Revolon starter kit", 10.55, 15.99, 50, "Revolon eyelashes starter kit");
INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) VALUES ("Sukin Cleanser", 6.55, 12.99, 102, "Sukin Oil balancing GEL cleanser");
INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) VALUES ("Tom Ford Black Orchid", 80.50, 129.00, 15, "Tom Ford Black Orchid 50ml fragrance");
INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) VALUES ("Dior jadore", 111.25, 149.00, 4, "Dior Jadore 75ml fragrance");
INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) VALUES ("Strepsils", 1.29, 4.55, 201, "Strepsils 12 pack");
INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) VALUES ("Swisspers Cotton Tips", 2.95, 4.60, 2012, "400 cotton tips in box");
INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) VALUES ("Radox Shower Gel", 1.12, 3.00, 23, "Radox uplifted shower GEL 250ml");
INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) VALUES ("Dove go fresh", 3.10, 5.10, 34, "Dove go fresh deodorant");
INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) VALUES ("Gilette Mach3", 4.41, 6.80, 44, "Gillette mach3 blade and razor");
INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) VALUES ("Just For Men", 7.12, 10.20, 32, "Just for men hair colour range blue");
INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) VALUES ("Oral B Toothbrush", 2.29, 4.79, 10, "Orab-B toothbrush SOFT");
INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) VALUES ("iWhite instant", 24.49, 35.95, 11, "Teeth whitening kit");
INSERT INTO PRODUCT_INVENTORY (NAME, COST_PRICE, SALE_PRICE, STOCK_LEVEL, DESCRIPTION) VALUES ("Sensodyne repair", 1.20, 3.19, 2, "Tooth paste to repair and protect teeth");
EOF;
      $this->exec($sql);
   }

   /**conducts an SQL SELECT on a table using column name and column value.
   returns the selected row in array format

   see here for more details on how to implement:
   http://php.net/manual/en/book.sqlite3.php

   specifically this might be helpful: http://php.net/manual/en/sqlite3.querysingle.php

   */
   function selectRowByColumnValue($table_name, $column_name, $column_value)
   {
      $sql = sprintf(
         "SELECT * FROM %s WHERE %s=\"%s\"",
         $table_name,
         $column_name,
         SQLite3::escapeString($column_value));
      //echo $sql;
      $query_result = $this->query($sql);
      //echo count($query_result->fetchArray());
      $num_columns = $query_result->numColumns();
      // echo "<br>num columns: ".$num_columns;
      // echo "<br>column 0 type: ".$query_result->columnType(0);
      // echo "<br>SQLITE3_NULL: ".SQLITE3_NULL."<br>";
      return $query_result->fetchArray(SQLITE3_ASSOC);
      
   }

   /** deletes a row from a table by column value */
   function deleteRowByColumnValue($table_name, $column_name, $column_value)
   {
      $sql = sprintf(
         "DELETE FROM %s WHERE %s=\"%s\"",
         $table_name, $column_name,
         SQLite3::escapeString($column_value));
      $this->exec($sql);
   }

   /**
   * table_name: name of the table we are editing
   * key_column_name: The name of the colun we are using as a key (normally ID)
   * key_value: The value of the key we use to select the row to edit (normally just the ID value)
   * column_name: the name of the column we want to edit
   * new value: the new value to replace the old one
   */
   function editValue($table_name, $key_column_name, $key_value, $column_name, $new_value)
   {
      $sql = sprintf(
         "UPDATE %s SET %s = \"%s\" WHERE %s = \"%s\";",
         $table_name,
         $column_name,
         SQLite3::escapeString($new_value),
         $key_column_name,
         SQLite3::escapeString($key_value));
      $this->exec($sql);
   }

   function editRow($table_name, $key_column_name, $key_value, $row)
   {
      foreach($row as $column_name=>$column_value)
      {
         $this->editValue(
            $table_name, 
            $key_column_name,
            $key_value, 
            $column_name, 
            $column_value);
      }
   }

   /** get an array of arrays of rows */
   function getRows($table_name)
   {
      $sql = sprintf("SELECT * FROM %s", $table_name);
      $rows = array();

      $result = $this->query($sql);
      while($row = $result->fetchArray(SQLITE3_ASSOC))
      {
         array_push($rows, $row);
      }
      
      return $rows;
   }

   // Column name then value, type of array key value dictionary
   // returns the primary key of the inserted row.
   function insertRow($row)
   {
      $column_names_sql = '';
      $column_values_sql = '';
      $i = 0;
      $len = count($row);
      foreach($row as $column_name=>$column_value)
      {
         $i = $i + 1;
         $column_names_sql.=$column_name;
         $column_values_sql.="\"".sprintf("%s", SQLite3::escapeString($column_value))."\"";

         if ($i < ($len))
         {
            $column_names_sql.=", ";
            $column_values_sql.=", ";
         }
      }


      $sql = sprintf("INSERT INTO PRODUCT_INVENTORY (%s) VALUES (%s);", $column_names_sql, $column_values_sql);
      $this->exec($sql);

      return $this->lastInsertRowId();

   }

   /** get the number of rows in a table */
   function getNumberOfRows($table_name)
   {
      $sql = "SELECT COUNT(*) as count FROM ".$table_name;
      return $this->querySingle($sql);
   }

   /**
   * table_name: name of the table we are editing
   * key_column_name: The name of the colun we are using as a key (normally ID)
   * key_value: The value of the key we use to select the row to edit (normally just the ID value)
   * column_name: the name of the column we want to edit
   * return: the value we selected
   */
   function getValue($table_name, $key_column_name, $key_value, $column_name)
   {

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
function openDatabase($testing=false) {
   $file_path = NULL;
   if ($testing) {
      $file_path = 'data/testing_database.db';
      unlink($file_path);
   } else {
      $file_path = 'data/database.db';
   }
   $db = new WebsiteDatabase($file_path);
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