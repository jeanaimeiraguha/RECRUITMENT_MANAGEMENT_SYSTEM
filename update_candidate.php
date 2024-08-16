
    <?php
    include("connection.php");
    include("index.php");
    if(isset($_GET['update'])){
        $up=$_GET['update'];
        $upd=mysqli_query($conn,"SELECT * FROM candidatesresult WHERE cid=$up");
        while($fetch=mysqli_fetch_array($upd)){
            ?>
    <form action="" method="POST" class="form-control">
<h3>Update Candidate</h3>
            <input class="form-control" type="number" name="national" value="<?php echo $fetch['candidatenationalid'];?>">
            <input class="form-control" type="text" name="fname" value="<?php echo $fetch['fname'];?>">
            <input class="form-control" type="text" name="lname"  value="<?php echo $fetch['lname'];?>">
            gender <input type="radio" name="sex" value="male">male
            <input type="radio" name="sex" value="female">female <br>
            date of birth : <input class="form-control" type="date" name="dob" value="<?php echo $fetch['dateofbirth'];?>" >
            post name : <select class="form-control" name="pid" id="">
                <?php
                $select=mysqli_query($conn,"SELECT * FROM position");
                while($row=mysqli_fetch_array($select)){
                    ?>
                    <option value="<?php echo $row['postid'];?>">
                    <?php echo $row['postname'];?>
                </option>
                <?php
                }
                ?>
            </select>
            exam date : <input class="form-control" type="date" name="examdate"  value="<?php echo $fetch['examdate'];?>">
            phone number: <input class="form-control" type="number"  name="phone"  value="<?php echo $fetch['phonenumber'];?>">
            marks : <input class="form-control"  type="number" name="marks" min="0" max="100"  value="<?php echo $fetch['marks'];?>"><br>
            <input class="btn btn-success" type="submit" name="update" value="update">

</form>
<?php
        }
    }
    if(isset($_POST['update'])){
        $nationalid=$_POST['national'];
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $gender=$_POST['sex'];
        $dob=$_POST['dob'];
        $postid=$_POST['pid'];
        $examdate=$_POST['examdate'];
        $phone=$_POST['phone'];
        $marks=$_POST['marks'];

        $update=mysqli_query($conn,"UPDATE candidatesresult SET candidatenationalid='$nationalid',fname='$fname',lname='$lname',
        gender='$gender',dateofbirth='$dob',postid='$postid',examdate='$examdate',phonenumber='$phone',marks='$marks'  WHERE cid=$up");

        if($update){
            ?>
            <script>
                alert('well updated');
                window.location.href='candidatesresult.php';
            </script>
            <?php
        }else{
            echo "not well updated";
        }
    }
     
    ?>