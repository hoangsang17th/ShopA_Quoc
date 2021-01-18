<?php
include('layouts/header1.php');
?>
<script src="https://cdn.tiny.cloud/1/rm8h7epfc7tvhvacjxs9dfg7u4whkpmvn962dhuwiavn550n/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#mytextarea'
    });
</script>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name_Product = $_POST['Name_Product']; 
    $Brand_Product = $_POST['Brand_Product'];
    $Price_Product = $_POST['Price_Product'];
    $ID_Catalog = $_POST['ID_Catalog'];
    $Des_Product =$_POST['Des_Product'];
    $Title_Product =$_POST['Title_Product'];
    $Keywords_Product =$_POST['Keywords_Product'];
    $Des_Page =$_POST['Des_Page'];
    $Image_Product = $_FILES["uploadfile"]["name"]; 
	$tempname = $_FILES["uploadfile"]["tmp_name"];	 
    $folder = "assets/img/shop/".$Image_Product;
    $Statement_Add_Product = "INSERT INTO product(Name_Product, Brand_Product, Price_Product, ID_Catalog, Des_Product, Title_Product, Keywords_Product, Des_Page, Image_Product) VALUES ('$Name_Product','$Brand_Product','$Price_Product','$ID_Catalog', '$Des_Product','$Title_Product','$Keywords_Product','$Des_Page', '$Image_Product')";
    $ketqua = mysqli_query($conn, $Statement_Add_Product);
    if (move_uploaded_file($tempname, $folder))  { 
        $msg = "Image uploaded successfully"; 
    }else{ 
        $msg = "Failed to upload image"; 
    } 
}
?>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thông tin cơ bản</h4>
                        <p class="card-title-desc">Điền tất cả thông tin bên dưới</p>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="formrow-firstname-input">Tên sản phẩm</label>
                                        <input type="text" class="form-control" name="Name_Product">
                                    </div>
                                    <div class="form-group">
                                        <label for="manufacturername">Thương hiệu</label>
                                        <input name="Brand_Product" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                    <label class="control-label">Danh Mục</label>
                                        <select name="ID_Catalog" class="form-control select">
                                        <?php
                                            $Statement_Catalog = "SELECT * FROM catalog ORDER BY Name_Catalog ASC";
                                            $Query_Catalog =mysqli_query($conn, $Statement_Catalog);
                                            while ($Display_Catalog = mysqli_fetch_assoc($Query_Catalog)) {
                                                echo '<option value="'.$Display_Catalog['ID_Catalog'].'">'.$Display_Catalog['Name_Catalog'].'</option>';
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Giá Bán</label>
                                        <input name="Price_Product" type="number" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="productdesc">Mô tả sản phẩm</label>
                                        <textarea name="Des_Product" id="mytextarea" class="form-control pb-2" maxlength="1000" rows="15" placeholder="Không quá 1000 ký tự"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="col-12 card-title my-3">Phần SEO</h4>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="metatitle">Tiêu đề trang</label>
                                        <input id="metatitle" name="Title_Product" type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="metakeywords">Keywords của trang</label>
                                        <input id="metakeywords" name="Keywords_Product" type="text" class="form-control" placeholder="Ngăn cách các từ khóa bằng dấu phẩy">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="metadescription">Mô tả trang</label>
                                        <textarea class="form-control" name="Des_Page" rows="5" placeholder="Em là nguồn cảm hứng đằng sau tất cả những gì anh làm, là nguồn gốc của những điều tốt lành trong cuộc sống của anh. Mãi yêu Code"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h4 class="card-title mb-3">Ảnh về sản phẩm</h4>
                                    <input name="uploadfile" type="file">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary mr-1 mt-3 waves-effect waves-light" value="Lưu và hiển thị">
                            <a href="sanpham.php" class="btn btn-danger mt-3 waves-effect px-5">Hủy</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
<?php
include('layouts/footer1.php');
?>