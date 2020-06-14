<?php
require_once "pdo.php";
session_start();
if(isset($_POST["name"]) && isset($_POST["password"])){
    unset($_SESSION["gym_id"]);
}



if ( isset($_POST['name']) && isset($_POST['password'])  ) {

    $sql = "SELECT gym_id FROM gymmember 
        WHERE name = :em AND password = :pw";
    

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':em' => $_POST['name'], 
        ':pw' => $_POST['password']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if ( $row === FALSE ) {
      echo "<h1>User not found.  Please enter proper name and/or password</h1>\n";
   } else { 
       $_SESSION["gym_id"] = $row['gym_id'];
       header('Location: /directory.php');
      return;
       
   }
    
}
?>

<h3>Please log in</h3>
<form method="post">
<p>Enter your name:
<input type="text" size="40" name="name"></p>
<p>Enter your password:
<input type="text" size="40" name="password"></p>
<p><input type="submit" value="Login"/>
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

