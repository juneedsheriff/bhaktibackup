<?php
include_once './app/class/XssClean.php';
include_once './app/class/databaseConn.php';
include_once './app/lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$xssClean = new xssClean();

// Set the number of records per page

if(isset($_POST['selectedFilters'])){
    $records_per_page = 8;
// Get selected filters and page number
$selectedFilters = isset($_POST['selectedFilters']) ? explode(',', $_POST['selectedFilters']) : [];
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$page = max($page, 1);

// Calculate the OFFSET for SQL query
$offset = ($page - 1) * $records_per_page;

// Build the query based on selected filters
$query = "SELECT * FROM temples";
$params = [];
$bind_types = '';

if (!empty($selectedFilters)) {
    $placeholders = implode(',', array_fill(0, count($selectedFilters), '?'));
    $query .= " WHERE god_id IN ($placeholders)";
    $bind_types .= str_repeat('s', count($selectedFilters));
    $params = $selectedFilters;
}

// Add pagination limit
$query .= " LIMIT ?, ?";
$bind_types .= 'ii';
$params[] = $offset;
$params[] = $records_per_page;

$stmt = $DatabaseCo->dbLink->prepare($query);
$stmt->bind_param($bind_types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Generate HTML for listings
$listingsHtml = '';
while ($Row = $result->fetch_assoc()) {
    $photos = htmlspecialchars($Row['photos']);
    $title = htmlspecialchars($Row['title']);
    $index_id = (int)$Row['index_id'];

    $listingsHtml .= "<div class='listing'>
                        <a href='temple-details.php?id={$index_id}' target='_blank'>
                            <img src='app/uploads/temple/{$photos}' alt=''>
                        </a>
                        <div class='listing-details'>
                            <a href='temple-details.php?id={$index_id}' target='_blank'>
                                <div class='listing-title'>{$title}</div>
                            </a>
                            <div class='listing-rating text-dark'><a href='temple-details.php?id={$index_id}' target='_blank'>Read more</a></div>
                        </div>
                      </div>";
}

// Fetch total number of records for pagination
$total_query = "SELECT COUNT(*) AS total FROM temples";
if (!empty($selectedFilters)) {
    $total_query .= " WHERE god_id IN ($placeholders)";
}

$total_stmt = $DatabaseCo->dbLink->prepare($total_query);
$total_stmt->bind_param(str_repeat('s', count($selectedFilters)), ...$selectedFilters);
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $records_per_page);

// Generate pagination controls
$paginationHtml = '';
for ($i = 1; $i <= $total_pages; $i++) {
    $activeClass = $i == $page ? 'active' : '';
    $paginationHtml .= "<button class='pagination-button {$activeClass}' onclick='fetchFilteredListings({$i})'>{$i}</button>";
}

// Return JSON response
echo json_encode(['listings' => $listingsHtml, 'pagination' => $paginationHtml]);

$stmt->close();
$total_stmt->close();
}else{

}





