<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">

        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="ti-menu"></i>
            </a>
            <a class="mobile-search morphsearch-search" href="#">
                <i class="ti-search"></i>
            </a>
            <a href="index.php">
                <img class="img-fluid" src="assets/images/logo.png" alt="Theme-Logo" style="width: 140px;" />
            </a>
            <a class="mobile-options">
                <i class="ti-more"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li>
                    <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                </li>
            </ul>
            <ul class="nav-right">
                <li class="user-profile header-notification">
                    <a href="#!">
                        <span id="current-user-name"><?=$_SESSION['user']['name']?></span>
                        <i class="ti-angle-down"></i>
                    </a>
                    <ul class="show-notification profile-notification">
                        <!-- <li>
                            <a href="profile.php">
                                <i class="ti-user"></i> Profile
                            </a>
                        </li> -->
                        <li>
                            <a href="logout.php">
                                <i class="ti-layout-sidebar-left"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            
        </div>
    </div>
</nav>