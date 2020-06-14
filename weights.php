
<?php
session_start();
require_once "pdo.php";

/*

*/





if ( ! isset($_SESSION['gym_id']) ) {
    die('Not logged in');
}


if ( isset($_POST['exercise']) && isset($_POST['time']) && isset($_POST['date']) && isset($_POST['reps']) && isset($_POST['sets']) && isset($_POST['weight'])  ) {
    echo("<p>Handling POST data...</p>\n");

    $sql1 = "SELECT exercise_id FROM exercises
        WHERE name =  :nm";

    echo "<p>$sql1</p>\n";

    $stmt = $pdo->prepare($sql1);
    $stmt->execute(array(
        ':nm' => $_POST['exercise']));
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo $row['exercise_id'];

   if ( $row === FALSE ) {
      echo "<h1>Login incorrect.</h1>\n";
   } else { 
      echo "<p>Record Added.</p>\n";
   }
} else{
        echo("<p>Please enter data into all fields</p>\n");


}
?>
<style>
td {
    border: solid 2px lightgrey;
}
</style>
<p>Enter data</p>
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
    
    <h3>Autos</h3> <br> <br>


<?php
$stmt2 = $pdo->query("SELECT exercises.name, lift.exercise_id, lift.time, lift.date, lift.reps, lift.sets, lift.weight_in_kg  FROM lift INNER JOIN exercises ON exercises.exercise_id = lift.exercise_id");
echo '<table border:1px>';
echo "<tr><td>";
    
echo "Exercise Name</td>";
echo "<td>Time</td>";
echo "<td>Date</td>";
echo "<td>reps</td>";
echo "<td>sets</td>";
echo "<td>Weight in kilograms</td>";

echo "<td>Edit a workout</td>";



echo "</td>


</tr>";
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
    
echo "</td></tr>";

}
echo'</table>';

?>



