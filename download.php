<?php
// $class= $_POST['class_name'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $class = $_POST['class'];
    include 'connect.php';
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $class . '.csv"');
    $o = fopen('php://output', 'w');

    fputcsv($o, array('DATE'));


    $sqll = "SELECT startt,endd FROM `classes` WHERE class_name='$class'";
    $ress = mysqli_query($conn, $sqll);
    $row = mysqli_fetch_assoc($ress);
    $start = $row['startt'];
    $endd = $row['endd'];
    

    
    for ($i = $start; $i <= $endd; $i++) {
        fputcsv($o, array($i));
        $sqll = "SELECT DISTINCT datee,`status` FROM attendencee WHERE roll='$i' AND class_name='$class' GROUP BY datee;";
        $ress = mysqli_query($conn, $sqll);

        while ($row = mysqli_fetch_assoc($ress)) {
            
            fputcsv($o, $row);
        }
    }
    fclose($o);
}
