<?php
    include("connect.php");
   if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $user = $_GET['id'];
    
    // Thực hiện truy vấn xóa dựa trên id
    $queryDelete = "DELETE FROM `nguoidung` WHERE `id` = $user";
    $resultDelete = $connect->query($queryDelete);

    if ($resultDelete) {
        // Chuyển hướng về trang danh sách tài khoản sau khi xóa
        header("Location: QLtaikhoannguoidung.php");
        exit();
    } else {
        echo "Lỗi khi xóa tài khoản: " . $connect->error;
    }
} else {
    echo "Id không hợp lệ";
}
?>
