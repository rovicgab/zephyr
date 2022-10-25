
<div class="user-container">

    <h1 class="page-title"><b>Borrowable Device List</b></h1>
    <span class="device-count"><?= $total; ?> devices</span>

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
            <?php foreach ($stocks as $stock) : ?>
                <div class="item-row">
                    <div class="item-pic">
                        <img src="assets/pictures/lenovo.png" alt="device-pic">
                        <div class="item-desc">
                            <h6><?= $stock->dev_name; ?></h6>
                            <h6>Status: <?= $stock->cur_status; ?></h6>
                            <h6>Stock: <?= $stock->stock; ?></h6>
                        </div>
                    </div>

                    <div class="item-btn">
                        <a href="<?= site_url('Employee/reserveDev/') . $stock->dev_name; ?>">
                            <input type="submit" class="all_btn" id="reserve_btn" value="Borrow Device">
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <?= $this->pagination->create_links() ?>
</div>