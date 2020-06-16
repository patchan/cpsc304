
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
<h4>Display all members who have done all:</h4>
<p><input type="checkbox" name="weights" value="g.name"> Weights exercises</p>
<p><input type="checkbox" name="cardio" value="g.gym_id"> Cardio exercises</p>
<input type="submit" name="submit" value="Submit Query"/>
</form>
<input type="button" value="Logout" 
onClick="window.location = 'logout.php'" />
    
<br> <br>


<?php

    if (isset($_POST['weights'])) {
        $sql = "SELECT g.gym_id, g.name FROM gymmember g WHERE NOT EXISTS ((SELECT w.exercise_id FROM weights w) EXCEPT (SELECT l.exercise_id FROM lift l WHERE g.gym_id = l.gym_id))";

        // print($sql);
        $result = $pdo->query($sql);

        if ($result->rowCount() > 0) {
            $fetch = $result->fetch(PDO::FETCH_ASSOC);
            $fetchAll = $result->fetchAll(PDO::FETCH_ASSOC);

            $output = '<h3>Weights Exercises:</h3>';

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
            echo('<h3>Weights Exercises</h3>');
            echo('No results found.');
        }
    }
    
    if (isset($_POST['cardio'])) {
        $sql = "SELECT g.gym_id, g.name FROM gymmember g WHERE NOT EXISTS ((SELECT c.exercise_id FROM cardio c) EXCEPT (SELECT p.exercise_id FROM perform p WHERE g.gym_id = p.gym_id))";

        // print($sql);
        $result = $pdo->query($sql);

        if ($result->rowCount() > 0) {
            $fetch = $result->fetch(PDO::FETCH_ASSOC);
            $fetchAll = $result->fetchAll(PDO::FETCH_ASSOC);

            $output = '<h3>Cardio Exercises:</h3>';

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
            echo('<h3>Cardio Exercises:</h3>');
            echo('No results found.');
        }
    }


?>



