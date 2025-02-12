<?php
    include("sessions.php");  //để bắt đầu phiên làm việc của session nếu đéo có các biến session không thể được đọc hoặc ghi
    // include("connect.php"); // kết nối đến database
    require_once("connect.php");
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>NHÓM 6 QUÁN LÝ BÁN SÁCH</title>
  <?php
    include("header.php");
  ?>
    <style>
    .login-title {
        font-size: 1.5em;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        margin-bottom: 8px;
    }

    .form-input {
        padding: 10px;
        margin-bottom: 16px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-button {
    padding: 10px;
    width: 10%; /* Đặt chiều rộng của nút là 100% của phần tử cha */
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.form-button:hover {
    background-color: #0056b3;
}
    </style>
</head>

<body id="page-top">
    <?php
    // ktra session
    if(isset($_SESSION['dangnhapthanhcong']) || isset($_COOKIE["remember"])){  
        $_SESSION['tranghientai'] = "taotaikhoan";   // đặt trang thái active trang hồ sơ cá tao T khoan
    ?> 

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php 
            include("sidebar.php");
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                    include("topbar.php");
                ?>
                <!-- End of Topbar -->

            </div>
            <!-- End of Main Content -->
            <div class="container-fluid" class >

                <!-- <h1 class="h3 mb-4 text-gray-800"></h1> -->
                
                <h3 class="login-title " align ="center" ><b>TẠO TÀI KHOẢN ADMIN</b></h3>

                <!-- php ktra khong thanh cong thi cho cúc luôn -->
                <!-- <?php

                    if(isset($_SESSION['dangnhapkhongthanhcong'])){
                                                    
                ?> 
                        <div class="alert alert-danger" role="alert">
                            <i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION['dangnhapkhongthanhcong'];?> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button> 
                        </div> 

                <?php
                        unset($_SESSION['dangnhapkhongthanhcong']); // gỡ unset tránh trường hợp 
                    }
                ?>

                 php ktra khong thanh cong thi cho cúc luôn -->


                  <!-- php ktra khong thanh cong thi cho cúc luôn -->
                <?php

                    if(isset($_SESSION['taotaikhoanthanhcong'])){
                                                    
                    ?> 
                        <div class="alert alert-danger" role="alert">
                            <i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION['taotaikhoanthanhcong'];?> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button> 
                        </div> 

                    <?php
                        unset($_SESSION['taotaikhoanthanhcong']); // gỡ unset tránh trường hợp lưu lại session
                    }
                    ?>
                

                <form action="taotaikhoan.php" method="POST">
                    <label for="username" class="form-label">Name:</label>
                    <input type="text"  name="username" class="form-input" value="" required >

                    <label for="email" class="form-label">Email:</label>
                    <input type="email"  name="email" class="form-input" value=""  required>

                    <label for="password1" class="form-label"> Nhâp mật khẩu:</label required>
                    <input type="password" name="password1" class="form-input" >

                    <label for="password2" class="form-label">Nhập lại mật khẩu:</label required>
                    <input type="password" name="password2" class="form-input" >
<!-- 
                    <label for="Newpassword2" class="form-label">Nhập lại mật khẩu mới:</label>
                    <input type="password"  name="Newpassword2" class="form-input" > -->

                    <!-- <label for="admincheck" class="form-label">Tai khoàn admin:</label>
                    <input type="checkbox"  name="admincheck" class="form-input" > -->

                    <button type="submit" class="form-button" name ="xacnhantaotaikhoan">Xác Nhận</button>
                </form>

            </div>
            <!-- Footer -->
            <?php 
                // include("footer.php");
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc muốn đăng xuất không?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" bên dưới nếu bạn sẵn sàng kết thúc phiên hiện tại của mình.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Quay lại</button>
                    <a class="btn btn-primary" href="logout.php">Đăng Xuất</a>
                </div>
            </div>
        </div>
    </div>


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["xacnhantaotaikhoan"])) {
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $password1 = md5($_POST['password1']);
        $password2 = md5($_POST['password2']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);

        // Kiểm tra xem tên người dùng đã tồn tại chưa
        $queryUsername = "SELECT * FROM `user` WHERE `username` = '$username'";
        $resultUsername = $connect->query($queryUsername);

        // Kiểm tra xem địa chỉ email đã tồn tại chưa
        $queryEmail = "SELECT * FROM `user` WHERE `email` = '$email'";
        $resultEmail = $connect->query($queryEmail);

        // Kiểm tra xem tên người dùng đã tồn tại chưa
        if ($resultUsername->num_rows > 0) {
            $_SESSION['dangnhapkhongthanhcong'] = "Tên tài khoản đã tồn tại";
            header("Location: taotaikhoan.php");

        } elseif ($resultEmail->num_rows > 0) {
            // Kiểm tra xem địa chỉ email đã tồn tại chưa
            $_SESSION['dangnhapkhongthanhcong'] = "Địa chỉ email đã tồn tại";
            header("Location: taotaikhoan.php");
            exit();
        } elseif ($password1 != $password2) {
            // Kiểm tra xem mật khẩu có khớp không
            $_SESSION['dangnhapkhongthanhcong'] = "Mật khẩu không khớp";
            header("Location: taotaikhoan.php");
            exit();
        } else {
            // Thêm vào cơ sở dữ liệu
            $queryInsert = "INSERT INTO `user` (`username`, `password`, `email`) VALUES ('$username', '$password1', '$email')";
            if ($connect->query($queryInsert)) {
                $_SESSION['taotaikhoanthanhcong'] = "Tạo tài khoản thành công";
                header("Location: taotaikhoan.php");
                exit();
            } else {
                $_SESSION['dangnhapkhongthanhcong'] = "Lỗi khi thêm tài khoản: " . $connect->error;
                header("Location: taotaikhoan.php");
                exit();
            }
        }
    }

    // php phân quyền
    } else {
        echo '<script>alert("Không thể truy cập trang admin, bạn cần phải đăng nhập tài khoản")</script>';
        header('Refresh: 0; url=../webquanly/login.php');
   // Đảm bảo thoát sau khi chuyển hướng header
    }
    ?>

    <!-- script-->
    <?php
        include("scripts.php");
    ?>
    <!-- Endscript -->
</body>

</html>
