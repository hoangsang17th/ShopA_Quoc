<!-- Thêm sản phẩm vào giỏ hàng -->
<?php
session_start();
$id = $_GET['item'];
if(isset($_SESSION['cart'][$id])){
    $qty = $_SESSION['cart'][$id] + 1;
    // Nếu đã tồn tại thì cộng thêm 1 còn chưa thì cho =1
}
else{
    $qty = 1;
}
$_SESSION['cart'][$id] = $qty;
// header("Location: Shop.php");
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>