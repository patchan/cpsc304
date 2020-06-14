<?php
session_start();
require_once "pdo.php";


// p' OR '1' = '1
if ( ! isset($_SESSION['gym_id']) ) {
    die('Not logged in');
}

if ( isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])  ) {
    echo("<p>Handling POST data...</p>\n");

    $sql = "INSERT INTO autos(make, year, mileage)
        VALUES( :y, :m, :mile)";

    echo "<p>$sql</p>\n";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':y' => $_POST['make'], 
        ':m' => $_POST['year'],
        ':mile' => $_POST['mileage']));
    
    

   if ( $row === FALSE ) {
      echo "<h1>Login incorrect.</h1>\n";
   } else { 
      echo "<p>Record Added.</p>\n";
   }
}
?>
<style>
td {
    border: solid 2px lightgrey;
}
</style>
<p>Please Login</p>
<form method="post">
<p>Make:
<input type="text" size="40" name="make"></p>
<p>Year:
<input type="text" size="40" name="year"></p>
 <p>Mileage:
<input type="text" size="40" name="mileage"></p>
<p><input type="submit" value="Submit"/>
<a href="<?php echo($_SERVER['PHP_SELF']);?>">Refresh</a></p>
</form>
<p>
<input type="button" value="Logout" 
onClick="window.location = 'logout.php'" />    
    
    <h3>Autos</h3> <br> <br>


<?php
$stmt2 = $pdo->query("SELECT * FROM autos");
echo '<table border:1px>';
while( $row = $stmt2->fetch(PDO::FETCH_ASSOC)){
echo "<tr><td>";
echo $row['make'];
echo "</td><td>";
echo $row['year'];
 echo "</td><td>";
echo $row['mileage'];
echo "</td></tr>";

}
echo'</table>';


?>

