
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
<h2>Search for gym member: <input type="text" size="40" name="name"> </h2>
<h4>Select fields to be displayed</h4>
<p><input type="checkbox" name="query[]" value="g.name"> Name</p>
<p><input type="checkbox" name="query[]" value="g.gym_id"> Gym ID</p>
<p><input type="checkbox" name="query[]" value="g.phone"> Phone</p>
<p><input type="checkbox" name="query[]" value="g.address"> Address</p>
<p><input type="checkbox" name="query[]" value="g.dob"> DOB</p>
<input type="submit" name="submit" value="Submit Query"/>
</form>
<p>
<input type="button" value="Logout" 
onClick="window.location = 'logout.php'" />    
    
<br> <br>


<?php

if (isset($_POST['query']) && !empty($_POST['query']) && !empty($_POST['name'])) {
    $sql = "SELECT ";
    foreach($_POST['query'] AS $value) {
        $sql .= "{$value}, ";
    }
    $sql  = substr($sql, 0, -2);
    $sql .= " FROM gymmember g WHERE g.name = '";
    $sql .= $_POST['name'];
    $sql .= "'";

    // print($sql);

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
    if (empty($_POST['name'])) {
        echo('<h2>Please enter a name to search for.</h2>');
    } else {
        echo('Please select fields to be displayed.');
    }
}


?>



