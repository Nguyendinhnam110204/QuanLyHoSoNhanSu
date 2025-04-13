<?php
    // Kết nối tới cơ sở dữ liệu
    require_once '../Connect.php'; // File connect.php chứa thông tin kết nối MySQL

    // Kiểm tra nếu form được gửi đi (người dùng nhấn nút Thêm)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $MaDinhDanh = $_POST['MaDinhDanh'];
        $HoTen = $_POST['HoTen'];
        $GioiTinh = $_POST['GioiTinh'];
        $NamSinh = $_POST['NamSinh'];
        $CMND_CCCD = $_POST['CMND_CCCD'];
        $SoDienThoai = $_POST['SoDienThoai'];
        $Email = $_POST['Email'];
        $DiaChi = $_POST['DiaChi'];
        $NgayVaoLam = $_POST['NgayVaoLam'];
        $NgayNghiHuu = $_POST['NgayNghiHuu']; // Sử dụng giá trị từ form
        $TinhTrangLamViec = $_POST['TinhTrangLamViec'];
        $LoaiHopDong = $_POST['LoaiHopDong'];
        $TenChucVu = $_POST['TenChucVu'];

        $NamSinh = $_POST['NamSinh'];
        $NgayVaoLam = $_POST['NgayVaoLam'];
        $NgayNghiHuu = $_POST['NgayNghiHuu'];
        
        // Chuyển đổi các ngày thành DateTime objects để so sánh chính xác hơn
        $date_ngaysinh = new DateTime($NamSinh);
        $date_ngayvaolam = new DateTime($NgayVaoLam);
        $date_ngaynghihuu = new DateTime($NgayNghiHuu);
        $date_now = new DateTime();

        // Tính tuổi
        $age = $date_now->diff($date_ngaysinh)->y;

        // Kiểm tra tuổi phải đủ 18
        if ($age < 18) {
            echo "<script>alert('Nhân viên phải đủ 18 tuổi!'); window.history.back();</script>";
            exit();
        }

        // Tính khoảng cách giữa ngày sinh và ngày vào làm
        $years_to_work = $date_ngayvaolam->diff($date_ngaysinh)->y;
        
        // Kiểm tra ngày vào làm phải sau ngày sinh ít nhất 18 năm
        if ($years_to_work < 18) {
            echo "<script>alert('Ngày vào làm phải sau ngày sinh ít nhất 18 năm!'); window.history.back();</script>";
            exit();
        }

        // Kiểm tra ngày nghỉ hưu phải sau ngày vào làm
        if ($date_ngaynghihuu <= $date_ngayvaolam) {
            echo "<script>alert('Ngày nghỉ hưu phải lớn hơn ngày vào làm!'); window.history.back();</script>";
            exit();
        }

        // Kiểm tra độ dài và định dạng của CMND/CCCD
        if (!preg_match("/^\d{10}$/", $CMND_CCCD)) { // Sử dụng $cmndCccd (viết thường)
            echo "<script>alert('CMND/CCCD phải có đúng 10 số!'); window.history.back();</script>";
            exit();
        }

        // Kiểm tra Mã định danh trùng
        $sql_check = "SELECT * FROM NhanSu WHERE MaDinhDanh = '$MaDinhDanh'";
        $result_check = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            echo "<script>alert('Mã định danh này đã tồn tại! Vui lòng kiểm tra lại.'); window.history.back();</script>";
            exit();
        }

        // Kiểm tra CMND/CCCD trùng
        $sql_check = "SELECT * FROM NhanSu WHERE CMND_CCCD = '$CMND_CCCD'";
        $result_check = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            echo "<script>alert('CMND/CCCD này đã tồn tại! Vui lòng kiểm tra lại.'); window.history.back();</script>";
            exit();
        }

        // Kiểm tra Email trùng
        $sql_check = "SELECT * FROM NhanSu WHERE Email = '$Email'";
        $result_check = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            echo "<script>alert('Email này đã tồn tại! Vui lòng kiểm tra lại.'); window.history.back();</script>";
            exit();
        }

        // Thêm nhân sự vào cơ sở dữ liệu
        $sql_insert = "INSERT INTO NhanSu (MaDinhDanh,HoTen, GioiTinh, NgaySinh, CMND_CCCD, SoDienThoai, Email, DiaChi, NgayVaoLam, NgayNghiHuu, TinhTrangLamViec, LoaiHopDong, MaChucVu) 
        VALUES ('$MaDinhDanh','$HoTen', '$GioiTinh', '$NamSinh', '$CMND_CCCD', '$SoDienThoai', '$Email', '$DiaChi', '$NgayVaoLam', '$NgayNghiHuu', '$TinhTrangLamViec', '$LoaiHopDong', '$TenChucVu')";

        if (mysqli_query($conn, $sql_insert)) {
            echo "<script>alert('Thêm nhân sự thành công!'); window.location.href = 'NhanSu_Index.php';</script>";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    }
?>
