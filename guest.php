<?php
require_once "pdo.php";
session_start();
if ( ! isset($_SESSION['gym_id']) ) {
    die('Not logged in');
}

$tempName = '';

if ( isset($_POST['name']) && isset($_POST['relation']) && isset($_POST['dob'])  ) {

    $sql = "INSERT INTO guest_member(gym_id, name, relation, dob) 
    VALUES(:g, :n, :r, :d)";
        

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':g' => $_SESSION['gym_id'], 
        ':n' => $_POST['name'],
        ':r' => $_POST['relation'],
        ':d' => $_POST['dob']
    
    ));    
    $_SESSION['success'] = 'True';
    $tempName = $_POST['name'];
       header('Location: /guest.php');
      return;
       
   }

if( isset($_SESSION['success'])){
    
    echo '<h2> gym member '.$tempName.' added successfully </h2>';
    unset($_SESSION['success']);

    
    
}
    

?>

<h3>Please enter guest member details</h3>
<form method="post">
<p>Enter guest name:
<input type="text" size="40" name="name"></p>
<p>Enter guest relation:
<input type="text" size="40" name="relation"></p>
<p>Enter guest date of birth:
<input type="text" size="40" name="dob"></p>
<p><input type="submit" value="Add Guest"/>
<a href="<?php echo($_SERVER['PHP_SELF']);?>">Refresh</a></p>
</form>
<p>
    
    
    <?php
$stmt2 = $pdo->query("SELECT * FROM lift");
echo '<table border:1px>';
while( $row = $stmt2->fetch(PDO::FETCH_ASSOC)){
echo "<tr><td>";
echo $row['gym_id'];
echo "</td><td>";
    
        echo('<a href="directory.php?gym_id='.$row['gym_id'].'&exercise_id='.$row['exercise_id'].'&time='.$row['time'].'&date='.$row['date'].'&reps='.$row['reps'].'&sets='.$row['sets'].'&weight_in_kg='.$row['weight_in_kg'].'  ">Click</a> / ');

    echo "</td><td>";

    
echo $row['exercise_id'];
 echo "</td><td>";
echo $row['time'];
echo "</td><td>";
echo $row['date'];
echo "</td></tr>";

}
echo'</table>';


?>

