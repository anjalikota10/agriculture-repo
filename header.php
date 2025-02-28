<?php
$conn=mysqli_connect("localhost","root","","agriculture");

session_start();
if(isset($_SESSION['email'])){
    $email=$_SESSION['email'];
    $sql="select * from reg where email='$email'";
    $res=mysqli_query($conn,$sql);
    $rs=mysqli_fetch_row($res);
    $name=$rs[1];
    $nameParts = explode(" ",$name);
     $fname=$nameParts[0];
    $lname=$nameParts[1];
     $address=$rs[5];
    $contact=$rs[4];
}


date_default_timezone_set('Asia/Kolkata');

$city_name = 'Solapur';
$api_key = 'fe424122ab870431152a5aaa103d7b75';
$api_url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $city_name . '&appid=' . $api_key . '&units=metric';

$weather_data = file_get_contents($api_url);
$data = json_decode($weather_data, true);

$current_date_time = date('l, F j, Y h:i A'); 


if ($data && $data['cod'] == 200) {
    $temperature = $data['main']['temp']; 
    $iconCode = $data['weather'][0]['icon']; 
    $iconUrl = "https://openweathermap.org/img/wn/{$iconCode}@2x.png"; 
}




?>

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Freshshop - Ecommerce Bootstrap 4 HTML Template</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Start Main Top -->
    
    <!-- End Main Top -->

    <!-- Start Main Top -->
    <header class="main-header" >
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
              
    <a class="navbar-brand" href="index.php"><img src="images/logo.png" class="logo" alt="" ></a>
    <a class="navbar-brand" ><img src="cloudy.png" style='width: 50px; height: 50px;margin-bottom:-10px;' class="logo" alt=""><span style='font-size:15px; font-weight: bold;'><?php echo $temperature;?>°C</span><br>
    <span style="font-size: 12px; color: #555;"><?php echo $current_date_time; ?></span>
    </a>
                    
                </div>
                

                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp" >
                        <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="shop.php">SHOP</a></li>

                        <!-- <li class="dropdown">
                            <a href="shop.php" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">SHOP</a> -->
                            <!-- <ul class="dropdown-menu">
								<li><a href="shop.php">Sidebar Shop</a></li>
								<li><a href="shop-detail.php">Shop Detail</a></li>
                                <li><a href="cart.php">Cart</a></li>
                                <li><a href="checkout.php">Checkout</a></li>
                               
                            </ul> -->
                        <!-- </li> -->
                       
                        <li class="nav-item"><a class="nav-link" href="Contact_us.php">Contact Us</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="">
							<a href="cart.php">
								<i class="fa fa-shopping-cart"></i>
								<span class="badge">
                                    <?php
                                   
                                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                    $i=0;
                                    foreach ($_SESSION['cart'] as $item) {
                                        $i++;
                                    }
                                    echo $i;
                                }
                                        
                                        ?>
                                    
                                </span>
								</a>
							</a>
						</li>
                        <?php
                        if(isset($_SESSION['email']))
                        {
                        ?>
                        <li style="margin-top:25px;"><b><?php echo $name;?></b></li>
                        <li>
                        
                        <div class="col-12 d-flex shopping-box"><a href="logout.php" class="ml-auto btn hvr-hover" style="margin-top:15px;">Logout</a> </div>
                        </li>
                        <?php
                        }
                        else
                        {
                        ?>
                        <li>
                        <div class="col-12 d-flex shopping-box"><a href="login.php" class="ml-auto btn hvr-hover" style="margin-top:15px;">Login</a> </div>
                        </li>
                        <?php
                         }
                        ?>
                        
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>