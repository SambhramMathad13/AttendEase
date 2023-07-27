<?php
session_start();
$log = false;
$log = $_SESSION['logedin'];
$email = $_SESSION['email'];
$pass = $_SESSION['pass'];
if ($log == true) {
    include 'connect.php';
    $emaill = $_GET['h'];
    if ($emaill != $email) {
        // header("location: Signup.php");
        // exit;
        echo "<script>
        window.location.href='Signup.php';
        </script>";
    } else {

        $res = "";
        $sql = "SELECT class_name,startt,endd FROM classes WHERE email = '$email'";
        $ress = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($ress);
        $slno=1;

      
        $_SESSION['email'] = $email;
        $_SESSION['pass'] = $pass;
        if (mysqli_num_rows($ress) > 0) {
            while ($row = mysqli_fetch_assoc($ress)) {

                $res = $res ."<tr class='h5'>
                <th scope='row' class='col-1'>".$slno."</th>
                <td class='col-5'>".$row['class_name']."</td>
                <td>".$row['startt']."-".$row['endd']."</td>
                <td class='col-2'> <a href='take_attendence-1.php?c=".$row['class_name']."' type='button' class='btn btn-light me-2'>Take</a> <a href='view_attendence.php?c=".$row['class_name']."' type='button' class='btn btn-dark me-2'>View</a></td>
            </tr>";
            $slno++;
            }
        }
        // echo "<script type='text/javascript'>
        // document.getElementById('table').innerHTML ='".$res."';
        // </script>";


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $class = $_POST['class'];
            $start = $_POST['start'];
            $end = $_POST['end'];

            $sql = "SELECT * FROM `classes` WHERE `class_name`='$class'";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($res);
            // echo $row;
            if ($row == 1) {

                echo "<script type='text/javascript'> 

            alert('Class name already taken. Please enter some other name.'); 
            window.location.href='take_attendence.php?h=".$email."';
            </script>";
                // header("location: take_attendence.php?h=$email");
                // // echo ('<script type="text/javascript"> 
                // //   window.location.href="c.php"; 
                // //    </script>');
                // exit;
            } else {
                $s = "SELECT `namee` FROM `class_namee` WHERE `email`='$email' && `pass`='$pass'";
                $res = mysqli_query($conn, $s);
                if ($res) {
                    $row = mysqli_fetch_assoc($res);
                    $name = $row['namee'];
                }



                $sql = "INSERT INTO `classes` (`name`,`pass`,`email`,`class_name`,`startt`,`endd`, `datee`) VALUES ('$name','$pass','$email','$class','$start','$end',current_timestamp())";

                $res = mysqli_query($conn, $sql);
                if ($res) {
                    // echo $name;
                    echo "<script type='text/javascript'>alert('Class created successfuly ...');</script>";
                    echo ('<script type="text/javascript"> 
            window.location.href="take_attendence.php?h=' . $email . '";  
               </script>');
                    exit;
                }
            }
        }
    }
} else {
    // header("location: Signup.php");
    // exit;
    echo "<script>
    window.location.href='Signup.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>AttendEase</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Jost:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">

        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="index.php" class="navbar-brand p-0">
                    <h1 class="m-0">AttentEase</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto py-0">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="Login.php" class="nav-item nav-link">Login</a>
                        <a href="Signup.php" class="nav-item nav-link ">Signup</a>
                        <a href="#" class="nav-item nav-link active">Take Attendence</a>
                        <!-- <a href="view_attendence.html" class="nav-item nav-link">View Attendence</a> -->
                        <a href="index.php" class="nav-item nav-link">Logout</a>
                    </div>
                </div>
            </nav>

            <div class="container-fluid mb-0 mt-0 bg-primary hero-header">

            </div>
        </div>
        <!-- Navbar & Hero End -->


        <!-- Contact Start -->
        <div class="container-xxl py-2">
            <div class="container py-2 px-lg-5">
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title text-secondary justify-content-center"><span></span>Create
                        class<span></span></p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="wow fadeInUp" data-wow-delay="0.3s">
                            <form name="myForm" onsubmit="return validateForm()" action="http://localhost/attend/real/take_attendence.php?h=<?php echo $email ?>" method="post">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" name="class" placeholder="Class Name" required>
                                            <label for="name">Class Name</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="email" name="start" placeholder="Starting Roll" required>
                                            <label for="email">Starting Roll</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="subject" name="end" placeholder="Ending Roll" required>
                                            <label for="subject">Ending Roll</label>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->

        <div class="container-xxl my-5">
            <h1 class="mb-5">Your Classes</h1>

            <table class="table table-light table-striped border-info border border-dark">
                <thead>
                    <tr>
                        <th scope="col">Sno</th>
                        <th scope="col">Class</th>
                        <th scope="col">Rolls</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="table">
                    <?php 
                    echo $res;
                    ?>
                    

                </tbody>
            </table>

        </div>

        <!-- Footer Start -->
        <div class="container-fluid bg-primary text-light footer wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-3">
                        <p class="section-title text-white h5 mb-4">Address<span></span></p>
                        <p><i class="fa fa-map-marker-alt me-3"></i>Gogte Institution Of Technology,Belagavi.</p>
                        <p><i class="fa fa-phone-alt me-3"></i>7204701301</p>
                        <p><i class="fa fa-envelope me-3"></i>sambhrammathad@gmail.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <p class="section-title text-white h5 mb-4">Quick Link<span></span></p>
                        <a class="btn btn-link" href="Signup.php">Signin</a>
                        <a class="btn btn-link" href="Login.php">Login</a>
                        <a class="btn btn-link" href="index.php">Steps</a>
                        <a class="btn btn-link" href="index.php">Logout</a>
                    </div>
                </div>
            </div>
            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">AttendEase</a>, All Right Reserved.

                            
                            Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="index.php">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-secondary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    
    <script>
       function validateForm() {
            // console.log("create");
            //   window.location.href="create_class.php";
            let clas = document.forms["myForm"]["class"].value;
            let start = document.forms["myForm"]["start"].value;
            let end = document.forms["myForm"]["end"].value;
            // let y = document.forms["myForm"]["pass"].value;
            if (clas.length <= 3 || clas.length >= 10) {
                alert("Class name must be between 3 to 10 characters.");
                // document.getElementById("class").value = "";
                return false;
            } else if (start.length >= 4) {
                alert("Please enter number less than 4 digits");
                // document.getElementById("start").value = "";
                return false;
            } else if (end.length >= 4) {
                alert("Please enter number less than 4 digits");
                // document.getElementById("end").value = "";
                return false;
            } 
            else if (start>=end) {
                alert("Invalid rolls...");
                // document.getElementById("end").value = "";
                return false;
            }
            else {
                return true;
            }
            // return false;
        }
        </script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>