<?php
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tentheloai= mysqli_real_escape_string($connect, $_POST['tentheloai']);


    $query = "INSERT INTO theloai (tentheloai) VALUES ('$name')";

    if (mysqli_query($connect, $query)) {
        header("location: Quanlydanhmuc.php");
    } else {
        echo "Lỗi: " . $query . "<br>" . mysqli_error($connect);
    }
}


mysqli_close($connect);
?>
