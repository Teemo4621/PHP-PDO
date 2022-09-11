<?php

session_start();
include '../services/db.php';
if (isset($_SESSION['admin_login'])) {
    $admin_id = $_SESSION['admin_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header('Location: ../');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN | Zemon Hub</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/0cfafdce5f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="swiper-bundle.min.css">
    <script src="swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="../css/zemonStyle.css">
</head>

<body>

    <!--SideBarMenu-->
    <div class="sidebarMenu text-gray-200 h-screen">
        <div class="sidebarmenu-wrapper w-full h-full">
            <div class="brand-icon text-center text-gray-200 pt-2">
                <a href="">
                    <h3>ZEMON<sup>HUB</sup></h3>
                </a>
            </div>
            <ul class="menu mt-2">
                <!--Home-->
                <li class="homepage menu-item"><a href=""><i class="fa-solid fa-house"></i>หน้าหลัก</a></li>
                <!--product-->
                <p class="title text-white">การจัดการข้อมูล</p>
                <li class="edit-product dropdown dropdown-editproduct menu-item"><i class="fa-solid fa-coins"></i>จัดการสินค้า<i class="fa-solid fa-caret-down"></i>
                    <ul class="menu menu-editproduct">
                        <li><a href="">จัดการชนิดสินค้า</a></li>
                        <li><a href="">(เพิ่ม/ลบ) รายการสินค้า</a></li>
                    </ul>
                </li>
                <!---member--->
                <li class="member-list menu-item"><a href=""><i class="fa-solid fa-users"></i>จัดการสมาชิก</a></li>
                <!---edit-website--->
                <p class="title text-white">การจัดการหน้าเว็พไซต์</p>
                <li class="edit-website menu-item"><a href=""><i class="fa-solid fa-brush"></i>ตกเเต่งหน้าเว็พไขต์</a></li>
                <!---order--->
                <p class="title text-white">รายการ</p>
                <li class="order dropdown dropdown-order menu-item"><i class="fa-solid fa-table-list"></i></i>การสั่งซืัอ<i class="fa-solid fa-caret-down"></i>
                    <ul class="menu menu-order">
                        <li><a href="">ซืัอRobux</a></li>
                        <li><a href="">ซืัอItem</a></li>
                    </ul>
                </li>
            </ul>
            <div class="porfile flex p-1">
                <div class="image-profile">
                    <img src="../pages/image_profile/<?php echo $row['profile_img']; ?>" alt="" class="profile-image h-full">
                </div>
                <div class="admin-name flex">
                    <p><?php echo $row['username']; ?></p>
                </div>
                <div class="logout flex">
                    <form action="../services/profile_db.php" method="post">
                        <button type="submit" name="logout" class="btn btn-logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/script.js"></script>
</body>

</html>