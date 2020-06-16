
<?php
session_start();
require_once "pdo.php";

/*

*/





if ( ! isset($_SESSION['gym_id']) ) {
    die('Not logged in');
}


?>
<style>
td {
    border: solid 2px lightgrey;
}
</style>
<h2>Select fields to be displayed</h2>
<form method="post">
<p><input type="checkbox" name="query[]" value="e.name"> Exercise Name</p>
<p><input type="checkbox" name="query[]" value="l.reps"> Sets</p>
<p><input type="checkbox" name="query[]" value="l.sets"> Reps</p>
<p><input type="checkbox" name="query[]" value="l.time"> Time</p>
<p><input type="checkbox" name="query[]" value="l.date"> Date</p>
<input type="submit" name="submit" value="Submit Query"/>
</form>
<p>
<input type="button" value="Logout" 
onClick="window.location = 'logout.php'" />    
    
<br> <br>


<?php

if (isset($_POST['query']) && !empty($_POST['query'])) {
    $sql = "SELECT ";
    foreach($_POST['query'] AS $value) {
        $sql .= "{$value}, ";
    }
    $sql  = substr($sql, 0, -2);
    $sql .= " FROM lift l, exercises e WHERE l.exercise_id = e.exercise_id AND l.gym_id = ";
    $sql .= $_SESSION['gym_id'];

    $result = $pdo->query($sql);

    if ($result->rowCount() > 0) {
        $fetch = $result->fetch(PDO::FETCH_ASSOC);
        $fetchAll = $result->fetchAll(PDO::FETCH_ASSOC);

        $output = '<h3>Result</h3>';

        $output .= '<table>';

        $output .= '<tr>';
        foreach($fetch as $name => $data) {
            $output .= '<td><strong>' . $name . '</strong></td>';
        }
        $output .= '</tr>';

        $output .= '<tr>';
        foreach($fetch as $name => $data) {
            $output .= '<td>' . $data . '</td>';
        }
        $output .= '</tr>';

        foreach($fetchAll as $key => $val) {
            $output .= '<tr>';
            foreach($val as $name => $data) {
                $output .= '<td>' . $data . '</td>';
            }
            $output .= '</tr>';
        }

        $output .= '</table>';
        
        echo $output;
    } else {
        echo('<h3>Result</h3>');
        echo('No results found.');
    }

} else {
    echo('Please select fields to be displayed.');
}


?>



