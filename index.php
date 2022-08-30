<?php

session_start();
include_once 'services/db.php';

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
</head>

<body>

    <!---Navbar--->
    <div class="w-full h-20 bg-neutral-800 ">
        <div class="row w-3/4 h-full m-auto flex items-center align-center" style="max-width: 1080px;">
            <!--Left-Menu-->
            <ul class="flex h-full items-center float-left">
                <li><a href="\ZEMONWeb\index.php" class="px-3.5 text-white font-medium text-xl font-mono duration-500 hover:text-gray-300"><i class="fa-solid fa-house text-lg p-1"></i>Home</a></li>
                <li><a href="Shop" class="px-3.5 text-white font-medium text-xl font-mono duration-500 hover:text-gray-300"><i class="fa-solid fa-shop text-lg p-1"></i>Shop</a></li>
                <li class="relative"><button id="dropdown-category" class="px-3.5 text-white font-medium text-xl font-mono duration-500 hover:text-gray-300" style="cursor: pointer;"><i class="fa-solid fa-caret-down text-lg p-1"></i>Category</button>
                    <div class="z-10 bg-gray-300 w-28 absolute top-12 left-4 rounded-md truncate dropdown-menu duration-500" style="display: none; cursor: pointer;" id="category-menu">
                        <a href="" class="w-full p-2 flex rounded-sm hover:bg-gray-400 duration-500">Robux</a>
                        <a href="" class="w-full p-2 flex rounded-sm hover:bg-gray-400 duration-500">All Item</a>
                        <a href="" class="w-full p-2 flex rounded-sm hover:bg-gray-400 duration-500">Buy ID</a>
                    </div>
                </li>
            </ul>
            <script>
                let clickonmenu = document.getElementById("dropdown-category");
                let menu = document.getElementById("category-menu");

                clickonmenu.addEventListener("click", function() {
                    if (menu.style.display == "none") {
                        menu.style.display = "block";
                    } else {
                        menu.style.display = "none";
                    }
                });
            </script>
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
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                    <li><a href="Catalog" class="px-3.5 text-white font-medium text-xl font-mono duration-500 hover:text-gray-300"><i class="fa-solid fa-box-open text-lg p-1"></i></a></li>
                    <li class="relative text-white font-medium pl-1 p-1 duration-500 uppercase flex items-center" style="cursor: pointer;" id="dropdown-menu-user"><img type="image" src="pages/image_profile/<?php echo $row['profile_img']; ?>" class="w-10 h-10 rounded-full mt-0.5 mr-2" /><?php echo $row['username']; ?>
                        <div class="z-10 bg-gray-300 w-34 absolute top-12 left-4 rounded-md truncate dropdown-menu duration-500" style="display: none; cursor: pointer;" id="user-menu">
                            <a href="#" class="w-full p-2 flex hover:bg-gray-400 text-black rounded-sm duration-500">ชื่อผู้ใช้ : <?php echo $row['username'] ?></a>
                            <a href="#" class="w-full p-2 flex hover:bg-gray-400 text-black rounded-sm duration-500">จำนวนเครดิต : 0</a>
                            <a href="pages/account/user_profile.php" class="w-full p-2 flex hover:bg-gray-400 text-black rounded-sm duration-500">ขอมูลส่วนตัว</a>
                            <form action="services/profile_db.php" method="post">
                            <button type="submit" name="logout" class="p-2 bottom-5 w-full bg-red-200 boder-red-400 text-white font-bold hover:text-gray-200 hover:bg-red-500 duration-500 ease-in-out transition">ออกจากระบบ</button>
                        </div>
                    </li>
                    <script>
                        let clickonusermenu = document.getElementById("dropdown-menu-user");
                        let usermenu = document.getElementById("user-menu");

                        clickonusermenu.addEventListener("click", function() {
                            if (usermenu.style.display == "none") {
                                usermenu.style.display = "block";
                            } else {
                                usermenu.style.display = "none";
                            }
                        });
                    </script>
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
</body>

</html>