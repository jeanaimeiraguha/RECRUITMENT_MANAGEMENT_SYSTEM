<?php
include("connection.php");
session_start();
?>
<link rel="stylesheet" href="bootstrap-5.0.2-dist\css\bootstrap.css">
<div class="head">
    <p>Nyamata_recruitment_management</p>

</div>
<div class="form-control card shadow mt-5" style="width:600px;margin-left:400px;background-color:whitesmoke;">
    <form action="" method="POST">
        <h2 style="text-align:center;">Login Form</h2>
        <div class="input group mb-3 " >
            <span class="input group-text">Username</span>
            <input class="form-control" type="text" name="username" placeholder="Enter username">

        </div>
        <div class="input group mb-3">
            <span class="input group-text">Password</span>
            <input class="form-control" type="password" name="password" min="6" max="8" placeholder="Enter password">

        </div>
        Create An Account <a href="signup.php">Sign up</a>
        <input class="form-control btn btn-outline-success" type="submit" name="login" value="Login">
    </form>
    <?php
    if(isset($_POST['login'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $sql=mysqli_query($conn,"SELECT * FROM admin WHERE username='$username' AND password='$password'");
        if(mysqli_num_rows($sql)==1){
            $_SESSION['username']=$username;
            $_SESSION['password']=$password;
            ?>
            <script>
                alert('Successful to logged in Welcome');
                window.location.href='home.php';
            </script>
            <?php
        }else{
            echo "<p style='color:red;'>Unsuccessful to login ,Check your Credentials</p>";
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