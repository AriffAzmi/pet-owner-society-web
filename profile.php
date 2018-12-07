<?php
    require_once __DIR__.'/includes/header.php';
?>
<link rel="stylesheet" href="<?=$config['SERVER_URL']?>/assets/plugins/sweetalert/sweetalert2.css">
<link rel="stylesheet" href="<?=$config['SERVER_URL']?>/assets/css/jquery.filer.css">
<link rel="stylesheet" href="<?=$config['SERVER_URL']?>/assets/css/jquery.filer-dragdropbox-theme.css">
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #4680ff !important;
    }
</style>
<?php require_once __DIR__.'/includes/preloader.php'; ?>
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
        <?php require_once __DIR__.'/includes/header_nav.php'; ?>
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <?php require_once __DIR__.'/includes/sidebar-nav.php'; ?>
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- Page-header start -->
                                <div class="page-header card">
                                    <div class="row align-items-end">
                                        <div class="col-lg-8">
                                            <div class="page-header-title">
                                                <i class="ti-user bg-c-pink"></i>
                                                <div class="d-inline">
                                                    <h4>Profile</h4>
                                                    <!-- <span>New file</span> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item">
                                                        <a href="index.php">
                                                        <i class="icofont icofont-home"></i>
                                                        </a>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="#!">Profile</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Page-header end -->
                                <!-- Page body start -->
                                <div class="page-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!-- Basic Form Inputs card start -->
                                            <div class="card">
                                                <div class="card-block">
                                                    <form enctype="multipart/form-data" method="POST" id="upload-file-form">
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-2 col-form-label">
                                                                Username
                                                            </label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="username" id="username" class="form-control" value="<?=$_SESSION['user']['name']?>">
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-2 col-form-label">
                                                                Password
                                                            </label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="password" id="password" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-2 col-form-label">
                                                                Password Confirmation
                                                            </label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="password_confirmation" id="password_confirmation" class="form-control">
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group row"> -->
                                                            <button class="btn btn-primary" type="button" onclick="updateProfile()">Update</button>
                                                        <!-- </div> -->
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div id="upload-result"></div>
                                        <!--  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php require_once __DIR__.'/includes/footer.php'; ?>
<script src="<?=$config['SERVER_URL']?>/assets/plugins/sweetalert/sweetalert2.js"></script>
<script>
    function updateProfile() {
        
        var username = $('#username');
        var password = $('#password');
        var password_confirmation = $('#password_confirmation');

        $.post(
            'process/update-profile.php',
            {
                username:username.val(),
                password:password.val(),
                password_confirmation:password_confirmation.val()
            }, function(data, textStatus, xhr) {
            
            if (data.status) {

                $('#current-user-name').text(username.val());
            }
        });
    }
</script>