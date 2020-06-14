
<?php
session_start();
require_once "pdo.php";

/*

*/





if ( ! isset($_SESSION['gym_id']) ) {
    die('Not logged in');
}


if (isset($_POST['exercise']) && isset($_POST['time']) && isset($_POST['date']) && isset($_POST['distance_in_km']) && isset($_POST['duration']) && isset($_POST['avg_HR'])  ) {
    echo("<p>Handling POST data...</p>\n");
    
    $sql0 = "SELECT exercise_id FROM exercises
        WHERE name =  :nm";

    $stmt0 = $pdo->prepare($sql0);
    $stmt0->execute(array(
        ':nm' => $_POST['exercise']));

    $result = $stmt0->fetch(PDO::FETCH_ASSOC);


    $sql1 = "INSERT INTO perform(gym_id, exercise_id, time, date, distance_in_km, duration, avg_HR)
        VALUES (:g, :e, :t, :d, :di, :dr, :h)";

    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute(array(
        ':g' => $_SESSION['gym_id'], 
        ':e' => $result['exercise_id'],
        ':t' => $_POST['time'],
        ':d' => $_POST['date'],
        ':di' => $_POST['distance_in_km'],
        ':dr' => $_POST['duration'],
        ':h' => $_POST['avg_HR']
    ));

    echo '<h4> Exercise log added successfully </h4>';


} else{
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
<p>Distance (km):
<input type="text" size="40" name="distance_in_km"></p>
<p>Duration:
<input type="text" size="40" name="duration"></p>
<p>Average HR:
<input type="text" size="40" name="avg_HR"></p>
<p><input type="submit" value="Submit"/>
<a href="<?php echo($_SERVER['PHP_SELF']);?>">Refresh</a></p>
</form>
<p>
<input type="button" value="Logout" 
onClick="window.location = 'logout.php'" />    
    
<br> <br>
<h3>Logged Exercise</h3>

<?php
$sql2 = "SELECT e.name, p.exercise_id, p.time, p.date, p.distance_in_km, p.duration, p.avg_HR  FROM perform p INNER JOIN exercises e ON e.exercise_id = p.exercise_id WHERE p.gym_id = :id";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute(array(
    ':id' => $_SESSION['gym_id']));
echo '<table border:1px>';
echo "<tr><td>";
    
echo "Exercise Name</td>";
echo "<td>Time</td>";
echo "<td>Date</td>";
echo "<td>distance (km)</td>";
echo "<td>duration</td>";
echo "<td>Average HR</td>";

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
echo $row['distance_in_km'];
echo "</td><td>";
echo $row['duration'];
echo "</td><td>";
echo $row['avg_HR'];
echo "</td><td>";
echo('<a href="edit.php?name='.$row['name'].'&time='.$row['time'].'&exercise_id='.$row['exercise_id'].'&date='.$row['date'].'&distance_in_km='.$row['distance_in_km'].'&duration='.$row['duration'].'&avg_HR='.$row['avg_HR'].'  ">Edit</a>');

echo "</td><td>";
    
echo "</td></tr>";

}
echo'</table>';

?>



