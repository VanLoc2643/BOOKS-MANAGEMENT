<?php
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["xacnhandanghang"])) {
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $soluong = mysqli_real_escape_string($connect, $_POST['soluong']);
    $image = mysqli_real_escape_string($connect, $_POST['image']);
    $tacgia = mysqli_real_escape_string($connect, $_POST['tacgia']);
    $namxuatban = mysqli_real_escape_string($connect, $_POST['namxuatban']);
    $theloai = mysqli_real_escape_string($connect, $_POST['theloai']);
    $mucgia = mysqli_real_escape_string($connect, $_POST['mucgia']);
    $noidung = mysqli_real_escape_string($connect, $_POST['noidung']);

    $query = "INSERT INTO books (name, soluong, image, tacgia, namxuatban, theloai, mucgia, noidung) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "ssssssss", $name, $soluong, $image, $tacgia, $namxuatban, $theloai, $mucgia, $noidung); //"ssssssss" là chuỗi kiểu dữ liệu của các biến, mỗi ký tự tương ứng với một biến

    if (mysqli_stmt_execute($stmt)) {
        header("location: QuanLyBook.php");
    } else {
        // Log the error or handle it appropriately
        echo "Lỗi: " . $query . "<br>" . mysqli_error($connect);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($connect);
?>
