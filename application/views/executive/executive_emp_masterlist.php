<div class="user-container">

    <h1 class="page-title"><b>View Employee Masterlist</b></h1>
    <span class="user-count"><?= $total; ?> Users</span>

    <div class="searchContainer">
        <div class="search-box">
            <?= form_open_multipart('Executive/searchEmp');?>
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
                                src="<?= base_url('./assets/users_image/') . $employee->emp_image; ?>"
                                alt="employee pic"
                            <?php endif?>
                        >
                    </td>
                    <td class="emp-name-bold"><?=$employee->emp_name; ?></td>
                    <td><?=$employee->emp_id; ?></td>
                    <td><?=ucfirst($employee->emp_role); ?></td>
                    <td><?=$employee->superior; ?></td>
        
                    <td>
                        <a href="<?= site_url('Executive/employee_view/') . $employee->id; ?>"><i class="fa fa-solid fa-eye"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
 
        </tbody>
    </table>

    <?= $this->pagination->create_links() ?>
</div>
