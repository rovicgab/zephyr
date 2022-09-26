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
                <a class="remove-btn" href="<?= site_url('Admin/remove_employee/') . $employee->id; ?>"><i class="fas fa-trash-alt" id="remove-icon"></i>Remove Employee</a>
            </div>
            
            <div class="detail-header">
                
                <img 
                    <?php if(isset($employee->emp_image)): ?>
                        class="emp-pic"
                        src="<?= base_url('./assets/employee_image/') . $employee->emp_image; ?>"
                        alt="employee pic"
                    <?php endif?>
                >
                <h4><?=$employee->emp_name; ?></h4>
                
            </div>

            

            <div class="detail-table-div">
                <table class="detail-table">
                    <thead>
                        <tr>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Employee Role</th>
                            <th scope="col">Direct Superior</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        <tr class="align-middle">
                            <td><?=$employee->emp_id; ?></td>
                            <td><?=ucfirst($employee->emp_role); ?></td>
                            <td><?=$employee->superior; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="transacted-div">
                <table class="transacted">
                    <thead>
                        <tr>
                            <th>List of Devices Transacted With</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Macbook Pro</td> <!-- Transaction to follow -->
                        </tr>
                        <tr>
                            <td>Meta Quest</td> <!-- Transaction to follow -->
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            
        </div>
</div>