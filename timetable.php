
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
<h4>Show all of:</h4>
<p><input type="checkbox" name="classes" value=""> class timetables</p>
<p><input type="checkbox" name="plans" value =""> fitness plans</p>
<p><input type="submit" name="submit" value="Submit Query"/></p>
</form>
<input type="button" value="Logout" 
onClick="window.location = 'logout.php'" />
    
<br> <br>


<?php

    if (isset($_POST['classes'])) {
        $sql = "SELECT c.name AS class_name, c.location, lc.capacity, t.time, t.date, i.name AS instructor FROM instructor i, leads l, classes c, classes_assigned_to_timeslot t, location_capacity lc WHERE i.instr_id = l.instr_id AND l.class_id = c.class_id AND c.class_id = t.class_id AND c.location = lc.location";

        // print($sql);
        $result = $pdo->query($sql);

        if ($result->rowCount() > 0) {
            $fetch = $result->fetch(PDO::FETCH_ASSOC);
            $fetchAll = $result->fetchAll(PDO::FETCH_ASSOC);

            $output = '<h3>Class Timetable</h3>';

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
    }
    
    if (isset($_POST['plans'])) {
        $sql = "SELECT f.plan_id, f.category, i.name as instructor FROM instructor i, fitness_plan f, develops d WHERE i.instr_id = d.instr_id AND f.plan_id = d.plan_id";

        // print($sql);
        $result = $pdo->query($sql);

        if ($result->rowCount() > 0) {
            $fetch = $result->fetch(PDO::FETCH_ASSOC);
            $fetchAll = $result->fetchAll(PDO::FETCH_ASSOC);

            $output = '<h3>Fitness Plans</h3>';

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
    }



?>



