<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();


function function_alert()
{

    echo "<script>alert('Thank you. Your Order has been placed!');</script>";
    echo "<script>window.location.replace('your_orders.php');</script>";
}

if (empty($_SESSION["user_id"])) {
    header('location:login.php');
} else {

    foreach ($_SESSION["cart_item"] as $item) {

        $item_total += ($item["price"] * $item["quantity"]);

        if ($_POST['submit']) {

            $cod_address = isset($_POST['cod_address']) ? mysqli_real_escape_string($db, $_POST['cod_address']) : NULL;
$gnumber = isset($_POST['gnumber']) ? mysqli_real_escape_string($db, $_POST['gnumber']) : NULL;
$gref = isset($_POST['gref']) ? mysqli_real_escape_string($db, $_POST['gref']) : NULL;
$payment_mode = $_POST['mod']; // Get payment mode (COD or GCash)

// Loop through cart items and insert order
foreach ($_SESSION["cart_item"] as $item) {
    $item_total += ($item["price"] * $item["quantity"]);

    $SQL = "INSERT INTO users_orders (u_id, title, quantity, price, payment_mode, cod_address, gnumber, gref)
            VALUES ('" . $_SESSION["user_id"] . "', 
                    '" . $item["title"] . "', 
                    '" . $item["quantity"] . "', 
                    '" . $item["price"] . "', 
                    '$payment_mode', 
                    '$cod_address', 
                    '$gnumber', 
                    '$gref')";
                    
    mysqli_query($db, $SQL);
}


            unset($_SESSION["cart_item"]);
            $success = "Thank you. Your order has been placed!";
            function_alert();
        }

    }
    ?>


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="#">
        <title>Checkout</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/animsition.min.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <style>
        #editProfileModal>div {
            max-height: 70vh;
            overflow-y: auto;
        }
    </style>

    <body>

        <div class="site-wrapper">
            <header id="header" class="header-scroll top-header headrom">
                <nav class="navbar navbar-dark">
                    <div class="container">
                        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse"
                            data-target="#mainNavbarCollapse">&#9776;</button>
                        <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/logo.png" alt=""
                                height="35px"></a>
                        <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                            <ul class="nav navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" href="index.php">Home <span
                                            class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="restaurants.php">Restaurants <span
                                            class="sr-only"></span></a>
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
                                <div id="editProfileModal"
                                    style="display: none; position: fixed; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
                                    <div
                                        style="position: relative; width: 50%; margin: 10% auto; background: white; padding: 20px; border-radius: 5px;">
                                        <h2>Edit Profile</h2>
                                        <form action="update_user.php" method="POST">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="username" class="form-label">Username</label>
                                                        <input type="text" class="form-control" id="username"
                                                            name="username">
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
                                                        <input type="password" class="form-control" id="password"
                                                            name="password">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Address</label>
                                                        <textarea class="form-control" id="address"
                                                            name="address"></textarea>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Save</button>
                                                <button type="button" class="btn btn-secondary"
                                                    onclick="closeModal()">Close</button>
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
                            <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choose
                                    Restaurant</a></li>
                            <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Pick Your favorite food</a>
                            </li>
                            <li class="col-xs-12 col-sm-4 link-item active"><span>3</span><a href="checkout.php">Order and
                                    Pay</a></li>
                        </ul>
                    </div>
                </div>

                <div class="container">
                    <span style="color:green;">
                        <?php echo $success; ?>
                    </span>

                </div>



                <div class="container m-t-30">
                    <form action="" method="post">
                        <div class="widget clearfix">
                            <div class="widget-body">
                                <form method="post" action="#">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="cart-totals margin-b-20">
                                                <div class="cart-totals-title">
                                                    <h4>Cart Summary</h4>
                                                </div>
                                                <div class="cart-totals-fields">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Cart Subtotal</td>
                                                                <td> <?php echo "₱" . $item_total; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Delivery Charges</td>
                                                                <td>Free</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-color"><strong>Total</strong></td>
                                                                <td class="text-color"><strong>
                                                                        <?php echo "₱" . $item_total; ?></strong></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="payment-option">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <label class="custom-control custom-radio m-b-20">
                                                            <input name="mod" id="cod" checked value="COD" type="radio"
                                                                class="custom-control-input"
                                                                onclick="togglePaymentFields(false)">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Cash on Delivery</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="custom-control custom-radio m-b-20">
                                                            <input name="mod" id="gcash" value="GCash" type="radio"
                                                                class="custom-control-input"
                                                                onclick="togglePaymentFields(true)">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">GCash</span>
                                                        </label>
                                                    </li>
                                                </ul>

                                                <!-- COD Address Field (Initially Hidden) -->
                                                <div id="cod-address-form">
                                                    <div class="form-group">
                                                        <label for="cod_address">Delivery Address</label>
                                                        <input type="text" class="form-control" name="cod_address"
                                                            id="cod_address" placeholder="Enter your address">
                                                    </div>
                                                </div>

                                                <!-- GCash Payment Fields (Initially Hidden) -->
                                                <div id="gcash-form" style="display: none;">
                                                    <p><strong>Send payment here: 09132131321</strong></p>
                                                    <div class="form-group">
                                                        <label for="gref">GCash Reference Number</label>
                                                        <input type="text" class="form-control" name="gref" id="gref">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gnumber">GCash Number</label>
                                                        <input type="text" class="form-control" name="gnumber" id="gnumber">
                                                    </div>
                                                    <div id="cod-address-form">
                                                    <div class="form-group">
                                                        <label for="cod_address">Delivery Address</label>
                                                        <input type="text" class="form-control" name="cod_address"
                                                            id="cod_address" placeholder="Enter your address">
                                                    </div>
                                                </div>
                                                </div>

                                                <p class="text-xs-center">
                                                    <input type="submit"
                                                        onclick="return confirm('Do you want to confirm the order?');"
                                                        name="submit" class="btn btn-success btn-block" value="Order Now">
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>

                            <script>
                                function toggleGCashForm(show) {
                                    document.getElementById('gcash-form').style.display = show ? 'block' : 'none';
                                }
                            </script>

                        </div>
                </div>
            </div>
            </form>
        </div>
        </div>
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/animsition.min.js"></script>
        <script src="js/bootstrap-slider.min.js"></script>
        <script src="js/jquery.isotope.min.js"></script>
        <script src="js/headroom.js"></script>
        <script src="js/foodpicky.min.js"></script>
    
        <script>
    function togglePaymentFields(isGCash) {
        document.getElementById('gcash-form').style.display = isGCash ? 'block' : 'none';
        document.getElementById('cod-address-form').style.display = isGCash ? 'none' : 'block';

        // Set required attributes based on the selection
        document.getElementById('cod_address').required = !isGCash;
        document.getElementById('gref').required = isGCash;
        document.getElementById('gnumber').required = isGCash;
    }
</script>

    
    </body>

    </html>
    <?php
}
?>