if(isset($_POST['selectedFilters_iconic'])){
    $records_per_page = 8;
// Get selected filters and page number
$selectedFilters = isset($_POST['selectedFilters_iconic']) ? explode(',', $_POST['selectedFilters_iconic']) : [];
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$page = max($page, 1);

// Calculate the OFFSET for SQL query
$offset = ($page - 1) * $records_per_page;

// Build the query based on selected filters
$query = "SELECT * FROM iconic";
$params = [];
$bind_types = '';

if (!empty($selectedFilters)) {
    $placeholders = implode(',', array_fill(0, count($selectedFilters), '?'));
    $query .= " WHERE god_id IN ($placeholders)";
    $bind_types .= str_repeat('s', count($selectedFilters));
    $params = $selectedFilters;
}

// Add pagination limit
$query .= " LIMIT ?, ?";
$bind_types .= 'ii';
$params[] = $offset;
$params[] = $records_per_page;

$stmt = $DatabaseCo->dbLink->prepare($query);
$stmt->bind_param($bind_types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Generate HTML for listings
$listingsHtml = '';
while ($Row = $result->fetch_assoc()) {
    $photos = htmlspecialchars($Row['photos']);
    $title = htmlspecialchars($Row['title']);
    $index_id = (int)$Row['index_id'];

    $listingsHtml .= "<div class='listing'>
                        <a href='iconic-details.php?id={$index_id}' target='_blank'>
                            <img src='app/uploads/iconic/{$photos}' alt=''>
                        </a>
                        <div class='listing-details'>
                            <a href='iconic-details.php?id={$index_id}' target='_blank'>
                                <div class='listing-title'>{$title}</div>
                            </a>
                            <div class='listing-rating text-dark'><a href='iconic-details.php?id={$index_id}' target='_blank'>Read more</a></div>
                        </div>
                      </div>";
}

// Fetch total number of records for pagination
$total_query = "SELECT COUNT(*) AS total FROM iconic";
if (!empty($selectedFilters)) {
    $total_query .= " WHERE god_id IN ($placeholders)";
}

$total_stmt = $DatabaseCo->dbLink->prepare($total_query);
$total_stmt->bind_param(str_repeat('s', count($selectedFilters)), ...$selectedFilters);
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $records_per_page);

// Generate pagination controls
$paginationHtml = '';
for ($i = 1; $i <= $total_pages; $i++) {
    $activeClass = $i == $page ? 'active' : '';
    $paginationHtml .= "<button class='pagination-button {$activeClass}' onclick='fetchFilteredListings({$i})'>{$i}</button>";
}

// Return JSON response
echo json_encode(['listings' => $listingsHtml, 'pagination' => $paginationHtml]);

$stmt->close();
$total_stmt->close();

}else{

}


if(isset($_POST['selectedFilters_abroad'])){
    $records_per_page = 8;
// Get selected filters and page number
$selectedFilters = isset($_POST['selectedFilters_abroad']) ? explode(',', $_POST['selectedFilters_abroad']) : [];
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$page = max($page, 1);

// Calculate the OFFSET for SQL query
$offset = ($page - 1) * $records_per_page;

// Build the query based on selected filters
$query = "SELECT * FROM abroad";
$params = [];
$bind_types = '';

if (!empty($selectedFilters)) {
    $placeholders = implode(',', array_fill(0, count($selectedFilters), '?'));
    $query .= " WHERE god_id IN ($placeholders)";
    $bind_types .= str_repeat('s', count($selectedFilters));
    $params = $selectedFilters;
}

// Add pagination limit
$query .= " LIMIT ?, ?";
$bind_types .= 'ii';
$params[] = $offset;
$params[] = $records_per_page;

$stmt = $DatabaseCo->dbLink->prepare($query);
$stmt->bind_param($bind_types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Generate HTML for listings
$listingsHtml = '';
while ($Row = $result->fetch_assoc()) {
    $photos = htmlspecialchars($Row['photos']);
    $title = htmlspecialchars($Row['title']);
    $index_id = (int)$Row['index_id'];

    $listingsHtml .= "<div class='listing'>
                        <a href='abroad-details.php?id={$index_id}' target='_blank'>
                            <img src='app/uploads/abroad/{$photos}' alt=''>
                        </a>
                        <div class='listing-details'>
                            <a href='abroad-details.php?id={$index_id}' target='_blank'>
                                <div class='listing-title'>{$title}</div>
                            </a>
                            <div class='listing-rating text-dark'><a href='abroad-details.php?id={$index_id}' target='_blank'>Read more</a></div>
                        </div>
                      </div>";
}

// Fetch total number of records for pagination
$total_query = "SELECT COUNT(*) AS total FROM abroad";
if (!empty($selectedFilters)) {
    $total_query .= " WHERE god_id IN ($placeholders)";
}

$total_stmt = $DatabaseCo->dbLink->prepare($total_query);
$total_stmt->bind_param(str_repeat('s', count($selectedFilters)), ...$selectedFilters);
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $records_per_page);

// Generate pagination controls
$paginationHtml = '';
for ($i = 1; $i <= $total_pages; $i++) {
    $activeClass = $i == $page ? 'active' : '';
    $paginationHtml .= "<button class='pagination-button {$activeClass}' onclick='fetchFilteredListings({$i})'>{$i}</button>";
}

// Return JSON response
echo json_encode(['listings' => $listingsHtml, 'pagination' => $paginationHtml]);

$stmt->close();
$total_stmt->close();

}else{

}


// mantras

