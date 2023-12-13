<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $frontendSkills = implode(', ', $_POST['frontendSkills']);
    $backendSkills = implode(', ', $_POST['backendSkills']);

    // Get the current user's ID (you may need to modify this based on your authentication system)
    $userId = getCurrentUserId();

    // Update the user's skills in the database
    updateSkills($userId, $frontendSkills, $backendSkills);

    echo "Skills updated successfully!";
} else {
    echo "Invalid request!";
}
