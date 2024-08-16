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
    <title>IRAGUHA RESULT MANAGEMENT SYSTEM</title>
</head>

<body>
    <br><br>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">Add Position</button>
    <div class="modal" id="add" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">

                <form action="" method="POST" class="form-control">
                    <h3>Position Form</h3>
                    <input class="form-control" type="text" name="postname" placeholder="Enter position name"><br>
                    <input class="form-control btn btn-success" type="submit" name="sub" value="Enter">
                </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if(isset($_POST['sub'])){
        $postname=$_POST['postname'];
        $select=mysqli_query($conn,"SELECT * FROM position WHERE postname='$postname'");
        $row=mysqli_fetch_array($select);
        if(mysqli_num_rows($select)<1){
        $sql=mysqli_query($conn,"INSERT INTO position VALUES(null,'$postname')");
        if($sql){
            ?>
    <script>
        alert('well inserted');
        window.location.href = 'position.php';
    </script>
    <?php
        }else{
            echo "not well inserted";
        }
    }else{
        echo "Position Already exist Choose another";
    }
    }
    
    ?>
    <br><br>
    <h2 style="text-align:center;">List of Positions</h2>
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Position Names</th>
            <th colspan="2">Actions</th>
        </tr>
        <?php
        $select=mysqli_query($conn,"SELECT * FROM position");
        $count=1;
        while($row=mysqli_fetch_array($select)){
            ?>
        <tr>
            <td>
                <?php echo $count++;?>
            </td>
            <td>
                <?php echo $row['postname'];?>
            </td>
            <td><a href="position.php?update=<?php echo $row['postid'];?>">update</a></td>
            <td><a href="position.php?delete=<?php echo $row['postid'];?>"
                    onclick="return confirm('Sure you want to delete')">delete</a></td>

        </tr>
        <?php
        }
        ?>
    </table>

    <?php
    if(isset($_GET['delete'])){
        $de=$_GET['delete'];
        $delete=mysqli_query($conn,"DELETE FROM position WHERE postid=$de");

    }
    
    ?>

    <?php
    if(isset($_GET['update'])){
        $up=$_GET['update'];
        $upd=mysqli_query($conn,"SELECT * FROM position WHERE postid=$up");
        while($r=mysqli_fetch_array($upd)){
            ?>
            <center>
    <form action="" method="POST">
        <h2>Update Position</h2>
        Position Name: <br><input type="text" name="postname" value="<?php echo $r['postname'];?>"><br><br>
        <input class="btn btn-outline-success"type="submit" name="update" value="update">
    </form>
    </center>
    <?php
        }
    }
    if(isset($_POST['update'])){
        $postname=$_POST['postname'];
        $update=mysqli_query($conn,"UPDATE position SET postname='$postname' WHERE postid=$up ");

        if($update){
            ?>
    <script>
        alert('successful to update');
        window.location.href = 'position.php';
    </script>
    <?php
        }else{
            echo "unsuccessful to update";
        }

        }
    ?>
</body>

</html>