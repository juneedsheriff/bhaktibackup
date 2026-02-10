<?php

 include_once './class/databaseConn.php';// Ensure the database connection is included

 $DatabaseCo = new DatabaseConn();

 $city_name = $_POST['city_name'] ?? '';



 if ($city_name) {

     $query = "SELECT * FROM towns WHERE city = '$city_name' ORDER BY town_name";

     $result = mysqli_query($DatabaseCo->dbLink, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<option value=''>-- Select Town --</option>";
        while ($row = mysqli_fetch_object($result)) {
            echo "<option value='{$row->id}'>{$row->town_name}</option>";
        }
    } else {
        echo "<option value=''>-- No Towns Found --</option>";
    }

 }

?>