if(isset($_POST['selectedFilters_mantras'])){
    $records_per_page = 8;
// Get selected filters and page number
$selectedFilters = isset($_POST['selectedFilters_mantras']) ? explode(',', $_POST['selectedFilters_mantras']) : [];
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$page = max($page, 1);

// Calculate the OFFSET for SQL query
$offset = ($page - 1) * $records_per_page;

// Build the query based on selected filters
$query = "SELECT * FROM mantras_subcategory";
$params = [];
$bind_types = '';

if (!empty($selectedFilters)) {
    $placeholders = implode(',', array_fill(0, count($selectedFilters), '?'));
    $query .= " WHERE index_id IN ($placeholders)";
    $bind_types .= str_repeat('s', count($selectedFilters));
    $params = $selectedFilters;
}

// Add pagination limit
$query .= " LIMIT ?, ?";
$bind_types .= 'ii';
$params[] = $offset;
$params[] = $records_per_page;

$stmt = $DatabaseCo->dbLink->prepare($query);
$stmt->bind_param($bind_types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Generate HTML for listings
$listingsHtml = '';
while ($Row = $result->fetch_assoc()) {
    $photos = htmlspecialchars($Row['photos']);
    $title = htmlspecialchars($Row['title']);
    $index_id = (int)$Row['index_id'];

    $listingsHtml .= "<div class='listing'>
                        <a href='mantras-details.php?id={$index_id}' target='_blank'>
                            <img src='app/uploads/gods/{$photos}' alt=''>
                        </a>
                        <div class='listing-details'>
                            <a href='mantras-details.php?id={$index_id}' target='_blank'>
                                <div class='listing-title'>{$title}</div>
                            </a>
                            <div class='listing-rating text-dark'><a href='mantras-details.php?id={$index_id}' target='_blank'>Read more</a></div>
                        </div>
                      </div>";
}

// Fetch total number of records for pagination
$total_query = "SELECT COUNT(*) AS total FROM mantras_subcategory";
if (!empty($selectedFilters)) {
    $total_query .= " WHERE index_id IN ($placeholders)";
}

$total_stmt = $DatabaseCo->dbLink->prepare($total_query);
$total_stmt->bind_param(str_repeat('s', count($selectedFilters)), ...$selectedFilters);
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $records_per_page);


// Generate pagination controls
$paginationHtml = '';
for ($i = 1; $i <= $total_pages; $i++) {
    $activeClass = $i == $page ? 'active' : '';
    $paginationHtml .= "<button class='pagination-button {$activeClass}' onclick='fetchFilteredListings({$i})'>{$i}</button>";
}

// Return JSON response
echo json_encode(['listings' => $listingsHtml, 'pagination' => $paginationHtml]);

$stmt->close();
$total_stmt->close();

}else{

}
if(isset($_POST['selectedFilters_saints'])){
    $records_per_page = 8;
// Get selected filters and page number
$selectedFilters = isset($_POST['selectedFilters_saints']) ? explode(',', $_POST['selectedFilters_saints']) : [];
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$page = max($page, 1);

// Calculate the OFFSET for SQL query
$offset = ($page - 1) * $records_per_page;

// Build the query based on selected filters
$query = "SELECT * FROM other_page";
$params = [];
$bind_types = '';

if (!empty($selectedFilters)) {
    $placeholders = implode(',', array_fill(0, count($selectedFilters), '?'));
    $query .= " WHERE index_id IN ($placeholders)";
    $bind_types .= str_repeat('s', count($selectedFilters));
    $params = $selectedFilters;
}

// Add pagination limit
$query .= " LIMIT ?, ?";
$bind_types .= 'ii';
$params[] = $offset;
$params[] = $records_per_page;

$stmt = $DatabaseCo->dbLink->prepare($query);
$stmt->bind_param($bind_types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Generate HTML for listings
$listingsHtml = '';
while ($Row = $result->fetch_assoc()) {
    $photos = htmlspecialchars($Row['photos']);
    $title = htmlspecialchars($Row['title']);
    $index_id = (int)$Row['index_id'];

    $listingsHtml .= "<div class='listing'>
                        <a href='saints-details.php?id={$index_id}' target='_blank'>
                            <img src='app/uploads/others/{$photos}' alt=''>
                        </a>
                        <div class='listing-details'>
                            <a href='saints-details.php?id={$index_id}' target='_blank'>
                                <div class='listing-title'>{$title}</div>
                            </a>
                            <div class='listing-rating text-dark'><a href='saints-details.php?id={$index_id}' target='_blank'>Read more</a></div>
                        </div>
                      </div>";
}

// Fetch total number of records for pagination
$total_query = "SELECT COUNT(*) AS total FROM other_page";
if (!empty($selectedFilters)) {
    $total_query .= " WHERE index_id IN ($placeholders)";
}

$total_stmt = $DatabaseCo->dbLink->prepare($total_query);
$total_stmt->bind_param(str_repeat('s', count($selectedFilters)), ...$selectedFilters);
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $records_per_page);


// Generate pagination controls
$paginationHtml = '';
for ($i = 1; $i <= $total_pages; $i++) {
    $activeClass = $i == $page ? 'active' : '';
    $paginationHtml .= "<button class='pagination-button {$activeClass}' onclick='fetchFilteredListings({$i})'>{$i}</button>";
}

// Return JSON response
echo json_encode(['listings' => $listingsHtml, 'pagination' => $paginationHtml]);

$stmt->close();
$total_stmt->close();

}else{

}



