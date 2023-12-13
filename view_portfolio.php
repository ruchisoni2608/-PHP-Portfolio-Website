<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'app.php';

// Check if the user is logged in
if (!isUserLoggedIn()) {
    header("Location: login.php");
    exit();
}

// Check if the ID is set in the URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    // Retrieve the portfolio item by ID
    $portfolioItem = getPortfolioItemById($id);
    if (!$portfolioItem) {
        // Redirect to index.php if the portfolio item is not found
        header("Location: index.php");
        exit();
    }
} else {
    // Redirect to index.php if ID is not set
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Portfolio</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: black;
            color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 16px;
            background-color: white;
            margin-top: 20px;
            max-width: 664px;
            margin-left: auto;
            margin-right: auto;
            height: 538px !important;
        }

        .portfolio-card {
            border: 1px solid #ddd;
            padding: 16px;
            margin: 16px 0;
            background-color: #f1f1f1;
            color: black;
        }

        .portfolio-card img {
            max-width: 76%;
            height: auto;
        }

        .back-link {
            display: block;
            margin-top: 16px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="portfolio-card">
            <?php if (isset($portfolioItem['image'])) : ?>
                <img src="/PortfolioPHP/<?php echo $portfolioItem['image']; ?>" alt="<?php echo $portfolioItem['title']; ?>">
            <?php else : ?>
                <p>No image available</p>
            <?php endif; ?>

            <h2><?php echo $portfolioItem['title']; ?></h2>
            <p><?php echo $portfolioItem['description']; ?></p>

            <?php if (isset($portfolioItem['resume_path'])) : ?>
                <p><a href="/PortfolioPHP/<?php echo $portfolioItem['resume_path']; ?>" target="_blank">View Resume</a></p>
            <?php else : ?>
                <p>No Resume</p>
            <?php endif; ?>
        </div>

        <a href="index.php" class="back-link">Back to Portfolio List</a>
    </div>
</body>

</html>