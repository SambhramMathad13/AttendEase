<?php 
session_start();
$otp = $_SESSION['otp'];
$email = $_SESSION['email'];
$name = $_SESSION['name'];
$pass = $_SESSION['pass'];
$logined = $_SESSION['logedin'];

    $servername = "localhost";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($servername, $username, $password, "attent");
    if (!$conn) {
      echo "<script>
            alert('Server error please try again...');</script>";
      exit;
    }

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $n1 = $_POST['n1'];
    $n2 = $_POST['n2'];
    $n3 = $_POST['n3'];
    $n4 = $_POST['n4'];
    $n5 = $_POST['n5'];
    $n6 = $_POST['n6'];

    $otp2 = $n1 . $n2 . $n3 . $n4 . $n5 . $n6;
    
    if ($otp2 == $otp) {
      
        $_SESSION['name'] = $name;
        $_SESSION['pass'] = $pass;
        $_SESSION['email'] = $email;
        $status = 1;
        $sql = "INSERT INTO `class_namee` (`namee`, `email`,`pass`,`loged`) VALUES ('$name','$email','$pass','$status')";
        $res = mysqli_query($conn, $sql);
        if ($res) {
        // header("location: take_attendence.php");
        // exit;
        echo "<script>
        window.location.href='take_attendence.php';
        </script>";
        }
    }
    else{
        echo "<script>
        alert('Invalid OTP');
        window.location.href='Signup.php';
        </script>";
        // header("location: Signup.php");
        // exit;
    }
}
