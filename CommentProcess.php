<?php
    include("Connect.php");
    session_start();
    $Display_Users['ID_User']='';
    if(isset($_SESSION["Email_User"])){
        $Email_User = $_SESSION['Email_User'];
        $Statement_Users = "SELECT * FROM `users` WHERE Email_User= '$Email_User'";
        $Query_Users =mysqli_query($conn, $Statement_Users);
        $Display_Users = mysqli_fetch_assoc($Query_Users);
    }
    $ID_Product = $_POST['ID_Product'];
    $ID_User = $Display_Users['ID_User'];
    $content = $_POST['content'];
    $Statement_Comment = "INSERT INTO comment(ID_Product, ID_User, Comment) VALUES ('$ID_Product', '$ID_User', '$content')";
    $Query_Comment = mysqli_query($conn, $Statement_Comment);
?>