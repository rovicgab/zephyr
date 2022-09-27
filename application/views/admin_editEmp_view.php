<nav>
    <div class="logo"><img src="<?= base_url('./assets/pictures/calibr8logo.jpg');?>" alt="Calibr8 Logo" height="30px"></div>
    <a class="nav-link" href="#">Dashboard</a>
    <a class="nav-link" href="<?= site_url('Admin/emp_masterlist_view')?>" id="activebtn">View</a>
    <a class="nav-link" href="#">Edit</a>
    <a class="nav-link" href="#">Reservation</a>
    <a class="nav-link" href="#">Generate Reports</a>
    </div>
    <div class="dropdown">
        <a href="#" class="regbtn">Registration</a>
        <div class="list">
            <a href="<?= site_url('Admin/devReg_view')?>" class="links">Device Registration</a>
            <a href="<?= site_url('Admin/empReg_view')?>" class="links">Employee Registration</a>
        </div>
    </div>
    <a class="nav-link" href="<?= site_url('Login/logout')?>">Logout</a> <!-- Temporary only -->

    <a href="#" class="ts"><i class="far fa-user" id="nav-user-icon"></i>Admin</a>
    
    </form>
    
</nav>

<script>
    let click = document.querySelector('.regbtn');
    let list = document.querySelector('.list');
    click.addEventListener("click", ()=> {
        list.classList.toggle('newList');
    });
</script>

<section class="main_container">
    
    <div class="register_container">
        
        <div class="login_box">
            <!-- FORM HERE -->
            <?= form_open_multipart('Admin/editEmp_details/'); ?>
                <p class="login_header">Edit Employee Details</p>
                    <?php if($this->session->has_userdata('success')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->userdata('success'); ?>
                            </div>
                    <?php endif; ?>
                <div class="row">
                    <div class="col">
                        <input type="hidden" id="emp-id" name="emp-id" value="<?= $employee->id; ?>">    

                        <label for="empname" class="register_label">Employee Name</label><br>
                        <input type="text" id="empname" name="empname" value="<?= $employee->emp_name;?>"><br>
                        <span class="text-danger"><?= form_error('empname') ?></span>

                        <label for="roles" class="register_label">Employee Roles</label><br>
                        <select name="roles" id="roles">
                            <option value="administrator">Administrator</option>
                            <option value="employee">Employee</option>
                            <option value="executive">Executive</option>
                        </select><br>
                        <span class="text-danger"><?= form_error('roles') ?></span>  

                    </div>

                    <div class="col">

                        <label for="rfid" class="register_label">RFID</label><br>
                        <input type="text" id="rfid" name="rfid"><br>
                        <span class="text-danger"><?= form_error('rfid') ?></span>

                        <label for="employee_image" class="register_label">Employee Image</label><br>
                        <input type="file" id="upload" name="employee_image" hidden/>
                            <label for="upload" class="upload-btn">Upload image </label>
                            <span class="text-danger" id="file-chosen"><?= form_error('employee_image') ?></span>
                    </div>
                    

                </div>

                <div class="save-cancel-div">
                    <input type="submit" class="all_btn" id="cancel-btn" name="cancel-btn" value="Cancel">
                    <input type="submit" class="all_btn" id="reg-dev" name="reg-dev" value="Save Changes">
                </div>
                
            <?= form_close();?>
        </div>
        
    </div>    

    
</section>