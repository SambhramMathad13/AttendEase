<?php 
session_start();
$email = $_SESSION['email'];
$pass = $_SESSION['pass'];
$class=$_GET["c"];
include 'connect.php';
$sql = "SELECT `name`,startt,endd FROM classes WHERE class_name = '$class'";
$ress = mysqli_query($conn, $sql);
if (mysqli_num_rows($ress) > 0) {
    while ($row = mysqli_fetch_assoc($ress)) {
        $start=$row['startt'];
        $end=$row['endd'];
        $name=$row['name'];
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Take Attendence</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Font Link for Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css"
        integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Jost:wght@500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        #bodyy
        {
            border-radius: 10px;
            /* box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12); */
            background: #eee;
            box-shadow: inset -10px -10px 15px rgba(255, 255, 255, 0.198),
                inset 10px 10px 15px rgba(70, 70, 70, 0.12);
        }
        #bodyy:hover {
            transform: translateY(5px);
            box-shadow: inset 0px 10px 20px 2px rgba(0, 0, 0, 0.25);
        }
    </style>

</head>

<body class="bg-white">

    <div class="container-xxl bg-white p-0">

        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="index.php" class="navbar-brand p-0">
                    <h1 class="m-0">AttentEase</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto py-0">
                        <a href="take_attendence.php?h=<?php echo$email?>" class="nav-item nav-link">Go Back</a>
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="Login.php" class="nav-item nav-link ">Login</a>
                        <a href="Signup.php" class="nav-item nav-link">Signup</a>
                        <!-- <a href="view_attendence.html" class="nav-item nav-link">View Attendence</a> -->
                        <a href="index.php" class="nav-item nav-link">Logout</a>
                    </div>
                </div>
            </nav>

            <div class="container-fluid mb-0 mt-0 bg-primary hero-header">

            </div>
        </div>


        <div class="container-xxl col-sm-3 col-lg-3 text-dark fw-bold border-1  roundedborder  shadow-lg" id="bodyy">
            <div class="formm" class="mb-3 my-5 col-12 text-dark" style="margin-top:6vh; margin-bottom: 2vh;">



                <!-- <form name="myForm"> -->

                <div class=" mb-1 mt-3 ms-3 col-12 text-dark h2 fw-bold">
                    Welcome to class-<?php echo $class?><br><br>
                    <span class='time-right mb-1 ms-1' id="s"><?php echo $start?></span><span class="h5">_to_</span><span
                        class='time-left mb-1' id="e"><?php echo $end?></span>

                </div>



                <div class="mb-4 ms-3 my-1 col-11 text-dark">
                    <label for="exampleInputEmail1" class="form-label pt-3 h4">Roll number</label>
                    <div class="border border-dark rounded text-center display-1 p-5 p-sm-5 bg-white text-dark"
                        id="start">

                    </div>

                </div>

                            <!-- <div class="border border-dark rounded" id="start">
                    hi
                </div> -->

                <button class="btn btn-outline-success my-3 col-4 ms-2 fs-4 p-2" onclick="present()"
                    id="p">Present</button>


                <button class="btn btn-outline-danger my-3 col-4 ms-1 fs-4 p-2" onclick="absent()"
                    id="a">Absent</button>
                <button class="btn btn-outline-dark my-3 col-3 ms-1 fs-4 p-2" onclick="none()"
                    id="n">None</button>
                <button class="btn btn-outline-primary my-2 col-11 ms-3 fs-5 p-1" onclick="update()"
                    id="u">Update</button>
                
                    

                <!-- </form> -->

            </div>
        </div>

    </div>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>


    <script>
        let b = document.getElementById("s").innerText;
        let roll = document.getElementById("s").innerText;
        let e = document.getElementById("e").innerText;
        document.onload
        {
            document.getElementById("start").innerHTML = b;
        }
        function present() {
            // console.log("Present...");
            if (b < e) {
                b++;
                document.getElementById("start").innerHTML = b;
            }
            else {
                alert("done...");
                window.location.href = "http://localhost/attend/real/take_attendence.php?h=<?php echo $email;?>";   
            }

        }
        function absent() {
            // console.log("Absent...");
            if (b < e) {
                b++;
                document.getElementById("start").innerHTML = b;
            }
            else {

                alert("done...");
                window.location.href = "http://localhost/attend/real/take_attendence.php?h=<?php echo $email;?>";

            }
        }
        function none () {
            // console.log("Absent...");
            if (b < e) {
                b++;
                document.getElementById("start").innerHTML = b;
            }
            else {

                alert("done...");
                window.location.href = "http://localhost/attend/real/take_attendence.php?h=<?php echo $email;?>";

            }
        }

        $("#p").click(function () {
             if (roll <= e) {
            let status = "P"
            $.post("insert.php", {
                roll: roll,
                status: status,
                name: '<?php echo $name; ?>',
                class_name: '<?php echo $class; ?>'
            },
                function (data, status) {
                    // console.log(data);
                });
            roll++;
            }
        });


        $("#a").click(function () {
            if (roll <= e) {
            let status = "A"
            $.post("insert.php", {
                roll: roll,
                status: status,
                name: '<?php echo $name; ?>',
                class_name: '<?php echo $class; ?>'
            },
                function (data, status) {
                    // console.log(data);
                });
            roll++;
            }
        });
        $("#n").click(function () {
            if (roll <= e) {
            let status = "N"
            $.post("insert.php", {
                roll: roll,
                status: status,
                name: '<?php echo $name; ?>',
                class_name: '<?php echo $class; ?>'
            },
                function (data, status) {
                    // console.log(data);
                });
            roll++;
            }
        });

    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>