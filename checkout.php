<?php
include('layouts/header.php');
?>

<section class="checkout-area another-page pt-60 pb-30">
    <div class="container">
        <form action="ok.php" method="post">
            <div class="row">
                <div class="col-md-7">
                    <div class="checkout-content">
                        <h4 class="checkout-title">Billing details </h4>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" placeholder="Name" disabled class="form-control"value="<?php echo $profile['Name_User'];?>">
                            </div>
                            <div class="col-md-12">
                                <input type="text" placeholder="Address" required class="form-control" name="address">
                            </div>
                            <div class="col-lg-12">
                                <input type="text" placeholder="Phone Number" required class="form-control" name="numberphone">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="cart-total-box">
                        <h4 class="checkout-title">Cart Total </h4>
                        <div id="order-review" class="wc-checkout-review-order">

                            <div class="order-item-wrap">
                            <?php
                            if($counts!=0){
                                foreach($_SESSION['cart'] as $key=>$value){
                                    $item[]=$key;
                                }
                                $str=implode(",",$item);
                                $Statement_Product = "SELECT * FROM product WHERE ID_Product IN ($str)";
                                $Query_Product = mysqli_query($conn, $Statement_Product);
                                $total = 0;
                                while ($Display_Product = mysqli_fetch_assoc($Query_Product)){
                                    $total += $_SESSION['cart'][$Display_Product['ID_Product']]*$Display_Product['Price_Product'];
                                }
                            }
                            ?>
                                <div class="order-item">
                                    <div class="product">Sport Shoes</div>
                                    <div class="price">$<?php echo $total;?></div>
                                </div>
                                <div class="order-item">
                                    <div class="product">Shipping Cost</div>
                                    <div class="price">$0</div>
                                </div>
                                <div class="order-item total">
                                    <div class="product">Total</div>
                                    <div class="price">$<?php echo $total;?></div>
                                </div>
                            </div>
                            <div class="button-wrapper">
                                <input class="btn-bg2 place-order" type="submit" value="Place Order">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
</section>

    <script src="assets\js\jquery-3.3.1.min.js"></script>
    <script src="assets\js\popper-v1.14.3.min.js"></script>
    <script src="assets\js\bootstrap-v4.1.3.min.js"></script>
    <script src="assets\js\owl.carousel.min.js"></script>
    <script src="assets\js\jquery.countTo.js"></script>
    <script src="assets\js\jquery.nice-select.min.js"></script>
    <script src="assets\js\jquery.magnific-popup.min.js"></script>
    <script src="assets\js\wow.min.js"></script>
    <script src="assets\js\isotope.pkgd.min.js"></script>
    <script src="assets\js\main.js"></script>
    
</body>
<?php
include('layouts/footer.php');
?>