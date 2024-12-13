<nav class="navbar navbar-expand fixed-top">
    <ul class="navbar-nav mr-auto align-items-center">

        <li class="" style="margin-left:300px; margin-top: 15px">
            <form class="search-bar" action="" method="GET">
                <div style="display: flex; align-items: center;">
                    <select name="loaiTimKiem" class="form-control"
                        style="width: 180px; margin-right: 10px; height: 40px;">
                        <option value="anpham" <?php echo isset($_GET['loaiTimKiem']) && $_GET['loaiTimKiem'] == 'anpham' ? 'selected' : ''; ?>>Tìm ấn phẩm</option>
                        <option value="dauap" <?php echo isset($_GET['loaiTimKiem']) && $_GET['loaiTimKiem'] == 'dauap' ? 'selected' : ''; ?>>Tìm đầu ấn phẩm</option>
                        <option value="danhmuc" <?php echo isset($_GET['loaiTimKiem']) && $_GET['loaiTimKiem'] == 'danhmuc' ? 'selected' : ''; ?>>Tìm danh mục</option>

                    </select>
                    <input type="text" class="form-control" placeholder="Tìm kiếm" name="tim"
                        style="width:500px; float:left; height: 40px;" required>
                    <button type="submit" class="btn-success" name="timkiem"
                        style="margin-left:5px; border-radius: 3px; border:none; padding: 5px 10px; background-color:grey; height:38px">
                        <span class="material-icons" style="vertical-align: middle;">search</span></button>
                </div>
            </form>
            <?php
            if (isset($_GET['timkiem'])) {
                $tim = $_GET['tim'] ?? '';
                $loaiTimKiem = $_GET['loaiTimKiem'] ?? 'anpham'; // Mặc định là tìm ấn phẩm
            
                $_SESSION['timkiem'] = $tim;
                $_SESSION['loaiTimKiem'] = $loaiTimKiem;

                header("Location: index.php?page=timkiem&loaiTimKiem=$loaiTimKiem&tim=" . urlencode($tim));
                exit;
            }
            ?>
        </li>
    </ul>


</nav>