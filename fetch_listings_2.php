<?php

include_once './app/class/XssClean.php';

include_once './app/class/databaseConn.php';

include_once './app/lib/requestHandler.php';



$DatabaseCo = new DatabaseConn();

$xssClean = new xssClean();



// Retrieve and sanitize inputs

$country = isset($_POST['country']) ? $xssClean->clean_input($_POST['country']) : 'IN'; // Default to 'IN'

$state = isset($_POST['state']) ? $xssClean->clean_input($_POST['state']) : null;

$city = isset($_POST['city']) ? $xssClean->clean_input($_POST['city']) : null;

$town = isset($_POST['city']) ? $xssClean->clean_input($_POST['town']) : null;

$filter_type = isset($_POST['filter_type']) ? $_POST['filter_type'] : 'combined';



// Build the base query

$query = "SELECT * FROM temples WHERE country = '" . mysqli_real_escape_string($DatabaseCo->dbLink, $country) . "'"; // Default country filter



// Choose filtering method based on filter type

if ($filter_type === 'separate') {

    // Separate filters: apply conditions for state OR city

    $filters = [];

    if ($state) {

        $filters[] = "state = '" . mysqli_real_escape_string($DatabaseCo->dbLink, $state) . "'";

    }

    if ($city) {

        $filters[] = "city = '" . mysqli_real_escape_string($DatabaseCo->dbLink, $city) . "'";

    }

    if (!empty($filters)) {

        $query .= " AND (" . implode(' OR ', $filters) . ")";

    }

} else{



}



if ($filter_type === 'combined') {

    // Combined filters: apply conditions for state AND city

    if ($state) {

        $query .= " AND state = '" . mysqli_real_escape_string($DatabaseCo->dbLink, $state) . "'";

    }

    if ($city) {

        $query .= " AND city = '" . mysqli_real_escape_string($DatabaseCo->dbLink, $city) . "'";

    }

    if ($town) {

        $query .= " AND town = '" . mysqli_real_escape_string($DatabaseCo->dbLink, $town) . "'";

    }



}

// Add a limit for pagination, modify as needed

//$query .= " LIMIT 9";

//echo $query;

// Execute the query and handle results

$result = mysqli_query($DatabaseCo->dbLink, $query);



if (mysqli_num_rows($result) > 0) {

    while ($Row = mysqli_fetch_assoc($result)) {

        $photos = $Row['photos'];

        echo "<div class='listing'>

                <a href='temple-details.php?id={$Row['index_id']}'target='_blank'>

                    <img src='app/uploads/temple/{$photos}' alt=''>

                </a>

                <div class='listing-details'>

                    <a href='temple-details.php?id={$Row['index_id']}' target='_blank'>

                        <div class='listing-title'>{$Row['title']}</div>

                    </a>

                    <div class='listing-rating text-dark'><a href='temple-details.php?id={$Row['index_id']}' target='_blank'>Read more</a></div>

                </div>

              </div>";

    }

} else {

    echo "<p>No listings found.</p>";

}

?>

