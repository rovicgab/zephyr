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