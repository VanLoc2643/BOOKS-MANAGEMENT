<?php
    include("connect.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["capnhat"])) {
        $userId = $_POST['id'];
        $name = mysqli_real_escape_string($connect, $_POST['name']);
        $soluong = mysqli_real_escape_string($connect, $_POST['soluong']);
        $image = mysqli_real_escape_string($connect, $_POST['image']);
        $tacgia = mysqli_real_escape_string($connect, $_POST['tacgia']);
        $namxuatban = mysqli_real_escape_string($connect, $_POST['namxuatban']);
        $theloai = mysqli_real_escape_string($connect, $_POST['theloai']);
        $mucgia = mysqli_real_escape_string($connect, $_POST['mucgia']);
        // Thực hiện truy vấn cập nhật dựa trên id
        $queryUpdate = "UPDATE `books` SET 
        `name` = '$name', 
        `soluong` = '$soluong', 
        `image` = '$image', 
        `tacgia` = '$tacgia', 
        `namxuatban` = '$namxuatban', 
        `theloai` = '$theloai', 
        `mucgia` = '$mucgia'
        WHERE `id` = $userId";

        $resultUpdate = $connect->query($queryUpdate);
    
        if ($resultUpdate) {
            // Chuyển hướng về trang danh sách tài khoản sau khi cập nhật
            header("Location: QuanLyBook.php");
            exit();
        } else {
            echo "Lỗi khi cập nhật tài khoản: " . $connect->error;
        }
    }
    
?>
