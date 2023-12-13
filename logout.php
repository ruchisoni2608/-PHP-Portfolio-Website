<?php
include 'config.php';

logoutUser();

header("Location: login.php");
exit();
?>
