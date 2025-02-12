<?php
    include("sessions.php");
    include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
    

    <title>Đăng Nhập</title>    
<head>
    <?php
    include("header.php");
    ?>
</head>

    <?php
        // if(isset($_COOKIE["remember"])){
        //     header("refresh: 0; url='index.php'"); // nếu cookie còn tồn tại ta chuyển tới trang chủ luôn
        // } else {
        if(isset($_SESSION['dangnhapthanhcong' || isset($_COOKIE["remember"])])){
            // unset($_SESSION['dangnhapthanhcong']);
            header("refresh: 0; url='index.php'");
        } else {
    ?> 
<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image  "></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Xin Chào, Admin </h1>
                                    </div>
                                    <!-- php ktra khong thanh cong thi cho cúc luôn -->
                                    <?php
                                        if(isset($_SESSION['dangnhapkhongthanhcong'])){
                                
                                    ?> 
                                    <div class="alert alert-danger" role="alert">
                                        <i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION['dangnhapkhongthanhcong'];?> 
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button> 
                                    </div> 

                                    <?php
                                        unset($_SESSION['dangnhapkhongthanhcong']);
                                         }
                                    ?>

                                    <form class="user" name="formdangnhap" action="login.php" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                name="email" id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Nhập Địa Chỉ Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="password" id="exampleInputPassword" placeholder="Mật Khẩu">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck" name="remember" value="remember">
                                                <label class="custom-control-label" for="customCheck">Ghi nhớ tài khoản</label>
                                            </div>
                                        </div>
                                        <button name="dangnhap" type="submit" class="btn btn-primary btn-user btn-block">Đăng Nhập</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    
                                       
    <?php
            
        }
        if(isset($_POST['dangnhap']))
        {
            $email = mysqli_escape_string($connect, $_POST['email']); 
            $password = md5($_POST['password']); // da dc ma hoa
            // if (isset($_POST['remember'])) {   // check xem co nhan rememver ko
            //     $remember = $_POST['remember'];
            // }

            $sqlcheckuser = "SELECT * FROM `user` WHERE `email` = '". $email ."' AND `password`= '". $password ."'" ; 
            $ketqua = $connect->query($sqlcheckuser);

            if($ketqua->num_rows > 0) { 
                $user = $ketqua->fetch_assoc();
                $_SESSION['dangnhapthanhcong'] = 'Oke';
                $_SESSION['username'] = $user['username']; // gan để máy hiểu là thanh cong
                $_SESSION['email'] = $user['email'];
                header("refresh: 0; url='index.php'");
                //session chỉ tồn tại trong 1 phiên làm việc nếu như ta làm gi và làm nó ngặt đột ngột như unset thì cái session ý đéo tông tại nữa , và ta phải đăng nhập lại 1 lần  -->
                // còn nếu như ta set 1 cái cookie thì khi chúng ta mất session rồi thì chúng ta vẫn còn cái thời gian tồn tại (tùy chúng ta đặt) 
                if(isset($_POST['remember'])){
                setcookie('remember', $email, time() + 3600);
                }
         
                
            } else {
                // echo "<script>alert('Tài khoản hoặc mật khẩu không chính xác')</script>";
                $_SESSION['dangnhapkhongthanhcong'] = "Tài khoản hoặc mật khẩu không chính xác";
                header("refresh:0, url='login.php'");
            }
        }
    ?>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>