if (isset($_POST['selectedFilters_mystery'])) {
    $records_per_page = 8;
    // Get selected filters and page number
    $selectedFilters = isset($_POST['selectedFilters_mystery']) ? explode(',', $_POST['selectedFilters_mystery']) : [];
    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
    $page = max($page, 1);

    // Calculate the OFFSET for SQL query
    $offset = ($page - 1) * $records_per_page;

    // Build the query for all three tables (temples, iconic, abroad) with mystery = 1
    $query = "SELECT * FROM (
                SELECT 'temple' AS type, t.index_id, t.title, t.photos, t.god_id FROM temples t WHERE t.my_stery = 1
                UNION
                SELECT 'iconic' AS type, i.index_id, i.title, i.photos, i.god_id FROM iconic i WHERE i.my_stery = 1
                UNION
                SELECT 'abroad' AS type, a.index_id, a.title, a.photos, a.god_id FROM abroad a WHERE a.my_stery = 1
              ) AS combined";

    $params = [];
    $bind_types = '';

    // Apply filter based on god_id
    if (!empty($selectedFilters)) {
        $placeholders = implode(',', array_fill(0, count($selectedFilters), '?'));
        $query .= " WHERE god_id IN ($placeholders)";
        $bind_types .= str_repeat('s', count($selectedFilters));
        $params = $selectedFilters;
    }

    // Add pagination limit
    $query .= " LIMIT ?, ?";
    $bind_types .= 'ii';
    $params[] = $offset;
    $params[] = $records_per_page;

    // Prepare and execute the query
    $stmt = $DatabaseCo->dbLink->prepare($query);
    $stmt->bind_param($bind_types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate HTML for listings
    $listingsHtml = '';
    while ($Row = $result->fetch_assoc()) {
        $photos = htmlspecialchars($Row['photos']);
        $title = htmlspecialchars($Row['title']);
        $index_id = (int)$Row['index_id'];
        $type = htmlspecialchars($Row['type']); // This will be either 'temple', 'iconic', or 'abroad'

        $listingsHtml .= "<div class='listing'>
                            <a href='{$type}-details.php?id={$index_id}' target='_blank'>
                                <img src='app/uploads/{$type}/{$photos}' alt=''>
                            </a>
                            <div class='listing-details'>
                                <a href='{$type}-details.php?id={$index_id}' target='_blank'>
                                    <div class='listing-title'>{$title}</div>
                                </a>
                                <div class='listing-rating text-dark'><a href='{$type}-details.php?id={$index_id}'target='_blank'>Read more</a></div>
                            </div>
                          </div>";
    }

    // Fetch total number of records for pagination (from all three tables)
    $total_query = "SELECT COUNT(*) AS total FROM (
                      SELECT 'temple' AS type, t.index_id, t.title, t.photos, t.god_id FROM temples t WHERE t.my_stery = 1
                      UNION
                      SELECT 'iconic' AS type, i.index_id, i.title, i.photos, i.god_id FROM iconic i WHERE i.my_stery = 1
                      UNION
                      SELECT 'abroad' AS type, a.index_id, a.title, a.photos, a.god_id FROM abroad a WHERE a.my_stery = 1
                    ) AS combined";

    if (!empty($selectedFilters)) {
        $total_query .= " WHERE god_id IN ($placeholders)";
    }

    $total_stmt = $DatabaseCo->dbLink->prepare($total_query);
    if (!empty($selectedFilters)) {
        $total_stmt->bind_param(str_repeat('s', count($selectedFilters)), ...$selectedFilters);
    }
    $total_stmt->execute();
    $total_result = $total_stmt->get_result();
    $total_row = $total_result->fetch_assoc();
    $total_records = $total_row['total'];
    $total_pages = ceil($total_records / $records_per_page);

    // Generate pagination controls
    $paginationHtml = '';
    for ($i = 1; $i <= $total_pages; $i++) {
        $activeClass = $i == $page ? 'active' : '';
        $paginationHtml .= "<button class='pagination-button {$activeClass}' onclick='fetchFilteredListings({$i})'>{$i}</button>";
    }

    // Return JSON response
    echo json_encode(['listings' => $listingsHtml, 'pagination' => $paginationHtml]);

    $stmt->close();
    $total_stmt->close();
}


