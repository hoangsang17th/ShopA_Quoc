<?php
include('layouts/header1.php');
?>
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        <a href="themsanpham.php" class="btn btn-primary mr-2 w-md mb-3">Thêm Sản Phẩm</a>
                    <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" cellspacing="0" id="tickets-table">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Thương Hiệu</th>
                            <th>Giá</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            if (isset($_GET['iddanhmuc'])) {
                                $Statement_Product = "SELECT * FROM product WHERE iddanhmuc=" .$_GET['iddanhmuc'];
                            } else {                
                                $Statement_Product = "SELECT * FROM product";
                            }
                            $Query_Product =mysqli_query($conn, $Statement_Product);
                            $Stt= 1;
                            while ($Display_Product = mysqli_fetch_assoc($Query_Product)){
                                echo "<tr>";
                                echo '<td>'.$Stt.'</td>';
                                echo "<td>".$Display_Product['Name_Product']."</td>";
                                echo "<td>".$Display_Product['Brand_Product']."</td>";
                                echo "<td>".$Display_Product['Price_Product']."</td>";
                                echo '<td><a href="suasanpham.php?id='.$Display_Product['ID_Product'].'" class="px-2"><i class="far fa-edit"></i><a/>';
                                echo '<a href="xoasanpham.php?id='.$Display_Product['ID_Product'].'" class="px-2"><i class="far fa-trash-alt"></i><a/></td>';
                                echo "</tr>";
                                $Stt++;
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
</div> 
<?php
include('layouts/footer1.php');
?>