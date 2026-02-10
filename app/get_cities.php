<?php

 include_once './class/databaseConn.php';// Ensure the database connection is included

 $DatabaseCo = new DatabaseConn();

 $state_code = $_POST['state_code'] ?? '';

 echo  $state_code;

echo "<option value=''>-Select City-</option>";
 if ($state_code) {

     $query = "SELECT * FROM city WHERE state_id = '$state_code' ORDER BY city_name";

     $result = mysqli_query($DatabaseCo->dbLink, $query);

     

     while ($row = mysqli_fetch_object($result)) {

         echo "<option value='{$row->city_id}'>{$row->city_name}</option>";

     }

 }

?>

