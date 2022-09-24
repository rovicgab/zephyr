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
    
    </form>
        
</nav>

<script>
    let click = document.querySelector('.regbtn');
    let list = document.querySelector('.list');
    click.addEventListener("click", ()=> {
        list.classList.toggle('newList');
    });
</script>

<div class="user-container">

    <h1 class="page-title"><b>View Device Masterlist</b></h1>
    <span class="user-count"><?= $total; ?> Devices</span>

    <div class="searchContainer">
        <div class="search-box">
        <?= form_open_multipart('Admin/searchDev');?>
            <div class="search">
            <input type="text" class="searchTerm" name="searchTerm" placeholder="Search for a device...">
            <button type="submit" class="searchButton" name="search">
                <i class="fa fa-search"></i>
            </button>
            </div>
        </div>

        <div class="searchFilters">
            <!-- <label for="device-model">Device Model</label> -->
            <select name="device-model" id="device-model" class="filterGroup">
                <option value="#">Device Model</option>
                <option value="Laptop">Laptop</option>
                <option value="Gateway">Gateway</option>
                <option value="Smartphone">Smartphone</option>
                </select>
        

            <!-- <label for="manufacturer">Manufacturer</label> -->
            <select name="manufacturer" id="manufacturer" class="filterGroup">
                <option value="#">Manufacturer</option>
                <option value="Laptop">Apple</option>
                <option value="Gateway">Dell</option>
                <option value="Smartphone">Lenovo</option>
                </select>
        

        
            <!-- <label for="status">Status</label> -->
            <select name="status" id="status" class="filterGroup">
                <option value="#">Status</option>
                <option value="Available">Available</option>
                <option value="Reserved">Reserved</option>
                <option value="Removed">Removed</option>
                </select>

                <a href="<?= site_url('Admin/dev_masterlist_view')?>"><u>Clear All</u></a>
        </div>

        <?= form_close();?>
    </div>
        

    <table class="table">
        <thead>
            <tr class="user-details">
                <th scope="col"></th>
                <th scope="col">Device Name</th>
                <th scope="col">Device Model</th>
                <th scope="col">Manufacturer</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>             
            </tr>
        </thead>

        <!--placed a placeholder so it can easily be identified and replaced with php function-->
        <tbody>
            <?php foreach($devices as $device): ?>
                <tr class="align-middle">
                    <td>
                        <img
                            <?php if(isset($device->dev_image)): ?>
                                class="device-pic"
                                src="<?= base_url('./assets/device_image/') . $device->dev_image; ?>"
                                alt="device-pic"
                            <?php endif?>
                        >
                    </td>
                    <td class="emp-name-bold"><?= $device->dev_name;?></td>
                    <td><?= $device->dev_model;?></td>
                    <td><?=$device->manufacturer; ?></td>
                    <td><?=$device->cur_status; ?></td>
        
                    <td>
                        <a href="<?= site_url('Admin/device_view/') . $device->id; ?>"><i class="fa fa-solid fa-eye"></i></a>
                        <a href="<?= site_url('Admin/editDev_view/') . $device->id; ?>"><i class="fas fa-edit" id="edit-btn"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>  

        </tbody>
    </table>

    <?= $this->pagination->create_links() ?>
</div>
