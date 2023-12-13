<?php error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'app.php';
?>

<?php
//include 'config.php';

// Check if the user is logged in
if (!isUserLoggedIn()) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Portfolio</title>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <!-- Include DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>


    <style>
        /* Add this to your existing CSS or create a new CSS file */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 36%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .sele {
            margin-left: 162px;
            width: 208px;
            height: 113px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Portfolio page</h1>


    </header>

    <table id="userTable" class="display table table-responsive" style="width:100%">
        <thead>
            <tr>
                <th>Profile Photo</th>
                <th>Name</th>
                <th>Description</th>
                <th>Resume</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $portfolioItems = getPortfolioItems();
            foreach ($portfolioItems as $item) : ?>
                <tr>
                    <td> <?php if (isset($item['image'])) : ?>
                            <img src="/PortfolioPHP/<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" width="50" height="50">
                        <?php else : ?>


                            <!-- Provide a default image if no profile photo is available -->
                            <img src="default.jpg" alt="Default Photo" width="50" height="50">
                        <?php endif; ?>
                    </td>
                    <td><?php echo $item['title']; ?></td>
                    <?php
                    $description = $item['description'];
                    $maxLength = 90;

                    $truncatedDescription = strlen($description) > $maxLength ? substr($description, 0, $maxLength) . "..." : $description;
                    ?>

                    <td><?php echo $truncatedDescription; ?></td>
                    <td>
                        <?php if (isset($item['resume_path'])) : ?>
                            <a href="/PortfolioPHP/<?php echo $item['resume_path']; ?>" target="_blank">View Resume</a>
                        <?php else : ?>
                            No Resume
                        <?php endif; ?>
                    </td>

                    <td>
                        <!-- Add a button to trigger the "Add Skills" modal -->

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSkillsModal" id="btnAddSkills">Add Skills</button>

                        <a href="view_portfolio.php?id=<?php echo $item['id']; ?>">Show</a>
                        <a href="edit_portfolio.php?id=<?php echo $item['id']; ?>">Edit</a>
                        <a href="delete_portfolio.php?id=<?php echo $item['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Add Skills Modal -->

    <div class="modal" id="addSkillsModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Skills</h4>
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>
                <hr>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Your existing form elements go here -->
                    <!-- Example: -->
                    <label for="frontendSkills">Front-End Skills:</label><br>
                    <select name="frontendSkills" id="frontendSkills" class="sele" multiple>
                        <option value=" HTML">HTML</option>
                        <option value="CSS">CSS</option>
                        <option value="JavaScript">JavaScript</option>
                        <option value="React">React</option>
                    </select>
                    <br>
                    <label for="backendSkills">Back-End Skills:</label><br>
                    <select name="backendSkills" id="backendSkills" class="sele" multiple>
                        <option value="Node.js">Node.js</option>
                        <option value="Express">Express</option>
                        <option value="MongoDB">MongoDB</option>
                        <option value="Mongoose">Mongoose</option>
                        <option value="Chai">Chai</option>
                        <option value="Mocha">Mocha</option>
                    </select>
                </div>
                <br>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="submitSkills">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>




    <script>
        $(document).ready(function() {
            // Initialize DataTable

            new DataTable('#userTable', {
                pagingType: 'full_numbers'
            });

            // Button click to open the "Add Skills" modal
            $('#btnAddSkills').click(function() {
                
                $('#addSkillsModal').modal('show');
            });

            // // Modal functionality
            // var addSkillsModal = document.getElementById('addSkillsModal');
            // var btnAddSkills = document.getElementById('btnAddSkills');
            // var spanClose = document.getElementsByClassName('close')[0];

            // btnAddSkills.onclick = function() {
            //     addSkillsModal.style.display = 'block';
            // }

            // spanClose.onclick = function() {
            //     addSkillsModal.style.display = 'none';
            // }

            // window.onclick = function(event) {
            //     if (event.target == addSkillsModal) {
            //         addSkillsModal.style.display = 'none';
            //     }
            // }

            // AJAX to submit skills
            $('#submitSkills').click(function() {
                var frontendSkills = $('#frontendSkills').val();
                var backendSkills = $('#backendSkills').val();
                alert(frontendSkills, backendSkills);
                $.ajax({
                    type: 'POST',
                    url: 'submit_skills.php', // Create this PHP file to handle the submission
                    data: {
                        frontendSkills: frontendSkills,
                        backendSkills: backendSkills
                    },
                    success: function(response) {
                        // Handle success (if needed)
                        console.log(response);
                    },
                    error: function(error) {
                        // Handle error (if needed)
                        console.log(error);
                    }
                });
            });
        });
    </script>

    <div class="container signin">

        <button type="button"> <a href="add_portfolio.php">Create Portfolio</a></button>
        <!-- <p>Create Portfolio <a href="add_portfolio.php">click here</a>.</p> -->
    </div>
    <footer>
        <p></p>
    </footer>
</body>

</html>