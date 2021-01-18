<?php
include('layouts/header1.php');
?>
<?php
    // Đếm số đơn hàng được order
    $Quanlity_Order = 0;
    $Statement_Order = "SELECT COUNT(ID_Order) AS Quanlity_Order FROM `order`";
    $Query_Order =mysqli_query($conn, $Statement_Order);
    $Display_Order = mysqli_fetch_assoc($Query_Order);
    $Quanlity_Order = $Display_Order['Quanlity_Order'];
    // Đếm tổng số sản phẩm có trên giỏ hàng
    $Quanlity_Product = 0;
    $Statement_Product = "SELECT COUNT(ID_Product) AS Quanlity_Product FROM `product`";
    $Query_Product =mysqli_query($conn, $Statement_Product);
    $Display_Product = mysqli_fetch_assoc($Query_Product);
    $Quanlity_Product = $Display_Product['Quanlity_Product'];
    // Đếm tổng số danh mục tòn tại trong của hàng
    $Quanlity_Catalog = 0;
    $Statement_Catalog = "SELECT COUNT(ID_Catalog) AS Quanlity_Catalog FROM `catalog`";
    $Query_Catalog =mysqli_query($conn, $Statement_Catalog);
    $Display_Catalog = mysqli_fetch_assoc($Query_Catalog);
    $Quanlity_Catalog = $Display_Catalog['Quanlity_Catalog'];
    // Đếm tổng số khách hàng của cửa hàng
    $Quanlity_Users = 0;
    $Statement_Users = "SELECT COUNT(ID_User) AS Quanlity_Users FROM `users`";
    $Query_Users =mysqli_query($conn, $Statement_Users);
    $Display_Users = mysqli_fetch_assoc($Query_Users);
    $Quanlity_Users = $Display_Users['Quanlity_Users'];
