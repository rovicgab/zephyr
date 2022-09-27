   <nav>
    <div class="logo"><img src="<?= base_url('./assets/pictures/calibr8logo.jpg');?>" alt="Calibr8 Logo" height="30px"></div>
    <a class="nav-link" href="<?= site_url('Employee/index')?>">View</a>
    <a class="nav-link" href="#" id="activebtn">Reservation</a>

    <a class="nav-link" href="<?= site_url('Login/logout')?>">Logout</a> <!-- Temporary only -->

    <a href="#" class="ts"><i class="far fa-user" id="nav-user-icon"></i>Employee</a>


</nav>

<div class="user-container">

    <h1 class="page-title"><b>Borrowable Device List</b></h1>
    <span class="device-count">189 devices</span>

    <div class="searchContainer">
        <div class="search-box">
            <div class="search">
            <input type="text" class="searchTerm" placeholder="Search for a device...">
            <button type="submit" class="searchButton">
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
        
<!--            
            <label for="manufacturer">Manufacturer</label> -->
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

                <a href="#"><u>Clear All</u></a>
        </div>

    
    </div>
    
    <section class="main_container">
        
        <div class="reservation_container">
            <div class="item-row">
                <div class="item-pic">
                    <img src="assets/pictures/lenovo.png" alt="Lenovo Laptop">
                    <div class="item-desc">
                        <h6>Lenovo Thinkpad X1</h6>
                        <h6>Status: Available</h6>
                        <h6>Stock: 2</h6>
                    </div>
                </div>
    
                <div class="item-btn">
                    <input type="submit" class="all_btn" id="reserve_btn" value="Borrow Device">
                </div>  
            </div>

            <div class="item-row">
                <div class="item-pic">
                    <img src="assets/pictures/lenovo.png" alt="Lenovo Laptop">
                    <div class="item-desc">
                        <h6>Lenovo Thinkpad X1</h6>
                        <h6>Status: Available</h6>
                        <h6>Stock: 2</h6>
                    </div>
                </div>
    
                <div class="item-btn">
                    <input type="submit" class="all_btn" id="reserve_btn" value="Borrow Device">
                </div>  
            </div>

            <div class="item-row">
                <div class="item-pic">
                    <img src="assets/pictures/lenovo.png" alt="Lenovo Laptop">
                    <div class="item-desc">
                        <h6>Lenovo Thinkpad X1</h6>
                        <h6>Status: Available</h6>
                        <h6>Stock: 2</h6>
                    </div>
                </div>
    
                <div class="item-btn">
                    <input type="submit" class="all_btn" id="reserve_btn" value="Borrow Device">
                </div>  
            </div>
        </div> 

</div>



    
</section>