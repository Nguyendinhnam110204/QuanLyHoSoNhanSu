<?php
// Kết nối cơ sở dữ liệu
include '../Connect.php'; // File này chứa kết nối đến database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $maNhanSu = $_POST["MaNhanSu"];
    $hoTen = $_POST["HoTen"];
    $gioiTinh = $_POST["GioiTinh"];
    $namSinh = $_POST["NamSinh"];
    $CMND_CCCD = $_POST["CMND_CCCD"];
    $soDienThoai = $_POST["SoDienThoai"];
    $email = $_POST["Email"];
    $diaChi = $_POST["DiaChi"];
    $ngayVaoLam = $_POST["NgayVaoLam"];
    $ngayNghiHuu = $_POST["NgayNghiHuu"];
    $tinhTrangLamViec = $_POST["TinhTrangLamViec"];
    $loaiHopDong = $_POST["LoaiHopDong"];
    $tenChucVu = $_POST["TenChucVu"];

    // Kiểm tra độ dài và định dạng của CMND/CCCD
    if (!preg_match("/^\d{10}$/", $CMND_CCCD)) { // Sử dụng $cmndCccd (viết thường)
        echo "<script>alert('CMND/CCCD phải có đúng 10 số!'); window.history.back();</script>";
        exit();
    }

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

    // Kiểm tra Email trùng
    $sql_check = "SELECT * FROM NhanSu WHERE Email = '$Email'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo "<script>alert('Email này đã tồn tại! Vui lòng kiểm tra lại.'); window.history.back();</script>";
        exit();
    }

    // Câu lệnh SQL để cập nhật
    $sql = "UPDATE NhanSu 
            SET 
                HoTen = ?, 
                GioiTinh = ?, 
                NgaySinh = ?, 
                CMND_CCCD = ?, 
                SoDienThoai = ?, 
                Email = ?, 
                DiaChi = ?, 
                NgayVaoLam = ?, 
                NgayNghiHuu = ?, 
                TinhTrangLamViec = ?, 
                LoaiHopDong = ?, 
                MaChucVu = ?
            WHERE MaNhanSu = ?";

    // Chuẩn bị và thực thi câu lệnh
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssssssssi",
        $hoTen,
        $gioiTinh,
        $namSinh,
        $CMND_CCCD,
        $soDienThoai,
        $email,
        $diaChi,
        $ngayVaoLam,
        $ngayNghiHuu,
        $tinhTrangLamViec,
        $loaiHopDong,
        $tenChucVu,
        $maNhanSu
    );

    // Kiểm tra kết quả
    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật nhân sự thành công!'); window.location.href = 'NhanSu_Index.php';</script>";
    } else {
        echo "<script>alert('Cập nhật nhân sự thất bại!'); window.location.href = 'NhanSu_Index.php';</script>";
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();
} else {
    // Nếu không phải phương thức POST, chuyển hướng về danh sách
    header("Location: NhanSu_Index.php");
    exit();
}
?>
