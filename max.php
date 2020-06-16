
<?php
session_start();
require_once "pdo.php";


if ( ! isset($_SESSION['gym_id']) ) {
    die('Not logged in');
}


?>
<style>
td {
    border: solid 2px lightgrey;
}
</style>
<form method="post">
<h4>Display personal bests for member with ID:
<input type="text" size="20" name="gym_id"></h4>
<p><input type="checkbox" size="40" name="weights"> Weights exercises</p>
<p><input type="checkbox" size="40" name="cardio""> Cardio exercises</p>
<input type="submit" name="submit" value="Submit Query"/>
</form>
<input type="button" value="Logout" 
onClick="window.location = 'logout.php'" />
    
<br> <br>


<?php

    if (isset($_POST['weights']) && isset($_POST['gym_id'])) {
        $sql = "SELECT e.name, MAX(l.reps) AS reps, MAX(l.sets) AS sets, MAX(l.weight_in_kg) AS weight_in_kg FROM lift l, exercises e WHERE l.exercise_id = e.exercise_id AND l.gym_id = ";
        $sql .= $_POST['gym_id'];
        $sql .= " GROUP BY e.name, e.exercise_id";

        // print($sql);
        $result = $pdo->query($sql);

        if ($result->rowCount() > 0) {
            $fetch = $result->fetch(PDO::FETCH_ASSOC);
            $fetchAll = $result->fetchAll(PDO::FETCH_ASSOC);

            $output = '<h3>Weights Personal Bests:</h3>';

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
            echo('<h3>Weights Personal Bests:</h3>');
            echo('No results found.');
        }
    }
    
    if (isset($_POST['cardio']) && isset($_POST['gym_id'])) {
        $sql = "SELECT e.name, MAX(p.distance_in_km) AS distance, MAX(p.duration) AS duration, MAX(p.avg_HR) AS average_HR FROM perform p, exercises e WHERE p.exercise_id = e.exercise_id AND p.gym_id = ";
        $sql .= $_POST['gym_id'];
        $sql .= " GROUP BY e.name, e.exercise_id";

        // print($sql);
        $result = $pdo->query($sql);

        if ($result->rowCount() > 0) {
            $fetch = $result->fetch(PDO::FETCH_ASSOC);
            $fetchAll = $result->fetchAll(PDO::FETCH_ASSOC);

            $output = '<h3>Cardio Personal Bests:</h3>';

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
            echo('<h3>Cardio Personal Bests:</h3>');
            echo('No results found.');
        }
    }


?>



