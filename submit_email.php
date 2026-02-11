<?php
// Database connection
include_once './app/class/XssClean.php';
include_once './app/class/databaseConn.php';
include_once './app/lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$xssClean = new xssClean();

// Retrieve email and phone from POST data
if (isset($_POST['email']) && isset($_POST['phone'])) {
    // Clean and validate the email
    $email = $DatabaseCo->dbLink->real_escape_string(trim($_POST['email']));
    $phoneRaw = preg_replace('/\D/', '', trim($_POST['phone']));

    // Server-side email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    // Phone: digits only, 10–15 (with country code)
    if (strlen($phoneRaw) < 10 || strlen($phoneRaw) > 15 || !ctype_digit($phoneRaw)) {
        echo "Invalid phone number. Enter 10–15 digits with country code.";
        exit;
    }
    $phone = $DatabaseCo->dbLink->real_escape_string($phoneRaw);

    // Insert email and phone into the database
    $sql = "INSERT INTO subscribe (email, phone) VALUES ('$email', '$phone')";
    if ($DatabaseCo->dbLink->query($sql) === TRUE) {
        echo "Thank you! Your subscription has been successfully recorded.";
    } else {
        echo "Error: " . $DatabaseCo->dbLink->error;
    }
} else {
    echo "Email or phone number not provided.";
}

// Close the database connection
$DatabaseCo->dbLink->close();
?>
