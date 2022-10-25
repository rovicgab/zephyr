<section class="main_container">
        
    <div class="register_container">
        
        <div class="login_box">
            <!-- FORM HERE -->
            <?= form_open_multipart('Admin/device_registration'); ?>    
                <p class="login_header">Device Registration</p>
                    <?php if($this->session->has_userdata('success')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->userdata('success'); ?>
                            </div>
                    <?php endif; ?> 
                <div class="row">
                    <div class="col">
                        <label for="uniquenum" class="register_label">Device Unique Number</label><br>
                        <input type="text" id="uniquenum" name="uniquenum"><br>
                        <span class="text-danger"><?= form_error('uniquenum') ?></span>
            
                        <label for="devicename" class="register_label">Device Name</label><br>
                        <input type="text" id="devicename" name="devicename"><br>
                        <span class="text-danger"><?= form_error('devicename') ?></span>
                    
                        <label for="model" class="register_label">Device Model</label><br>
                        <input type="text" id="model" name="model"><br>
                        <span class="text-danger"><?= form_error('model') ?></span>
                    
                        <label for="roles" class="register_label">Allowed Roles</label><br>
                        <select name="roles" id="roles">
                            <option value="Administrator">Administrator</option>
                            <option value="Employee">Employee</option>
                            <option value="Executive">Executive</option>
                        </select><br>
                        <span class="text-danger"><?= form_error('roles') ?></span>        

                    </div>
                    
                    <div class="col">
                        <label for="manuf" class="register_label">Manufacturer</label><br>
                        <input type="text" id="manuf" name="manuf"><br>
                        <span class="text-danger"><?= form_error('manuf') ?></span>
                    
                        <label for="specs" class="register_label">Specifications</label><br>
                        <textarea rows="1" cols="50" wrap="physical" id="specs" name="specs"></textarea><br>
                        <span class="text-danger"><?= form_error('specs') ?></span>
                
                        <label for="emp-img" class="register_label">Device Image</label><br>
                        <input type="file" id="upload" name="device_image" hidden/>
                            <label for="upload" class="upload-btn">Upload image </label>
                            <span class="text-danger" id="file-chosen"><?= form_error('device_image') ?></span>
                    </div>

                </div>

                <div class="reg-div">
                    <input type="submit" class="all_btn" id="reg-dev" name ="reg-dev" value="REGISTER DEVICE">
                </div>
                
            <?= form_close(); ?>
        </div>
        
    </div>    

    
</section>
