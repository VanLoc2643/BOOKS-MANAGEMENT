<?php
    include("sessions.php");  //để bắt đầu phiên làm việc của session nếu đéo có các biến session không thể được đọc hoặc ghi
    // include("connect.php"); // kết nối đến database
    require_once("connect.php");
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }
?>


<?php


    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $userId = $_GET['id'];
        
        // Thực hiện truy vấn lấy thông tin tài khoản dựa trên id
        $querySelect = "SELECT * FROM `books` WHERE `id` = $userId";
        $resultSelect = $connect->query($querySelect);

        if ($resultSelect->num_rows > 0) {
            $row = $resultSelect->fetch_assoc();
            $name = $row['name'];
            $soluong = $row['soluong'];
            $image = $row['image'];
            $tacgia = $row['tacgia'];
            $namxuatban = $row['namxuatban'];
            $theloai = $row['theloai'];
            $mucgia = $row['mucgia'];
            
    ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <title>NHÓM 6 QUÁN LÝ BÁN SÁCH</title>
  <?php
    include("header.php");
  ?>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        #wrapper {
            overflow-x: hidden;
        }

        .search-container {
            margin-bottom: 20px;
        }

        #dataTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #dataTable th,
        #dataTable td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        #dataTable th {
            background-color: #f8f9fa;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .scroll-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
        }

        .scroll-to-top:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .container {
            margin-top: 50px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }


    </style>
</head>

<body id="page-top">
    <?php
    // ktra session
    if(isset($_SESSION['dangnhapthanhcong']) || isset($_COOKIE["remember"])){  
        $_SESSION['tranghientai'] = "quanlybook";   // đặt trang thái active trang hồ sơ cá tao T khoan
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
                
                <h3 class="login-title " align ="center" ><b>Sửa tài khoản</b></h3>

         
                <!-- php ktra khong thanh cong thi cho cúc luôn -->
                 <?php

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

            <div class="container">
            <form action="capnhatBook.php" method="POST" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="name" class="form-label">Tên sách:</label>
                    <input type="text"  name="name"  value="<?php echo $name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="soluong" class="form-label">Số Lượng:</label>
                    <input type="number" name="soluong" value="<?php echo $soluong; ?>" required min="0">
                </div>
                <div class="form-group">
                    <label for="image" class="form-label">Ảnh:</label>
                    <input type="text" name="image"  value="<?php echo $image; ?>" required>
                </div>
                <div class="form-group">
                    <label for="tacgia" class="form-label">Tên tác giả:</label>
                    <input type="text" name="tacgia"  value="<?php echo $tacgia; ?>" required>
                </div>  
                <div class="form-group">
                    <label for="namxuatban" class="form-label">Năm xuất bản:</label>
                    <input type="date"  name="namxuatban"  value="<?php echo $namxuatban; ?>" required>
                </div>
                <div class="form-group">
                    <label for="theloai" class="form-label">Thể loại:</label>
                    <input type="text"  name="theloai"  value="<?php echo $theloai; ?>" required>
                </div>
                <div class="form-group">
                    <label for="mucgia" class="form-label">Mức Giá: </label>
                    <input type="text"  name="mucgia" class="form-input"  value="<?php echo $mucgia; ?>" required>
                </div>

                <input type="hidden" name="id" value="<?php echo $userId; ?>">
                <button type="submit" name="capnhat">Cập nhật</button>
    </form>
            </div>
            <?php
            } else {
                echo "Không tìm thấy thông tin tài khoản";
            }
            } else {
            echo "Id không hợp lệ";
            }
?> 
            </div>
            </div>

        </div>
     

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

<script>
    function validateForm() {
        var tenSach = document.getElementsByName("name")[0].value;
        var tacGia = document.getElementsByName("tacgia")[0].value;
        var namXuatBan = document.getElementsByName("namxuatban")[0].value;
        var theLoai = document.getElementsByName("theloai")[0].value;
        var mucGia = document.getElementsByName("mucgia")[0].value;
        var regex = /^[a-zA-Z\sàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễđìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳỹỷỵÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄĐÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲỸỶỴ]*$/;

        // Kiểm tra xem tên sách có chứa kí tự đặc biệt hay không
        if (!regex.test(tenSach)) {
            alert("Tên sách không được chứa kí tự đặc biệt!");
            return false;
        }

        // Kiểm tra xem tên tác giả có chứa kí tự đặc biệt hay không
        if (!regex.test(tacGia)) {
            alert("Tên tác giả không được chứa kí tự đặc biệt!");
            return false;
        }

        // Kiểm tra xem năm xuất bản có lớn hơn năm hiện tại không
        var namHienTai = new Date().getFullYear();
        if (parseInt(namXuatBan) > namHienTai) {
            alert("Năm xuất bản không được lớn hơn năm hiện tại!");
            return false;
        }

        // Kiểm tra xem mức giá có phải là số không và có lớn hơn hoặc bằng 0 không
        if (isNaN(mucGia) || mucGia < 0) {
            alert("Mức giá phải là một số dương!");
            return false;
        }

        // Kiểm tra xem thể loại có phải là số không
        if (!isNaN(theLoai)) {
            alert("Thể loại không được là số!");
            return false;
        }

        return true; // Cho phép form được gửi đi nếu tất cả điều kiện đều đúng
    }
</script>
    <?php
        include("scripts.php");
        
    ?>
    <!-- Endscript -->
</body>

</html>
