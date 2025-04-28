<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch'
    href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

  <link rel="stylesheet" href="css/login.css">

  <style type="text/css">
    #buttn {
      color: #fff;
      background-color: #4e8a3e;
    }
    .bg {
    background-image: url('images/bh.jpg');
    background-size: cover; /* Ensures the image covers the full area */
    background-position: center; /* Centers the background image */
    background-repeat: no-repeat; /* Prevents repetition */
    
    width: 100vw; /* Full width of the viewport */
    height: 100vh; /* Full height of the viewport */
    position: fixed; /* Stays fixed even on scroll */
    top: 0;
    left: 0;
  }
  </style>


  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animsition.min.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

</head>

<body>
  <header id="header" class="header-scroll top-header headrom">
    <nav class="navbar navbar-dark">
      <div class="container">
        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse"
          data-target="#mainNavbarCollapse">&#9776;</button>
        <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/nlogo.png" alt=""
            height="35px"></a>
        <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
          <ul class="nav navbar-nav">
            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span
                  class="sr-only">(current)</span></a> </li>
            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span
                  class="sr-only"></span></a> </li>

            <?php
            if (empty($_SESSION["user_id"])) {
              echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							<li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
            } else {


              echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
              echo '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
            }

            ?>

          </ul>
        </div>
      </div>
    </nav>
  </header>
  <div class="bg">

  <?php
include("connection/connect.php");
error_reporting(0);
session_start();

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Fetch the hashed password from the database
        $loginquery = "SELECT * FROM users WHERE username = '" . mysqli_real_escape_string($db, $username) . "'";
        $result = mysqli_query($db, $loginquery);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Verify the hashed password
            if (password_verify($password, $row['password'])) {
                if ($row['role'] == 'admin') {
                    $_SESSION["adm_id"] = $row['u_id'];
                    header("location: admin/dashboard.php");
                    exit();
                } else {
                    $_SESSION["user_id"] = $row['u_id'];
                    header("location: index.php");
                    exit();
                }
            } else {
                $message = "Invalid Username or Password!";
            }
        } else {
            $message = "User not found!";
        }
    } else {
        $message = "Please enter both username and password!";
    }
}
?>




    <div class="pen-title">
      </div>

      <div class="module form-module" style="margin-top: 150px;">
    <div class="toggle"></div>
    <div class="form">
        <h2>Login to your account</h2>
        <span style="color:red;"><?php echo $message; ?></span>
        <span style="color:green;"><?php echo $success; ?></span>
        <form action="" method="post">
            <input type="text" placeholder="Username" name="username" />
            <input type="password" placeholder="Password" name="password" />
            <input type="submit" id="buttn" name="submit" value="Login" />
        </form>
    </div>
    <div class="cta">Not registered? <a href="registration.php" style="color:#4e8a3e;">Create an account</a></div>
</div>

<style>
/* Initial State */
.module.form-module {
    opacity: 0;
    transform: translateY(50px);
    animation: slideUp 0.8s ease-in-out forwards;
}

/* Animation */
@keyframes slideUp {
    0% {
        opacity: 0;
        transform: translateY(50px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <div class="container-fluid pt-3">
          <p></p>
        </div>
  </div>
</body>

</html>