<?php
include("connection.php");
session_start();
if(isset($_SESSION['username'])){
    echo "Welcome"."   ".$_SESSION['username'];
}else{
    header("location:login.php");
}
?>
<link rel="stylesheet" href="bootstrap-5.0.2-dist\css\bootstrap.css">
<div class="head">
    <p>Nyamata_recruitment_management</p>

</div>
<body bg-color="whitesmoke;">
    

<div class="navbar" style="background-color: rgb(38, 51, 75);">
<ul class="nav">
<li><a href="home.php" class="nav-link">Home</a></li>
    <li><a href="position.php" class="nav-link">Position</a></li>
    <li><a href="candidatesresult.php" class="nav-link">Candidates</a></li>
    <li><a href="report.php" class="nav-link">Report</a></li>
    <li><a href="logout.php" class="nav-link">Logout</a></li>

</ul>

</div>
</body>
<style>
    .head{
    background-color: rgb(3, 94, 97);
    color:white;
    height:100px;
    font-size:30px;
    text-align:center;
}
.navbar a{
    color:white;
}
.navbar a:hover{
    background-color:whitesmoke;
}
</style>