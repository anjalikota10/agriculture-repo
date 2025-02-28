<?php
$conn=mysqli_connect("localhost","root","","agriculture");
// if($conn){
//     echo "<script>alert('Connected');</script>";
// }
// else{
//     echo "Error";
// }
session_start();

if(isset($_SESSION['admin_email'])){
$admin_email=$_SESSION['admin_email'];
$sql="select * from admin where email='$admin_email'";
$res=mysqli_query($conn,$sql);
$rs=mysqli_fetch_row($res);
$admin_name=$rs[1];
}

if(isset($_SESSION['farmer_email'])){
    $farmer_email=$_SESSION['farmer_email'];
    $sql="select * from farmer_reg where email='$farmer_email'";
    $res=mysqli_query($conn,$sql);
    $rs=mysqli_fetch_row($res);
    $farmer_name=$rs[1];
    $farmer_id=$rs[0];
    // $farmer_contact=$rs[1];
    }
?>


<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ela Admin - HTML5 Admin Template</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php
                    if(isset($_SESSION['admin_email']))
                    {
                    ?>
                    <li>
                        <a href="index.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="menu-title">UI elements</li><!-- /.menu-title -->
                    <li>
                        <a href="registration_table.php"> <i class="menu-icon ti-email"></i>Registration Details </a>
                    </li>
                    
                    <li>
                        <a href="category_table.php"> <i class="menu-icon ti-email"></i>Category Details</a>
                    </li>
                  
                    <li>
                        <a href="product_table.php"> <i class="menu-icon ti-email"></i>Product Details </a>
                    </li>
                    <li>
                        <a href="order_table.php"> <i class="menu-icon ti-email"></i>Order Details </a>
                    </li>
                    
                    <?php
                     }else if(isset($_SESSION['farmer_email'])){

                     ?>
                      <li>
                        <a href="index.html"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="menu-title">UI elements</li><!-- /.menu-title -->

                  
                    <li>
                        <a href="product_table.php"> <i class="menu-icon ti-email"></i>Product Details </a>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php"><img src="logo.png" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                  
                <?php
                    if(isset($_SESSION['admin_email']))
                    {
                        
                         ?>
                          <p style="margin-top:10px;"><?php      echo $admin_name;?></p>
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            

                            <a class="nav-link" href="admin_logout.php"><i class="fa fa-power-off"></i>Logout</a>
                        </div>
                     
                    </div>

                    <?php
                        }
                        else if(isset($_SESSION['farmer_email']))
                        {
                        ?>
                        <p style="margin-top:10px;"><?php echo $farmer_name;?></p>
                          <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            

                            <a class="nav-link" href="farmer_logout.php"><i class="fa fa-power-off"></i>Logout</a>
                        </div>
                     
                    </div>
                        <?php
                         }
                         else
                         {
                        ?>
                        <a href="admin_login.php"><button type="button" class="btn btn-outline-primary" style="margin-top:10px;">Admin Login</button></a>&nbsp;
                        <a href="farmer_login.php"><button type="button" class="btn btn-outline-primary" style="margin-top:10px;">Farmer Login</button></a>
                        <?php
                            }
                        ?>


                </div>
            </div>
        </header>