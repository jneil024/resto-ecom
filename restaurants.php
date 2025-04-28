<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Restaurants</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<style>
    /* Title Styling */
    .restaurant-title {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        padding: 10px;
        background:#4e8a3e;
        color: white;
        border-radius: 8px;
    }

    /* Restaurant Card Styling */
    .restaurant-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        border: 2px solid rgb(227, 185, 0) ;/* Border Added */
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .entry-logo img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
    }

    .entry-dscr {
        flex-grow: 1;
        margin-left: 15px;
    }

    .right-content {
        margin-left: auto;
    }

    .btn-purple {
        background-color: #4e8a3e;
        color: white;
        padding: 8px 12px;
        text-decoration: none;
        border-radius: 5px;
        display: inline-block;
    }

    .btn-purple:hover {
        background-color:#284420;
    }
    .headrom{
        background-color: green!important;
    }
    #editProfileModal>div {
        max-height: 70vh;
        overflow-y: auto;
    }

    .inner-page-hero {
    background-image: url("images/bh.jpg"); /* Set background image */
    background-size: cover; /* Make the image cover the div */
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Prevent image repetition */
    height: 300px; /* Adjust height as needed */
    display: flex; /* Use flexbox */
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    text-align: center; /* Ensure text stays centered */
    height: 5rem;

}

/* .inner-page-hero h1 {
    font-size: 60px !important;
    color: #f3f3f3;
    font-family: 'Give You Glory', cursive;
    text-decoration: underline; 
} */
@import url('https://fonts.googleapis.com/css2?family=Give+You+Glory&display=swap');

.inner-page-hero h1 {
    font-family: 'Give You Glory', cursive;
    font-size: 60px !important;
    color: #f3f3f3;
    display: inline-block;
    position: relative;
    padding-bottom: 5px;
}

/* Underline Starts Empty & Animates Automatically */
.inner-page-hero h1::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 0%;
    height: 3px;
    background-color: #f3f3f3;
    animation: underlineMove 1s ease-in-out forwards;
}

/* Keyframes: Expanding Effect */
@keyframes underlineMove {
    0% { width: 0%; }
    100% { width: 100%; }
}



</style>
<body>

<header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse"
                    data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/nlogo.png" alt="" height="35px"></a>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="restaurants.php">Restaurants <span class="sr-only"></span></a>
                        </li>

                        <?php
                        if (empty($_SESSION["user_id"])) {
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
    <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
                        } else {
                            echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
                            echo '<li class="nav-item" style="position: relative; display: inline-block;">
        <a href="#" class="nav-link" onclick="toggleDropdown()" style="text-decoration: none; color: white; font-size: 20px;">
            <i class="fa fa-user-circle"></i> ▼
        </a>
        <ul id="userDropdown" class="dropdown-menu" style="display: none; position: absolute; right: 0; background: white; list-style: none; padding: 10px; border: 1px solid #ccc; width: 150px;">
            <li><a href="#" onclick="openModal()" style="text-decoration: none; color: black; display: block; padding: 5px;">Edit Profile</a></li>
            <li><a href="logout.php" style="text-decoration: none; color: black; display: block; padding: 5px;">Logout</a></li>
        </ul>
    </li>';

                            echo '<script>
        function toggleDropdown() {
            var dropdown = document.getElementById("userDropdown");
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }
        
        function openModal() {
            document.getElementById("editProfileModal").style.display = "block";
        }
        
        function closeModal() {
            document.getElementById("editProfileModal").style.display = "none";
        }
    </script>';
                        }
                        ?>

                        <!-- Edit Profile Modal -->
                        <div id="editProfileModal" style="display: none; position: fixed; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
                            <div style="position: relative; width: 50%; margin: 10% auto; background: white; padding: 20px; border-radius: 5px;">
                                <h2>Edit Profile</h2>
                                <form action="update_user.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="username" name="username">
                                            </div>
                                            <div class="mb-3">
                                                <label for="f_name" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="f_name" name="f_name">
                                            </div>
                                            <div class="mb-3">
                                                <label for="l_name" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="l_name" name="l_name">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password" name="password">
                                            </div>
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <textarea class="form-control" id="address" name="address"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Save</button>
                                        <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </ul>

                </div>
            </div>
        </nav>

    </header>
    <div class="page-wrapper">
        <div class="top-links">
            <div class="container">
                <ul class="row links">

                    <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="#">Choose Restaurant</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Pick Your favorite food</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>
                </ul>
            </div>
        </div>
        <div class="inner-page-hero">
    <div class="container text-center">
        <h1>Restaurant</h1>    
    </div>
</div>
        </div>
        <div class="container"> 
        <div class="result-show">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>
        <section class="restaurants-page">
        <div class="container">
    <h2 class="restaurant-title">Available Restaurants</h2> <!-- Title Added -->
    <div class="row">
        <div class="col-12">
            <div class="bg-gray restaurant-entry">
                <div class="row">
                    <?php 
                    $ress = mysqli_query($db, "SELECT * FROM restaurant");
                    while ($rows = mysqli_fetch_array($ress)) {
                        echo '
                        <div class="col-12 restaurant-card">
                            <div class="entry-logo">
                                <a class="img-fluid" href="dishes.php?res_id=' . $rows['rs_id'] . '">
                                    <img src="admin/Res_img/' . $rows['image'] . '" alt="Food logo">
                                </a>
                            </div>
                            <div class="entry-dscr">
                                <h5><a href="dishes.php?res_id=' . $rows['rs_id'] . '">' . $rows['title'] . '</a></h5>
                                <span>' . $rows['address'] . '</span>
                            </div>
                            <div class="right-content">
                                <a href="dishes.php?res_id=' . $rows['rs_id'] . '" class="btn btn-purple">View Menu</a>
                            </div>
                        </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>