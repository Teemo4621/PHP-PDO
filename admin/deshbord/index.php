<?php

session_start();
include_once '../../services/db.php';

if (!isset($_SESSION['admin_login'])) {
    header('Location: ../../pages/login.php');
}
?>

<h1>DESHBORD ADMIN</h1>
<div class="w-4/6 h-screen m-auto" style="max-width: 860px;">
    <div class="w-full h-4/5 bg-neutral-800 px-6 my-6 relative rounded-md">
        <form method="post" action="../../services/profile_db.php" class="edit-from">
            <button type="submit" name="logout" class="p-2 absolute bottom-5 left-5 bg-red-600 rounded-md text-white font-bold hover:text-gray-200 hover:bg-red-700 duration-500 ease-in-out transition">Logout</button>
        </form>
    </div>
</div>