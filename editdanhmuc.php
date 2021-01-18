<?php
include('layouts/header1.php');
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name_Catalog = $_POST['Name_Catalog'];
    $ID_Catalog=$_GET['id'];
    $Statement_Update_Catalog = "UPDATE catalog SET Name_Catalog='$Name_Catalog' WHERE ID_Catalog=$ID_Catalog";
    $Query_Update_Catalog = mysqli_query($conn, $Statement_Update_Catalog);
}
?>
<?php
    if (isset($_GET['id'])){
        $Statement_Catalog = "SELECT * FROM catalog WHERE ID_Catalog=".$_GET['id'];        
        $Query_Catalog = mysqli_query($conn, $Statement_Catalog);
        $Display_Catalog = mysqli_fetch_assoc($Query_Catalog);
    }
?>
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Thay đổi thông tin danh mục</h4>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="formrow-firstname-input">Tên Danh Mục</label>
                            <input type="text" class="form-control" name="Name_Catalog"value="<?php echo $Display_Catalog['Name_Catalog']; ?>">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary w-md">Hoàn Thành</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
<?php
include('layouts/footer1.php');
?>