//iconic temple

if(isset($_POST['selectedFilters_iconic_temple'])){
    $records_per_page = 8;
// Get selected filters and page number
$selectedFilters = isset($_POST['selectedFilters_iconic_temple']) ? explode(',', $_POST['selectedFilters_iconic_temple']) : [];
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$page = max($page, 1);

// Calculate the OFFSET for SQL query
$offset = ($page - 1) * $records_per_page;

// Build the query based on selected filters
$query = "SELECT * FROM iconic_temples";
$params = [];
$bind_types = '';

if (!empty($selectedFilters)) {
    $placeholders = implode(',', array_fill(0, count($selectedFilters), '?'));
    $query .= " WHERE categories_id IN ($placeholders)";
    $bind_types .= str_repeat('s', count($selectedFilters));
    $params = $selectedFilters;
}

// Add pagination limit
$query .= " LIMIT ?, ?";
$bind_types .= 'ii';
$params[] = $offset;
$params[] = $records_per_page;

$stmt = $DatabaseCo->dbLink->prepare($query);
$stmt->bind_param($bind_types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Generate HTML for listings
$listingsHtml = '';
while ($Row = $result->fetch_assoc()) {
    $photos = htmlspecialchars($Row['photos']);
    $title = htmlspecialchars($Row['title']);
    $index_id = (int)$Row['index_id'];

    $listingsHtml .= "<div class='listing'>
                        <a href='iconic-details.php?id={$index_id}' target='_blank'>
                            <img src='app/uploads/iconic_temple/{$photos}' alt=''>
                        </a>
                        <div class='listing-details'>
                            <a href='iconic-details.php?id={$index_id}' target='_blank'>
                                <div class='listing-title'>{$title}</div>
                            </a>
                            <div class='listing-rating text-dark'><a href='iconic-details.php?id={$index_id}' target='_blank'>Read more</a></div>
                        </div>
                      </div>";
}

// Fetch total number of records for pagination
$total_query = "SELECT COUNT(*) AS total FROM iconic_temples";
if (!empty($selectedFilters)) {
    $total_query .= " WHERE categories_id IN ($placeholders)";
}

$total_stmt = $DatabaseCo->dbLink->prepare($total_query);
$total_stmt->bind_param(str_repeat('s', count($selectedFilters)), ...$selectedFilters);
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $records_per_page);

// Generate pagination controls
$paginationHtml = '';
for ($i = 1; $i <= $total_pages; $i++) {
    $activeClass = $i == $page ? 'active' : '';
    $paginationHtml .= "<button class='pagination-button {$activeClass}' onclick='fetchFilteredListings({$i})'>{$i}</button>";
}

// Return JSON response
echo json_encode(['listings' => $listingsHtml, 'pagination' => $paginationHtml]);

$stmt->close();
$total_stmt->close();

}

