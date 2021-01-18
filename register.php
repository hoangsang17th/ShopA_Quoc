<?php
include('layouts/header.php');
?>
<?php
    include("Connect.php");
    $userErr = "";
    if (isset($_REQUEST['Email_User'])){
        $Name_User =  stripslashes($_REQUEST['Name_User']);
        $Name_User =  mysqli_real_escape_string($conn,$Name_User);
        $Email_User = stripslashes($_REQUEST['Email_User']);
        $Email_User = mysqli_real_escape_string($conn,$Email_User);
        $Password_User = stripslashes($_REQUEST['Password_User']);
        $Password_User = mysqli_real_escape_string($conn,$Password_User);
        $Statement_Users = "SELECT Email_User FROM users WHERE Email_User='$Email_User'";
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date("Y-m-d H:i:s");
        $Query_Users = mysqli_query($conn, $Statement_Users);
        if (mysqli_num_rows($Query_Users) > 0){
            $userErr = "Tên đăng nhập đã tồn tại!";
        }
        else{
            $Statement_Users = "INSERT INTO `users` (Email_User, Password_User, Name_User, Date_Join_User) VALUES ('$Email_User', '$Password_User', '$Name_User', '$date')";
            $Query_Users = mysqli_query($conn,$Statement_Users);
            if($Query_Users){
                header("Location: login.php");
            }
        }
    }
?>
<section class="login-area another-page pt-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="login-information pb-150">
                    <h2>Hey There!</h2>
                    <p>Welcome To Our Family.<br>
                    You are just one step away to your feed.</p>
                    <form action="" method="post" class="login-form">
                        <div class="text-field">
                            <input type="text" placeholder="User Name" class="form-control" name="Name_User">
                            <span class="text-danger "><?php echo $userErr;?></span>
                        </div>
                        <div class="email-field">
                            <input type="email" placeholder="Email Address" class="form-control" name="Email_User">
                        </div>
                        <div class="password-field">
                            <input type="password" placeholder="Password" class="form-control" name="Password_User">
                        </div>
                        <div class="signin-button-wrap">
                            <button type="submit" class="btn-bg2">Sign Up</button>
                        </div>

                    </form>
                    <div class="alternative-login">
                        Allready have an account?<a class="signup-link" href="#"> Sign In</a>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include('layouts/footer.php');
?>