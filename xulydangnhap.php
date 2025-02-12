<?php
require_once("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $query = "SELECT id, password FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row["password"];
            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION["user_id"] = $row["id"];
                header("location: index2.html");
                exit();
            } else {
                header("location: index2.html");
            }
        } else {
            echo "Tên người dùng không tồn tại.";
        }
    } else {
        echo "Đã xảy ra lỗi. Vui lòng thử lại sau.";
    }
}
?>
