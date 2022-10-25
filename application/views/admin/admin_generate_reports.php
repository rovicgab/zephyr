
<script>
    let click = document.querySelector('.regbtn');
    let list = document.querySelector('.list');
    click.addEventListener("click", ()=> {
        list.classList.toggle('newList');
    });
</script>

<div class="user-container">

    <h1 class="page-title"><b>Generate Reports</b></h1>

    <div class="report-picker">

        <div class="calendar">
            <label for="reservation-date">Start Date</label><br>
            <input type="date" id="reservation-date" class="date-picker" name="reservation-date">
        </div>

        <div class="calendar">
            <label for="reservation-date">End Date</label><br>
            <input type="date" id="reservation-date" class="date-picker" name="reservation-date">
        </div>

        

    </div>

    <div class="generate-btn-div">
        <button class="generate-btn">GENERATE REPORT</button>
    </div>


</div>
