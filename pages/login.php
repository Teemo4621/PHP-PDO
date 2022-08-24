<?php

    session_start();
    include_once '../services/db.php';
    if (isset($_SESSION['user_login']) or (isset($_SESSION['admin_login']))) {
        header('Location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PAGE | Zemon Hub</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/0cfafdce5f.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php if (isset($_SESSION['error'])) { ?>
        <?php 
            echo $_SESSION['error']; 
            unset($_SESSION['error']);
        ?>
    <?php } ?>
    <?php if (isset($_SESSION['success'])) { ?>
        <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
        ?>
    <?php } ?>
    <div class="w-full h-screen bg-gradient-to-r from-cyan-500 to-blue-700 flex justify-item-center content-center">
        <div class="bg-neutral-800 h-80 w-2/6 m-auto rounded-lg shadow-md">
            <div class="w-full text-center h-full flex justify-item-center content-center">
                <!--Form-Input-->
                <form action="../services/singIn_db.php" method="post" class="w-3/4 m-auto">
                    <div class="text-white text-2xl font-bold mb-4">LoginPage</div>
                    <!--email-Input-->
                    <div class="flex content-center px-4 mb-4">
                        <div class="rounded-l-lg bg-gray-400 w-8"><i class="fa-solid fa-user mt-2 text-white"></i></div>
                        <input type="text" class="w-full h-8 p-1 rounded-r-lg" placeholder="Email" name="email"/>
                    </div>
                    <!--Password-Input-->
                    <div class="flex content-center px-4 mb-4">
                        <div class="rounded-l-lg bg-gray-400 w-8"><i class="fa-solid fa-key mt-2 text-white"></i></div>
                        <input type="password" class="w-full h-8 p-1 rounded-r-lg focus:ring-2" placeholder="Password" name="password"/>
                    </div>
                    <!--Submit-Form-->
                    <div class="px-4">
                        <button type="submit" name="login" class="w-full text-white px-2 py-2 rounded-lg bg-blue-700 hover:bg-blue-800 duration-500"><i class="fa-solid fa-right-to-bracket text-white"></i>Login</button>
                        <p class="font-lg text-white ">You don't have an account yet? Click <a href="register.php" class="text-blue-500">here</a>  for Singup</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>