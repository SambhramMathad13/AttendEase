<?php
session_start();
$email = $_SESSION['email'];
$name = $_SESSION['name'];
$pass = $_SESSION['pass'];
$logined = $_SESSION['logedin'];
$servername = "localhost";
$username = "root";
$password = "";

if ($logined) {

    $conn = mysqli_connect($servername, $username, $password, "attent");
    if (!$conn) {
        echo "<script>
            alert('Server error please try again...');</script>";
        exit;
    } else {


        $otp = rand(100000, 999999);
        // echo($otp . "<br>");
        // echo $email;

        $receiver = "$email";
        $subject = "Email Varification...";
        $body = "Hi, there...Your one time password(OTP) is " . $otp;
        $sender = "From:sambhrammathad@gmail.com";
        if (mail($receiver, $subject, $body, $sender)) {
            // echo "Email sent successfully to $receiver";
            echo "<script>
        alert('An OTP has sent to your email " . $receiver . " ');</script>";
        $_SESSION['otp'] =$otp;
        $_SESSION['name'] =$name;
        $_SESSION['pass'] =$pass;
        $_SESSION['email'] =$email;
        } else {
            echo"<script>
            alert('Sorry, failed to sent the OTP! Please connect to internet.');
            window.location.href='Signup.php';
            </script>";
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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OTP Verification Form</title>
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        /* Import Google font - Poppins */
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #4070f4;
        }

        :where(.container, form, .input-field, header) {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: #fff;
            padding: 30px 65px;
            border-radius: 12px;
            row-gap: 20px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .container header {
            height: 65px;
            width: 65px;
            background: #4070f4;
            color: #fff;
            font-size: 2.5rem;
            border-radius: 50%;
        }

        .container h4 {
            font-size: 1.25rem;
            color: #333;
            font-weight: 500;
        }

        form .input-field {
            flex-direction: row;
            column-gap: 10px;
        }

        .input-field input {
            height: 45px;
            width: 42px;
            border-radius: 6px;
            outline: none;
            font-size: 1.125rem;
            text-align: center;
            border: 1px solid #ddd;
        }

        .input-field input:focus {
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
        }

        .input-field input::-webkit-inner-spin-button,
        .input-field input::-webkit-outer-spin-button {
            display: none;
        }

        form button {
            margin-top: 25px;
            width: 100%;
            color: #fff;
            font-size: 1rem;
            border: none;
            padding: 9px 0;
            cursor: pointer;
            border-radius: 6px;
            pointer-events: none;
            background: #6e93f7;
            transition: all 0.2s ease;
        }

        form button.active {
            background: #4070f4;
            pointer-events: auto;
        }

        form button:hover {
            background: #0e4bf1;
        }
    </style>
</head>

<body>
    <div class="container my-5 col-sm-3 col-lg-3 my-5 mt-5  ms-3 me-3">
        <header>
            <i class="bx bxs-check-shield"></i>
        </header>
        <h4>Enter OTP Code</h4>
        <form action="http://localhost/attend/real/Verify_otp.php" method="post">
            <div class="input-field">
                <input id="n1" type="number" name="n1" />
                <input id="n2" type="number" disabled name="n2" />
                <input id="n3" type="number" disabled name="n3" />
                <input id="n4" type="number" disabled name="n4" />
                <input id="n5" type="number" disabled name="n5" />
                <input id="n6" type="number" disabled name="n6" />
            </div>
            <button type="submit">Verify OTP</button>
        </form>
    </div>


    <script>
        const inputs = document.querySelectorAll("input"),
            button = document.querySelector("button");

        // iterate over all inputs
        inputs.forEach((input, index1) => {
            input.addEventListener("keyup", (e) => {
                // This code gets the current input element and stores it in the currentInput variable
                // This code gets the next sibling element of the current input element and stores it in the nextInput variable
                // This code gets the previous sibling element of the current input element and stores it in the prevInput variable
                const currentInput = input,
                    nextInput = input.nextElementSibling,
                    prevInput = input.previousElementSibling;

                // if the value has more than one character then clear it
                if (currentInput.value.length > 1) {
                    currentInput.value = "";
                    return;
                }
                // if the next input is disabled and the current value is not empty
                //  enable the next input and focus on it
                if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
                    nextInput.removeAttribute("disabled");
                    nextInput.focus();
                }

                // if the backspace key is pressed
                if (e.key === "Backspace") {
                    // iterate over all inputs again
                    inputs.forEach((input, index2) => {
                        // if the index1 of the current input is less than or equal to the index2 of the input in the outer loop
                        // and the previous element exists, set the disabled attribute on the input and focus on the previous element
                        if (index1 <= index2 && prevInput) {
                            input.setAttribute("disabled", true);
                            input.value = "";
                            prevInput.focus();
                        }
                    });
                }
                //if the fourth input( which index number is 3) is not empty and has not disable attribute then
                //add active class if not then remove the active class.
                if (!inputs[5].disabled && inputs[5].value !== "") {
                    button.classList.add("active");
                    return;
                }
                button.classList.remove("active");
            });
        });

        //focus the first input which index is 0 on window load
        // window.addEventListener("load", () => inputs[0].focus());

        // function get()
        // {
        //     let n1=document.getElementById("n1").text;
        //     let n2=document.getElementById("n2").text;
        //     let n3=document.getElementById("n3").text;
        //     let n4=document.getElementById("n4").text;
        //     let n5=document.getElementById("n5").text;
        //     let n6=document.getElementById("n6").text;
        //     let otp=n1+n2+n3+n4+n5+n6;
        //     console.log(otp);
        // }
    </script>
</body>

</html>