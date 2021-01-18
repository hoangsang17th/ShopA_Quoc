<?php
include('layouts/header1.php');
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_Order=$_POST['ID_Order'];
    $Date_De = date("H:i:s Y/m/d");
    $Statement_Update_Order = "UPDATE `order` SET Date_De='$Date_De', Status_Order = 'Giao Thành Công' WHERE ID_Order = $ID_Order";
    $Query_Update_Order = mysqli_query($conn, $Statement_Update_Order);
}
?>
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" cellspacing="0" id="tickets-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày mua</th>
                                    <th>Khách hàng</th>
                                    <th>Trạng thái</th>
                                    <th>Chi Tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Statement_Order = "SELECT * FROM `order`WHERE Status_Order = 'Chưa Giải Quyết' ";
                                $Query_Order = mysqli_query($conn, $Statement_Order);
                                // Từ bảng order chúng ta bắt đầu truy vấn các trường dữ liệu ở các bảng khác để bổ sung thông tin cho hóa đơn
                                while ($Display_Order = mysqli_fetch_assoc($Query_Order)){
                                    // Từ ID_User lấy ra dữ liệu tên người dùng
                                    $Statement_Users = "SELECT * FROM users WHERE ID_User =".$Display_Order['ID_User'];
                                    $Query_Users = mysqli_query($conn, $Statement_Users);
                                    $Display_Users = mysqli_fetch_assoc($Query_Users); 
                                    // Từ ID_Order lấy toàn bộ dữ liệu của đơn đặt hàng
                                    $Statement_OrderDetail = "SELECT * FROM orderdetail WHERE ID_Order =".$Display_Order['ID_Order'];
                                    $Query_OrderDetail = mysqli_query($conn, $Statement_OrderDetail);
                                    $Display_OrderDetail = mysqli_fetch_assoc($Query_OrderDetail); 
                                    echo "<tr>
                                        
                                    <td><a href='javascript: void(0);' class='text-primary ml-3'>VKU".$Display_Order['ID_Order']."</a> </td>
                                    <td>$Display_Order[Date_Order]</td>
                                    <td>
                                    $Display_Users[Name_User]
                                    </td>
                                    <td>";
                                    if($Display_Order['Status_Order'] == "Chưa Giải Quyết"){
                                        echo "Chưa Giao";
                                    }
                                    else echo "Đã Giao";
                                echo "</td>";
                                echo "<td>
                                        <button type='button' class='btn btn-primary btn-sm btn-rounded' data-toggle='modal' data-target='.Modal$Display_Order[ID_Order]'>
                                            Xem
                                        </button>
                                    </td>
                                </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
                        <p class='mb-2'>Mã Đơn Hàng: <span class='text-primary'> VKU$Display_Order[ID_Order]</span></p>
                        <p class='mb-2'>Khách Hàng: <span class='text-primary'> $Display_Users[Name_User]</span></p>
                        <p class='mb-2'>Liên Lạc: <span class='text-primary'> $Display_Order[Phone_User]</span></p>
                        <p class='mb-4'>Địa Chỉ: <span class='text-primary'> $Display_Order[Address_User]</span></p>
                        <div class='table-responsive'>
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
                    <form action='' method='post'>
                        <input type='hidden' name='ID_Order' value='".$Display_Order['ID_Order']."'>
                        <button type='submit' class='btn btn-success'>Đã Giao</button>
                    </form>
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