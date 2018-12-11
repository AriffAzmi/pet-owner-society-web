<?php
    require_once __DIR__.'/includes/header.php';
    ?>
<link rel="stylesheet" href="<?=$config['SERVER_URL']?>/assets/plugins/sweetalert/sweetalert2.css">
<link rel="stylesheet" href="<?=$config['SERVER_URL']?>/assets/css/timeline.css">
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
                                                <i class="icofont icofont-rss-feed bg-c-blue"></i>
                                                <div class="d-inline">
                                                    <h4>Pets Activity Stream</h4>
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
                                            <div class="card">
                                                <div class="card-block">
                                                    <form id="new-stream-form" enctype="multipart/form-data">
                                                        <input type="hidden" name="t" value="<?=$_SESSION['user']['token']?>">
                                                        <h5>How's your pet doing today ?</h5>
                                                        <hr>
                                                        <div class="alert alert-danger" id="err-div" style="display: none;">
                                                        </div>
                                                        <div class="alert alert-success" id="success-div" style="display: none;">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Title</label>
                                                            <input type="text" class="form-control" id="title" name="title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                                                        </div>

                                                        <input type="file" id="images" name="images" accept="image/x-png.image/jpeg" style="display: none;">

                                                        <div class="text-right m-t-20">
                                                            <a href="#" id="add-image-btn" onclick="triggerImageUpload()" class="btn btn-primary waves-effect waves-light"><i class="icofont icofont-image"></i> Add image</a>
                                                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="addNewStream()">Post</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div id="stream-response"></div>
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
    $.ajax({
        url: '<?=$config['API_ENDPOINT']?>/streams',
        type: 'GET',
        data: {
            t: "<?=$_SESSION['user']['token']?>"
        }
    })
    .done(function(response) {
        
        console.log(response);
        var stream_html_element = '';

        if (response.data.length > 0) {

            $.each(response.data, function(index, obj) {
                
                stream_html_element+=''+
                '<div class="card">\
                    <div class="card-block post-timelines">\
                        <div class="chat-header f-w-600">'+obj.post_by+'</div>\
                        <div class="social-time text-muted">'+obj.updated_at+'</div>\
                    </div>\
                    <div class="card-block">\
                        <div class="timeline-details">\
                            <div class="chat-header">\
                            <img src="'+obj.photo_path+'" class="img-responsive" alt="" style="width:30%;">\
                            </div>\
                            <p class="">'+obj.description+'</p>\
                        </div>\
                    </div>\
                </div>';
            });

            $('#stream-response').html(stream_html_element);
        }
    })
    .fail(function() {
        console.log("error");
    });

    $('#images').change(function(event) {
        
        $('#add-image-btn').html("<i class='icofont icofont-image'></i>"+($(this)[0].files.length > 0 ? "("+$(this)[0].files.length+")" : "")+" Add image");
    });
    
    $('#new-stream-form').submit(function(event) {
        
        event.preventDefault();

        var formData;

        if ($('#images')[0].files.length > 0) {
            
            formData = new FormData($(this)[0]);

            $.ajax({
                url: '<?=$config['API_ENDPOINT']?>/stream',
                type: 'POST',
                headers: {
                    "X-SECURE-TOKEN" : "<?=$_SESSION['user']['token']?>"
                },
                data: formData,
                contentType:false,
                processData:false
            })
            .done(function(response) {

                $('#err-div').hide('slow');
                $('#success-div').html(response.message);
                $('#success-div').show('slow');
            })
            .fail(function(err) {

                $('#success-div').hide('slow');
                var err_lists = '<ul>';

                $.each(err.responseJSON.errors, function(index, val) {
                    err_lists+="<li>- "+val+"</li>";
                });
                err_lists+="</ul>";

                var err_title = '<h5>'+err.responseJSON.message+'</h5>';
                var err_element = err_title+""+err_lists;

                $('#err-div').html(err_element);
                $('#err-div').show('slow');

            });
        }
        else {

            formData = {
                "title":$('#title').val(),
                "description":$('#description').val()
            };

            $.ajax({
                url: '<?=$config['API_ENDPOINT']?>/stream',
                type: 'POST',
                headers: {
                    "X-SECURE-TOKEN" : "<?=$_SESSION['user']['token']?>"
                },
                data: formData
            })
            .done(function(response) {

                $('#err-div').hide('slow');
                $('#success-div').html(response.message);
                $('#success-div').show('slow');
            })
            .fail(function(err) {

                $('#success-div').hide('slow');
                var err_lists = '<ul>';

                $.each(err.responseJSON.errors, function(index, val) {
                    err_lists+="<li>- "+val+"</li>";
                });
                err_lists+="</ul>";

                var err_title = '<h5>'+err.responseJSON.message+'</h5>';
                var err_element = err_title+""+err_lists;

                $('#err-div').html(err_element);
                $('#err-div').show('slow');

            });
        }
    });

    function triggerImageUpload() {
        
        $('#images').trigger('click');
    }

    function addNewStream() {
        
        $('#new-stream-form').submit();
    }
</script>