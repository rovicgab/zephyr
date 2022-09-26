<nav>
    <div class="logo"><img src="assets/pictures/calibr8logo.jpg" alt="Calibr8 Logo" height="30px"></div>
    <a class="nav-link" href="#">Dashboard</a>
    <a class="nav-link" href="#" id="activebtn">View</a>
    <a class="nav-link" href="#">Edit</a>
    <a class="nav-link" href="#">Reservation</a>
    <a class="nav-link" href="#">Generate Reports</a>
    </div>
    <div class="dropdown">
        <a href="#" class="regbtn">Registration</a>
        <div class="list">
            <a href="device_register.html" class="links">Device Registration</a>
            <a href="employee_register.html" class="links">Employee Registration</a>
        </div>
    </div>
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

    <h1 class="page-title"><b>View Live System Logs</b></h1>
        

    <table class="table">
        <thead>
            <tr class="user-details">
                <th scope="col">Transactions</th>
                <th scope="col">Timestamp</th>            
            </tr>
        </thead>

        <!--placed a placeholder so it can easily be identified and replaced with php function-->
        <tbody>
                <tr class="align-middle">
                
                    <td class="emp-name-bold">Lenovo Thinkpad X1 borrowed by Andrea Blancaflor</td>
                    <td>12:34:56 | 07/16/2022 </td>
                </tr>

                <tr class="align-middle">
                
                    <td class="emp-name-bold">Macbook Pro borrowed by Elaine Enricoso</td>
                    <td>12:34:56 | 07/16/2022 </td>
                </tr>

                <tr class="align-middle">
                
                    <td class="emp-name-bold">Dell Gateway returned by John Michael Reyes</td>
                    <td>12:34:56 | 07/16/2022 </td>
                </tr>
        </tbody>
    </table>
</div>