<?php
require_once "pdo.php";
session_start();
if ( ! isset($_SESSION['gym_id']) ) {
    die('Not logged in');
}
?>

<h1>Select what you would like to do</h1>
<a href="weights.php">Modify a weight workout</a> <br>
<a href="cardio.php">Modify a cardio workout</a> <br>
<a href="guest.php">Add a guest member</a>

<input type="button" value="Logout" 
onClick="window.location = 'logout.php'" />   