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
    $ID_Product = $_GET['id'];
    $Statement_Update_Product = "UPDATE product SET Name_Product='$Name_Product',ID_Catalog=$ID_Catalog,Brand_Product='$Brand_Product',Price_Product=$Price_Product, Des_Product='$Des_Product', Title_Product='$Title_Product', Keywords_Product='$Keywords_Product', Des_Page='$Des_Page', Image_Product='$Image_Product' WHERE ID_Product=$ID_Product";
    $Query_Product = mysqli_query($conn, $Statement_Update_Product);   
    if (move_uploaded_file($tempname, $folder))  { 
        $msg = "Image uploaded successfully"; 
    }else{ 
        $msg = "Failed to upload image"; 
    }  
}
?>
<?php
    if (isset($_GET['id'])){
        $Statement_Product = "SELECT * FROM product WHERE ID_Product=".$_GET['id'];        
        $Query_Product = mysqli_query($conn, $Statement_Product);
        $Display_Product = mysqli_fetch_assoc($Query_Product);
        $count= mysqli_num_rows($Query_Product);
        if($count==0){
            $Display_Product['Name_Product'] = $Display_Product['Brand_Product'] = $Display_Product['Price_Product']
        = $Display_Product['ID_Catalog'] = $Display_Product['Des_Product'] = $Display_Product['Title_Product']
        = $Display_Product['Keywords_Product'] = $Display_Product['Des_Page'] =
        "Sản Phẩm Không Tồn Tại!";
        }
    }
    else {
        $Display_Product['Name_Product'] = $Display_Product['Brand_Product'] = $Display_Product['Price_Product']
        = $Display_Product['ID_Catalog'] = $Display_Product['Des_Product'] = $Display_Product['Title_Product']
        = $Display_Product['Keywords_Product'] = $Display_Product['Des_Page'] =
        "Lỗi GET, vui lòng thử lại bằng cách chọn 1 sản phẩm khác";
    }
?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Thay đổi thông tin sản phẩm</h4>
                            <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="formrow-firstname-input">Tên sản phẩm</label>
                                        <input type="text" class="form-control" name="Name_Product" value="<?php echo $Display_Product['Name_Product']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="manufacturername">Thương hiệu</label>
                                        <input name="Brand_Product" type="text" class="form-control"value="<?php echo $Display_Product['Brand_Product']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                    <label class="control-label">Danh Mục</label>
                                        <select name="ID_Catalog" class="form-control select"  selected="<?php echo (isset($Display_Product))?$Display_Product['ID_Catalog']:'';?>">
                                        <?php
                                            $Statement_Catalog = "SELECT * FROM catalog";
                                            $Query_Catalog = mysqli_query($conn,$Statement_Catalog);
                                            while($Display_Catalog = mysqli_fetch_assoc($Query_Catalog))
                                            {
                                                echo '<option value="'.$Display_Catalog['ID_Catalog'].'"';
                                                if ($Display_Catalog['ID_Catalog'] == $Display_Product['ID_Catalog']) echo 'selected="selected">'.$Display_Catalog['Name_Catalog'].'</option>';
                                                if ($Display_Catalog['ID_Catalog'] != $Display_Product['ID_Catalog']) echo '>'.$Display_Catalog['Name_Catalog'].'</option>';
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Giá Bán</label>
                                        <input name="Price_Product" type="number" class="form-control" value="<?php echo $Display_Product['Price_Product']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="productdesc">Mô tả sản phẩm</label>
                                        <textarea name="Des_Product" id="mytextarea" class="form-control pb-2" maxlength="1000" rows="15" placeholder="Không quá 1000 ký tự"><?php echo $Display_Product['Des_Product']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="col-12 card-title my-3">Phần SEO</h4>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="metatitle">Tiêu đề trang</label>
                                        <input id="metatitle" name="Title_Product" type="text" class="form-control" value="<?php echo $Display_Product['Title_Product']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="metakeywords">Keywords của trang</label>
                                        <input id="metakeywords" name="Keywords_Product" type="text" class="form-control" placeholder="Ngăn cách các từ khóa bằng dấu chấm phẩy" value="<?php echo $Display_Product['Keywords_Product']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="metadescription">Mô tả trang</label>
                                        <textarea class="form-control" name="Des_Page" rows="5" placeholder="Em là nguồn cảm hứng đằng sau tất cả những gì anh làm, là nguồn gốc của những điều tốt lành trong cuộc sống của anh. Mãi yêu Code"><?php echo $Display_Product['Des_Page']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h4 class="card-title mb-3">Ảnh về sản phẩm</h4>
                                    <input name="uploadfile" type="file">
                                </div>
                            </div>
                            <div>
                                <input type="submit" class="btn btn-primary mr-1 mt-3 waves-effect waves-light" value="Lưu và hiển thị">
                                <a href="dssanpham.html" class="btn btn-danger mt-3 waves-effect px-5">Hủy</a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
<?php
include('layouts/footer1.php');
?>
