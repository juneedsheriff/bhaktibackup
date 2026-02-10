<?php
include_once './app/class/XssClean.php';
include_once './app/class/databaseConn.php';
include_once './app/lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$xssClean = new xssClean();

if($_REQUEST['comment']!='' && $_REQUEST['name']!=''){
    $name = $xssClean->clean_input($_REQUEST['name']);
    $comment = $xssClean->clean_input($_REQUEST['comment']);
    $type = $xssClean->clean_input($_REQUEST['ty']);
    $temple_id = $xssClean->clean_input($_REQUEST['id']);
    $log = date("d-m-Y H:i A");
    $query = "INSERT INTO `comments` (`name`, temple_id, `type`, `comment`, is_approved, log_date) VALUES ('$name', '$temple_id', '$type', '$comment', '0', '$log')";
    mysqli_query($DatabaseCo->dbLink,$query);    
}

$page = $_REQUEST['pageid']?$_REQUEST['pageid']:1;
$start = $page*9;
$limit = 9;

if($_REQUEST['type']=='india'){
    $query = "SELECT * FROM temples ORDER BY order_by ASC LIMIT $start,$limit";
    $result = mysqli_query($DatabaseCo->dbLink,$query);
    
    // Generate HTML for listings
    $listingsHtml = '';
    while ($Row = mysqli_fetch_array($result)) {
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
    echo $listingsHtml;
}
if($_REQUEST['type']=='abroad'){
    $query = "SELECT * FROM abroad ORDER BY order_by ASC LIMIT $start,$limit";
    $result = mysqli_query($DatabaseCo->dbLink,$query);
    
    // Generate HTML for listings
    $listingsHtml = '';
    while ($Row = mysqli_fetch_array($result)) {
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
    echo $listingsHtml;
}
if($_REQUEST['type']=='mantras'){
    $query = "SELECT * FROM abroad ORDER BY order_by ASC LIMIT $start,$limit";
    $result = mysqli_query($DatabaseCo->dbLink,$query);
    
    // Generate HTML for listings
    $listingsHtml = '';
    while ($Row = mysqli_fetch_array($result)) {
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
    echo $listingsHtml;
}

