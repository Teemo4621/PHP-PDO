    <!---Navbar--->
    <div class="w-full h-20 bg-neutral-800 ">
        <div class="row w-3/4 h-full m-auto flex items-center align-center">
            <!--Left-Menu-->
            <ul class="flex h-full items-center float-left">
                <li><a href="\ZEMONWeb\index.php"
                        class="px-3.5 text-white font-medium text-xl font-mono duration-500 hover:text-gray-300"><i
                            class="fa-solid fa-house text-lg p-1"></i>Home</a></li>
                <li><a href="Shop"
                        class="px-3.5 text-white font-medium text-xl font-mono duration-500 hover:text-gray-300"><i
                            class="fa-solid fa-shop text-lg p-1"></i>Shop</a></li>
                <li><a href="Category"
                        class="px-3.5 text-white font-medium text-xl font-mono duration-500 hover:text-gray-300"><i
                            class="fa-solid fa-caret-down text-lg p-1"></i>Category</a></li>
            </ul>
            <!--SearchBar-->
            <form class="flex w-1/4 text-center items-center align-center justify-center ml-auto" method="post"
                action="">
                <label class="relative block">
                    <span class="sr-only">Search</span>
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg class="fill-slate-300" viewBox="0 0 20 20"><i
                                class="fa-solid fa-magnifying-glass text-gray-300"></i></svg>
                    </span>
                    <input
                        class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                        placeholder="Search for anything..." type="text" name="search" />
                </label>
            </form>
            <!--Right-Menu-->
            <ul class="flex h-full items-center ">
                <li><a href="Catalog"
                        class="px-3.5 text-white font-medium text-xl font-mono duration-500 hover:text-gray-300"><i
                            class="fa-solid fa-box-open text-lg p-1"></i></a></li>
                <li><a href="pages\register.php" class="text-white font-medium pl-1 p-1 duration-500 hover:text-gray-300">SingUp</a>
                </li>
                <li>
                    <p class="text-white font-medium"> │ </p>
                </li>
                <li><a href="pages\login.php" class="text-white font-medium pl-1 p-1 duration-500 hover:text-gray-300">Login</a>
                </li>
            </ul>
        </div>
    </div>