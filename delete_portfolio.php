<?php
include 'config.php';

// Check if the user is logged in
if (!isUserLoggedIn()) {
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];

    // Perform delete operation in the database
    $sql = "DELETE FROM portfolio WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
