<?php 
include 'connect.php';

// $datee = $_POST['datee'];
$class= $_POST['class_name'];

$sqll = "SELECT COUNT(DISTINCT datee) AS total FROM `attendencee` WHERE class_name='$class'";
$ress = mysqli_query($conn, $sqll);
$row=mysqli_fetch_assoc($ress);
$total=$row['total'];

$sqll = "SELECT startt,endd FROM `classes` WHERE class_name='$class'";
$ress = mysqli_query($conn, $sqll);
$row=mysqli_fetch_assoc($ress);
$start=$row['startt'];   
$endd=$row['endd'];

$res="";
$slno=1;

$sqll = "SELECT roll,round(COUNT(DISTINCT datee)*100/$total,1) AS count FROM attendencee WHERE status='P' AND class_name='$class' GROUP BY roll";
$ress = mysqli_query($conn, $sqll);

while($row=mysqli_fetch_assoc($ress))
{
    $res = $res ."<tr class='h5'>
        <th scope='row' class='col-1'>".$slno."</th>
        <td class='col-5'>".$row['roll']."</td>
        <td class='col-5'>".round($row['count']*$total/100)." of ".$total."</td>
        <td class='col-5'>".$row['count']."%</td>
    </tr>";
    $slno++;
}

echo $res
?> 
