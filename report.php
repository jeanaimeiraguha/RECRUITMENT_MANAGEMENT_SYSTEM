<?php
include("connection.php");
include("index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="bootstrap-5.0.2-dist\css\bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nyamata_recruitment_management</title>
</head>
<body>
    <form action="" method="POST" class="form-control">
        <h2 style="text-align:center;">Result Report</h2>
        <select class="form-control" name="pid" id="">
                                <option value="">--Choose Position</option>
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
                            </select><br>
    <input class="btn btn-success" type="submit" name="report" value="Generate">
    </form>
    <?php
    if(isset($_POST['report'])){
        $status=$_POST['pid'];
        // if($status =='employee'){
            ?>
            
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>National id</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Gender</th>
            <th>Date of birth</th>
            <th>Post Name</th>
            <th>Exam date</th>
            <th>Phone number</th>
            <th>Marks</th>
        </tr>
        <?php
        $s=mysqli_query($conn,"SELECT * FROM candidatesresult AS c JOIN position AS p ON c.postid=p.postid WHERE p.postid='$status'");
        $count=1;
        while($r=mysqli_fetch_array($s)){
            ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo $r['candidatenationalid'];?></td>
                <td><?php echo $r['fname'];?></td>
                <td><?php echo $r['lname'];?></td>
                <td><?php echo $r['gender'];?></td>
                <td><?php echo $r['dateofbirth'];?></td>
                <td><?php echo $r['postname'];?></td>
                <td><?php echo $r['examdate'];?></td>
                <td><?php echo $r['phonenumber'];?></td>
                <td><?php echo $r['marks'];?></td>
            </tr>
            <?php
        }
        
        ?>
    </table>
    <?php

        }
    // }
    ?>
</body>
</html>