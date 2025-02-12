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

        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 50px;
            border-radius: 5px;
        }
    </style>

    </style>
</head>

<body id="page-top">
    <?php
    // ktra session
    if(isset($_SESSION['dangnhapthanhcong']) || isset($_COOKIE["remember"])){  
        $_SESSION['tranghientai'] = "quanlydonhang";   // đặt trang thái active trang hồ sơ cá tao T khoan
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
          

                <!-- <h1 class="h3 mb-4 text-gray-800"></h1> -->
                
            

            
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

                <div class="container mt-5">
                <?php
                     // Kết nối đến cơ sở dữ liệu
                    include("connect.php");
                    // Kiểm tra xem có tham số id được truyền không
                    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                        $order_id = $_GET['id'];

                        // Thực hiện truy vấn lấy chi tiết đơn hàng
                        $querySelect = "SELECT * FROM donhang WHERE id = $order_id";
                        $resultSelect = mysqli_query($connect, $querySelect);

                        // Kiểm tra xem truy vấn có thành công không
                        if ($resultSelect !== false) {
                            // Kiểm tra xem có dòng dữ liệu nào trả về không
                            if (mysqli_num_rows($resultSelect) > 0) {
                                $order = mysqli_fetch_assoc($resultSelect);
                ?>



                <div class="container">
                    <h2>Chi Tiết Đơn Hàng #<?php echo $order['id']; ?></h2>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Mã Khách Hàng</th>
                                <td><?php echo $order['id_nguoidung']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Tên Đơn Hàng</th>
                                <td><?php echo $order['ten_donhang']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Số Lượng</th>
                                <td><?php echo $order['soluong']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Tổng Tiền</th>
                                <td><?php echo $order['mucgia']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Ngày Đặt Hàng</th>
                                <td><?php echo $order['created_at']; ?></td>
                            </tr>
                           
                            <tr>
                                <th scope="row">Trạng Thái</th>
                                <td><?php echo $order['trangthai']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <?php
                    } else {
                ?>
                <div class="container alert alert-warning mt-5" role="alert"><p>Không tìm thấy đơn hàng.</p></div>
                <?php
                    }
                    } else {
                ?>
                    <div class="container alert alert-danger mt-5" role="alert">
                        <p>Lỗi trong quá trình truy vấn SQL:
                <?php echo mysqli_error($connect); ?></p>
                    </div>
                <?php
                }
                } else {
                ?>
                <div class="container alert alert-danger mt-5" role="alert">
                    <p>ID đơn hàng không hợp lệ.</p>
                </div>
                <?php
                }

                // Đóng kết nối
                mysqli_close($connect);
                ?>
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

    <!-- script-->
    <script>
    function searchUsers() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("TimKiem");
        filter = input.value.toUpperCase();
        table = document.getElementById("dataTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Index 1 là cột tên tài khoản
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
    <?php
        include("scripts.php");
        
    ?>
    <!-- Endscript -->
</body>

</html>
