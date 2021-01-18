<?php
include('layouts/header.php');
$counts = 0;
if(isset($_SESSION['cart'])){
    $items = $_SESSION['cart'];
    $counts = count($items);
}
?>
<?php
if($counts!=0){
    foreach($_SESSION['cart'] as $key=>$value){
        $item[]=$key;
    }
    $str=implode(",",$item);
    $Statement_Product = "SELECT * FROM product WHERE ID_Product IN ($str)";
    $Query_Product = mysqli_query($conn, $Statement_Product);
    $total = 0;
    $ID_User= $profile['ID_User'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $Date_Order= date("H:i:s d/m/Y");
    $Address_User = $_POST['address'];
    $Phone_User = $_POST['numberphone'];
    $Name_User= $profile['Name_User'];
    $Email_User = $profile['Email_User'];
    $stt=0;
    $Statement_Order= "INSERT INTO `order`(ID_User, Address_User, Phone_User, Status_Order, Date_Order) VALUES ('$ID_User', '$Address_User', '$Phone_User', 'Chưa Giải Quyết', '$Date_Order')";
    $Query_Order = mysqli_query($conn, $Statement_Order);
    $last_id = mysqli_insert_id($conn);
    while ($Display_Product = mysqli_fetch_assoc($Query_Product)){
        $stt++;
        $ID_Product = $Display_Product['ID_Product'];
        $Quanlity_Order= $_SESSION['cart'][$Display_Product['ID_Product']];
        $Price_Order = ($_SESSION['cart'][$Display_Product['ID_Product']]*$Display_Product['Price_Product']*1000);
        $Statement_OrderDetail= "INSERT INTO orderdetail(ID_Order, ID_Product, Quanlity_Order, Price_Order) VALUES ('$last_id', '$ID_Product', '$Quanlity_Order', '$Price_Order')";
        $Query_OrderDetail = mysqli_query($conn, $Statement_OrderDetail);
    }
    unset($_SESSION['cart']); 
    // header("Location : http://localhost/Mr.%20Quoc/OUTSide/index.php");
    echo "Đặt Hàng Thành Công";
}
?>

