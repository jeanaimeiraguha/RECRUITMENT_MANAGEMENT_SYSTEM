<?php
    $conn=mysqli_connect("localhost","root","","audioupload") or die("Unable to get database"
    .mysqli_connect_error($conn));
    if (isset($_POST['save_audio'])) {
        $dir='uploads/';
        $audio_path=$dir.basename($_FILES['audiofile']['name']);
        $add_values="INSERT into audios values(null,'$audio_path')";
        if ($_FILES['audiofile']['type']!='image/jpg' ||) {
            echo"File type error";
        }
        elseif (move_uploaded_file($_FILES['audiofile']['tmp_name'],$audio_path) && mysqli_query($conn,$add_values)) {
            echo"Upload succed and values inserted";
        }
        else {
            echo"Problem with upload or inserting";
        }
    }
?>