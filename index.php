<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include 'includes/config.php';
include 'includes/header.php';

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
if ($search) {
    $sql = "SELECT * FROM students WHERE name LIKE '%$search%' OR student_id LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM students";
}
$result = mysqli_query($conn, $sql);
?>

<h2>Danh sách Sinh viên</h2>
<form method="GET" action="index.php" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm sinh viên" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit" class="btn btn-success">Tìm</button>
    </div>
</form>


<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Mã SV</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ</th>
        <th>Thao tác</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['student_id']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td>
                <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Sửa</a>
                <a href="delete_student.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
            </td>
        </tr>
    <?php } ?>
</table>
</div>
</body>

</html>
