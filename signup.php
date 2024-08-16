<?php
include("connection.php");

?>
<link rel="stylesheet" href="bootstrap-5.0.2-dist\css\bootstrap.css">
<div class="head">
    <p>IRAGUHA TRAINING SERVICES SCHOOL</p>

</div>
<div class="form-control card shadow mt-5" style="width:600px; margin-left:400px;background-color:whitesmoke;">
    <form action="" method="POST" >
        <h2 style="text-align:center;">Sign Up Form</h2>
        <div class="input group mb-3 " >
            <span class="input group-text">Username</span>
            <input class="form-control" type="text" name="username" placeholder="Enter username">

        </div>
        <div class="input group mb-3">
            <span class="input group-text">Password</span>
            <input class="form-control" type="password" name="password" min="6" max="8" placeholder="Enter password">

        </div>
        Already Have an account <a href="login.php">Login</a>
        <input class="form-control btn btn-outline-success" type="submit" name="sign" value="Sign Up">
    </form>
    <?php
    if(isset($_POST['sign'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $pass=strlen($password);

        if($pass>=8){
        $sql=mysqli_query($conn,"INSERT INTO admin VALUES(null,'$username','$password')");
        if($sql){
            ?>
            <script>
                alert('Account Well created');
                window.location.href='login.php';
            </script>
            <?php
        }else{
            echo "Account not well created";
        }
    }else{
        echo "<p style='color:red;'> password should contain atleast 8 characters </p>";
    }
}
    ?>
</div>
<style>
    .head{
    background-color: rgb(3, 94, 97);
    color:white;
    height:100px;
    font-size:30px;
    text-align:center;
}
</style>