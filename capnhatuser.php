<?php
    include("connect.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["capnhat"])) {
        $userId = $_POST['id'];
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $diachi = mysqli_real_escape_string($connect, $_POST['diachi']);
        $sodienthoai = mysqli_real_escape_string($connect, $_POST['sodienthoai']);
    
        // Thực hiện truy vấn cập nhật dựa trên id
        $queryUpdate = "UPDATE `nguoidung` SET `username` = '$username', `email` = '$email', `diachi` = '$diachi', `sodienthoai` = '$sodienthoai' WHERE `id` = $userId";
        $resultUpdate = $connect->query($queryUpdate);
    
        if ($resultUpdate) {
            // Chuyển hướng về trang danh sách tài khoản sau khi cập nhật
            header("Location: QLtaikhoannguoidung.php");
            exit();
        } else {
            echo "Lỗi khi cập nhật tài khoản: " . $connect->error;
        }
    }
    
?>
