<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $cpass = $_POST['cpass'];
  if ($pass != $cpass) {
    echo "<script>
            alert('Mismatch conferm password...');</script>";
  } else {
    $servername = "localhost";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($servername, $username, $password, "attent");
    if (!$conn) {
      echo "<script>
            alert('Server error please try again...');</script>";
      exit;
    }


    $sql = "SELECT * FROM `class_namee` WHERE `namee`='$name'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    // echo $row;
    if ($row == 1) {

      echo "<script>
            alert('Username already taken... Please enter other name...');</script>";
    } else {

      $sqll = "SELECT * FROM `class_namee` WHERE `email`='$email'";
      $ress = mysqli_query($conn, $sqll);
      $roww = mysqli_num_rows($ress);
      // echo $row;
      if ($roww == 1) {

        echo "<script>
            alert('Email already taken... Please enter other email...');</script>";
      } else {
       
        
          // echo "<script>alert('An OTP has sent to your email address entered...');</script>";
          session_start();
          $_SESSION['logedin'] = true;
          $_SESSION['name'] = $name;
          $_SESSION['pass'] = $pass;
          $_SESSION['email'] = $email;
        //   header("location: emaill.php");
        //   exit;
        echo "<script>
        window.location.href='emaill.php';
        </script>";
        
      }
    }
  }
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
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Jost:wght@500;600;700&display=swap"
        rel="stylesheet">

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
                        <a href="#" class="nav-item nav-link active">Signup</a>
                        <a href="take_attendence.php" class="nav-item nav-link">Take Attendence</a>
                        <a href="index.php" class="nav-item nav-link">Logout</a>
                    </div>
                </div>
            </nav>

            <div class="container-fluid mb-0 mt-0 bg-primary hero-header">
               
            </div>
        </div>
       
        <div class="container-xxl py-2">
            <div class="container py-2 px-lg-5">
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title text-secondary justify-content-center"><span></span>Signin<span></span></p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="wow fadeInUp" data-wow-delay="0.3s">
                            <form name="myForm" onsubmit="return validate()" action="http://localhost/attend/real/Signup.php" method="post">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                            <label for="name">Your Name</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email" 
                                                placeholder="Your Email" required>
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="subject" name="pass" placeholder="Create password" required>
                                            <label for="subject">Create password</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="subjec" name="cpass" placeholder="Create password" required>
                                            <label for="subjec">Confirm password</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit" >Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->


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
                        <a class="btn btn-link" href="#">Signin</a>
                        <a class="btn btn-link" href="Login.php">Login</a>
                        <a class="btn btn-link" href="index.php">Steps</a>
                        <a class="btn btn-link" href="#">Logout</a>
                    </div>
                </div>
            </div>
            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="index.php">AttendEase</a>, All Right Reserved.
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        function validate()
        {
            let x = document.forms["myForm"]["name"].value;
          let y = document.forms["myForm"]["pass"].value;
          let z = document.forms["myForm"]["email"].value;
          if (x.length > 20) {
            alert("Name must be between 4 to 20 characters long");
            // document.getElementById("n").value = "";
            return false;
          } else if (x.length < 4) {
            alert("Name must be at more than 4 characters");
            // document.getElementById("n").value = "";
            return false;
          } else if (y.length <= 7 || y.length >= 13) {
            alert("Password must be between 8 to 12 characters...");
            // document.getElementById("pass").value = "";
            // document.getElementById("cpass").value = "";
            return false;
          } else {
            return true;
          }
        }
    </script>
</body>

</html>