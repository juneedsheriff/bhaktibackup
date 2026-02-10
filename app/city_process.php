<?php
include_once './class/databaseConn.php';
include_once 'lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$response = ['successStatus' => false, 'responseMessage' => ''];





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the database connection is included
    $action = $_POST['action']; // Get the action ('insert' or 'update')

    $city_name = trim($_POST['city_name']);
    $country_code = strtoupper(trim($_POST['country_code'])); // Uppercase for consistency
    $state_code = strtoupper(trim($_POST['state_code'])); // Uppercase for consistency
    $country_status = $_POST['status'];
    $city_id = $_POST['city_id'] ?? null; // Only used for updates

    // Validate country code length
    if (strlen($country_code) !== 2) {
        echo json_encode(['success' => false, 'message' => 'Country code must be exactly 2 characters.']);
        exit;
    }

    try {
        if ($action === 'update') {
            // Prepare update statement
            $sql = "UPDATE city SET city_name = ?, country_code = ?, status = ?, state_code = ? WHERE city_id = ?";
            $stmt = $DatabaseCo->dbLink->prepare($sql);
            $stmt->bind_param("sssii", $city_name, $country_code, $country_status, $state_code, $city_id);
        } elseif ($action === 'insert') {
            // Prepare insert statement
            $sql = "INSERT INTO city (city_name, country_code, status, state_code) VALUES (?, ?, ?, ?)";
            $stmt = $DatabaseCo->dbLink->prepare($sql);
            $stmt->bind_param("ssss", $city_name, $country_code, $country_status, $state_code);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid operation.']);
            exit;
        }

        // Execute the statement and send response
        if ($stmt->execute()) {
            $message = ($action === 'update') ? 'City updated successfully.' : 'City added successfully.';
            echo json_encode(['success' => true, 'message' => $message]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database operation failed.']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}


// Make sure this points to your database configuration file


?>










