<?php
    include("sessions.php");  //để bắt đầu phiên làm việc của session nếu đéo có các biến session không thể được đọc hoặc ghi
    include("connect.php"); // kết nối đến database
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
        $_SESSION['tranghientai'] = "profile";   // đặt trang thái active trang hồ sơ cá nahannn
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
                
                <h3 class="login-title"><b>Chỉnh sửa thông tin cá nhân</b></h3>

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

                <form action="../webquanly/profile.php" method="POST">
                    <label for="username" class="form-label">Name:</label>
                    <input type="text"  name="username" class="form-input" value=" <?php echo $_SESSION["username"];?>" required >

                    <label for="email" class="form-label">Email:</label>
                    <input type="email"  name="email" class="form-input" value="<?php echo $_SESSION["email"];?>  ">

                    <label for="passwordCu" class="form-label">Mật khẩu cũ:</label>
                    <input type="password" name="passwordCu" class="form-input" >

                    <label for="Newpassword" class="form-label">Mật khẩu mới:</label>
                    <input type="password" name="Newpassword" class="form-input" >

                    <label for="Newpassword2" class="form-label">Nhập lại mật khẩu mới:</label>
                    <input type="password"  name="Newpassword2" class="form-input" >

                    <button type="submit" class="form-button" name ="xacnhanprofile">Xác Nhận</button>
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
        if (isset($_POST["xacnhanprofile"])) { // sở dĩ
            $username = mysqli_real_escape_string($connect, $_POST['username']);
            $email = mysqli_real_escape_string($connect, $_POST['email']);
        
            $passwordCu = $_POST['passwordCu'];
            $Newpassword = md5($_POST['Newpassword']);
            $Newpassword2 = md5($_POST['Newpassword2']);
      

            $thaydoiname = false;
            $thaydoiemail = false;
            // ktra xem trung email hay khomnh

        if($username != "") {
            //nếu user name  bị nào nhập email mà không nhập thi ta mới thực hiện truy xuất database user từ bảng username          
            $sqlcheckuser = "SELECT * FROM `user` WHERE `username` = '". $username ."'";
            $ketqua = $connect->query($sqlcheckuser);  
            
            // xác mình xem có username,  nào đạt trùng vs csdl ko
            if($ketqua->num_rows > 0) {  // cái db này ktra xem có dòng (bản ghi) nào có trong database hay không nếu có 
                $_SESSION['dangnhapkhongthanhcong'] = "Tên tài khoản đã tồn tại";  // check email có tồn tại
                echo "<script>alert('THanh cong')</script>";
                header("refresh:0, url='../webquanly/profile.php'");

            } else {
                // cập nhật lại username
                $connect->query("UPDATE `user` SET `username`= '". $username ."' WHERE `username` = '". $_SESSION['username'] ."'");
                $thaydoiname = true; // tức là toi đã thay đổi tên tài khoản
            }
        
        }
       

        // kiem tra email
        if($email != "") {
            //nếu user name ko bị trống tức là tg ngu nào nhập email mà không nhập thi ta mới thực hiện truy xuất database user từ bảng username          
            $sqlcheckuser = "SELECT * FROM `user` WHERE `email` = '". $email ."'";
            $ketqua = $connect->query($sqlcheckuser);  
       
            // xác mình xem có email,  nào đạt trùng vs csdl ko
            if($ketqua->num_rows > 0) {  // cái db này ktra xem có dòng (bản ghi) nào có trong database hay không nếu có 
                $_SESSION['dangnhapkhongthanhcong'] = "Địa chỉ email đã tồn tại";  // check email có tồn tại
                echo '<meta http-equiv="refresh" content="0;URL=../webquanly/profile.php">';
                // header("refresh:0, url='profile.php'");
            }  else {
                $connect->query("UPDATE `user` SET `email`= '". $email ."' WHERE `username` = '". $_SESSION['username'] ."'");// cập nhật lại uemail
                $thaydoiemail = true; // tức là tao đã tahy đổi địa chỉ email
              }
        } 

        // kiểm tra mật khẩu cũ
        if($passwordCu != "") { // nếu mật khảu cũ không để trống 
            if($Newpassword != $Newpassword2) { // nếu mật khẩu mới nhập lại khi ta nhập lại mật khẩu mới không trùng nhau
                $_SESSION['dangnhapkhongthanhcong'] = "Mật khẩu không khớp";  // check email có tồn tại
                echo '<meta http-equiv="refresh" content="0;URL=../webquanly/profile.php">';
               
            } else { // ta check tiếp nếu m nhập mật khẩu cũ trùng với  mật khẩu mới thì đéo ai cho m đổi nhập lại mk cũ cc à
                $sqlcheckuser = "SELECT * FROM `user` WHERE `email` = '".  $_SESSION['email'] ."' AND `password` = '". md5($passwordCu) ."'";
                
                $ketqua = $connect->query($sqlcheckuser);

                if($ketqua->num_rows > 0) {  // ta check tiếp lại mật khẩu cũ nếu nhập đúng thì mới cho đổi kìaâa

                    $connect->query("UPDATE `user` SET `password`= '". $Newpassword ."' WHERE `username` = '". $_SESSION['username'] ."'");
                    
                } else { // nếu nhập sai mật khẩu cũ ta xuất luôn báo lỗi

                    $_SESSION['dangnhapkhongthanhcong'] = "Mật khẩu cũ không chính xác";  // check email có tồn tại
                    echo '<meta http-equiv="refresh" content="0;URL=../webquanly/profile.php">';
                }
                
            }

        }
        
        if($thaydoiname ) { // nếu như tao đã thay đổi tên tài khoản thì thay đôi session luôn
            $_SESSION['username'] = $username; // sau khi ta set cập nhật cái username mới rồi thì ta phải thay đổi session username cũ bằng username mới luôn cho chắc
            echo '<meta http-equiv="refresh" content="0;URL=../webquanly/profile.php">';
        }
        if($thaydoiemail) { // email cũng tương tự
            $_SESSION['email'] = $email;  
            echo '<meta http-equiv="refresh" content="0;URL=../webquanly/profile.php">';
        } 
     
        // không set mật khẩu vì về cơ bản mật khẩu đéo ảnh hưởng

    }


    // php phân quyền
    } else {
        echo '<script>alert("Không thể truy cập trang admin, bạn cần phải đăng nhập tài khoản")</script>';
        header('Refresh: 0; url=../webquanly/login.php');
        exit(); // Đảm bảo thoát sau khi chuyển hướng header
    }
    ?>

    <!-- script-->
    <?php
        include("scripts.php");
    ?>
    <!-- Endscript -->
</body>

</html>
