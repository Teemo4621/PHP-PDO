<?php

    session_start();
    include_once 'db.php';
    
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username)) {
            $_SESSION['error'] = "
                <script>
                    Swal.fire(
                        'ERROR!',
                        'กรุณาใส่ Username',
                        'error'
                    )
                </script>
            ";
            header("location: ../pages/login.php");
        }  elseif (empty($password)) {
            $_SESSION['error'] = "
                <script>
                    Swal.fire(
                        'ERROR!',
                        'กรุณาใส่ Password',
                        'error'
                    )
                </script>
            ";
            header("location: ../pages/login.php");
        } elseif (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = "
                <script>
                    Swal.fire(
                        'ERROR!',
                        'Password ต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร',
                        'error'
                    )
                </script>
                ";
                header("location: ../pages/login.php");
        } else {
            try {

                $check_data = $conn->prepare("SELECT * FROM users WHERE username = :username");
                $check_data->bindParam(":username", $username);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {

                    if ($username == $row['username']) {
                        if (password_verify($password, $row['password'])) {
                            if ($row['urole'] == 'admin') {
                                $_SESSION['admin_login'] = $row['id'];
                                $_SESSION['success'];
                                header("location: ../admin/index.php");
                            } else {
                                $_SESSION['user_login'] = $row['id'];
                                $_SESSION['success'];
                                header("location: ../");
                            }
                        } else {
                            $_SESSION['error'] = "
                                <script>
                                    Swal.fire(
                                        'ERROR!',
                                        'Password หรือ Email ผิด',
                                        'error'
                                    )
                                </script>
                            ";
                            header("location: ../pages/login.php");
                        }
                    } else {
                        $_SESSION['error'] = "
                            <script>
                                Swal.fire(
                                    'ERROR!',
                                    'Password หรือ Email ผิด',
                                    'error'
                                )
                            </script>
                        ";
                        header("location: ../pages/login.php");
                    }
                } else {
                    $_SESSION['error'] = "
                        <script>
                            Swal.fire(
                                'ERROR!',
                                'ไม่มีผู้ใช่อยู่ในระบบ',
                                'error'
                            )
                        </script>
                    ";
                    header("location: ../pages/login.php");
                }

            } catch (PDOException $e) { 
                echo $e->getMessage();
            }
        }
    }
?>