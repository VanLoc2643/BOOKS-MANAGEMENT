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
#errorPopup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        #errorMessage {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body id="page-top">
    <?php
    // ktra session
    if(isset($_SESSION['dangnhapthanhcong']) || isset($_COOKIE["remember"])){  
        $_SESSION['tranghientai'] = "dangbooks";   // đặt trang thái active trang hồ sơ cá tao T khoan
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
                
                <h3 class="login-title " align ="center" ><b>ĐĂNG SẢN PHẨM</b></h3>

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
                    <form action="Xulydangsanpham.php" method="POST" onsubmit="return validateForm()">
                        <label for="name" class="form-label">Tên sách:</label>
                        <input type="text"  name="name" class="form-input" value="" required >

                        <label for="soluong" class="form-label">Số Lượng:</label>
                        <input type="text"  name="soluong" class="form-input" value=""  required>

                        <label for="image" class="form-label">Ảnh:</label >
                        <input type="text" name="image" class="form-input" value="" required>

                        <label for="tacgia" class="form-label">Tên tác giả:</label >
                        <input type="text" name="tacgia" class="form-input" required >

                        <label for="namxuatban" class="form-label">Năm xuất bản:</label >
                        <input type="date" name="namxuatban" class="form-input" required>

                        <label for="theloai" class="form-label">Thể loại:</label >
                        <input type="text"  name="theloai" class="form-input" required>

                        <label for="mucgia" class="form-label">Mức Giá: </label >
                        <input type="text"  name="mucgia" id="mucgia" class="form-input" required> 
                                        
                        <label for="noidung" class="form-label">Nội dung: </label >
                        <input type="text"  name="noidung" class="form-input" > 

                        <button type="submit" class="form-button" name ="xacnhandanghang">Xác Nhận</button>
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

  
</div>

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
            if ($connect->query($queryInsert) === TRUE) {
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
<<script>
    function validateForm() {
        var tenSach = document.getElementsByName("name")[0].value;
        var tacGia = document.getElementsByName("tacgia")[0].value;
        var namXuatBan = document.getElementsByName("namxuatban")[0].value;
        var mucGia = document.getElementsByName("mucgia")[0].value;
        var soLuong = document.getElementsByName("soluong")[0].value;
        var theLoai = document.getElementsByName("theloai")[0].value;

        var regex = /^[a-zA-Z\sàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễđìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳỹỷỵÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄĐÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲỸỶỴ]*$/;

        if (!regex.test(tenSach)) {
            alert("Tên sách không được chứa kí tự đặc biệt!");
            return false;
        }

        if (!regex.test(tacGia)) {
            alert("Tên tác giả không được chứa kí tự đặc biệt!");
            return false;
        }

        var namHienTai = new Date().getFullYear();
        if (parseInt(namXuatBan) > namHienTai) {
            alert("Năm xuất bản không được lớn hơn năm hiện tại!");
            return false;
        }

        if (isNaN(soLuong) || soLuong < 0) {
            alert("Số lượng phải là một số dương!");
            return false;
        }

        // Kiểm tra xem thể loại có phải là số không
        if (!isNaN(theLoai)) {
            alert("Thể loại không được là số!");
            return false;
        }

        return true;
    }
    </script>

    <!-- Endscript -->
</body>

</html>