?>
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <?php
                if($profile['Position'] == 2){
                    echo "<div class='text-center mb-2'>
                    <div class='row'>
                        <div class='col-md-6 col-xl-3'>
                            <div class='card-box'>
                                <i class='fe-tag font-24'></i>
                                <h3>$Quanlity_Order</h3>
                                <p class='text-uppercase mb-1 font-13 font-weight-medium'>Đơn Hàng</p>
                            </div>
                        </div>
                        <div class='col-md-6 col-xl-3'>
                            <div class='card-box'>
                                <i class='fe-archive font-24'></i>
                                <h3 class='text-warning'>$Quanlity_Product</h3>
                                <p class='text-uppercase mb-1 font-13 font-weight-medium'>Sản Phẩm</p>
                            </div>
                        </div>
                        <div class='col-md-6 col-xl-3'>
                            <div class='card-box'>
                                <i class='fe-shield font-24'></i>
                                <h3 class='text-success'>$Quanlity_Catalog</h3>
                                <p class='text-uppercase mb-1 font-13 font-weight-medium'>Danh Mục</p>
                            </div>
                        </div>
                        <div class='col-md-6 col-xl-3'>
                            <div class='card-box'>
                                <i class='fe-user font-24'></i>
                                <h3 class='text-danger'>$Quanlity_Users</h3>
                                <p class='text-uppercase mb-1 font-13 font-weight-medium'>Người Dùng</p>
                            </div>
                        </div>
                    </div>
                </div>";
                }
                ?>


                <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" cellspacing="0" id="tickets-table">
                    <thead class="bg-light">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày mua</th>
                        <th>Sản phẩm</th>
                        <th>Chi Tiết</th>
                    </tr>
                    </thead>

                    <tbody class="font-14">
                        <?php
                            $UID= $profile['ID_User'];
                            if($profile['Position'] ==1){
                                $Statement_Order = "SELECT * FROM `order` WHERE ID_User= $UID";
                            }
                            else {
                                $Statement_Order = "SELECT * FROM `order`";
                            }
                            $Query_Order = mysqli_query($conn, $Statement_Order);
                            while ($Display_Order = mysqli_fetch_assoc($Query_Order)){
                                $Statement_OrderDetail = "SELECT * FROM orderdetail WHERE ID_Order =".$Display_Order['ID_Order'];
                                $Query_OrderDetail = mysqli_query($conn, $Statement_OrderDetail);
                                echo "<tr>
                                <td><a href='javascript: void(0);' class='text-primary ml-3'>VKU$Display_Order[ID_Order]</a> </td>
                                <td>$Display_Order[Date_Order]</td>
                                <td class='text_product_hidden'>";
                                while($Display_OrderDetail = mysqli_fetch_assoc($Query_OrderDetail)){
                                    $Statement_Product = "SELECT * FROM product WHERE ID_Product =".$Display_OrderDetail['ID_Product'];
                                    $Query_Product = mysqli_query($conn, $Statement_Product);
                                    $Display_Product = mysqli_fetch_assoc($Query_Product);
                                    echo "$Display_Product[Name_Product], ";
                                }
                                echo "</td><td>
                                        <button type='button' class='btn btn-primary btn-sm btn-rounded' data-toggle='modal' data-target='.Modal$Display_Order[ID_Order]'>Xem</button>
                                </td>";
                            echo    "
                            </tr>";
                            }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
    $Statement_Order = "SELECT * FROM `order`";
    $Query_Order = mysqli_query($conn, $Statement_Order);
    while ($Display_Order = mysqli_fetch_assoc($Query_Order)){
    $Statement_Users = "SELECT * FROM users WHERE ID_User =".$Display_Order['ID_User'];
    $Query_Users = mysqli_query($conn, $Statement_Users);
    $Display_Users = mysqli_fetch_assoc($Query_Users); 
    echo "<div class='modal fade Modal$Display_Order[ID_Order]' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Chi Tiết Đơn Hàng</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <p class='mb-1'>Mã Đơn Hàng: <span class='text-primary'> VKU$Display_Order[ID_Order]</span></p>
                        <p class='mb-1'>Liên Lạc: <span class='text-primary'> $Display_Order[Phone_User]</span></p>
                        <p class='mb-2'>Địa Chỉ: <span class='text-primary'> $Display_Order[Address_User]</span></p>";
                        if($Display_Order['Status_Order']=="Chưa Giải Quyết"){
                                echo "<p class='mb-2'>Chưa Giải Quyết</p>";
                            }
                            else echo "<p class='mb-2'>Giao Hàng Thành Công</p>";
                 echo"       <div class='table-responsive'>
                            <table class='table table-centered table-nowrap'>
                                <thead>
                                    <tr>
                                    <th scope='col'>Hình Ảnh</th>
                                    <th scope='col'>Tên Sản Phẩm</th>
                                    <th scope='col'>Tổng</th>
                                    </tr>
                                </thead>
                                <tbody>";
                $Statement_OrderDetail = "SELECT * FROM orderdetail WHERE ID_Order =".$Display_Order['ID_Order'];
                $Query_OrderDetail = mysqli_query($conn, $Statement_OrderDetail);
                $Total=0;
                while($Display_OrderDetail = mysqli_fetch_assoc($Query_OrderDetail)){
                    $Statement_Product = "SELECT * FROM product WHERE ID_Product =".$Display_OrderDetail['ID_Product'];
                    $Query_Product = mysqli_query($conn, $Statement_Product);
                    $Display_Product = mysqli_fetch_assoc($Query_Product);
                    echo "<tr>
                            <th scope='row'>
                                <div>
                                    <img src='http://localhost/Mr.%20Quoc/outSide/assets/img/shop/$Display_Product[Image_Product]' class='border' width='70px'>
                                </div>
                            </th>
                            <td>
                                <div>
                                    <h5 class='text-truncate font-size-14'>$Display_Product[Name_Product]</h5>
                                    <p class='text-muted mb-0'>".number_format($Display_Product['Price_Product'], 3)."đ x $Display_OrderDetail[Quanlity_Order]</p>
                                </div>
                            </td>
                            <td>".number_format($Display_OrderDetail['Price_Order'])."đ</td>
                        </tr>";
                        $Total+= $Display_OrderDetail['Price_Order'];
                }
                                    echo"<tr>
                                    <td colspan='2'>
                                        <h6 class='m-0 text-right'>Total:</h6>
                                    </td>
                                    <td>
                                    ".number_format($Total)."đ
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                    </div>
                </div>
            </div>
        </div>";
    }
?>

<?php
include('layouts/footer1.php');
?>