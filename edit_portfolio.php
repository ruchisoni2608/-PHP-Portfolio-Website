<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

// Check if the user is logged in
if (!isUserLoggedIn()) {
  header("Location: login.php");
  exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST["id"];
  $title = $_POST["title"];
  $description = $_POST["description"];

  // Check if a new image is uploaded
  if ($_FILES["image"]["size"] > 0) {
    // File upload handling for image
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
      $uploadOk = 0;
    }

    // Check file size (limit to 2MB)
    if ($_FILES["image"]["size"] > 2 * 1024 * 1024) {
      $uploadOk = 0;
    }

    // Allow only certain file formats
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
      $uploadOk = 0;
    }

    // If everything is ok, try to upload the file
    if ($uploadOk) {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        // Update portfolio item in the database with new image
        $sql = "UPDATE portfolio SET title = '$title', description = '$description', image = '$targetFile' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
          header("Location: index.php");
          exit();
        } else {
          echo "Error updating record: " . $conn->error;
        }
      } else {
        echo "Error uploading image file.";
      }
    }
  }

  // Check if a new resume is uploaded
  if ($_FILES["resume"]["size"] > 0) {
    // File upload handling for resume
    $resumeTargetDir = "resumes/";
    $resumeTargetFile = $resumeTargetDir . basename($_FILES["resume"]["name"]);
    $resumeUploadOk = 1;
    $resumeFileType = strtolower(pathinfo($resumeTargetFile, PATHINFO_EXTENSION));

    // Check if the file is a PDF
    if ($resumeFileType != "pdf") {
      $resumeUploadOk = 0;
    }

    // Move the uploaded resume file
    if ($resumeUploadOk && move_uploaded_file($_FILES["resume"]["tmp_name"], $resumeTargetFile)) {
      $resumePath = $resumeTargetFile;

      // Update portfolio item in the database with new resume
      $sql = "UPDATE portfolio SET title = '$title', description = '$description', resume_path = '$resumePath' WHERE id = $id";

      if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
      } else {
        echo "Error updating record: " . $conn->error;
      }
    } else {
      echo "Error uploading resume file.";
    }
  } else {
    // Update portfolio item in the database without changing the image or resume
    $sql = "UPDATE portfolio SET title = '$title', description = '$description' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
      header("Location: index.php");
      exit();
    } else {
      echo "Error updating record: " . $conn->error;
    }
  }
} else {
  // Display the form for editing
  // Check if the ID is set in the URL
  if (isset($_GET["id"])) {
    $id = $_GET["id"];
    // Retrieve the portfolio item by ID
    $portfolioItem = getPortfolioItemById($id);
  } else {
    // Redirect to index.php if ID is not set
    header("Location: index.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="style.css"> -->
  <title>Edit </title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background-color: black;
    }

    * {
      box-sizing: border-box;
    }

    /* Add padding to containers */
    .container {
      padding: 16px;
      background-color: white;
    }

    /* Full-width input fields */
    input[type=text],
    input[type=password] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      display: inline-block;
      border: none;
      background: #f1f1f1;
    }

    input[type=text]:focus,
    input[type=password]:focus {
      background-color: #ddd;
      outline: none;
    }

    /* Overwrite default styles of hr */
    hr {
      border: 1px solid #f1f1f1;
      margin-bottom: 25px;
    }

    /* Set a style for the submit button */
    .registerbtn {
      background-color: #04AA6D;
      color: white;
      padding: 16px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
      opacity: 0.9;
    }

    .registerbtn:hover {
      opacity: 1;
    }

    /* Add a blue text color to links */
    a {
      color: dodgerblue;
    }

    /* Set a grey background color and center the text of the "sign in" section */
    .signin {
      background-color: #f1f1f1;
      text-align: center;
    }
  </style>
</head>

<body>
  <!-- HTML form for editing a portfolio item -->
  <form action="edit_portfolio.php" method="post" enctype="multipart/form-data">
    <div class="container">
      <h2>Edit </h2>
      <input type="hidden" name="id" value="<?php echo $portfolioItem['id']; ?>">
      <label for="title">Title:</label>
      <input type="text" name="title" value="<?php echo $portfolioItem['title']; ?>" required>

      <label for="description">Description:</label>
      <input type="text" name="description" value="<?php echo $portfolioItem['description']; ?>" required>

      <label for="currentImage">Current Image:</label>
      <?php if (isset($portfolioItem['image'])) : ?>
        <img src="/PortfolioPHP/<?php echo $portfolioItem['image']; ?>" alt="<?php echo $item['title']; ?>" width="50" height="50">

      <?php else : ?>
        <p>No image available</p>
      <?php endif; ?>

      <label for="image">Image:</label>
      <input type="file" name="image" accept="image/*">

      <label for="currentResume">Current Resume:</label>
      <?php if (isset($portfolioItem['resume_path'])) : ?>
        <p><?php echo $portfolioItem['resume_path']; ?></p>
      <?php else : ?>
        <p>No resume available</p>
      <?php endif; ?>

      <label for="resume">Resume (PDF only):</label></br>
      <input type="file" name="resume" accept=".pdf">


      <button type="submit" class="registerbtn">Update Portfolio Item</button>
    </div>
  </form>