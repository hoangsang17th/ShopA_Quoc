<?php
include('layouts/header.php');
?>
<div class="shop-page another-page pt-65">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="categories">
                    <div class="categorie-title">
                        <h4><i class="flaticon-layers"></i>Categories</h4>
                    </div>
                    <ul class="categorie-list">
                    <?php
                    $Query_Catalog = mysqli_query($conn, "SELECT * FROM catalog");
                    while ($Display_Catalog = mysqli_fetch_assoc($Query_Catalog)){
                    $Statement_Product = "SELECT * FROM product WHERE ID_Catalog = ".$Display_Catalog['ID_Catalog'];
                    $Query_Product = mysqli_query($conn, $Statement_Product);
                    $Display_Product= mysqli_num_rows($Query_Product);
                    echo "<li><a href='?c=".$Display_Catalog['ID_Catalog']."'>$Display_Catalog[Name_Catalog] <span class='text-primary'>($Display_Product)</span></a></li>";
                    }
                    ?>
                    </ul>
                </div>
            </div>
            <?php
                if(!isset($_SESSION['limit'])){
                    $_SESSION['limit'] =10;
                }
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $custom = $_POST['limi'];
                    $_SESSION['limit'] =  $custom;
                }
                $limit = $_SESSION['limit'];
            if (isset($_GET['c'])){
                $c=$_GET['c'];
                $Statement_Product = "SELECT * FROM product WHERE ID_Catalog=".$c;
                $resultcou = mysqli_query($conn, $Statement_Product);
                $total_records = mysqli_num_rows($resultcou);
                $current_page = isset($_GET["page"]) ? $_GET["page"] : 1;
                $total_page = ceil($total_records / $limit);
                if ($current_page > $total_page){
                $current_page = $total_page;
                }
                else if ($current_page < 1){
                $current_page = 1;
                }
                $start = ($current_page - 1) * $limit;
                $result = mysqli_query($conn, "SELECT * FROM product WHERE ID_Catalog= $c LIMIT $start,$limit");
            }else 
            if(isset($_GET['s'])){
                $s =$_GET['s'];
                $Statement_Product = "SELECT * FROM product WHERE LOWER(Name_Product)  LIKE '%".$s."%'" ;
                $resultcou = mysqli_query($conn, $Statement_Product);
                
                $total_records = mysqli_num_rows($resultcou);
                $current_page = isset($_GET["page"]) ? $_GET["page"] : 1;
                $total_page = ceil($total_records / $limit);
                if ($current_page > $total_page){
                $current_page = $total_page;
                }
                else if ($current_page < 1){
                $current_page = 1;
                }
                $start = ($current_page - 1) * $limit;
                $sqls= "SELECT * FROM product WHERE LOWER(Name_Product)  LIKE '%".$s."%' LIMIT $start,$limit";
                $result = mysqli_query($conn, $sqls);
            } else {
                $Statement_Product = "SELECT * FROM product";
                $resultcou = mysqli_query($conn, $Statement_Product);
                $total_records = mysqli_num_rows($resultcou);
                $current_page = isset($_GET["page"]) ? $_GET["page"] : 1;
                $total_page = ceil($total_records / $limit);
                if ($current_page > $total_page){
                $current_page = $total_page;
                }
                else if ($current_page < 1){
                $current_page = 1;
                }
                $start = ($current_page - 1) * $limit;
                $result = mysqli_query($conn, "SELECT * FROM product LIMIT $start,$limit");
            }
            ?>
            <div class="col-lg-9 col-md-6">
                <div class="row align-items-center mb-2">
                    <div class="col-lg-3 col-md-5 mt-4 mt-sm-0 pt-2 pt-sm-0">
                        <div class="form custom-form" >
                            <form action="index.php" method="POST">
                            <div class="form-group mb-0">
                                <select class="form-control custom-select" name="limi" onchange = 'this.form.submit ()'>
                                    <option >Số SP Mỗi Trang</option>
                                    <option value="10">10 Sản Phẩm</option>
                                    <option value="20">20 Sản Phẩm</option>
                                    <option value="30">30 Sản Phẩm</option>
                                </select>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-7 mt-4 mt-sm-0 pt-2 pt-sm-0">
                        <div class="form custom-form">
                            <form method="GET" action="">
                                <input type="text" class=" form-control" name="s" placeholder="Product Name" required>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="top-product-list">
                    
                    <div class="row">

                    <?php
                if ($total_records!=0){
                    while ($row = mysqli_fetch_assoc($result)){
                        echo "<div class='col-lg-3 col-md-4 col-sm-6'>
                        <div class='single-product-item'>
                            <div class='product-img'>
                                <a href='product.php?id=$row[ID_Product]'><img class='img-fluid' src='assets/img/shop/$row[Image_Product]' alt=''> </a>
                            </div>
                            <div class='single-product-details'>
                                <a href='product.php?id=$row[ID_Product]'><h5>$row[Name_Product]</h5></a>
                                <div class='price'>
                                    <span class='amount'><span class='Price-Symbol'>$</span>$row[Price_Product]</span>
                                </div>
                                <div class='ratting'>
                                    <span class='fa fa-star'> 4.3</span>
                                </div>
                                <div class='cart-btn'>
                                    <a href='AddToShop.php?item=$row[ID_Product]'><i class='flaticon-shopping-cart'></i></a>
                                </div>
                            </div>
                        </div>
                    </div>";
                    }
                } else {
                    echo    "</div class='col-12 mt-5'>
                                <p class='mt-5 text-center'>Trang này không có sản phẩm nào!</p>    
                            </div>";
                }
                ?>
                    </div>

                </div>
            </div>
        </div>
        <?php
                if ($total_page >1 && isset($_GET['c'])){
                    echo "<div class='row my-5'>
                            <div class='col-12'>
                                <ul class='pagination mb-0 justify-content-end'>";
                    if ($current_page > 1){
                        if ($current_page == 2){
                            echo "<li class='page-item'><a class='page-link' href='index.php?c=$c' aria-label='Previous'><i class='fas fa-arrow-left'></i> </a></li>";
                        }else
                        echo "<li class='page-item'><a class='page-link' href='index.php?page=".($current_page-1)."&c=$c' aria-label='Previous'><i class='fas fa-arrow-left'></i> </a></li>";
                    }
                    
                    for ($i = 1; $i <= $total_page; $i++){
                        if ($i == $current_page){
                            echo "<li class='page-item active'><span class='page-link'>".$i."</span></li>";
                        } else{
                            if ($i ==1){
                            echo "<li class='page-item'><a class='page-link' href='index.php?c=$c'>".$i."</a></li>";
                            }else 
                            echo "<li class='page-item'><a class='page-link' href='index.php?page=$i&c=$c'>".$i."</a></li>";
                        }
                    }
                    if ($current_page < $total_page){
                        echo "<li class='page-item'><a class='page-link' href='index.php?page=".($current_page+1)."&c=$c' aria-label='Next'><i class='fas fa-arrow-right'></i></i></a></li>";
                    }
                    echo        "</ul>
                        </div>
                    </div>";
                } else if($total_page >1 && !isset($_GET['c'])){
                    echo "<div class='row my-5'>
                            <div class='col-12'>
                                <ul class='pagination mb-0 justify-content-end'>";
                    if ($current_page > 1){
                        if ($current_page == 2){
                            echo "<li class='page-item'><a class='page-link' href='index.php' aria-label='Previous'><i class='fas fa-arrow-left'></i> </a></li>";
                        }else
                        echo "<li class='page-item'><a class='page-link' href='index.php?page=".($current_page-1)."' aria-label='Previous'><i class='fas fa-arrow-left'></i> </a></li>";
                    }
                    
                    for ($i = 1; $i <= $total_page; $i++){
                        if ($i == $current_page){
                            echo "<li class='page-item active'><span class='page-link'>".$i."</span></li>";
                        } else{
                            if ($i ==1){
                            echo "<li class='page-item'><a class='page-link' href='index.php'>".$i."</a></li>";
                            }else 
                            echo "<li class='page-item'><a class='page-link' href='index.php?page=$i'>".$i."</a></li>";
                        }
                    }
                    if ($current_page < $total_page){
                        echo "<li class='page-item'><a class='page-link' href='index.php?page=".($current_page+1)."' aria-label='Next'> <i class='fas fa-arrow-right'></i></a></li>";
                    }
                    echo        "</ul>
                        </div>
                    </div>";
                }                
                ?>      
    </div>
</div>
<?php
include('layouts/footer.php');
?>