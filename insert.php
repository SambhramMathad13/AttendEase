<?php 
include 'connect.php';

$roll = $_POST['roll'];
$status = $_POST['status'];
$name=$_POST['name'];
$class_name= $_POST['class_name'];

$sql = "INSERT INTO `attendencee` (`datee`,`status`,`roll`,`class_name`,`namee`) VALUES (current_date(),'$status','$roll','$class_name','$name')";
            $res = mysqli_query($conn, $sql);
?>