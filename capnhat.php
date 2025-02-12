<?php
    include("connect.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["capnhat"])) {
        $userId = $_POST['id'];
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);
   

        // Thực hiện truy vấn cập nhật dựa trên id
        $queryUpdate = "UPDATE `user` SET `username` = '$username', `email` = '$email' WHERE `id` = $userId";
        $resultUpdate = $connect->query($queryUpdate);

        if ($resultUpdate) {
            // Chuyển hướng về trang danh sách tài khoản sau khi cập nhật
            header("Location: quanlytaikhoanadmin.php");
            exit();
        } else {
            echo "Lỗi khi cập nhật tài khoản: " . $connect->error;
        }
    }
?>
