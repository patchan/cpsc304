
<?php
session_start();
require_once "pdo.php";

/*

*/


$temp; 

if ( ! isset($_SESSION['gym_id']) ) {
    die('Not logged in');
}

if ( isset($_POST['name']) && isset($_POST['time']) && isset($_POST['date']) && isset($_POST['reps']) && isset($_POST['sets']) && isset($_POST['weight_in_kg'])  ) {
    echo("<p>Handling POST data...</p>\n");

    $sql1 = "SELECT exercise_id FROM exercises
        WHERE name =  :nm";


    $stmt = $pdo->prepare($sql1);
    $stmt->execute(array(
        ':nm' => $_POST['name']));
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $temp = $row['exercise_id'] ?? false;
        echo temp;
    //Need 2 different exercise ids for update
    if(temp){
            $_POST['exercise_id2'] = $row['exercise_id'];

    } else{
        $_POST['exercise_id2'] = $_GET['exercise_id'];
        
    }
    

    
    //This will check for time and date existence.  If it exists, uses it, if not makes a new time and date and uses that
        //Need to add where condition in here so that time is equal to time
    
    
    //$_POST['exercise_id2'] is the new one $_POST['exercise_id'] is previous vallue
    $sqlcheck = 'SELECT * FROM timeslot WHERE time = :tm AND date = :dt';
    
    $stmt3 = $pdo->prepare($sqlcheck);
    $stmt3->execute(array(
        ':tm' => $_POST['time'],
        'dt' => $_POST['date']));          
    
    $row = $stmt3->fetch(PDO::FETCH_ASSOC);
       if(($row) == false){
           
           
    $sqlInsert = "INSERT INTO timeslot(time, date)
    VALUES(:tm2, :dt2)";
        

    $stmt2 = $pdo->prepare($sqlInsert);
    $stmt2->execute(array(
        ':tm2' => $_POST['time'],
        ':dt2' => $_POST['date']
    
    ));         
           echo("halllujah, it is working");
                      echo $_POST['time'];
           $_POST['date'];

           
    }
    
    
        
    $temp = Date($_POST['time']);
        echo '<h3>'.$temp.'</h3>';

    
    
    
    $sqlFinal  = ' UPDATE lift SET time = "'.$_POST['time'].'"'.
     ', date = "'.$_POST['date'].'"'.
    ', reps = '.$_POST['reps'].
    ', sets = '.$_POST['sets'].
    ', exercise_id = '.$_POST['exercise_id2'].
    ', weight_in_kg = '.$_POST['weight_in_kg'].
    ' WHERE exercise_id = '.$_GET['exercise_id'].
    ' AND date = "'.$_GET['date'].'"'.
    ' AND time = "'.$_GET['time'].'"'.
    ' AND gym_id = '.$_SESSION['gym_id'];
       
    echo '<h3>'.$sqlFinal.'</h3>';
    
 //try simple update table set key = new key
    
    
$stmt5 = $pdo->query($sqlFinal) or die(mysql_error());

 
    $_SESSION['success'] = 'True';
       header('Location: /edit.php');
      return;
    
       
   }

if( isset($_SESSION['success'])){
    
    echo '<h2> gym member '.$tempName.' added successfully </h2>';
    unset($_SESSION['success']);

    
    
}
    
    
    
    echo '<h3>'.$_SESSION['gym_id'].'</h3>';


?>
<style>
td {
    border: solid 2px lightgrey;
}
    
</style>
<p>Enter data</p>
<form method="post">
<p>Exercise:
<input type="text" size="40" name="name" value="<?=$_GET['name'] ?>"></p>
<p>Time:
<input type="text" size="40" name="time" value="<?=$_GET['time'] ?>"></p>
 <p>Date:
<input type="text" size="40" name="date" value="<?=$_GET['date'] ?>"></p>
<p>Reps:
<input type="text" size="40" name="reps" value="<?=$_GET['reps'] ?>"></p>
<p>Sets:
<input type="text" size="40" name="sets" value="<?=$_GET['sets'] ?>"></p>
<p>weight:
<input type="text" size="40" name="weight_in_kg" value="<?=$_GET['weight_in_kg'] ?>"></p>
<p><input type="submit" value="Confirm Changes"/>
</p>
</form>
<p>
<input type="button" value="Logout" 
onClick="window.location = 'logout.php'" />    
    


<?php
$stmt2 = $pdo->query("SELECT * FROM lift");
echo '<table border:1px>';
echo "<tr><td>";
    
echo "Exercise Name</td>";
echo "<td>Time</td>";
echo "<td>Date</td>";
echo "<td>reps</td>";
echo "<td>sets</td>";
echo "<td>date</td>";
echo "<td>Edit a workout</td>";



echo "</td>


</tr>";
while( $row = $stmt2->fetch(PDO::FETCH_ASSOC)){

echo "<tr><td>";
echo $row['gym_id'];
echo "</td><td>";
    


echo $row['exercise_id'];
 echo "</td><td>";
echo $row['time'];
echo "</td><td>";
echo $row['date'];
echo $row['reps'];
echo "</td><td>";
echo $row['sets'];
echo "</td><td>";
echo $row['weight_in_kg'];
echo "</td><td>";
echo('<a href="edit.php?gym_id='.$row['gym_id'].'&exercise_id='.$row['exercise_id'].'&time='.$row['time'].'&date='.$row['date'].'&reps='.$row['reps'].'&sets='.$row['sets'].'&weight_in_kg='.$row['weight_in_kg'].'  ">Edit</a>');

echo "</td><td>";
    
echo "</td></tr>";

}
echo'</table>';

?>



