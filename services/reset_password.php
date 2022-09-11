<?php
    session_start();
    include_once 'db.php';

    //edit Password
    if (isset($_POST['editpassword'])) {
        $passwordold = $_POST['passwordold'];
        $newpassword = $_POST['newpassword'];
        $cfnewpassword = $_POST['cfnewpassword'];
        $user_id = $_SESSION['user_login'];
        
        if (empty($passwordold)) {
            $_SESSION['error'] = "
                <script>
                    Swal.fire(
                        'ERROR!',
                        'กรุณากรอกรหัสผ่านเดิมของคุณ',
                        'error'
                    )
                </script>
            ";
            header('location: ../pages/account/user_profile.php');
        } else if (empty($newpassword)) {
            $_SESSION['error'] = "
                <script>
                    Swal.fire(
                        'ERROR!',
                        'กรุณากรอกรหัสผ่านใหม่',
                        'error'
                    )
                </script>
            ";
            header('location: ../pages/account/user_profile.php');
        } else if (empty($cfnewpassword)) {
            $_SESSION['error'] = "
                <script>
                    Swal.fire(
                        'ERROR!',
                        'กรุณายื่นยันรหัสผ่านใหม่อีกครั้ง',
                        'error'
                    )
                </script>
            ";
            header('location: ../pages/account/user_profile.php');
        } else if (strlen($_POST['newpassword']) > 20 || strlen($_POST['newpassword']) < 5) {
            $_SESSION['error'] = "
                <script>
                    Swal.fire(
                        'ERROR!',
                        'Password ต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร',
                        'error'
                    )
                </script>
                ";
            header('location: ../pages/account/user_profile.php');
        } elseif ($newpassword != $cfnewpassword) {
            $_SESSION['error'] = "
                    <script>
                        Swal.fire(
                            'ERROR!',
                            'Password ไม่ตรงกัน',
                            'error'
                        )
                    </script>
                ";
            header('location: ../pages/account/user_profile.php');
        } elseif ($newpassword == $passwordold) {
            $_SESSION['error'] = "
                    <script>
                        Swal.fire(
                            'ERROR!',
                            'Password กรุณากรอกรหัสผ่านอันใหม่',
                            'error'
                        )
                    </script>
                ";
            header('location: ../pages/account/user_profile.php');
        } else {
            try {
                $checkoldpassword = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
                $checkoldpassword->bindParam(":user_id", $user_id);
                $checkoldpassword->execute();
                $row = $checkoldpassword->fetch(PDO::FETCH_ASSOC);
                if ($checkoldpassword->rowCount() > 0) {
                    if ((password_verify($passwordold, $row['password']))) {
                        $passwordHash = password_hash($newpassword, PASSWORD_DEFAULT);
                        $smt = $conn->prepare("UPDATE users SET password = :newpassword WHERE id = :user_id");
                        $smt->bindParam(":newpassword", $passwordHash);
                        $smt->bindParam(":user_id", $user_id);
                        $smt->execute();
                        $_SESSION['success'] = "
                        <script>
                            Swal.fire(
                                'SUCCESS!',
                                'เปลี่ยน Password เสร็จสิ้น',
                                'success'
                            )
                        </script>";
                        header('location: ../pages/account/user_profile.php');
                    } else {
                    $_SESSION['error'] = "
                        <script>
                            Swal.fire(
                                'ERROR!',
                                'Password ไม่ถูกต้อง',
                                'error'
                            )
                        </script>
                    ";
                    header('location: ../pages/account/user_profile.php');
                    }
                } else {
                    $_SESSION['error'] = "
                        <script>
                            Swal.fire(
                                'ERROR!',
                                'มีบางอย่างผิดพลาด',
                                'error'
                            )
                        </script>
                        ";
                    header('location: ../pages/account/user_profile.php');
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>