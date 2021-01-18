<?php
include('layouts/header.php');
?>
<?php
    $LoginErr ="";
    if (isset($_POST['Email_User'])){
        $Email_User = stripslashes($_REQUEST['Email_User']);
        $Email_User = mysqli_real_escape_string($conn,$Email_User);
        $Password_User = stripslashes($_REQUEST['Password_User']);
        $Password_User = mysqli_real_escape_string($conn,$Password_User);
        $query = "SELECT * FROM `users` WHERE Email_User='$Email_User' and Password_User='$Password_User'";
        $result = mysqli_query($conn,$query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if($rows==1){
            $_SESSION['Email_User'] = $Email_User;
            header("Location: index.php");
        }
        else{
            $LoginErr ="* Sai Tài khoản hoặc Mật Khẩu!";
        }
    }
?>
<section class="shop-page another-page pt-65">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="login-information pb-150">
                    <h2>Hey There!</h2>
                    <p>Welcome Back. <br>
                    You are just one step away to your feed.</p>
                    <form action="" class="login-form" method="post">
                        <div class="text-field">
                            <input type="text" placeholder="User Name" class="form-control" name="Email_User">
                        </div>
                        <div class="password-field">
                            <input type="password" placeholder="Password" class="form-control" name="Password_User">
                        </div>
                        <div class="signin-button-wrap">
                            <button type="submit" class="btn-bg2">Sign In</button>
                        </div>
                    </form>
                    <div class="alternative-login">
                        Don't have an account yet ? <a class="signup-link" href="register.php"> Sign Up!</a>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include('layouts/footer.php');
?>