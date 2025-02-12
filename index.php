<?php
    include("sessions.php");
    include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>NHÓM 6 QUÁN LÝ BÁN SÁCH</title>
  <?php
    include("header.php");
  ?>
  

</head>

<body id="page-top">
    <?php
    // ktra session
    if(isset($_SESSION['dangnhapthanhcong']) || isset($_COOKIE["remember"])){  
        $_SESSION['tranghientai'] = "bangdieukhien";   // đặt trang thái active trang index
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

                <!-- Begin Main Content -->
                <?php
                    include("content.php");
                ?>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php 
                include("footer.php");
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
