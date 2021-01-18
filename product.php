<?php
include('layouts/header.php');
?>

<?php
    $Statement_Product = "SELECT * FROM product WHERE ID_Product= ".$_GET['id'];             
    $Query_Product = mysqli_query($conn, $Statement_Product);
    $Display_Product = mysqli_fetch_assoc($Query_Product);
    echo "<section class='shop-single-area another-page pt-65'>
    <div class='container'>
        <div class='single-products-details'>       
            <div class='product-content-box'>
                <div class='row'>
                    <div class='col-md-5'>
                        <img src='assets/img/shop/$Display_Product[Image_Product]' class='w-100'>
                    </div>
                    <div class='col-1'></div>
                    <div class='col-md-6'>
                        <div class='content-box'>
                            <h4>".$Display_Product['Name_Product']."</h4>
                            <h5>Price: <span>$".$Display_Product['Price_Product']."</span></h5>
                            <p>".$Display_Product['Des_Product']."</p>
                            <div class='product-spinner-wrap'>
                                <div class='atoc-btn-wrap'>
                                    <a href='AddToShop.php?item=$Display_Product[ID_Product]' class='btn-bg2'>Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</section>  ";
?>

<?php
        if ($profile['Email_User']!=''){
            echo" <div class='container my-5'>
        <h4 >KHÁCH HÀNG NHẬN XÉT</h4>
        <!-- <form method='GET' action=''> -->
            <div class='row mt-3'>
                <div class='col-md-12'>
                    <div class='form-group position-relative'>
                    <label>Comments</label>
                        <i data-feather='message-circle' class='fea icon-sm icons'></i>
                        <input type='text' id='comments' class='form-control pl-5' placeholder='Mời bạn để lại bình luận...'>
                    </div>
                </div>
            </div>
            <div class='row justify-content-end'>
                <div class='col-5 col-sm-4 col-md-3 col-lg-2'>
                    <input type='submit' id='sendcm' value='Gửi bình luận' class='btn btn-primary btn-lock'>
                </div>
            </div>
        <!-- </form> -->
    </div>";
        }
    echo "
    <div class='container mb-5'>
        <div class='row mb-5'>
            <div class='col-12 mb-5' id='listcomment'>
            <div class='card shadow rounded border-0 mt-4'>
    <div class='card-body'>";
        $Statement_Comment = "SELECT * FROM comment WHERE ID_Product =".$_GET['id'];
        $Query_Comment = mysqli_query($conn, $Statement_Comment);
        $Quanlity_Comment = mysqli_num_rows($Query_Comment);
        if ($Quanlity_Comment !=0){
            echo "<label>$Quanlity_Comment Bình Luận</label>";
        }
        else echo "<label>Chưa có đánh giá nào!</label>";
        while ($Display_Comment = mysqli_fetch_assoc($Query_Comment)){
            $Statement_Users = 'SELECT * FROM users WHERE ID_User ='.$Display_Comment['ID_User'];
            $Query_Users = mysqli_query($conn, $Statement_Users);
            $Display_Users = mysqli_fetch_assoc($Query_Users);
            echo "<ul class='media-list list-unstyled mb-0'>
                    <li class='mt-4'>
                        <div class='d-flex justify-content-between'>
                            <div class='media align-items-center'>
                                <div class='commentor-detail'>
                                    <h6 class='mb-0'><a href='javascript:void(0)' class='media-heading text-dark'>$Display_Users[Name_User]</a></h6>
                                    <small class='text-muted'>$Display_Comment[Date_Comment]</small>
                                </div>
                            </div>
                        </div>
                        <div class='mt-3'>
                            <p class='text-muted font-italic p-3 bg-light rounded'>' $Display_Comment[Comment]'</p>
                        </div>";
                        if (isset($_POST['btnsub-'.$Display_Comment['ID_Comment']])) {
                            $ID_User=$profile['ID_User'];
                            $ID_Comment = $Display_Comment['ID_Comment'];
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $date = date("Y-m-d");
                            $ReComment = $_POST['recomment-'.$Display_Comment['ID_Comment']];
                            $sql = "INSERT INTO recomment(ID_User, ID_Comment, ReComment, Date_ReComment) VALUES ('$ID_User','$ID_Comment','$ReComment','$date')";
                            $ketqua = mysqli_query($conn, $sql);
                        }
                        echo "
                            <form action='' method='POST'>
                            <div class='row'>
                            <div class='col-8 col-sm-9 col-md-10'>
                                <input type='text' id='recomments' name='recomment-$Display_Comment[ID_Comment]' class='form-control' placeholder='Trả lời bình luận của $Display_Users[Name_User]'>
                            </div>
                            <div class='col-4 col-sm-3 col-md-2'>
                                <input type='submit' id='sendrcm' value='Trả lời' name='btnsub-$Display_Comment[ID_Comment]' class='btn btn-primary btn-lock'>
                            </div></div>
                            </form>
                        
                        ";
                        $Statement_ReComment = "SELECT * FROM recomment WHERE ID_Comment = $Display_Comment[ID_Comment]";
                        $Query_ReComment = mysqli_query($conn, $Statement_ReComment);
                        while ($Display_ReComment = mysqli_fetch_assoc($Query_ReComment)){
                            $Statement_ReUsers = 'SELECT * FROM users WHERE ID_User ='.$Display_ReComment['ID_User'];
                            $Query_ReUsers = mysqli_query($conn, $Statement_ReUsers);
                            $Display_ReUsers = mysqli_fetch_assoc($Query_ReUsers);
            echo"
                        <ul class='list-unstyled pl-4 pl-md-5 sub-comment'>
                            <li class='mt-4'>
                                <div class='d-flex justify-content-between'>
                                    <div class='media align-items-center'>
                                        <div class='commentor-detail'>
                                            <h6 class='mb-0'><a href='javascript:void(0)' class='text-dark media-heading'>$Display_ReUsers[Name_User]</a></h6>
                                            <small class='text-muted'>$Display_ReComment[Date_ReComment]</small>
                                        </div>
                                    </div>
                                </div>
                                <div class='mt-3'>
                                    <p class='text-muted font-italic p-3 bg-light rounded'>' $Display_ReComment[ReComment]'</p>
                                </div>
                            </li>
                        </ul>";}
                        echo"
                    </li>
                </ul><hr>";
        }
    echo "  </div>
    </div>
    </div>
        </div>
    </div>";
?>

<?php
include('layouts/footer.php');
?>

