<nav>
    <div class="logo"><img src="<?= base_url('./assets/pictures/calibr8logo.jpg');?>" alt="Calibr8 Logo" height="30px"></div>
    <a class="nav-link" href="#">Dashboard</a>
    <a class="nav-link" href="<?= site_url('Admin/dev_masterlist_view')?>" id="activebtn">View</a>
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
    
    
</nav>

<script>
    let click = document.querySelector('.regbtn');
    let list = document.querySelector('.list');
    click.addEventListener("click", ()=> {
        list.classList.toggle('newList');
    });
</script>

<div class="view-emp-container">
    <h1 class="page-title"><b>View Employee Details</b></h1>

        <div class="detail-container">
            <div class="remove-btn-div">
                <a class="remove-btn" href="<?= site_url('Admin/remove_device/') . $device->id; ?>"><i class="fas fa-trash-alt" id="remove-icon"></i>Remove Device</a>
            </div>
            
            <div class="detail-header">
                <img 
                    <?php if(isset($device->dev_image)): ?>
                        class="device-pic"
                        src="<?= base_url('./assets/device_image/') . $device->dev_image; ?>"
                        alt="device pic"
                    <?php endif?>
                >
                <h4><?= $device->dev_name; ?></h4>
                
            </div>

            

            <div class="detail-table-div">
                <table class="detail-table">
                    <thead>
                        <tr>
                            <th scope="col">Device Unique ID</th>
                            <th scope="col">Device Model</th>
                            <th scope="col">Manufacturer</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        <tr class="align-middle">
                            <td><?= $device->unique_num; ?></td>
                            <td><?= $device->dev_model; ?></td>
                            <td><?= $device->manufacturer; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="spec-role-flex">
                <div class="specifications">
                    <table class="transacted">
                        <thead>
                            <tr>
                                <th>Specifications</th>
                            </tr>
                        </thead>
    
                        <tbody>
                            <tr>
                                <td><?= $device->specs; ?></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <div class="all-roles-div">
                    <table class="transacted">
                        <thead>
                            <tr>
                                <th>Allowed Roles</th>
                            </tr>
                        </thead>
    
                        <tbody>
                            <tr>
                                <td><?= $device->allowed_roles; ?></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="statuses-table">
                <table class="detail-table">
                    <thead>
                        <tr>
                            <th scope="col">Current Status</th>
                            <th scope="col">Previous Device Status</th> 
                        </tr>
                    </thead>
    
                    <tbody>
                        <tr>
                            <td><?= $device->cur_status; ?></td> 
                            <td><?= $device->prev_status; ?></td> 
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
</div>