<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
//include 'config.php';
include 'app.php';

// Check if the user is logged in
if (!isUserLoggedIn()) {
  header("Location: login.php");
  exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST["title"];
  $description = $_POST["description"];

  // File upload handling
  $targetDir = "uploads/";
  $targetFile = $targetDir . basename($_FILES["image"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

  // Check if the file is an actual image
  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if ($check === false) {
    $uploadOk = 0;
  }

  // // Check if file already exists
  // if (file_exists($targetFile)) {
  //   $uploadOk = 0;
  // }

  // Check file size (limit to 2MB)
  if ($_FILES["image"]["size"] > 2 * 1024 * 1024) {
    $uploadOk = 0;
  }

  // Allow only certain file formats
  $allowedFormats = ["jpg", "jpeg", "png", "gif"];
  if (!in_array($imageFileType, $allowedFormats)) {
    $uploadOk = 0;
  }

  //resume upload
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
  } else {
    echo "Error uploading resume file.";
    exit();
  }

  // If everything is ok, try to upload the file
  if ($uploadOk) {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
      // Insert portfolio item into the database
      $sql = "INSERT INTO portfolio (title, description, image, resume_path) VALUES ('$title', '$description', '$targetFile', '$resumePath')";
   //   echo "SQL Query: $sql";

      if ($conn->query($sql) === TRUE) {
        echo "Portfolio added successfully " . $sql;
        //exit;
       header("Location: index.php");
       // ob_end_flush();
     //   exit();
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
  }
}
?>
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

  <form action="add_portfolio.php" method="post" enctype="multipart/form-data">
    <div class="container">
      <h2>Add Portfolio Item</h2>

      <label for="title">Title:</label>
      <input type="text" name="title" required>

      <label for="description">Description:</label>
      <input type="text" name="description" required>
      <!-- <textarea name="description" id="description" class="form-control ckeditor" rows="5" required></textarea> -->


      <label for="image">Image:</label></br>
      <input type="file" name="image" accept="image/*" required></br></br>

      <label for="resume">Resume (PDF only):</label></br>
      <input type="file" name="resume" accept=".pdf">


      <button type="submit" class="registerbtn">Add Portfolio Item</button>
    </div>
  </form>
  <!-- Include CKEditor -->
  <!-- Include CKEditor script -->
  <!-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> -->

  <!-- <script>
        CKEDITOR.replace('description');
    </script> -->
</body>

</html>