
<?php
session_start();
require_once "pdo.php";

/*

*/





if ( ! isset($_SESSION['gym_id']) ) {
    die('Not logged in');
}

if ( isset($_GET['delete']) ) {
    $sqlDelete  = ' DELETE FROM lift WHERE exercise_id = '.$_GET['exercise_id'].
    ' AND date = "'.$_GET['date'].'"'.
    ' AND time = "'.$_GET['time'].'"'.
    ' AND gym_id = '.$_SESSION['gym_id'];
    
    echo($sqlDelete);

    $pdo->query($sqlDelete);
    
    unset($_GET['delete']);
}

if ( isset($_POST['exercise']) && isset($_POST['time']) && isset($_POST['date']) && isset($_POST['reps']) && isset($_POST['sets']) && isset($_POST['weight'])  ) {
    echo("<p>Handling POST data...</p>\n");

    $sql0 = "SELECT exercise_id FROM exercises
        WHERE name =  :nm";

    $stmt0 = $pdo->prepare($sql0);
    $stmt0->execute(array(
        ':nm' => $_POST['exercise']));

    $result = $stmt0->fetch(PDO::FETCH_ASSOC);


    $sql1 = "INSERT INTO lift(gym_id, exercise_id, time, date, reps, sets, weight_in_kg)
        VALUES (:g, :e, :t, :d, :r, :s, :w)";

    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute(array(
        ':g' => $_SESSION['gym_id'], 
        ':e' => $result['exercise_id'],
        ':t' => $_POST['time'],
        ':d' => $_POST['date'],
        ':r' => $_POST['reps'],
        ':s' => $_POST['sets'],
        ':w' => $_POST['weight']
    ));
    
    echo '<h4> Exercise log added successfully </h4>';
   
} else {
    echo("<p>Please enter data into all fields</p>\n");
}


?>
<style>
td {
    border: solid 2px lightgrey;
}
</style>
<h2>Enter data</h2>
<form method="post">
<p>Exercise:
<input type="text" size="40" name="exercise"></p>
<p>Time:
<input type="text" size="40" name="time"></p>
 <p>Date:
<input type="text" size="40" name="date"></p>
<p>Reps:
<input type="text" size="40" name="reps"></p>
<p>Sets:
<input type="text" size="40" name="sets"></p>
<p>weight:
<input type="text" size="40" name="weight"></p>
<p><input type="submit" value="Submit"/>
<a href="<?php echo($_SERVER['PHP_SELF']);?>">Refresh</a></p>
</form>
<p>
<input type="button" value="Logout" 
onClick="window.location = 'logout.php'" />    
    

<br> <br>
<h3>Logged Exercise</h3>

<?php
$sql2 = "SELECT e.name, l.exercise_id, l.time, l.date, l.reps, l.sets, l.weight_in_kg FROM lift l INNER JOIN exercises e ON e.exercise_id = l.exercise_id WHERE l.gym_id = :id";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute(array(
    ':id' => $_SESSION['gym_id'])); 
echo '<table border:1px>';
echo "<tr><td>";
    
echo "Exercise Name</td>";
echo "<td>Time</td>";
echo "<td>Date</td>";
echo "<td>reps</td>";
echo "<td>sets</td>";
echo "<td>Weight in kilograms</td>";

echo "<td>Edit a workout</td>";



echo "</td></tr>";
while( $row = $stmt2->fetch(PDO::FETCH_ASSOC)){

echo "<tr><td>";
    

echo $row['name'];
echo "</td><td>";
echo $row['time'];
echo "</td><td>";
echo $row['date'];
echo "</td><td>";
echo $row['reps'];
echo "</td><td>";
echo $row['sets'];
echo "</td><td>";
echo $row['weight_in_kg'];
echo "</td><td>";
echo('<a href="edit.php?name='.$row['name'].'&time='.$row['time'].'&exercise_id='.$row['exercise_id'].'&date='.$row['date'].'&reps='.$row['reps'].'&sets='.$row['sets'].'&weight_in_kg='.$row['weight_in_kg'].'  ">Edit</a>');
echo "</td><td>";
echo('<a href="weights.php?delete=true'.'&exercise_id='.$row['exercise_id'].'&time='.$row['time'].'&date='.$row['date'].'  ">Delete</a>');
    
echo "</td></tr>";

}
echo'</table>';

?>



