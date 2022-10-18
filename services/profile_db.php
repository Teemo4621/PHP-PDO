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
                    $row = $conn->prepare("UPDATE users SET profile_img = :fileName WHERE id = :user_id");
                    $row->bindParam(":fileName", $fileName);
                    $row->bindParam(":user_id", $user_id);
                    $row->execute();
                    if ($row) {
                        $_SESSION['uploadMsg'] = "<b>" . $fileName . "</b> อัพโหลดเรียบร้อยแล้ว.";
                        header("location: ../pages/account/user_profile.php");
                    } else {
                        $_SESSION['uploadMsg'] = "อัพโหลดไฟล์ไม่ได้ โปรดลองอีกครั้ง";
                        header("location: ../pages/account/user_profile.php");
                    }
                } else {
                    $_SESSION['uploadMsg'] = "ขออภัย เกิดข้อผิดพลาดในการอัปโหลดไฟล์ของคุณ";
                    header("location: ../pages/account/user_profile.php");
                }
            } else {
                $_SESSION['uploadMsg'] = "ขออภัย อนุญาตให้อัปโหลดเฉพาะไฟล์ JPG, JPEG, PNG และ GIF เท่านั้น";
                header("location: ../pages/account/user_profile.php");
            }
        } else {
            $_SESSION['uploadMsg'] = "โปรดเลือกไฟล์ที่จะอัปโหลด";
            header("location: ../pages/account/user_profile.php");
        }
    }
?>