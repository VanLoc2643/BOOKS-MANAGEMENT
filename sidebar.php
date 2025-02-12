<!-- Sidebar -->
<ul
    class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
    id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a
        class="sidebar-brand d-flex align-items-center justify-content-center"
        href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3" >
            <sup><?php echo $_SESSION['username']
            ?></sup>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item
         <?php
          if(isset($_SESSION['tranghientai']) && $_SESSION['tranghientai'] == 'bangdieukhien') // kiểm tra mình đang ở đâuu
             {?> active  
             <?php } ?> ">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Trang Chủ</span>
            </a>
        </li>

        <!-- Divider -->
        <!-- <hr class="sidebar-divider">
    -->
            <!-- <div class="sidebar-heading">
               Bảng điều khiển
            </div> -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?php
                        if(isset($_SESSION['tranghientai']) && $_SESSION['tranghientai'] == 'taotaikhoan' && $_SESSION['tranghientai'] == 'danhsachtaikhoan' ) // kiểm tra mình đang ở đâuu
                         {?> active <?php } ?> ">
                <a
                   class="nav-link collapsed"
                    href="#"
                    data-toggle="collapse"
                    data-target="#collapseTwo"
                    aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog "></i><span>Quản Lý</span>
                </a>
                <div
                    id="collapseTwo"
                    class="collapse show"
                    aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item <?php
                            if(isset($_SESSION['tranghientai']) && $_SESSION['tranghientai'] == 'taotaikhoan') // kiểm tra mình đang ở đâuu
                            {?> active <?php } ?>" href="taotaikhoan.php" >Tạo tài khoản Admin</a>

                        <a href="quanlytaikhoanadmin.php" class="collapse-item  <?php
                        if(isset($_SESSION['tranghientai']) && $_SESSION['tranghientai'] == 'danhsachtaikhoan') // kiểm tra mình đang ở đâuu
                        {?> active<?php } ?> ">Quản lý tài khoản Admin</a>

                        <a href="QLtaikhoannguoidung.php" class="collapse-item  <?php
                            if(isset($_SESSION['tranghientai']) && $_SESSION['tranghientai'] == 'danhsachtaikhoannguoidung') // kiểm tra mình đang ở đâuu
                            {?> active<?php } ?>">Quản lý tài khoản User</a>

                        
                        <a href="quanlyDonHang.php" class="collapse-item  <?php
                            if(isset($_SESSION['tranghientai']) && $_SESSION['tranghientai'] == 'quanlydonhang') // kiểm tra mình đang ở đâuu
                            {?> active<?php } ?> ">Quản lý đơn đặt hàng</a>

                        <a href="QuanLyBook.php" class="collapse-item  <?php
                            if(isset($_SESSION['tranghientai']) && $_SESSION['tranghientai'] == 'quanlybook') // kiểm tra mình đang ở đâuu
                            {?> active<?php } ?> ">Quản lý kho sách</a>

                        <a href="DangBooks.php"  class="collapse-item  <?php
                            if(isset($_SESSION['tranghientai']) && $_SESSION['tranghientai'] == 'dangbooks') // kiểm tra mình đang ở đâuu
                            {?> active<?php } ?> ">Đăng Sản Phẩm</a>    

                        <a href="Quanlydanhmuc.php"  class="collapse-item  <?php
                            if(isset($_SESSION['tranghientai']) && $_SESSION['tranghientai'] == 'dannhmuc') // kiểm tra mình đang ở đâuu
                            {?> active<?php } ?> ">Quản lý danh mục</a>    
                    </div>
                </div>
            </li>

         

            <!-- Divider -->
  

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapsePages"
                        aria-expanded="true"
                        aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Pages</span>
                    </a>
                    <div
                        id="collapsePages"
                        class="collapse"
                        aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Login Screens:</h6>
                            <a class="collapse-item" href="login.html">Login</a>
                            <a class="collapse-item" href="register.html">Register</a>
                            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                            <div class="collapse-divider"></div>
                            <h6 class="collapse-header">Other Pages:</h6>
                            <a class="collapse-item" href="404.html">404 Page</a>
                            <a class="collapse-item" href="blank.html">Blank Page</a>
                        </div>
                    </div>
                </li>

             
                </ul>
                <!-- End of Sidebar -->