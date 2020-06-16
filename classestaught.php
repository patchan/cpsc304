
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
<h4>Show the number of classes taguth by instructor ID:
<input type="text" size="20" name="instr_id"></h4>
<input type="submit" name="submit" value="Submit Query"/>
</form>
<input type="button" value="Logout" 
onClick="window.location = 'logout.php'" />
    
<br> <br>


<?php

    if (isset($_POST['instr_id']) && !empty($_POST['instr_id'])) {
        $sql = "SELECT i.instr_id, i.name, COUNT(*) AS count FROM instructor i, leads l WHERE i.instr_id = l.instr_id AND i.instr_id = ";
        $sql .= $_POST['instr_id'];
        $sql .= " GROUP BY i.instr_id, i.name";

        // print($sql);
        $result = $pdo->query($sql);

        if ($result->rowCount() > 0) {
            $fetch = $result->fetch(PDO::FETCH_ASSOC);
            $fetchAll = $result->fetchAll(PDO::FETCH_ASSOC);

            $output = '<h3>Result:</h3>';

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
            echo('<h3>Result:</h3>');
            echo('Instructor ');
            echo($_POST['instr_id']);
            echo(' does not teach any classes.');
        }
    }


?>



