<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "Root#roo12";
$dbname = "portfolio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getPortfolioItems() {
    global $conn;

    $sql = "SELECT * FROM portfolio";
    $result = $conn->query($sql);

    $portfolioItems = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $portfolioItems[] = $row;
        }
    }

    return $portfolioItems;
}


function registerUser($username, $email, $password) {
    global $conn;

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";

    //return $conn->query($sql);
     // Use proper error handling for query execution
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function loginUser($email, $password) {
    echo"login..";
    
    global $conn;

    $sql = "SELECT id, username, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            session_start();
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];

            return true;
        }
    }

    return false;
}
function getPortfolioItemById($id) {
    global $conn;

    $sql = "SELECT * FROM portfolio WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

function updateSkills($userId, $frontendSkills, $backendSkills)
{
    global $conn;

    $sql = "UPDATE portfolio SET frontend_skills = '$frontendSkills', backend_skills = '$backendSkills' WHERE user_id = $userId";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
function getCurrentUserId()
{
    // Assuming you store user ID in the session when the user logs in
    if (isset($_SESSION["user_id"])) {
        return $_SESSION["user_id"];
    } else {
        // Handle the case when the user is not logged in
        return null;
    }
}

function isUserLoggedIn() {
    return isset($_SESSION["user_id"]);
}

function logoutUser() {
    session_start();
    session_destroy();
}

//$conn->close();

?>
