<?php 
        // $msg = $_POST['text'];
        // $room = $_POST['room'];
        $servername = "localhost";
        $username = "root";
        $password = "";
        

        $conn = mysqli_connect($servername, $username, $password, "attent");
        if (!$conn) {
            echo "<script language='javascript'>
          alert('Server error please try again...');</script>";
            exit;
        } 
?>