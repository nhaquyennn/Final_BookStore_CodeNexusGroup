<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "layout/header.php"; ?>
  <title>Danh Mục Ấn Phẩm</title>
  <link rel="stylesheet" href="public/css/style.css">
</head>

<body class="bg-theme bg-theme2">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
          <h5>Danh mục</h5>
          <ul class="list-group">
            <li class="list-group-item" onclick="toggleSubMenu()">Danh mục Ấn Phẩm</li>
            <ul id="sub-menu" class="hidden sub-menu">
              <li class="sub-menu-item" onclick="showProducts('giaokhoa')">Sách Giáo Khoa</li>
              <li class="sub-menu-item" onclick="showProducts('thamkhao')">Sách Tham Khảo</li>
              <li class="sub-menu-item" onclick="showProducts('truyentranh')">Truyện Tranh</li>
            </ul>
          </ul>
        </div>

        <!-- Topbar -->
        <header class="topbar-nav">
          <?php require_once "layout/topbar.php" ?>
        </header>
        <!-- end Topbar -->

        <!-- Main Content -->




      </div>
    </div>
  </div>

  <?php require_once "layout/script.php"; ?>


</body>

</html>