// mantras title
if(isset($_POST['selectedFilters_mantras_title'])){
    $records_per_page = 8;
// Get selected filters and page number
$selectedFilters = isset($_POST['selectedFilters_mantras_title']) ? explode(',', $_POST['selectedFilters_mantras_title']) : [];
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$page = max($page, 1);

// Calculate the OFFSET for SQL query
$offset = ($page - 1) * $records_per_page;

// Build the query based on selected filters
$query = "SELECT * FROM mantras_subcategory";
$params = [];
$bind_types = '';

if (!empty($selectedFilters)) {
    $placeholders = implode(',', array_fill(0, count($selectedFilters), '?'));
    $query .= " WHERE index_id IN ($placeholders)";
    $bind_types .= str_repeat('s', count($selectedFilters));
    $params = $selectedFilters;
}

// Add pagination limit
$query .= " LIMIT ?, ?";
$bind_types .= 'ii';
$params[] = $offset;
$params[] = $records_per_page;

$stmt = $DatabaseCo->dbLink->prepare($query);
$stmt->bind_param($bind_types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Generate HTML for listings
$listingsHtml = '';
while ($Row = $result->fetch_assoc()) {
    $photos = htmlspecialchars($Row['photos']);
    $title = htmlspecialchars($Row['title']);
    $index_id = (int)$Row['index_id'];

    $listingsHtml .= "
    <div class='mx-auto mb-3'>
        <div class='card shadow-sm' style='background-color: #fff;'>
            <a href='mantras-details.php?id={$index_id}' target='_blank'>
                <img src='app/uploads/gods/{$photos}' class='card-img-top' alt='{$title}' style='height: 300px; object-fit: cover;'>
            </a>
            <div class='card-body'>
                <a href='mantras-details.php?id={$index_id}' target='_blank' class='text-decoration-none'>
                    <h5 class='card-title text-dark' style='font-size: 20px;'>{$title}</h5>
                </a>
                <p class='card-text text-dark'>
                    <a href='mantras-details.php?id={$index_id}' target='_blank' class=''>Read more</a>
                </p>
            </div>
        </div>
    </div>";
    
    

}

// Fetch total number of records for pagination
$total_query = "SELECT COUNT(*) AS total FROM mantras_subcategory";
if (!empty($selectedFilters)) {
    $total_query .= " WHERE index_id IN ($placeholders)";
}

$total_stmt = $DatabaseCo->dbLink->prepare($total_query);
$total_stmt->bind_param(str_repeat('s', count($selectedFilters)), ...$selectedFilters);
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $records_per_page);


// Generate pagination controls
$paginationHtml = '';
for ($i = 1; $i <= $total_pages; $i++) {
    $activeClass = $i == $page ? 'active' : '';
    $paginationHtml .= "<button class='pagination-button {$activeClass}' onclick='fetchFilteredListings({$i})'>{$i}</button>";
}

// Return JSON response
echo json_encode(['listings' => $listingsHtml, 'pagination' => $paginationHtml]);

$stmt->close();
$total_stmt->close();

}else{

}
// mantras_title_2



// Assuming you have already connected to the database using $DatabaseCo->dbLink

if (isset($_POST['title_id'])) {
    // Get selected filters
    $selectedFilters = isset($_POST['title_id']) ? explode(',', $_POST['title_id']) : [];

    // Build the query based on selected filters
    $query = "SELECT * FROM mantras_stotras";
    $params = [];
    $bind_types = '';

    if (!empty($selectedFilters)) {
        $placeholders = implode(',', array_fill(0, count($selectedFilters), '?'));
        $query .= " WHERE mantras_title IN ($placeholders)";
        $bind_types .= str_repeat('s', count($selectedFilters));
        $params = $selectedFilters;
    }

    $stmt = $DatabaseCo->dbLink->prepare($query);
    if (!empty($params)) {
        $stmt->bind_param($bind_types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate HTML for listings
    $listingsHtml = '';
    while ($Row = $result->fetch_assoc()) {
        $photos = htmlspecialchars($Row['photos']);
        $title = htmlspecialchars($Row['title']);
        $index_id = (int)$Row['index_id'];

        $listingsHtml .= "
        <div class='col-12 col-sm-6 col-md-4 mb-3'>
            <a href='mantras_title_details.php?id={$index_id}' class='text-decoration-none'>
                <div class='border border-4 border-warning rounded p-3 text-center' style='cursor: pointer; font-size: 16px;'>
                    {$title}
                </div>
            </a>
        </div>";
        
    }

    // Return JSON response
    echo json_encode(['listings_1' => $listingsHtml]);

    $stmt->close();
}

?>











