<?php
include('layouts/header.php');
?>
<?php
if(isset($_POST['submit'])){
    foreach($_POST['qty'] as $key=>$value){
        if( ($value == 0) and (is_numeric($value))){
            unset ($_SESSION['cart'][$key]);
        }
        else 
        if(($value > 0) and (is_numeric($value))){
            $_SESSION['cart'][$key]=$value;
        }
    }
    header("Location: cart.php");
}
?>
<form action="cart.php" method="POST">
<section class="shopping-cart-area another-page pt-65">
    <div class="container">
        <div class="cart-title d-none d-md-block">
            <div class="row">
                <div class="col-md-5">
                    <div class="product-title">
                        <h4>PRODUCT</h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="price-title">
                        <h4>PRICE</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="quantity-title">
                        <h4> QUANTITY</h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="total-title text-right">
                        <h4>TOTAL</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="cart-items mb-40">
        <?php
        foreach($_SESSION['cart'] as $key=>$value){
            $item[]=$key;
        }
        $str=implode(",",$item);
        $Statement_Product = "SELECT * FROM product WHERE ID_Product IN ($str)";
        $Query_Product = mysqli_query($conn, $Statement_Product);
        $total = 0;
        while ($Display_Product = mysqli_fetch_assoc($Query_Product)){
            echo "<div class='single-cart-item'>
            <div class='row align-items-center'>
                <div class='col-md-5 responsive-col'>
                    <div class='responsive-product-title d-block d-md-none'>
                        <h4>PRODUCT</h4>
                    </div>
                    <div class='product-image-wrap text-md-left text-right'>
                        <a class='product-remove' href='DeleteCart.html?id=$Display_Product[ID_Product]'><i class='flaticon-wrong'></i></a>
                        <img class='product-img' src='assets/img/shop/$Display_Product[Image_Product]' alt=''>
                    </div>
                </div>
                <div class='col-md-2 responsive-col'>
                    <div class='responsive-price d-block d-md-none'>
                        <h4>PRICE</h4>
                    </div>
                    <div class='product-price text-md-left text-right'>$".$Display_Product['Price_Product']."</div>
                </div>
                <div class='col-md-3 responsive-col'>
                    <div class='responsive-number-input d-block d-md-none'>
                        <h4>QUANTITY</h4>
                    </div>
                        <div class='number-input-box'>
                        <input class='quantity' min='1' name='qty[$Display_Product[ID_Product]]' value='{$_SESSION['cart'][$Display_Product['ID_Product']]}' type='number'>
                    </div>
                </div>
                <div class='col-md-2 responsive-col'>
                    <div class='responsive-total-title d-block d-md-none'>
                        <h4>TOTAL</h4>
                    </div>
                    <div class='product-total-price text-right'>$".$_SESSION['cart'][$Display_Product['ID_Product']]*$Display_Product['Price_Product']."</div>
                </div>
            </div>
        </div>";
}
?> 
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <div class="update-shopping text-left text-md-right">
                    <input type='submit' name='submit' value='Update Cart' class='btn-bg'>
                    <a href="checkout.php" class="btn-bg2">CheckOut</a>
                </div>
            </div>
        </div>
    </div>
</section>
</form>
<?php
include('layouts/footer.php');
?>