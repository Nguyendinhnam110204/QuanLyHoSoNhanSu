<!DOCTYPE html>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../CSS/Admin_Style.css?v = <?php echo time(); ?>">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Admin</title>
    <style>
    * {
        font-family: "Ubuntu", sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    </style>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../Img/vlogo.png" alt="" style="width: 190px; padding-left:23px;">
            </div>

            <!-- <span class="logo_name" style="color: orange;">UTT SCHOOL</span> -->
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="../TaiKhoan/TaiKhoan_Index.php">
                        <i class="uil uil-user"></i>
                        <span class="link-name">Quản lý tài khoản</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-table"></i>
                        <span class="link-name">Quản lý nhân sự</span>
                    </a></li>
                <li><a href="../Thongtincongviec/ThongTinCongViec.php">
                        <i class="uil uil-book-reader"></i>
                        <span class="link-name">Quản lý công việc</span>
                    </a></li>
                <li><a href="../quanlychucvu/ChucVu.php">
                        <i class="uil uil-briefcase-alt"></i>
                        <span class="link-name">Quản lý Chức Vụ</span>
                    </a></li>
                <li><a href="../Nghiphep/Nghiphep_Admin_Index.php">
                        <i class="uil uil-file-info-alt"></i>
                        <span class="link-name">Quản lý nghỉ phép</span>
                    </a></li>
                <li><a href="../Luong/Luong_Index.php">
                        <i class="uil uil-subject"></i>
                        <span class="link-name">Quản lý lương</span>
                    </a></li>
                <li><a href="../Lichsucongtac/lichsucongtac_Index.php">
                        <i class="uil uil-book-open"></i>
                        <span class="link-name">Lịch sử công tác</span>
                    </a></li>
                <li><a href="../report/BaoCaoThongKe_Index.php">
                        <i class="uil uil-analytics"></i>
                        <span class="link-name">Báo cáo và thống kê</span>
                    </a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="../Login/DangXuat.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Đăng xuất</span>
                    </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Chế độ</span>
                    </a>

                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>



            <img src="../Img/IMG_0190.JPG" alt="Avatar" style="margin-right: 50px;">
        </div>

        <div class="dash-content" style="margin-top: 20px;">
            <div class="container" style="text-align: center;">
                <h1 style="font-family: 'Times New Roman', Times, serif;"><b>Quản lý Nhân sự</b></h1>

                <div class="input-group mb-3" style="margin-top: 50px; width: 400px;">
                    <form action="NhanSu_Index.php" method="get" style="display: flex; width: 100%;">
                        <input type="search" class="form-control" placeholder="Tìm kiếm nhân sự" name="searchTerm">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit" style="width: 100px;">Tìm Kiếm</button>
                        </div>
                    </form>
                </div>

                <br>
                <table class="table" style="margin: -15px 0 0 -10px; width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Mã định danh</th>
                            <th>Họ tên</th>
                            <th>Giới tính</th>
                            <th>CMNN-CCCD</th>
                            <th>Chức vụ</th>
                            <th>Tình trạng làm việc</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once '../Connect.php';

                            $searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';
                            if ($searchTerm) {
                                $list_sql = "SELECT * FROM NhanSu 
                                            JOIN ChucVu ON NhanSu.MaChucVu = ChucVu.MaChucVu
                                            WHERE HoTen LIKE '%$searchTerm%'
                                            OR CMND_CCCD LIKE '%$searchTerm%'
                                            OR TenChucVu LIKE '%$searchTerm%'
                                            OR MaDinhDanh LIKE '%$searchTerm%'
                                            ORDER BY HoTen, TenChucVu";
                            } else {
                                $list_sql = "SELECT * FROM NhanSu
                                            JOIN ChucVu ON NhanSu.MaChucVu = ChucVu.MaChucVu
                                            ORDER BY TenChucVu, HoTen";
                            }
                            $result = mysqli_query($conn, $list_sql);

                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["MaDinhDanh"]); ?></td>
                            <td><?php echo htmlspecialchars($row["HoTen"]); ?></td>
                            <td><?php echo htmlspecialchars($row["GioiTinh"]); ?></td>
                            <td><?php echo htmlspecialchars($row["CMND_CCCD"]); ?></td>
                            <td><?php echo htmlspecialchars($row["TenChucVu"]); ?></td>
                            <td><?php echo htmlspecialchars($row["TinhTrangLamViec"]); ?></td>
                            <td>
                                <button type="button" class="btn btn-info btn-detail"
                                    data-MaNhanSu="<?php echo $row["MaNhanSu"]; ?>"
                                    data-MaDinhDanh="<?php echo htmlspecialchars($row["MaDinhDanh"]); ?>"
                                    data-HoTen="<?php echo htmlspecialchars($row["HoTen"]); ?>"
                                    data-GioiTinh="<?php echo htmlspecialchars($row["GioiTinh"]); ?>"
                                    data-NgaySinh="<?php echo htmlspecialchars($row["NgaySinh"]); ?>"
                                    data-CMND_CCCD="<?php echo htmlspecialchars($row["CMND_CCCD"]); ?>"
                                    data-SoDienThoai="<?php echo htmlspecialchars($row["SoDienThoai"]); ?>"
                                    data-Email="<?php echo htmlspecialchars($row["Email"]); ?>"
                                    data-DiaChi="<?php echo htmlspecialchars($row["DiaChi"]); ?>"
                                    data-NgayVaoLam="<?php echo htmlspecialchars($row["NgayVaoLam"]); ?>"
                                    data-NgayNghiHuu="<?php echo htmlspecialchars($row["NgayNghiHuu"]); ?>"
                                    data-TinhTrangLamViec="<?php echo htmlspecialchars($row["TinhTrangLamViec"]); ?>"
                                    data-LoaiHopDong="<?php echo htmlspecialchars($row["LoaiHopDong"]); ?>"
                                    data-TenChucVu="<?php echo htmlspecialchars($row["TenChucVu"]); ?>"
                                    data-toggle="modal" data-target="#detailModal">
                                    Xem Chi Tiết
                                </button>
                                <button type="button" class="btn btn-success btn-update"
                                    data-MaNhanSu="<?php echo $row["MaNhanSu"]; ?>"
                                    data-MaDinhDanh="<?php echo htmlspecialchars($row["MaDinhDanh"]); ?>"
                                    data-HoTen="<?php echo htmlspecialchars($row["HoTen"]); ?>"
                                    data-GioiTinh="<?php echo htmlspecialchars($row["GioiTinh"]); ?>"
                                    data-NamSinh="<?php echo htmlspecialchars($row["NgaySinh"]); ?>"
                                    data-CMND_CCCD="<?php echo htmlspecialchars($row["CMND_CCCD"]); ?>"
                                    data-SoDienThoai="<?php echo htmlspecialchars($row["SoDienThoai"]); ?>"
                                    data-Email="<?php echo htmlspecialchars($row["Email"]); ?>"
                                    data-DiaChi="<?php echo htmlspecialchars($row["DiaChi"]); ?>"
                                    data-NgayVaoLam="<?php echo htmlspecialchars($row["NgayVaoLam"]); ?>"
                                    data-NgayNghiHuu="<?php echo htmlspecialchars($row["NgayNghiHuu"]); ?>"
                                    data-TinhTrangLamViec="<?php echo htmlspecialchars($row["TinhTrangLamViec"]); ?>"
                                    data-LoaiHopDong="<?php echo htmlspecialchars($row["LoaiHopDong"]); ?>"
                                    data-TenChucVu="<?php echo htmlspecialchars($row["TenChucVu"]); ?>"
                                    data-toggle="modal" data-target="#updateModal">
                                    Cập Nhật
                                </button>
                                <a onclick="return confirm('Bạn có muốn xóa tài khoản này không?')"
                                    href="NhanSu_Delete.php?MaNhanSu=<?php echo $row["MaNhanSu"]; ?>"
                                    class="btn btn-danger">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                        <tr>
                            <td colspan="9"><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#myModal">Thêm</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal chi tiết -->
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Chi Tiết Nhân Sự</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><b>Mã định danh:</b> <span id="detailMaDinhDanh"></span></p>
                        <p><b>Họ và tên:</b> <span id="detailHoTen"></span></p>
                        <p><b>Giới tính:</b> <span id="detailGioiTinh"></span></p>
                        <p><b>Ngày sinh:</b> <span id="detailNgaySinh"></span></p>
                        <p><b>CMND_CCCD:</b> <span id="detailCMND_CCCD"></span></p>
                        <p><b>Số điện thoại:</b> <span id="detailSoDienThoai"></span></p>
                        <p><b>Email:</b> <span id="detailEmail"></span></p>
                        <p><b>Địa chỉ:</b> <span id="detailDiaChi"></span></p>
                        <p><b>Ngày vào làm:</b> <span id="detailNgayVaoLam"></span></p>
                        <p><b>Ngày nghỉ hưu:</b> <span id="detailNgayNghiHuu"></span></p>
                        <p><b>Tình trạng làm việc:</b> <span id="detailTinhTrangLamViec"></span></p>
                        <p><b>Loại hợp đồng:</b> <span id="detailLoaiHopDong"></span></p>
                        <p><b>Chức vụ:</b> <span id="detailTenChucVu"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Xử lý sự kiện click vào nút "Xem Chi Tiết"
            const detailButtons = document.querySelectorAll(".btn-detail");
            detailButtons.forEach(button => {
                button.addEventListener("click", function() {
                    // Lấy dữ liệu từ thuộc tính data-*
                    const maDinhDanh = this.getAttribute("data-MaDinhDanh");
                    const hoTen = this.getAttribute("data-HoTen");
                    const gioiTinh = this.getAttribute("data-GioiTinh");
                    const ngaySinh = this.getAttribute("data-NgaySinh");
                    const CMND_CCCD = this.getAttribute("data-CMND_CCCD");
                    const soDienThoai = this.getAttribute("data-SoDienThoai");
                    const email = this.getAttribute("data-Email");
                    const diaChi = this.getAttribute("data-DiaChi");
                    const ngayVaoLam = this.getAttribute("data-NgayVaoLam");
                    const ngayNghiHuu = this.getAttribute("data-NgayNghiHuu");
                    const tinhTrangLamViec = this.getAttribute("data-TinhTrangLamViec");
                    const loaiHopDong = this.getAttribute("data-LoaiHopDong");
                    const tenChucVu = this.getAttribute("data-TenChucVu");

                    // Cập nhật thông tin vào modal
                    document.getElementById("detailMaDinhDanh").textContent = maDinhDanh;
                    document.getElementById("detailHoTen").textContent = hoTen;
                    document.getElementById("detailGioiTinh").textContent = gioiTinh;
                    document.getElementById("detailNgaySinh").textContent = ngaySinh;
                    document.getElementById("detailCMND_CCCD").textContent = CMND_CCCD;
                    document.getElementById("detailSoDienThoai").textContent = soDienThoai;
                    document.getElementById("detailEmail").textContent = email;
                    document.getElementById("detailDiaChi").textContent = diaChi;
                    document.getElementById("detailNgayVaoLam").textContent = ngayVaoLam;
                    document.getElementById("detailNgayNghiHuu").textContent = ngayNghiHuu;
                    document.getElementById("detailTinhTrangLamViec").textContent =
                        tinhTrangLamViec;
                    document.getElementById("detailLoaiHopDong").textContent = loaiHopDong;
                    document.getElementById("detailTenChucVu").textContent = tenChucVu;
                });
            });
        });
        </script>




        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="font-family: 'Times New Roman', Times, serif;">Thêm nhân sự</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Thêm -->
                    <div class="modal-body">
                        <form action="NhanSu_Insert.php" method="post">
                            <div class="form-group">
                                <label for="MaDinhDanh">Mã định danh</label>
                                <input type="text" class="form-control" id="MaDinhDanh" name="MaDinhDanh" required>
                            </div>
                            <div class="form-group">
                                <label for="HoTen">Họ tên</label>
                                <input type="text" class="form-control" id="HoTen" name="HoTen" required>
                            </div>
                            <div class="form-group">
                                <label for="GioiTinh">Giới tính</label>
                                <select class="form-control" id="GioiTinh" name="GioiTinh" required>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="NamSinh">Năm sinh</label>
                                <input type="date" class="form-control" id="NamSinh" name="NamSinh" required>
                            </div>
                            <div class="form-group">
                                <label for="CMND_CCCD">CMND_CCCD</label>
                                <input type="text" class="form-control" id="CMND_CCCD" name="CMND_CCCD" required>
                            </div>
                            <div class="form-group">
                                <label for="SoDienThoai">Số điện thoại</label>
                                <input type="text" class="form-control" id="SoDienThoai" name="SoDienThoai" required>
                            </div>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="email" class="form-control" id="Email" name="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="DiaChi">Địa chỉ</label>
                                <input type="text" class="form-control" id="DiaChi" name="DiaChi" required>
                            </div>
                            <div class="form-group">
                                <label for="NgayVaoLam">Ngày vào làm</label>
                                <input type="date" class="form-control" id="NgayVaoLam" name="NgayVaoLam" required>
                            </div>
                            <div class="form-group">
                                <label for="NgayNghiHuu">Ngày nghỉ hưu</label>
                                <input type="date" class="form-control" id="NgayNghiHuu" name="NgayNghiHuu" required>
                            </div>
                            <div class="form-group">
                                <label for="TinhTrangLamViec">Tình trạng làm việc</label>
                                <select class="form-control" id="TinhTrangLamViec" name="TinhTrangLamViec" required>
                                    <option value="Đang làm">Đang làm</option>
                                    <option value="Đã nghỉ">Đã nghỉ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="LoaiHopDong">Loại hợp đồng</label>
                                <input type="text" class="form-control" id="LoaiHopDong" name="LoaiHopDong" required>
                            </div>
                            <div class="form-group">
                                <label for="TenChucVu">Chức vụ</label>
                                <select class="form-control" id="TenChucVu" name="TenChucVu">
                                    <?php
                                        $author_sql = "SELECT MaChucVu, TenChucVu FROM ChucVu";
                                        $author_result = mysqli_query($conn, $author_sql);

                                        while ($author_row = mysqli_fetch_assoc($author_result)) {
                                            echo '<option value="' . $author_row["MaChucVu"] . '">' . $author_row["TenChucVu"] . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Thêm</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"
                                style="margin-left: 325px;">Đóng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal" id="updateModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Sửa Thông Tin Nhân Sự</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form action="NhanSu_Update.php" method="post">
                            <input type="hidden" name="MaNhanSu" id="update_MaNhanSu">

                            <div class="form-group">
                                <label for="update_MaDinhDanh">Mã định danh</label>
                                <input type="text" class="form-control" id="update_MaDinhDanh" name="MaDinhDanh"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="update_HoTen">Họ tên</label>
                                <input type="text" class="form-control" id="update_HoTen" name="HoTen" required>
                            </div>
                            <div class="form-group">
                                <label for="update_GioiTinh">Giới tính</label>
                                <select class="form-control" id="update_GioiTinh" name="GioiTinh" required>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="update_NamSinh">Năm sinh</label>
                                <input type="date" class="form-control" id="update_NamSinh" name="NamSinh" required>
                            </div>
                            <div class="form-group">
                                <label for="update_CMND_CCCD">CMND/CCCD</label>
                                <input type="text" class="form-control" id="update_CMND_CCCD" name="CMND_CCCD" required>
                            </div>
                            <div class="form-group">
                                <label for="update_SoDienThoai">Số điện thoại</label>
                                <input type="text" class="form-control" id="update_SoDienThoai" name="SoDienThoai"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="update_Email">Email</label>
                                <input type="email" class="form-control" id="update_Email" name="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="update_DiaChi">Địa chỉ</label>
                                <input type="text" class="form-control" id="update_DiaChi" name="DiaChi" required>
                            </div>
                            <div class="form-group">
                                <label for="update_NgayVaoLam">Ngày vào làm</label>
                                <input type="date" class="form-control" id="update_NgayVaoLam" name="NgayVaoLam"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="update_NgayNghiHuu">Ngày nghỉ hưu</label>
                                <input type="date" class="form-control" id="update_NgayNghiHuu" name="NgayNghiHuu"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="update_TinhTrangLamViec">Tình trạng làm việc</label>
                                <select class="form-control" id="update_TinhTrangLamViec" name="TinhTrangLamViec"
                                    required>
                                    <option value="Đang làm">Đang làm</option>
                                    <option value="Đã nghỉ">Đã nghỉ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="update_LoaiHopDong">Loại hợp đồng</label>
                                <input type="text" class="form-control" id="update_LoaiHopDong" name="LoaiHopDong"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="update_TenChucVu">Chức vụ</label>
                                <select class="form-control" id="update_TenChucVu" name="TenChucVu">
                                    <?php
                                        $author_sql = "SELECT MaChucVu, TenChucVu FROM ChucVu";
                                        $author_result = mysqli_query($conn, $author_sql);

                                        while ($author_row = mysqli_fetch_assoc($author_result)) {
                                            echo '<option value="' . $author_row["MaChucVu"] . '">' . $author_row["TenChucVu"] . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Cập nhật</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Lấy tất cả các nút "Cập Nhật"
                const updateButtons = document.querySelectorAll('.btn-update');

                updateButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Lấy giá trị từ các thuộc tính data-
                        const maNhanSu = this.getAttribute("data-MaNhanSu");
                        const maDinhDanh = this.getAttribute("data-MaDinhDanh");
                        const hoTen = this.getAttribute("data-HoTen");
                        const gioiTinh = this.getAttribute("data-GioiTinh");
                        const namSinh = this.getAttribute("data-NamSinh");
                        const CMND_CCCD = this.getAttribute("data-CMND_CCCD");
                        const soDienThoai = this.getAttribute("data-SoDienThoai");
                        const email = this.getAttribute("data-Email");
                        const diaChi = this.getAttribute("data-DiaChi");
                        const ngayVaoLam = this.getAttribute("data-NgayVaoLam");
                        const ngayNghiHuu = this.getAttribute("data-NgayNghiHuu");
                        const tinhTrangLamViec = this.getAttribute("data-TinhTrangLamViec");
                        const loaiHopDong = this.getAttribute("data-LoaiHopDong");
                        const tenChucVu = this.getAttribute("data-TenChucVu");

                        // Cập nhật thông tin vào modal
                        document.getElementById("update_MaNhanSu").value = maNhanSu;
                        document.getElementById("update_MaDinhDanh").value = maDinhDanh;
                        document.getElementById("update_HoTen").value = hoTen;
                        document.getElementById("update_GioiTinh").value = gioiTinh;
                        document.getElementById("update_NamSinh").value = namSinh;
                        document.getElementById("update_CMND_CCCD").value = CMND_CCCD;
                        document.getElementById("update_SoDienThoai").value = soDienThoai;
                        document.getElementById("update_Email").value = email;
                        document.getElementById("update_DiaChi").value = diaChi;
                        document.getElementById("update_NgayVaoLam").value = ngayVaoLam;
                        document.getElementById("update_NgayNghiHuu").value = ngayNghiHuu;
                        document.getElementById("update_TinhTrangLamViec").value = tinhTrangLamViec;
                        document.getElementById("update_LoaiHopDong").value = loaiHopDong;

                        // Xử lý select option cho dropdown chức vụ
                        const chucVuDropdown = document.getElementById("update_TenChucVu");
                        for (let i = 0; i < chucVuDropdown.options.length; i++) {
                            if (chucVuDropdown.options[i].text === tenChucVu) {
                                chucVuDropdown.selectedIndex = i;
                                break;
                            }
                        }
                    });
                });
            });

        button.addEventListener('click', function() {
            // Các giá trị khác
            const tenChucVu = this.getAttribute("data-TenChucVu");

            // Gán giá trị cho dropdown chức vụ
            const dropdown = document.getElementById("update_TenChucVu");
            Array.from(dropdown.options).forEach(option => {
                option.selected = (option.textContent === tenChucVu);
            });
        });
        </script>


        </div>
    </section>

    <script src="../JS/Admin_Script.js?v = <?php echo time(); ?>"></script>
</body>

</html>