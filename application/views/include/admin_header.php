<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('.assets/style.css'); ?>">
    <link rel="icon" href="<?= base_url('.assets/pictures/c8.jpg'); ?>" type = "image/x-icon">
    <title><?= $title ?></title>
</head>

<nav>
    <div class="logo"><img src="<?= base_url('./assets/pictures/calibr8logo.jpg'); ?>" alt="Calibr8 Logo" height="30px"></div>
    <a class="nav-link" href="<?= site_url('Admin') ?>" id="activebtn">Dashboard</a>
    <div class="dropdown">
        <a href="<?= site_url('Admin/devApproval_view') ?>" class="regbtn">View</a>
        <div class="list">
            <a href="<?= site_url('Admin/dev_masterlist_view') ?>" class="links">Device Masterlist</a>
            <a href="<?= site_url('Admin/emp_masterlist_view') ?>" class="links">Employee Masterlist</a>
        </div>
    </div>
    <a class="nav-link" href="#">Edit</a>
    <a class="nav-link" href="<?= site_url('Admin/devList_view') ?>">Reservation</a>
    <a class="nav-link" href="#">Generate Reports</a>
    </div>
    <div class="dropdown">
        <a href="#" class="regbtn">Registration</a>
        <div class="list">
            <a href="<?= site_url('Admin/devReg_view') ?>" class="links">Device Registration</a>
            <a href="<?= site_url('Admin/empReg_view') ?>" class="links">Employee Registration</a>
        </div>
    </div>

    <a href="<?= site_url('Admin/profile_view') ?>" class="ts"><i class="far fa-user" id="nav-user-icon"></i>Admin</a>


</nav>

<script src="//cdn.amcharts.com/lib/4/core.js"></script>
<script src="//cdn.amcharts.com/lib/4/charts.js"></script>

<body>