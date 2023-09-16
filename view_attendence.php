<?php
session_start();
$email = $_SESSION['email'];
$pass = $_SESSION['pass'];
$class = $_GET["c"];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>View Attendence</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Font Link for Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">


    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <style>
        /* Import Google font - Poppins */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        } */

        .bodyy {
            display: flex;
            align-items: center;
            padding: 0 10px;
            justify-content: center;
            min-height: 100vh;
            background: white;
        }

        .wrapper {
            width: 450px;
            /* background: #d7d3fe; */
            border-radius: 10px;
            /* box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12); */
            background: #eee;
            box-shadow: inset -10px -10px 15px rgba(255, 255, 255, 0.198),
                inset 10px 10px 15px rgba(70, 70, 70, 0.12);

        }

        .wrapper:hover {
            transform: translateY(5px);
            box-shadow: inset 0px 10px 20px 2px rgba(0, 0, 0, 0.25);
        }

        .wrapper header {
            display: flex;
            align-items: center;
            padding: 25px 30px 10px;
            justify-content: space-between;
        }

        header .icons {
            display: flex;
        }

        header .icons span {
            height: 38px;
            width: 38px;
            margin: 0 1px;
            cursor: pointer;
            color: #878787;
            text-align: center;
            line-height: 38px;
            font-size: 1.9rem;
            user-select: none;
            border-radius: 50%;
        }

        .icons span:last-child {
            margin-right: -10px;
        }

        header .icons span:hover {
            background: #f2f2f2;
        }

        header .current-date {
            font-size: 1.45rem;
            font-weight: 500;
        }

        .calendar {
            padding: 20px;
        }

        .calendar ul {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            text-align: center;
        }

        .calendar .days {
            margin-bottom: 20px;
        }

        .calendar li {
            color: #333;
            width: calc(100% / 7);
            font-size: 1.07rem;
        }

        .calendar .weeks li {
            font-weight: 500;
            cursor: default;
        }

        .calendar .days li {
            z-index: 1;
            cursor: pointer;
            position: relative;
            margin-top: 30px;
        }

        .days li.inactive {
            color: #aaa;
        }

        .days li.active {
            color: #fff;
        }

        .days li::before {
            position: absolute;
            content: "";
            left: 50%;
            top: 50%;
            height: 40px;
            width: 40px;
            z-index: -1;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }

        .days li.taken::before {
            /* background: #9B59B6; */
            /* background:greenyellow; */
            border: 2px solid #9B59B6;
        }

        /* .taken
        {
            border: 2px solid #9B59B6;
        } */

        .days li.active::before {
            background: #9B59B6;
        }

        .days li:not(.active):hover::before {
            background: #f2f2f2;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Jost:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">


</head>

<body class="bg-white">

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
                        <a href="take_attendence.php?h=<?php echo $email ?>" class="nav-item nav-link">Go Back</a>
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="Login.php" class="nav-item nav-link ">Login</a>
                        <a href="Signup.php" class="nav-item nav-link">Signup</a>
                        <!-- <a href="#" class="nav-item nav-link active">View Attendence</a> -->
                        <a href="index.php" class="nav-item nav-link">Logout</a>
                    </div>
                </div>
            </nav>

            <div class="container-fluid mb-4 mt-0 bg-primary hero-header">

            </div>
        </div>

    </div>





    <!-- <div class="display-5">Welcome to </div> -->
    <div class="wow fadeInUp" data-wow-delay="0.1s">
        <p class="section-title text-secondary justify-content-center"><span></span>Welcome to <?php echo $class ?><span></span></p>
    </div>

    <div class="bodyy">




        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enter dates</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="alert alert-info" role="alert">
                        Note :
                        Please enter the range of dates on which you have taken the Attendence.
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="sd" class="col-form-label">Start date:</label>
                            <input type="date" class="form-control" id="sd">
                        </div>
                        <div class="mb-3">
                            <label for="ed" class="col-form-label">End date:</label>
                            <input type="date" class="form-control" id="ed">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" onclick="show()" data-bs-dismiss="modal" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>






        <div class="modal fade" id="exampleModall" tabindex="-1" aria-labelledby="exampleModalLabell" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="download.php" method='post'>
                    <input type="hidden" name="class" value="<?php echo $class ?>">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabell">Enter dates</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="alert alert-info" role="alert">
                            Note :
                            Please enter the range of dates on which you have taken the Attendence.
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="sdd" class="col-form-label">Start date:</label>
                                <input type="date" class="form-control" id="sdd" name='sdd'>
                            </div>
                            <div class="mb-3">
                                <label for="edd" class="col-form-label">End date:</label>
                                <input type="date" class="form-control" id="edd" name="edd">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="wrapper bg-light">
            <header>
                <div id="get">
                    <p class="current-date"></p>
                </div>
                <div class="icons">
                    <span id="prev" class="material-symbols-rounded">chevron_left</span>
                    <span id="next" class="material-symbols-rounded">chevron_right</span>
                </div>
            </header>
            <div class="calendar">
                <ul class="weeks">
                    <li>Sun</li>
                    <li>Mon</li>
                    <li>Tue</li>
                    <li>Wed</li>
                    <li>Thu</li>
                    <li>Fri</li>
                    <li>Sat</li>
                </ul>
                <ul class="days"></ul>
                <hr>
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title text-secondary justify-content-center"><span></span><span id="getdate">Date</span><span></span></p>
                </div>
            </div>
            <div class="container">
                <div class="show">
                    <div class="d-flex gap-2 ">
                        <div type="button" class="p-4 flex-fill rounded mb-2  btn btn-outline-success" style=" box-shadow: inset -10px -10px 15px rgba(255, 255, 255, 0.198), 
                        inset 10px 10px 15px rgba(70, 70, 70, 0.12);"><span id="present" class="h3"></span> Present
                        </div>
                        <div class="p-4 flex-fill rounded mb-2 btn btn-outline-danger" style=" box-shadow: inset -10px -10px 15px rgba(255, 255, 255, 0.198), 
                        inset 10px 10px 15px rgba(70, 70, 70, 0.12);"><span id="absent" class="h3"></span>Absent
                        </div>
                        <div class="p-4 flex-fill rounded mb-2 btn btn-outline-secondary" style=" box-shadow: inset -10px -10px 15px rgba(255, 255, 255, 0.198), 
                        inset 10px 10px 15px rgba(70, 70, 70, 0.12);"><span id="none" class="h3"></span> None</div>
                    </div>
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="p-1 col-12 flex-fill rounded mb-2 btn btn-outline-primary" style=" box-shadow: inset -10px -10px 15px rgba(255, 255, 255, 0.198), 
                        inset 10px 10px 15px rgba(70, 70, 70, 0.12);"><span id="show" class="h3"></span>Students details</button>


                    <button data-bs-toggle="modal" data-bs-target="#exampleModall" class="p-1 col-12 flex-fill rounded mb-2 btn btn-outline-primary" style=" box-shadow: inset -10px -10px 15px rgba(255, 255, 255, 0.198), 
                        inset 10px 10px 15px rgba(70, 70, 70, 0.12);"><span id="show" class="h3"></span>Download</button>

                </div>
            </div>
        </div>


    </div>


    <div class="container-xxl">


        <table class="table table-light table-striped border-info  mb-5 my-5">

            <thead>
                <tr class="col-7">
                    <th scope="col-4" class="col-3">Sno</th>
                    <th scope="col-4" class="col-3">Rolls</th>
                    <th scope="col-4" class="col-3">Score</th>
                    <th scope="col-4" class="col-3">Percentage</th>
                </tr>
            </thead>
            <tbody id="table1">
            </tbody>
        </table>




        <table class="table table-light table-striped border-info  mb-5 my-5">
            <thead>
                <tr class="col-7">
                    <th scope="col-4" class="col-3">Sno</th>
                    <th scope="col-4" class="col-3">Absent Rolls</th>
                    <th scope="col-4" class="col-3">Action</th>
                </tr>
            </thead>
            <tbody id="table">
            </tbody>
        </table>
    </div>






    <script>
        const daysTag = document.querySelector(".days"),
            currentDate = document.querySelector(".current-date"),
            prevNextIcon = document.querySelectorAll(".icons span");

        // getting new date, current year and month
        let date = new Date(),
            currYear = date.getFullYear(),
            currMonth = date.getMonth();

        // storing full name of all months in array
        const months = ["January", "February", "March", "April", "May", "June", "July",
            "August", "September", "October", "November", "December"
        ];

        const renderCalendar = () => {
            let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
                lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
                lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
                lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
            let liTag = "";

            for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
                liTag += `<li class="inactive" onclick="say(${lastDateofLastMonth - i + 1})" >${lastDateofLastMonth - i + 1}</li>`;


            }

            for (let i = 1; i <= lastDateofMonth; i++) { // creating li of all days of current month
                // adding active class to li if the current day, month, and year matched
                let isToday = i === date.getDate() && currMonth === new Date().getMonth() &&
                    currYear === new Date().getFullYear() ? "active" : "";
                liTag += `<li  class="${isToday}" id="${currYear}${currMonth+1}${i}"  onclick="say(this.id,${i})">${i}</li>`;
            }

            for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
                liTag += `<li class="inactive"  onclick="say(${i - lastDayofMonth + 1})" )>${i - lastDayofMonth + 1}</li>`


            }






            $.post("isTakenn.php", {
                    class_name: '<?php echo $class; ?>'
                },
                function(data, status) {
                    // console.log(data);
                    const a = data.split("___");
                    // let l=a.length;
                    // console.log(l);
                    a.pop();
                    // console.log(a);
                    for (i in a) {
                        let l = a[i].replace("0", "_");
                        const ll = l.replace("0", "_");
                        if (ll[9] != 0) {
                            // let llo = ll.replace("0", "_");
                            // }
                            // console.log(ll[9])
                            let llo = ll.replace("0", "_");
                            let lll = llo.replace("_", "0");
                            let last = lll.replace("_", "");
                            let lasto = last.replace("_", "");
                            let lastl = lasto.replace("-", "");
                            const nowlast = lastl.replace("-", "");
                            $(`#${nowlast}`).addClass("taken");

                        } else {
                            let lll = ll.replace("_", "0");
                            let last = lll.replace("_", "");
                            let lasto = last.replace("_", "");
                            let lastl = lasto.replace("-", "");
                            const nowlast = lastl.replace("-", "");
                            $(`#${nowlast}`).addClass("taken");
                        }
                        // console.log(nowlast);
                        // console.log(elemclass);
                        // elemclass.classList.add("#taken");
                    }

                });

            currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
            daysTag.innerHTML = liTag;
        }
        renderCalendar();

        prevNextIcon.forEach(icon => { // getting prev and next icons
            icon.addEventListener("click", () => { // adding click event on both icons
                // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
                currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

                if (currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
                    // creating a new date of current year & month and pass it as date value
                    date = new Date(currYear, currMonth, new Date().getDate());
                    currYear = date.getFullYear(); // updating current year with new date year
                    currMonth = date.getMonth(); // updating current month with new date month
                } else {
                    date = new Date(); // pass the current date as date value
                }
                renderCalendar(); // calling renderCalendar function
            });
        });

        function say(id, which) {
            // console.log(id);
            m = document.getElementById("get").innerText;
            let dob = new Date(which + m);
            const [d] = dob.toISOString().split("T");
            document.getElementById("getdate").innerText = d;
            // console.log(d);
            $.post("fetch.php", {
                    datee: d,
                    class_name: '<?php echo $class; ?>'
                },
                function(data, status) {
                    // console.log(data);
                    const a = data.split("___");
                    // console.log(a[0]);
                    // console.log(a[1]+"hello world");
                    document.getElementById("present").innerHTML = a[0];
                    document.getElementById("absent").innerHTML = a[1];
                    document.getElementById("none").innerHTML = a[2];
                    document.getElementById("table").innerHTML = a[3];

                });


        }

        function update(roll, str) {
            $.post("update.php", {
                    datee: str,
                    roll: roll,
                    class_name: '<?php echo $class; ?>'
                },
                function(data, status) {
                    const a = data.split("___");
                    document.getElementById("present").innerHTML = a[0];
                    document.getElementById("absent").innerHTML = a[1];
                    document.getElementById("none").innerHTML = a[2];
                    document.getElementById("table").innerHTML = a[3];

                });
        }

        function show() {
            const sd = document.getElementById('sd').value;
            const ed = document.getElementById('ed').value;
            $.post("show.php", {
                    class_name: '<?php echo $class; ?>',
                    s_date: sd,
                    e_date: ed
                },
                function(data, status) {
                    const a = data;
                    console.log(a);
                    document.getElementById("table1").innerHTML = a;

                });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>
