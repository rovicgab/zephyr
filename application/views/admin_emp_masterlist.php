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

<div class="user-container">

    <h1 class="page-title"><b>View Employee Masterlist</b></h1>
    <span class="user-count"><?= $total; ?> Users</span>

    <div class="searchContainer">
        <div class="search-box">
            <?= form_open_multipart('Admin/searchEmp');?>
                <div class="search">    
                    <input type="text" class="searchTerm" name="searchTerm" placeholder="Search for an employee...">
                    <button type="submit" class="searchButton" name="search">
                        <i class="fa fa-search"></i>
                    </button>
                    <!-- Include a clear button for search function -->
                </div>
            <?= form_close();?>
        </div>
    </div>
        

    <table id="datatable" class="table">
        <thead>
            <tr class="user-details">
                <th scope="col"></th>
                <th scope="col">Name</th>
                <th scope="col">ID</th>
                <th scope="col">Role</th>
                <th scope="col">Direct Superior</th>
                <th scope="col">Actions</th>             
            </tr>
        </thead>

        <!--placed a placeholder so it can easily be identified and replaced with php function-->
        <tbody>
            <?php foreach($employees as $employee): ?>
                <tr class="align-middle">
                    <td>
                        <img
                            <?php if(isset($employee->emp_image)): ?>
                                class="emp-pic"
                                src="<?= base_url('./assets/employee_image/') . $employee->emp_image; ?>"
                                alt="employee pic"
                            <?php endif?>
                        >
                    </td>
                    <td class="emp-name-bold"><?=$employee->emp_name; ?></td>
                    <td><?=$employee->emp_id; ?></td>
                    <td><?=ucfirst($employee->emp_role); ?></td>
                    <td><?=$employee->superior; ?></td>
        
                    <td>
                        <a href="<?= site_url('Admin/employee_view/') . $employee->id; ?>"><i class="fa fa-solid fa-eye"></i></a>
                        <a href="<?= site_url('Admin/editEmp_view/') . $employee->id;?>"><i class="fas fa-edit" id="edit-btn"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
 
        </tbody>
    </table>

    <?= $this->pagination->create_links() ?>
</div>
