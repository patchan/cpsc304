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
<style>
td {
    border: solid 2px lightgrey;
}
</style>
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

<br> <br>
<h3>Guest Members</h3>
    
    
<?php

$sql2 = "SELECT g.name, g.relation, g.dob FROM guest_member g WHERE g.gym_id = :id";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute(array(
    ':id' => $_SESSION['gym_id']));

echo '<table border:1px>';
echo "<tr>";
    
echo "<td>Name</td>";
echo "<td>Relation</td>";
echo "<td>DOB</td>";

echo "</tr>";
while( $row = $stmt2->fetch(PDO::FETCH_ASSOC)){

echo "<tr><td>";

echo $row['name'];
echo "</td><td>";
echo $row['relation'];
echo "</td><td>";
echo $row['dob'];
echo "</td></tr>";

}
echo'</table>';


?>

