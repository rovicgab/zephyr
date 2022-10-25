<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
</script>
<script>
    $(window).on("load resize ", function() {
        var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
        $('.tbl-header').css({'padding-right':scrollWidth});
    }).resize();
</script>
<script>
    $(document).ready(function(){
        $.ajax({
        url: "manage_users_up.php"
        }).done(function(data) {
        $('#manage_users').html(data);
        });
    setInterval(function(){
        $.ajax({
        url: "manage_users_up.php"
        }).done(function(data) {
        $('#manage_users').html(data);
        });
    },5000);
    });
</script>
<script>

    addUser = () => {
        //user Info
        var user_id = $('#user_id').val();
        var name = $('#name').val();
        var number = $('#number').val();
        var email = $('#email').val();
        //Additional Info
        var dev_uid = $('#dev_uid').val();
        var gender = $(".gender:checked").val();
        var dev_uid = $('#dev_sel option:selected').val();

        $.ajax({
            url: 'manage_users_conf.php',
            type: 'POST',
            data: {
                'Add': 1,
                'user_id': user_id,
                'name': name,
                'number': number,
                'email': email,
                'dev_uid': dev_uid,
                'gender': gender,
            },
            success: function(response){
                if (response == 1) {
                    $('#user_id').val('');
                    $('#name').val('');
                    $('#number').val('');
                    $('#email').val('');

                    $('#dev_sel').val('0');
                    $('.alert_user').fadeIn(500);
                    $('.alert_user').html('<p class="alert alert-success">A new User has been successfully added</p>');
                }
                else{
                    $('.alert_user').fadeIn(500);
                    $('.alert_user').html('<p class="alert alert-danger">'+ response + '</p>');
                }
        
                setTimeout(function () {
                    $('.alert').fadeOut(500);
                }, 5000);
                
                $.ajax({
                    url: "manage_users_up.php"
                    }).done(function(data) {
                    $('#manage_users').html(data);
                });
            }   
        });
    }

    updateUser = () => {
        //user Info
        var user_id = $('#user_id').val();
        var name = $('#name').val();
        var number = $('#number').val();
        var email = $('#email').val();
        //Additional Info
        var dev_uid = $('#dev_uid').val();
        var gender = $(".gender:checked").val();
        var dev_uid = $('#dev_sel option:selected').val();
        $.ajax({
                url: 'manage_users_conf.php',
                type: 'POST',
                data: {
                    'Update': 1,
                    'user_id': user_id,
                    'name': name,
                    'number': number,
                    'email': email,
                    'dev_uid': dev_uid,
                    'gender': gender,
                },
                success: function(response){
                    if (response == 1) {
                        $('#user_id').val('');
                        $('#name').val('');
                        $('#number').val('');
                        $('#email').val('');

                        $('#dev_sel').val('0');
                        $('.alert_user').fadeIn(500);
                        $('.alert_user').html('<p class="alert alert-success">The selected User has been updated!</p>');
                    }
                    else{
                        $('.alert_user').fadeIn(500);
                        $('.alert_user').html('<p class="alert alert-danger">'+ response + '</p>');
                    }
                    
                    setTimeout(function () {
                        $('.alert').fadeOut(500);
                    }, 5000);
                    
                    $.ajax({
                        url: "manage_users_up.php"
                        }).done(function(data) {
                        $('#manage_users').html(data);
                    });
                }
            });
    
    }

    deleteUser = () => {
        var user_id = $('#user_id').val();
        bootbox.confirm("Do you really want to delete this User?", function(result) {
        if(result){
            $.ajax({
            url: 'manage_users_conf.php',
            type: 'POST',
            data: {
                'delete': 1,
                'user_id': user_id,
            },
            success: function(response){
                if (response == 1) {
                    $('#user_id').val('');
                    $('#name').val('');
                    $('#number').val('');
                    $('#email').val('');
        
                    $('#dev_sel').val('0');
                    $('.alert_user').fadeIn(500);
                    $('.alert_user').html('<p class="alert alert-success">The selected User has been deleted!</p>');
                }else{
                    $('.alert_user').fadeIn(500);
                    $('.alert_user').html('<p class="alert alert-danger">'+ response + '</p>');
                }
                
                setTimeout(function () {
                    $('.alert').fadeOut(500);
                }, 5000);
                
                $.ajax({
                url: "manage_users_up.php"
                }).done(function(data) {
                $('#manage_users').html(data);
                });
            }
            });
        }
    }

    selectUser = () => {
        var el = this;
        var card_uid = $(this).attr("id");
        $.ajax({
            url: 'manage_users_conf.php',
            type: 'GET',
            data: {
            'select': 1,
            'card_uid': card_uid,
            }, 
            success: selectUserSuccess(response), 
            error : selectUserError(data)
        });
    }

    selectUserSuccess = (response) => {
        $(el).closest('tr').css('background','#70c276');

        $('.alert_user').fadeIn(500);
        $('.alert_user').html('<p class="alert alert-success">The card has been selected!</p>');
        
        setTimeout(function () {
            $('.alert').fadeOut(500);
        }, 5000);

        $.ajax({
            url: "manage_users_up.php"
            }).done(function(data) {
            $('#manage_users').html(data);
        });

        console.log(response);

        var user_id = {
            User_id : []
        };
        var user_name = {
            User_name : []
        };
        var user_on = {
            User_on : []
        };
        var user_email = {
            User_email : []
        };
        var user_dev = {
            User_dev : []
        };
        var user_gender = {
            User_gender : []
        };

        var len = response.length;

        for (var i = 0; i < len; i++) {
            user_id.User_id.push(response[i].id);
            user_name.User_name.push(response[i].username);
            user_on.User_on.push(response[i].serialnumber);
            user_email.User_email.push(response[i].email);
            user_dev.User_dev.push(response[i].device_uid);
            user_gender.User_gender.push(response[i].gender);
        }
        if (user_dev.User_dev == "All") {
            user_dev.User_dev = 0;
        }
        $('#user_id').val(user_id.User_id);
        $('#name').val(user_name.User_name);
        $('#number').val(user_on.User_on);
        $('#email').val(user_email.User_email);
        $('#dev_sel').val(user_dev.User_dev);

        if (user_gender.User_gender == 'Female'){
            $('.form-style-5').find(':radio[name=gender][value="Female"]').prop('checked', true);
        }
        else{
            $('.form-style-5').find(':radio[name=gender][value="Male"]').prop('checked', true);
        }
    }

    selectUserError = (data) => {
        console.log(data);
    }

    $(document).ready(function(){
        // Add user
        $(document).on('click', '.user_add', addUser());
        // Update user
        $(document).on('click', '.user_upd', updateUser());
        // delete user
        $(document).on('click', '.user_rmo', deleteUser());
    });
      // select user
    $(document).on('click', '.select_btn', selectUser());
</script>

<section class="main_container">
    
    <div class="register_container">
        
        <div class="login_box">
            <!-- FORM HERE -->
                <?= form_open_multipart('Admin/employee_registration'); ?>
                <p class="login_header">Employee Registration</p>
                    <?php if($this->session->has_userdata('success')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->userdata('success'); ?>
                            </div>
                    <?php endif; ?>
            <div class="row">
                <div class="col">
                    <label for="empid" class="register_label">Employee ID</label><br>
                    <input type="text" id="empid" name="empid"><br>
                    <span class="text-danger"><?= form_error('empid') ?></span>

                    <label for="empname" class="register_label">Employee Name</label><br>
                    <input type="text" id="empname" name="empname"><br>
                    <span class="text-danger"><?= form_error('empname') ?></span>

                    <label for="email" class="register_label">Employee Email</label><br>
                    <input type="text" id="email" name="email"><br>
                    <span class="text-danger"><?= form_error('email') ?></span>

                    <label for="superior" class="register_label">Direct Superior</label><br>
                    <input type="text" id="superior" name="superior"><br>
                    <span class="text-danger"><?= form_error('superior') ?></span>
                </div>

                <div class="col">
                    <label for="roles" class="register_label">Employee Role</label><br>
                    <select name="roles" id="roles">    
                        <option value="administrator">Administrator</option>
                        <option value="employee">Employee</option>
                        <option value="executive">Executive</option>
                    </select><br>
                    <span class="text-danger"><?= form_error('roles') ?></span>

                    <label for="init-pass" class="register_label">Initial Password</label><br>
                    <input type="password" id="init-pass" name="init-pass"><br>
                    <span class="text-danger"><?= form_error('init-pass') ?></span>

                    <label for="employee-image" class="register_label">Employee Image</label><br>
                    <input type="file" id="upload" name="employee_image" hidden/>
                        <label for="upload" class="upload-btn">Upload image </label>
                        <span class="text-danger" id="file-chosen"><?= form_error('employee_image') ?></span>
                </div>
            </div>
            
            
                
                
            <div class="reg-div">
                <input type="submit" class="all_btn" id="reg-emp" name="reg-emp" value="REGISTER EMPLOYEE">
            </div>
                
            <?= form_close(); ?>
        </div>
    
    </div> 


<!-- from rfidattendance -->
  	<link rel = "icon" href ="css/assets/c8.jpg" type = "image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/manageusers.css">


	<!-- <h1 class="slideInDown animated">MANAGE USERS</h1> -->
	<div>
		<form enctype="multipart/form-data">
			<div class="alert_user"></div>
			<fieldset>
				<legend><span class="number">1</span> User Info</legend>
				<input type="hidden" name="user_id" id="user_id">
				<input type="text" name="name" id="name" placeholder="Username">
				<input type="text" name="number" id="number" placeholder="Serial Number">
				<input type="email" name="email" id="email" placeholder="Email">
			</fieldset>
			<fieldset>
			<legend><span class="number">2</span> Additional Info</legend>
			<label>
				<label for="Device"><b>User Department:</b></label>
                    <select class="dev_sel" name="dev_sel" id="dev_sel" style="color: #000;">
                      <option value="0">All Departments</option>
                      <?php
                        require'connectDB.php';
                        $sql = "SELECT * FROM devices ORDER BY device_name ASC";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo '<p class="error">SQL Error</p>';
                        } 
                        else{
                            mysqli_stmt_execute($result);
                            $resultl = mysqli_stmt_get_result($result);
                            while ($row = mysqli_fetch_assoc($resultl)){
                      ?>
                              <option value="<?php echo $row['device_uid'];?>"><?php echo $row['device_dep']; ?></option>
                      <?php
                            }
                        }
                      ?>
                    </select>
				<input type="radio" name="gender" class="gender" value="Female"> Female
	          	<input type="radio" name="gender" class="gender" value="Male" checked="checked"> Male
	      	</label >
			</fieldset>
			<button type="button" name="user_add" class="user_add">Add User</button>
			<button type="button" name="user_upd" class="user_upd">Update User</button>
			<button type="button" name="user_rmo" class="user_rmo">Remove User</button>
		</form>
	</div>

	<!--User table-->
	<div class="section">
		
		<div class="slideInRight animated">
			<div id="manage_users"></div>
		</div>
	</div>
</section>
