<!---Navbar--->
    <div class="w-full h-20 bg-neutral-800 ">
        <div class="row w-3/4 h-full m-auto flex items-center align-center" style="max-width: 1080px;">
            <!--Left-Menu-->
            <ul class="flex h-full items-center float-left">
                <li><a href="\ZEMONWeb\index.php" class="nav px-3.5 text-white font-medium text-xl font-mono duration-500 hover:text-gray-300"><i class="fa-solid fa-house text-lg p-1"></i>Home</a></li>
                <li><a href="Shop" class="px-3.5 text-white font-medium text-xl font-mono duration-500 hover:text-gray-300"><i class="fa-solid fa-shop text-lg p-1"></i>Shop</a></li>
                <li class="relative"><button id="dropdown-category" class="px-3.5 text-white font-medium text-xl font-mono hover:text-gray-300 duration-500 c dropdown-category dropdown" style="cursor: pointer;">Category<i class="fa-solid fa-caret-down text-lg p-1 dropdown-category"></i></button>
                    <div class="z-10 bg-gray-300 w-28 absolute top-12 left-4 rounded-md truncate dropdown-cg-menu menu duration-500 hidden" style="cursor: pointer;" id="category-menu">
                        <a href="" class="w-full p-2 flex rounded-sm hover:bg-gray-400 duration-500">Robux</a>
                        <a href="" class="w-full p-2 flex rounded-sm hover:bg-gray-400 duration-500">All Item</a>
                        <a href="" class="w-full p-2 flex rounded-sm hover:bg-gray-400 duration-500">Buy ID</a>
                    </div>
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
                <?php if (isset($_SESSION['user_login'])) { ?>
                    <li><a href="Catalog" class="px-3.5 text-white font-medium text-xl font-mono duration-500 hover:text-gray-300"><i class="fa-solid fa-box-open text-lg p-1"></i></a></li>
                    <li class="relative text-white font-medium pl-1 p-1 duration-500 uppercase flex items-center dropdown-user hover:text-gray-300" style="cursor: pointer;"><img type="image" src="<?php echo $row['profile_img']; ?>" class="w-10 h-10 rounded-full mt-0.5 mr-2" /><?php echo $row['username']; ?><i class="fa-solid fa-caret-down text-lg p-1 dropdown-user"></i>
                        <div class="z-10 bg-gray-300 w-34 absolute top-12 left-4 rounded-md truncate dropdown-user-menu menu duration-500 hidden z-10" style="cursor: pointer;" id="user-menu">
                            <a href="#" class="w-full p-2 flex hover:bg-gray-400 text-black rounded-sm duration-500">?????????????????????????????? : <?php echo $row['username'] ?></a>
                            <a href="#" class="w-full p-2 flex hover:bg-gray-400 text-black rounded-sm duration-500">????????????????????????????????? : 0</a>
                            <a href="#" class="w-full p-2 flex hover:bg-gray-400 text-black rounded-sm duration-500">??????????????????????????????????????????</a>
                            <a href="pages/account/user_profile.php" class="w-full p-2 flex hover:bg-gray-400 text-black rounded-sm duration-500">????????????????????????????????????</a>
                            <form action="services/profile_db.php" method="post">
                                <button type="submit" name="logout" class="p-2 bottom-5 w-full bg-red-200 boder-red-400 text-white font-bold hover:text-gray-200 hover:bg-red-500 duration-500 ease-in-out transition">??????????????????????????????</button>
                            </form>
                        </div>
                    </li>
                <?php } else { ?>
                    <li><a href="pages/register.php" class="text-white font-medium pl-1 p-1 duration-500 hover:text-gray-300">SingUp</a></li>
                    <li>
                        <p class="text-white font-medium"> ??? </p>
                    </li>
                    <li><a href="pages/login.php" class="text-white font-medium pl-1 p-1 duration-500 hover:text-gray-300">Login</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>