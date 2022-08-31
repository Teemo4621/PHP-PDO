<?php

    session_start();
    include_once 'db.php';
    
    //logout
    if (isset($_POST['logout'])) {

        unset($_SESSION['user_login']);
        unset($_SESSION['admin_login']);
        header('location: ../index.php');
    }

    //Updata Profile 
    $targetDir = "../pages/image_profile/";

    if (isset($_POST['uploadProfile'])) {
        //Reset Password Soon

        //UploadProfile
        if (!empty($_FILES["fileImag"]["name"])) {
            $fileName = basename($_FILES["fileImag"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $user_id = $_SESSION['user_login'];
    
            // Allow certain file formats
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES['fileImag']['tmp_name'], $targetFilePath)) {
                    $row = $conn->prepare("UPDATE users SET profile_img= :fileName WHERE id = :user_id");
                    $row->bindParam(":fileName", $fileName);
                    $row->bindParam(":user_id", $user_id);
                    $row->execute();
                    if ($row) {
                        $_SESSION['uploadMsg'] = "The file <b>" . $fileName . "</b> has been uploaded successfully.";
                        header("location: ../pages/account/user_profile.php");
                    } else {
                        $_SESSION['uploadMsg'] = "File upload failed, please try again.";
                        header("location: ../pages/account/user_profile.php");
                    }
                } else {
                    $_SESSION['uploadMsg'] = "Sorry, there was an error uploading your file.";
                    header("location: ../pages/account/user_profile.php");
                }
            } else {
                $_SESSION['uploadMsg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.";
                header("location: ../pages/account/user_profile.php");
            }
        } else {
            $_SESSION['uploadMsg'] = "Please select a file to upload.";
            header("location: ../pages/account/user_profile.php");
        }
    }
?>