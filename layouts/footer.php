<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="footer-widget logo-widget">
                            <div class="footer-logo"><a href="index.html"><img src="assets/img/logo/footer-logo.png" alt=""></a></div>
                            <div class="widget-content">
                                <div class="text">
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat</p>
                                </div>
                                <div class="footer-social-icon">
                                    <ul class="social-icon-one">
                                        <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 mb-30">
                        <div class="footer-widget links-widget float-lg-right">
                            <h5 class="footer-title">Company</h5>
                            <div class="widget-content">
                                <ul class="list">
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Services</a></li>
                                    <li><a href="#">Features</a></li>
                                    <li><a href="#">Our Pricing</a></li>
                                    <li><a href="#">Latest News</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-sm-6 mb-30">
                        <div class="footer-widget links-widget float-lg-right">
                            <h5 class="footer-title">Support</h5>
                            <div class="widget-content">
                                <ul class="list">
                                    <li><a href="#">FAQ’s</a></li>
                                    <li><a href="#">Terms & Condition</a></li>
                                    <li><a href="#">Community</a></li>
                                    <li><a href="#">Contact</a></li>
                                    <li><a href="#">24/7 Days</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-30">
                        <div class="footer-widget links-widget float-lg-right">
                            <h5 class="footer-title">Resources</h5>
                            <div class="widget-content">
                                <ul class="list">
                                    <li><a href="#">Customers</a></li>
                                    <li><a href="#">Whitepaper</a></li>
                                    <li><a href="#">Dev API</a></li>
                                    <li><a href="#">Media Coverage</a></li>
                                    <li><a href="#">GDPR</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="copyright">Copyright@2020 <a href="#">Coui.</a> All rights reserved</div>
    </div>
</footer>
<button class="scroll-top scroll-to-target" data-target="html">
    <span class="fa fa-angle-up"></span>
</button>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#sendcm").click(function(){
            var url_string = window.location.href;
            var url = new URL(url_string);
            var ID_Product = <?php echo $_GET['id'];?>
            // url.searchParams.get("id");
            // var idpro = (new URL(document.location)).searchParams;
            var txt = $("#comments").val();
            document.getElementById("comments").value= "";
            alert("Đăng Bình Luận Thành Công");
            $.post("CommentProcess.php", {ID_Product: ID_Product, content: txt}, function (result) {
                // alert(result);
                $("#listcomment").append("<div class='rounded shadow my-3'><div class='p-4'><div class='d-flex justify-content-between'><div class='media align-items-center'><div class='commentor-detail'><h6 class='mb-0'><a href='javascript:void(0)' class='media-heading text-dark'>Bạn</a></h6><small class='text-muted'>Khách Hàng</small></div></div><small class='text-muted'>Vừa xong</small></div><div class='mt-3'><p class='mb-0'>"+txt+"</p></div></div></div>");
            });
        });
    });
</script>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper-v1.14.3.min.js"></script>
    <script src="assets/js/bootstrap-v4.1.3.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.countTo.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
</body>
</html>