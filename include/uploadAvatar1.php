<?php

include "database/config.php";
include "header.php";
include "profileData.php";

$canbeavatar = false;
$pathToUpload = "uploads/avatars/";
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_FILES["avatar_upload"]) && $_FILES["avatar_upload"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["avatar_upload"]["name"];
        $filetype = $_FILES["avatar_upload"]["type"];
        $filesize = $_FILES["avatar_upload"]["size"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) header("Location: settings.php?error=4");;
    
        $maxsize = 5242880;
        if($filesize > $maxsize) header("Location: settings.php?error=3");
    
        if(in_array($filetype, $allowed)){
            if(file_exists($pathToUpload . $filename)){
                header("Location: settings.php?error=2");
            } else{
				$uploadedFileName = $filename . rand() . "." . $ext;
                move_uploaded_file($_FILES["avatar_upload"]["tmp_name"], $pathToUpload . $uploadedFileName);
				$canbeavatar = true;
                header("Location: database.php");
            } 
        } else{
            header("Location: settings.php?error=2");
        }
    }
}
if ($canbeavatar == true) {
	$finalPath = $pathToUpload . $uploadedFileName;
	$avatar_sql = "UPDATE users SET profile_picture='$finalPath' WHERE id=$p_id";
	mysqli_query($con, $avatar_sql);
    header("Location: settings.php?success=2");
}


?>