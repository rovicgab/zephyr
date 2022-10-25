
<h1 class="page-title"><b>My Profile</b></h1>

<div class="p-main-container">
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-deets">
                <img src="<?= base_url('./assets/users_image/' . $executive->emp_image); ?>" alt="profile picture" class="prof-pic">  
                <h4 class="profile-name"><?= $executive->emp_name; ?></h4>
                <div class="profile-details">
                    <div class="detail-table-div">
                        <table class="detail-table">
                            <thead>
                                <tr>
                                    <th scope="col">Employee ID</th>
                                    <th scope="col">Employee</th>
                                    <th scope="col">Direct Superior</th>
                                </tr>
                            </thead>
            
                            <tbody>
                                <tr class="align-middle">
                                    <td><?= $executive->emp_id; ?></td>
                                    <td><?= ucfirst($executive->emp_role); ?></td>
                                    <td><?= $executive->superior; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
        
                </div>
            </div>

            <div class="logout-btn-div">
                <a href="<?= site_url('Login/logout')?>">
                    <button id="logout-btn">Logout</button>
                </a>
            </div>
        </div>

        <div class="resetpw-card">
            <div class="profile-deets">
                <?= form_open('Executive/reset_password');?>
                <h4 class="resetpw-h4" style="text-align: center; font-weight: 700;">Reset Password</h4>
                    <?php if($this->session->has_userdata('success')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->userdata('success'); ?>
                            </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="oldPass">Current Password</label>
                        <input type="password" class="form-control" id="oldPass" name="oldPass" placeholder="Enter your current password">
                        <span class="text-danger"><?= form_error('oldPass'); ?></span>

                        <label for="newPass">New Password</label>
                        <input type="password" class="form-control" id="newPass" name="newPass" placeholder="Enter your new password">
                        <span class="text-danger"><?= form_error('newPass'); ?></span>

                        <label for="confNewPass">Confirm New Password</label>
                        <input type="password" class="form-control" id="confNewPass" name="confNewPass" placeholder="Confirm your new password">
                        <span class="text-danger"><?= form_error('confNewPass'); ?></span>
                    </div>

                    <div class="btn-div">
                        <input type="submit" id="reset-btn" name="reset-btn" value="Reset Password">
                    </div> 
                <?= form_close(); ?>      
            </div>
        </div>
    </div>
</div>