<?php 
include 'connect.php';

$class= $_POST['class_name'];
$sqll = "SELECT DISTINCT datee FROM `attendencee` WHERE class_name='$class';";
$ress = mysqli_query($conn, $sqll);
$res="";
if (mysqli_num_rows($ress) > 0) {
    while ($row = mysqli_fetch_assoc($ress)) {

        $res = $res.$row['datee']."___";
    }
}
echo $res
?> 