<?php
    include("connect.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["capnhat"])) {
        $userId = $_POST['id'];
        $tentheloai = mysqli_real_escape_string($connect, $_POST['tentheloai']);

        // Thực hiện truy vấn cập nhật dựa trên id
        $queryUpdate = "UPDATE `theloai` SET 
        `tentheloai` = '$tentheloai'
        WHERE `id` = $userId";

        $resultUpdate = $connect->query($queryUpdate);
    
        if ($resultUpdate) {
            // Chuyển hướng về trang danh sách tài khoản sau khi cập nhật
            header("Location: Quanlydanhmuc.php");
            exit();
        } else {
            echo "Lỗi khi cập nhật tài khoản: " . $connect->error;
        }
    }
    
?>
