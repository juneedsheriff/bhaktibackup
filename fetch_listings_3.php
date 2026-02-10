<?php
include_once './app/class/XssClean.php';
include_once './app/class/databaseConn.php';
include_once './app/lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$xssClean = new xssClean();

// Retrieve and sanitize inputs
$country = isset($_POST['country']) ? $xssClean->clean_input($_POST['country']) : null;
$state = isset($_POST['state']) ? $xssClean->clean_input($_POST['state']) : null;
$city = isset($_POST['city']) ? $xssClean->clean_input($_POST['city']) : null;
$filter_type = isset($_POST['filter_type']) ? $_POST['filter_type'] : 'combined';

// Build the base query
$query = "SELECT * FROM abroad WHERE 1=1"; // Ensures 'AND' or 'OR' conditions append correctly

// Add filters based on the filter type
if ($filter_type === 'combined') {
    // Combined Filter: All selected filters must match
    if ($country) $query .= " AND country = '$country'";
    if ($state) $query .= " AND state = '$state'";
    if ($city) $query .= " AND city = '$city'";
} else {
    // Separate Filter: Match any selected filter
    $filters = [];
    if ($country) $filters[] = "country = '$country'";
    if ($state) $filters[] = "state = '$state'";
    if ($city) $filters[] = "city = '$city'";
    
    if (!empty($filters)) {
        $query .= " AND (" . implode(' OR ', $filters) . ")";
    }
}

// Add a limit for pagination, modify as needed
//$query .= " LIMIT 8";

// Execute the query and handle results
$result = mysqli_query($DatabaseCo->dbLink, $query);

if (mysqli_num_rows($result) > 0) {
    while ($Row = mysqli_fetch_assoc($result)) {
        $photos = $Row['photos'];
        echo "<div class='listing'>
                <a href='abroad-details.php?id={$Row['index_id']}' target='_blank'>
                    <img src='app/uploads/abroad/{$photos}' alt=''>
                </a>
                <div class='listing-details'>
                    <a href='abroad-details.php?id={$Row['index_id']}' target='_blank'>
                        <div class='listing-title'>{$Row['title']}</div>
                    </a>
                    <div class='listing-rating text-dark'><a href='abroad-details.php?id={$Row['index_id']}' target='_blank'>Read more</a></div>
                </div>
              </div>";
    }
} else {
    echo "<p>No listings found.</p>";
}
?>
