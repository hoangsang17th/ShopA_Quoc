<?php
    include("Connect.php");
    include("SSUser.php");
    $Email_User = $_SESSION['Email_User'];
    $Statement_Users = "SELECT * FROM `users` WHERE Email_User= '$Email_User'";
    $Query_Users =mysqli_query($conn, $Statement_Users);
    $profile = mysqli_fetch_assoc($Query_Users);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Mr.Quoc - Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="assets/img/favicon.ico">
        <link href="assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">
        <link href="assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="wrapper">
            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="assets/img/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ml-1">
                            <?php echo $profile['Name_User']; ?> <i class="mdi mdi-chevron-down"></i> 
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <a href="../logout.php" class="dropdown-item notify-item">
                                <i class="remixicon-logout-box-line"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
                <div class="logo-box">
                    <a href="index.php" class="logo text-center">
                        <span class="logo-lg">
                            <img src="assets/img/logo-light.png" alt="" height="20">
                        </span>
                        <span class="logo-sm">
                            <img src="assets/img/logo-sm.png" alt="" height="24">
                        </span>
                    </a>
                </div>
                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>
                </ul>
            </div>
            <div class="left-side-menu">
                <div class="slimscroll-menu">
                    <div id="sidebar-menu">
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Navigation</li>
                            <?php
                            if($profile['Position']== 2){
                                echo "<li>
                                <a href='javascript: void(0);' class='waves-effect'>
                                    <i class='remixicon-stack-line'></i>
                                    <span> Admin </span>
                                    <span class='menu-arrow'></span>
                                </a>
                                <ul class='nav-second-level' aria-expanded='false'>
                                    <li>
                                        <a href='user.php'>Người Dùng</a>
                                    </li>
                                    <li>
                                        <a href='danhmuc.php'>Danh Mục</a>
                                    </li>
                                    <li>
                                        <a href='sanpham.php'>Sản Phẩm</a>
                                    </li>
                                    <li>
                                        <a href='donhangdagiao.php'>Đơn Hàng Đã Giao</a>
                                    </li>
                                    <li>
                                        <a href='donhangchuagiao.php'>Đơn Hàng Chưa Giao</a>
                                    </li>
                                    <li>
                                        <a href='danhsachbinhluan.php'>Bình Luận</a>
                                    </li>
                                </ul>
                            </li>";
                            } else{
                                echo "<li>
                                        <a href='#'>
                                            <i class='remixicon-stack-line'></i>
                                            <span> Đơn Hàng</span>
                                        </a>
                                    </li>";
                            }
                            ?>
                            
                            
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="content-page">
                <div class="content">