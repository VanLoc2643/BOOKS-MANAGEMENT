<?php
    include("connect.php");

    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $userId = $_GET['id'];
        
       
        $queryDelete = "DELETE FROM `theloai` WHERE `id` = $userId";
        $resultDelete = $connect->query($queryDelete);

        if ($resultDelete) {
            header("Location: Quanlydanhmuc.php");
            exit();
        } else {
            echo "Lỗi khi xóa tài khoản: " . $connect->error;
        }
    } else {
        echo "Id không hợp lệ";
    }
?>
