<?php

session_start();
include_once 'db.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cfpassword = $_POST['cfpassword'];
    $urole = 'user';

    if (empty($username)) {
        $_SESSION['error'] = "
                <script>
                    Swal.fire(
                        'ERROR!',
                        'กรุณากรอก Username',
                        'error'
                    )
                </script>
            ";
        header('location: ../pages/register.php');
    } elseif (empty($email)) {
        $_SESSION['error'] = "
                <script>
                    Swal.fire(
                        'ERROR!',
                        'กรุณากรอก Email',
                        'error'
                    )
                </script>
            ";
        header('location: ../pages/register.php');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "
                <script>
                    Swal.fire(
                        'ERROR!',
                        'รูปเเบบ Email ไม่ถูกต้อง',
                        'error'
                    )
                </script>
            ";
        header('location: ../pages/register.php');
    } elseif (empty($password)) {
        $_SESSION['error'] = "
                <script>
                    Swal.fire(
                        'ERROR!',
                        'กรุณากรอก Password',
                        'error'
                    )
                </script>
            ";
        header('location: ../pages/register.php');
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
        header('location: ../pages/register.php');
    } elseif (empty($cfpassword)) {
        $_SESSION['error'] = "
                <script>
                    Swal.fire(
                        'ERROR!',
                        'กรุณายืนยัน Password',
                        'error'
                    )
                </script>
            ";
        header('location: ../pages/register.php');
    } elseif ($password != $cfpassword) {
        $_SESSION['error'] = "
                <script>
                    Swal.fire(
                        'ERROR!',
                        'Password ไม่ตรงกัน',
                        'error'
                    )
                </script>
            ";
        header('location: ../pages/register.php');
    } else {
        try {

            $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $check_email->bindParam(":email", $email);
            $check_email->execute();
            $row = $check_email->fetch(PDO::FETCH_ASSOC);

            if ($row['email'] == $email) {
                $_SESSION['error'] = "
                    <script>
                        Swal.fire(
                            'ERROR!',
                            'มี Email อยู่ในระบบเเล้ว',
                            'error'
                        )
                    </script>
                    ";
                header('location: ../pages/register.php');
            } else if (!isset($_SESSION['error'])) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users(username, email, password, urole) 
                                            VALUES(:username, :email, :password, :urole)");
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":password", $passwordHash);
                $stmt->bindParam(":urole", $urole);
                $stmt->execute();
                $_SESSION['success'] = "
                    <script>
                        Swal.fire(
                            'SUCCESS!',
                            'สมัครเสร็จสิ้น',
                            'success'
                        )
                    </script>";
                header('location: ../pages/login.php');
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
                header('location: ../pages/register.php');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
