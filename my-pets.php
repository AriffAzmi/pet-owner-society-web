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
                                                <i class="icofont icofont-animal-paw bg-c-pink"></i>
                                                <div class="d-inline">
                                                    <h4>My Pets</h4>
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
                                                    <li class="breadcrumb-item"><a href="#!">My Pets</a>
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
                                                <div class="card-header">
                                                    <!-- <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span> -->
                                                    <div class="card-header-right"><i
                                                        class="icofont icofont-spinner-alt-5"></i>
                                                    </div>
                                                    <div class="card-header-right">
                                                        <i class="icofont icofont-spinner-alt-5"></i>
                                                    </div>
                                                </div>
                                                <div class="card-block">
                                                    <button class="btn btn-info" type="button" data-toggle="modal" data-target="#add-new-pet-modal">Add new Pet</button>
                                                    <table class="table table-bordered" style="margin-top: 3%;">
                                                        <caption id="total-pets-description"></caption>
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Type</th>
                                                                <th>Quantity</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="cat-lists">
                                                        </tbody>
                                                    </table>
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
<div class="modal" tabindex="-1" role="dialog" id="add-new-pet-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pet Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="alert alert-danger" id="err-div" style="display: none;">
                    </div>
                    <div class="alert alert-success" id="success-div" style="display: none;">
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-10">
                            <select name="type" id="type" class="form-control">
                                <option value="1">
                                    Bats
                                </option>
                                <option value="2">
                                    Cats
                                </option>
                                <option value="3">
                                    Dog
                                </option>
                                <option value="4">
                                    Elephants
                                </option>
                                <option value="5">
                                    Giraffes
                                </option>
                                <option value="6">
                                    Horses
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Colour</label>
                        <div class="col-sm-10">
                            <select name="colour" id="colour" class="form-control">
                                <option value="1">
                                    Black
                                </option>
                                <option value="2">
                                    Yellow
                                </option>
                                <option value="3">
                                    Green
                                </option>
                                <option value="4">
                                    White
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="quantity" name="quantity">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="add-or-update-pet" onclick="addNewPet()">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__.'/includes/footer.php'; ?>
<script src="<?=$config['SERVER_URL']?>/assets/plugins/sweetalert/sweetalert2.js"></script>
<script>
    
    getListPets();
    
    function getListPets() {
        
        $.ajax({
            url: '<?=$config['API_ENDPOINT']?>/pets',
            type: 'GET',
            data: {
                t : "<?=$_SESSION['user']['token']?>"
            }
        })
        .done(function(response) {

            if (response.data.length == 0) {

                $('#total-pets-description').html("You have 0 total pets");
                $('#cat-lists').html("\
                    <tr>\
                        <td colspan='3'><center>"+response.message+"</center></td>\
                    </tr>\
                ");
            }
            else {

                var total_pet = 0;
                var list_pets = '';

                var c = 0;
                $.each(response.data, function(index, obj) {
                    
                    c++;
                    total_pet = obj.qty+total_pet;
                    list_pets+="\
                    <tr id='pet-row-"+obj.id+"'>\
                        <td>"+c+"</td>\
                        <td>"+obj.type+"</td>\
                        <td>"+obj.qty+"</td>\
                        <td><button type='button' onclick='showUpdatePetForm("+obj.id+")' class='btn btn-info'>Update</button><button type='button' onclick='deletePet("+obj.id+")' class='btn btn-danger'>Remove</button></td>\
                    </tr>\
                    ";
                });

                $('#total-pets-description').html("You have "+total_pet+" total pets");
                $('#cat-lists').html(list_pets);
            }
        })
        .fail(function(err) {
            // body...
        });
    }

    function addNewPet() {
        
        var pet_type = $('#type');
        var pet_colour = $('#colour');
        var pet_quantity = $('#quantity');

        $.ajax({
            url: '<?=$config['API_ENDPOINT']?>/pet',
            type: 'POST',
            data: {
                t: "<?=$_SESSION['user']['token']?>",
                type: pet_type.val(),
                colour: pet_colour.val(),
                quantity: pet_quantity.val()
            }
        })
        .done(function(response) {
            
            $('#err-div').hide('slow');
            $('#success-div').html(response.message);
            $('#success-div').show('slow');
            getListPets();

            setTimeout(function() {

                $('#success-div').hide('slow');
                $('#add-new-pet-modal').modal('hide');

            },2000)
        })
        .fail(function(err) {
            
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

    function showUpdatePetForm(id) {
        
        $('#add-new-pet-modal').modal('show');

        $.ajax({
            url: '<?=$config['API_ENDPOINT']?>/pet/'+id,
            type: 'GET',
            data: {
                t: "<?=$_SESSION['user']['token']?>"
            }
        })
        .done(function(response) {

            var pet_type = $('#type');
            var pet_colour = $('#colour');
            var pet_quantity = $('#quantity');

            pet_type.val(response.data.type);
            pet_colour.val(response.data.colour);
            pet_quantity.val(response.data.qty);

            $('#add-or-update-pet').removeAttr('onclick');
            $('#add-or-update-pet').attr('onclick','updatePet('+id+')');
        })
        .fail(function(err) {
            
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

    function updatePet(id) {
        
        var pet_type = $('#type');
        var pet_colour = $('#colour');
        var pet_quantity = $('#quantity');

        $.ajax({
            url: '<?=$config['API_ENDPOINT']?>/pet/'+id+'/update',
            type: 'PUT',
            data: {
                t: "<?=$_SESSION['user']['token']?>",
                type: pet_type.val(),
                colour: pet_colour.val(),
                quantity: pet_quantity.val()
            }
        })
        .done(function(response) {
            
            $('#err-div').hide('slow');
            $('#success-div').html(response.message);
            $('#success-div').show('slow');
            getListPets();

            setTimeout(function() {

                $('#success-div').hide('slow');
                $('#add-new-pet-modal').modal('hide');

            },2000)
        })
        .fail(function(err) {
            
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

    function deletePet(id) {
        
        $.ajax({
            url: '<?=$config['API_ENDPOINT']?>/pet/'+id+'/delete',
            type: 'DELETE',
            data: {
                t: "<?=$_SESSION['user']['token']?>"
            }
        })
        .done(function(response) {
            
            getListPets();
        })
        .fail(function(err) {
            // body...
        });
    }
</script>