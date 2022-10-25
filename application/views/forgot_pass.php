<div class="resetpw-card">
            <div class="profile-deets">
                <?= form_open('Employee/reset_password');?>
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