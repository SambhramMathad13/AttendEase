<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $class = $_POST['class'];
    $sd = $_POST['sdd'];
    $ed = $_POST['edd'];
    include 'connect.php';
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $class . '.csv"');
    $o = fopen('php://output', 'w');

    $sqll = "SELECT roll from attendencee WHERE class_name='$class' GROUP BY roll;";
    
    $ress = mysqli_query($conn, $sqll);
    // $row = mysqli_fetch_assoc($ress);

    $first_row=array('DATE');
    while ($row = mysqli_fetch_assoc($ress)) {
            
        array_push($first_row,$row['roll']);
    }
        fputcsv($o,$first_row);


        // $sqll = "SELECT DISTINCT datee FROM `attendencee` WHERE class_name='$class';";
        $sqll = "SELECT DISTINCT datee FROM `attendencee` WHERE class_name='$class' and `datee` between '$sd' and '$ed';";
        $ress = mysqli_query($conn, $sqll);
        $date_ary=array();
        while ($row = mysqli_fetch_assoc($ress)) {
            
            array_push($date_ary,$row['datee']);
        }
        
        $len=count($date_ary);
        for($i=0;$i<$len;$i++) {
            $d=$date_ary[$i];
            $a1=array($d);
        $sqll = "SELECT status from attendencee WHERE datee='$d' AND class_name='$class' GROUP BY roll;";
        $ress = mysqli_query($conn, $sqll);
        while ($row = mysqli_fetch_assoc($ress)) {
            array_push($a1,$row['status']);
            
        }
        fputcsv($o,$a1);
    }
    fclose($o);
}
?>
