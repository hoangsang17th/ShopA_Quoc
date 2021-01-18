<?php
include('layouts/header1.php');
?>
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="themdanhmuc.php" class="btn btn-primary mr-2 w-md mb-3">Thêm Danh Mục</a>
                    <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" cellspacing="0" id="tickets-table">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Danh Mục</th>
                            <th>Sửa</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $Stt= 1;
                            $Statement_Catalog = "SELECT * FROM catalog";
                            $Query_Catalog =mysqli_query($conn, $Statement_Catalog);
                            $Quanlity_Catalog=0;
                            while ($Display_Catalog = mysqli_fetch_assoc($Query_Catalog)){
                                echo "<tr>";
                                echo '<td>'.$Stt.'</td>';
                                echo '<td><a href="sanpham.php?iddanhmuc='.$Display_Catalog['ID_Catalog'].'">'.$Display_Catalog['Name_Catalog'].'<a/></td>';
                                echo '<td><a href="editdanhmuc.php?id='.$Display_Catalog['ID_Catalog'].'"><i class="far fa-edit"></i><a/></td>';
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