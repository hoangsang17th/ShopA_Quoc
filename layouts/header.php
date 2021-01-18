<?php
    include("Connect.php");
    session_start();
    $profile['Email_User']='';
    $profile['Phone_User']='';
    $profile['Address_User']='';
    $profile['Name_User']='';
    $profile['ID_User']= 1;
    if(isset($_SESSION["Email_User"])){
        $Email_User = $_SESSION['Email_User'];
        $Statement_Users = "SELECT * FROM `users` WHERE Email_User= '$Email_User'";
        $Query_Users =mysqli_query($conn, $Statement_Users);
        $profile = mysqli_fetch_assoc($Query_Users);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Shopping Conzex</title>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">  
    <script src="https://kit.fontawesome.com/1b32f59f62.js" crossorigin="anonymous"></script>         

</head>
<body>
    <div class="page-wrapper">
        <div class="preloader"></div>
        <header class="main-header">
            <div class="header-upper">
                <div class="container clearfix">
                    <div class="header-inner clearfix d-lg-flex">
                        <div class="logo-outer">
                            <div class="logo"><a href="index.php"><img src="assets/img/favicon.png" width="50px"></a></div>
                            <div class="fixed-logo"><a href="index.php"><img src="assets/img/favicon.png" width="50px"></a></div>
                        </div>
                        <nav class="main-menu navbar-expand-md ml-md-auto">
                            <div class="navbar-header clearfix">
                            <div class="logo"><a href="index.php"><img src="assets/img/favicon.png" width="50px"></a></div>
                            <div class="fixed-logo"><a href="index.php"><img src="assets/img/favicon.png" alt="" title="" width="50px"></a></div>
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-one">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse navbar-collapse-one collapse clearfix">
                                <ul class="navigation clearfix">
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="about.php">About</a></li>
                                    <?php
                                    if ($profile['Email_User']==''){
                                        echo '<li><a href="login.php">Đăng Nhập</a></li>';
                                    }
                                    else 
                                    echo "<li class='current dropdown'><a href='#'>".$profile['Name_User']."</a>
                                        <ul>
                                            <li><a href='home.php'>Đơn Hàng</a></li>
                                            <li><a href='../logout.php'>Dăng Xuất</a></li>
                                        </ul>
                                    </li>";
                                    ?>
                                    <li>
                                    <?php
                                        $counts = 0;
                                        if(isset($_SESSION['cart'])){
                                            $items = $_SESSION['cart'];
                                            $counts = count($items);
                                        }
                                        echo "<a href='cart.php'><i class='fas fa-shopping-basket'> </i> ".$counts."</a>";
                                    ?>                               
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        
        <section class="banner-section pt-160 pb-75">
        </section>
