<?php
include('layouts/header1.php');
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name_Catalog = $_POST['Name_Catalog'];
    $Statement_Add_Catalog = "INSERT INTO catalog(Name_Catalog) VALUES('$Name_Catalog')";
    $Query_Add_Catalog = mysqli_query($conn, $Statement_Add_Catalog);
}
?>
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Thêm danh mục mới</h4>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="formrow-firstname-input">Tên Danh Mục</label>
                            <input type="text" class="form-control" name="Name_Catalog">
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