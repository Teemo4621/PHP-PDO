<?php

session_start();
include_once 'services/db.php';
if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else if ((isset($_SESSION['admin_login']))) {
    $admin_id = $_SESSION['admin_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME PAGE | Zemon Hub</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/0cfafdce5f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="swiper-bundle.min.css">
    <script src="swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="css/zemonStyle.css">
</head>

<body>

    <!---Navbar--->
    <div class="w-full h-20 bg-neutral-800 ">
        <div class="nav row w-3/4 h-full m-auto flex items-center align-center" style="max-width: 1080px;">
            <!--Left-Menu-->
            <ul class="flex h-full items-center float-left">
                <li><a href="\ZEMONWeb\index.php" class="nav px-3.5 text-white font-medium text-xl font-mono duration-500 hover:text-gray-300"><i class="fa-solid fa-house text-lg p-1"></i>Home</a></li>
                <li><a href="Shop" class="category px-3.5 text-white font-medium text-xl font-mono duration-500 hover:text-gray-300"><i class="fa-solid fa-shop text-lg p-1"></i>Shop</a></li>
                <li class="relative"><button class="dropdown h-14 px-3.5 text-white font-medium text-xl font-mono hover:text-gray-300 duration-500" style="cursor: pointer;">Category<i class="fa-solid fa-caret-down text-lg p-1 dropdown-category"></i></button>
                    <ul class="menu z-10 bg-gray-300 w-28 absolute top-12 left-4 rounded-md truncate duration-500" style="cursor: pointer;" id="category-menu">
                        <a href="" class="w-full p-2 flex rounded-sm hover:bg-gray-400 duration-500">Robux</a>
                        <a href="" class="w-full p-2 flex rounded-sm hover:bg-gray-400 duration-500">All Item</a>
                        <a href="" class="w-full p-2 flex rounded-sm hover:bg-gray-400 duration-500">Buy ID</a>
                    </ul>
                </li>
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
            <ul class="flex h-full items-center">
                <?php if (isset($_SESSION['user_login']) | (isset($_SESSION['admin_login']))) { ?>
                    <?php if (isset($_SESSION['admin_login'])) { ?>
                        <li class="dropdown relative text-red-500 font-medium pl-1 p-1 duration-200 uppercase flex items-center hover:text-red-300" style="cursor: pointer;"><img type="image" src="pages/image_profile/<?php echo $row['profile_img']; ?>" class="w-10 h-10 rounded-full mt-0.5 mr-2" />ADMIN<i class="fa-solid fa-caret-down text-lg p-1 text-white"></i>
                            <ul class="menu z-10 bg-gray-300 w-34 absolute top-12 left-4 rounded-md truncate duration-200 z-10" style="cursor: pointer;">
                                <a href="#" class="w-full p-2 flex hover:bg-gray-400 text-black rounded-sm duration-200">ชื่อADMIN : <?php echo $row['username'] ?></a>
                                <a href="admin/index.php" class="w-full p-2 flex hover:bg-gray-400 text-black rounded-sm duration-200">หน้า Deshbord</a>
                                <form action="services/profile_db.php" method="post">
                                    <button type="submit" name="logout" class="p-2 bottom-5 w-full bg-red-200 boder-red-400 text-white font-bold hover:text-gray-200 hover:bg-red-500 duration-500 ease-in-out transition">ออกจากระบบ</button>
                                </form>
                            </ul>
                        </li>
                    <?php } else if (isset($_SESSION['user_login'])) { ?>
                        <li class="dropdown relative text-white font-medium pl-1 p-1 duration-200 uppercase flex items-center hover:text-gray-300" style="cursor: pointer;"><img type="image" src="pages/image_profile/<?php echo $row['profile_img']; ?>" class="w-10 h-10 rounded-full mt-0.5 mr-2" /><?php echo $row['username']; ?><i class="fa-solid fa-caret-down text-lg p-1"></i>
                            <div class="menu z-10 bg-gray-300 w-34 absolute top-12 left-4 rounded-md truncate dropdown-user-menu menu duration-200 z-10" style="cursor: pointer;">
                                <a href="#" class="w-full p-2 flex hover:bg-gray-400 text-black rounded-sm duration-200">ชื่อผู้ใช้ : <?php echo $row['username'] ?></a>
                                <a href="#" class="w-full p-2 flex hover:bg-gray-400 text-black rounded-sm duration-200">จำนวนเครดิต : 0</a>
                                <a href="#" class="w-full p-2 flex hover:bg-gray-400 text-black rounded-sm duration-200">ประวัติการซื้อ</a>
                                <a href="pages/account/user_profile.php" class="w-full p-2 flex hover:bg-gray-400 text-black rounded-sm duration-200">ขอมูลส่วนตัว</a>
                                <form action="services/profile_db.php" method="post">
                                    <button type="submit" name="logout" class="p-2 bottom-5 w-full bg-red-200 boder-red-400 text-white font-bold hover:text-gray-200 hover:bg-red-500 duration-500 ease-in-out transition">ออกจากระบบ</button>
                                </form>
                            </div>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <li><a href="pages/register.php" class="text-white font-medium pl-1 p-1 duration-500 hover:text-gray-300">SingUp</a></li>
                    <li>
                        <p class="text-white font-medium"> │ </p>
                    </li>
                    <li><a href="pages/login.php" class="text-white font-medium pl-1 p-1 duration-500 hover:text-gray-300">Login</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <!--- Container --->
    <div class="">
        <div class="">
            <!--- Swipper Image --->
            <div class="swiper sliderImage">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="image/glenn-carstens-peters-0woyPEJQ7jc-unsplash.jpg" alt=""></div>
                    <div class="swiper-slide"><img src="image/jeshoots-com-eCktzGjC-iU-unsplash.jpg" alt=""></div>
                    <div class="swiper-slide"><img src="image/nassim-allia-ot-HSrLNTP0-unsplash.jpg" alt=""></div>
                </div>
                <div class="swiper-button-next swiper-btn"></div>
                <div class="swiper-button-prev swiper-btn"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>

</body>

</html>