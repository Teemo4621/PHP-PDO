<?php
session_start();
include_once '../services/db.php';
if (!isset($_SESSION['user_login']) && !isset($_SESSION['admin_login'])) {
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILE PAGE | Zemon Hub</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/0cfafdce5f.js" crossorigin="anonymous"></script>
</head>

<body>

    <!---Navbar--->
    <div class="w-full h-20 bg-neutral-800 ">
        <div class="row w-3/4 h-full m-auto flex items-center align-center" style="max-width: 1080px;">
            <!--Left-Menu-->
            <ul class="flex h-full items-center float-left">
                <li><a href="\ZEMONWeb\index.php" class="px-3.5 text-white font-medium text-xl font-mono duration-500 hover:text-gray-300"><i class="fa-solid fa-house text-lg p-1"></i>Home</a></li>
                <li><a href="Shop" class="px-3.5 text-white font-medium text-xl font-mono duration-500 hover:text-gray-300"><i class="fa-solid fa-shop text-lg p-1"></i>Shop</a></li>
                <li><a href="Category" class="px-3.5 text-white font-medium text-xl font-mono duration-500 hover:text-gray-300"><i class="fa-solid fa-caret-down text-lg p-1"></i>Category</a></li>
            </ul>
            <!--SearchBar-->
            <form class="flex w-1/4 text-center items-center align-center justify-center ml-auto" method="post" action="">
                <label class="relative block">
                    <span class="sr-only">Search</span>
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg class="fill-slate-300" viewBox="0 0 20 20"><i class="fa-solid fa-magnifying-glass text-gray-300"></i></svg>
                    </span>
                    <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Search for anything..." type="text" name="search" />
                </label>
            </form>
            <!--Right-Menu-->
            <ul class="flex h-full items-center ">
                <?php if (isset($_SESSION['user_login'])) {
                    $user_id = $_SESSION['user_login'];
                    $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC); ?>
                    <li><a href="Catalog" class="px-3.5 text-white font-medium text-xl font-mono duration-500 hover:text-gray-300"><i class="fa-solid fa-box-open text-lg p-1"></i></a></li>
                    <li><a href="user_profile.php" class="text-white font-medium pl-1 p-1 duration-500 hover:text-gray-300 hover:opacity-75 uppercase flex items-center"><img type="image" src="image_profile/<?php echo $row['profile_img']; ?>" class="w-10 h-10 rounded-full mt-0.5 mr-2" /><?php echo $row['username']; ?></a></li>
                <?php } else { ?>
                    <li><a href="pages\register.php" class="text-white font-medium pl-1 p-1 duration-500 hover:text-gray-300">SingUp</a></li>
                    <li>
                        <p class="text-white font-medium"> │ </p>
                    </li>
                    <li><a href="pages\login.php" class="text-white font-medium pl-1 p-1 duration-500 hover:text-gray-300">Login</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div class="w-4/6 h-screen m-auto" style="max-width: 860px;">
        <div class="w-full bg-neutral-800 px-6 py-4 my-6 relative rounded-md" style="height: 38rem;">
            <!--EditDataForm-->
            <form method="post" action="../services/profile_db.php" class="edit-from" enctype="multipart/form-data">
                <h3 class="text-center text-white text-3xl mb-4">เเก้ไขขอมูลส่วนตัว</h3>
                <!--UploadProfile Box-->
                <div class="w-2/6  m-auto">
                    <div class="w-44 h-44 m-auto relative">
                        <img name="image_profile" id="imageProfile" src="image_profile/<?php echo $row['profile_img']; ?>" class="rounded-full m-auto bg-cover bg-no-repeat bg-center w-full h-full truncate" alt="">
                        <div class="bg-gray-400 rounded-full truncate w-10 h-10 absolute bottom-0 right-1 text-center hover:bg-gray-500 hover:text-gray-300 duration-500">
                            <i class="fa-solid fa-camera text-center w-4 h-4 pt-3 text-white " aria-hidden="true"></i>
                            <input type="file" name="uploadImg" id="uploadImgBtn" accept="image/png, image/gif, image/jpeg, image/jetty" class="absolute opacity-0" style="transform: scale(2.1);">
                        </div>
                    </div>
                    <script>
                        document.getElementById("uploadImgBtn").onchange = function() {
                            document.getElementById("imageProfile").src = URL.createObjectURL(uploadImgBtn.files[0]);
                        }
                    </script>
                </div>
                <!--EditDataInput-->
                <div class="my-4 mx-2">
                    <div class="mt-4">
                        <p class="text-white text-sm">Username:</p>
                        <input type="text" placeholder="Username" name="username" class="px-2 py-0.5 w-2/6 h-8 rounded-md" value="<?php echo $row['username']; ?>" />
                    </div>
                    <div class="mt-4">
                        <p class="text-white text-sm">Password ยืนยันรหัสผ่านปัจจุบัน:</p>
                        <input type="password" placeholder="Password" name="username" class="px-2 py-0.5 w-2/6 h-8 rounded-md" />
                    </div>
                    <div class="mt-4">
                        <p class="text-white text-sm">New Password รหัสผ่านใหม่:</p>
                        <input type="password" placeholder="Confirm Password" name="username" class="px-2 py-0.5 w-2/6 h-8 rounded-md" />
                    </div>
                    <div class="mt-4">
                        <p class="text-white text-sm">Confirm password ยืนยันรหัสผ่านใหม่:</p>
                        <input type="password" placeholder="Password" name="username" class="px-2 py-0.5 w-2/6 h-8 rounded-md" />
                    </div>
                </div>
                <!--LogoutButton-->
                <button type="submit" name="logout" class="p-2 absolute bottom-5 left-5 bg-red-600 rounded-md text-white font-bold hover:text-gray-200 hover:bg-red-700 duration-500 ease-in-out transition">Logout</button>
            </form>
        </div>
    </div>

</body>

</html>