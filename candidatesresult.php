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
    <script src="bootstrap-5.0.2-dist\js/bootstrap.bundle.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IRAGUHA TRAINING SERVICES SCHOOL</title>
</head>
<body>
<br><br>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">Add Candidate</button>
    <div class="modal" id="add" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                            <form action="" method="POST"class="form-control">
<h3>Candidate Form</h3>
                            <input class="form-control" type="number" name="national"  placeholder="Enter national id" reqiured>
                            <input class="form-control" type="text" name="fname"  placeholder="Enter First name"  reqiured>
                            <input class="form-control" type="text" name="lname"  placeholder="Enter Last name"  reqiured>
                            Gender :<input type="radio" name="sex" value="male"  reqiured>male
                            <input type="radio" name="sex" value="female"  reqiured>female <br>
                            Date of birth : <input class="form-control" type="date" name="dob">
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
                            </select>
                            exam date : <input class="form-control" type="date" name="examdate"  reqiured>
                            phone number: <input class="form-control" type="number"  name="phone" placeholder="Enter phone number"  reqiured>
                            marks : <input class="form-control" type="number" name="marks" minlength="0" maxlength="100" placeholder="Enter marks"  reqiured><br>
                            <input class="btn btn-primary" type="submit" name="sub" value="Enter">

                            </form>
                    </div>
            </div>
        </div>
    </div>
    
    <?php
    if(isset($_POST['sub'])){
        $nationalid=$_POST['national'];
        $nnid=strlen($nationalid);
        $nid=substr($nationalid,0,1);
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $gender=$_POST['sex'];
        $dob=$_POST['dob'];
        $dd=str_replace("-","",$dob);
        $cd=date("Ymd");
        $sd=$cd-$dd;
        $postid=$_POST['pid'];
        $examdate=$_POST['examdate'];
        $exam=date("Y-m-d");
        $phone=$_POST['phone'];
        $ph=substr($phone,0,3);
        $pp=strlen($phone);
        $marks=$_POST['marks'];
    
if($examdate >= $exam){    
    if($marks >=0 && $marks <=100) {         
        if(preg_match("/1/",$nid)){  
            if($nnid ==16){         
                if($sd>=180000){  
                    if((preg_match("/078/",$ph))||(preg_match("/079/",$ph))||(preg_match("/072/",$ph))||(preg_match("/073/",$ph))){  
                        if($pp==10){   
                            $sql=mysqli_query($conn,"INSERT INTO candidatesresult VALUES(null,'$nationalid','$fname','$lname','$gender',
                            '$dob','$postid','$examdate','$phone','$marks')");

                            if($sql){
                                ?>
                                <script>
                                    alert('Successful to insert candidate');
                                    window.location.href='candidatesresult.php';
                                </script>
                                <?php  
                            }else{
                                echo "Unsuccessful to insert candidate";
                            }
                        }else{
                           echo "<p style='color:red;'>Telephone number should contain 10 numbers.</p>";
                        } 
                    }else{
                        echo "<p style='color:red;'> Candidate phone number must start by 078,9,3 and 2.</p>";
                    }
                            
                }else{
                    echo "<p style='color:red;'> Candidate age is still young, Please enter Atleast 18 years old.</p>";
                }

            }else{
               echo "<p style='color:red;'> Nationalid must start contain 16 characters</p>.";
            }

        }else{
           echo "<p style='color:red;'> Nationalid must start by 1</p>. ";
        }    
    } else{
        echo "<p style='color:red;'>Marks must be on between 0 and 100 </p>.";
    }       
} else{
        echo "<p style='color:red;'> Exam date should be greater than current date </p>.";
    }

                
}
?>
<br><br>
<h2 style="text-align:center;">List of Candidates Result</h2>
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
            <th colspan="2">Actions</th>
        </tr>
        <?php
        $s=mysqli_query($conn,"SELECT * FROM candidatesresult AS c JOIN position AS p ON c.postid=p.postid");
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
                <td><a href="update_candidate.php?update=<?php echo $r['cid'];?>">update</a></td>
                <td><a href="candidatesresult.php?delete=<?php echo $r['cid'];?>" onclick="return confirm('Sure you want to delete this candidate?')">delete</a></td>



            </tr>
            <?php
        }
        
        ?>
    </table>
    <?php
    if(isset($_GET['delete'])){
        $del=$_GET['delete'];
        $delete=mysqli_query($conn,"DELETE FROM candidatesresult WHERE cid=$del");
    }
    ?>
</body>
</html>