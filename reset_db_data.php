<?php
/**
 * 
 * @author Muli Cohen
 * 
 * This snippet will help you reset/modify DB data on a monthly basis without having to worry about shorter / longer months while performing cronjobs. muliCohen
 * 
 */

class ResetData {

   public function __construct() {
      $this->db_connection();
      $this->reset_data();
   }

   private function db_connection() {
      // require your db_access securely.
      global $conn;
      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error)
         die("Connection failed: " . $conn->connect_error);
   }

   private function reset_data() {
      global $conn;
      $months_last_day = date("Y-m-t");
      $todays_date = date("Y-m-d");
      $todays_date_digits = substr($todays_date, -2);
      
      if ($months_last_day != $todays_date)  {
         $sql = $this->reset_data_sql_query($todays_date_digits, 0);
         $conn->query($sql);
         return;
      }
      else {
            if (substr($months_last_day, -2) <= 31) {
               for($i = 0; $i <= 31 - $todays_date_digits; $i++) {
                  $sql = $this->reset_data_sql_query($todays_date_digits, $i);
                  $conn->query($sql);
                  sleep(3);
               }
         }
   }
}

   private function reset_data_sql_query($arg, $i = 0) {
      // return an sql query that will reset/modify data on specific day properties.
   }

}

$instance = new ResetData();