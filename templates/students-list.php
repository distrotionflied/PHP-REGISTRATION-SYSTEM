<html>
<head>
    <title><?= htmlspecialchars($data['title']) ?></title>
</head>
<body>
    <?php include 'header.php' ?>

    <main>
        <h1><?= htmlspecialchars($data['title']) ?></h1>

        <table class="table">
            <tbody>
                <?php if ($data['students'] && $data['students']->num_rows > 0): ?>
                     <tr>
                        <th>ID</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>อีเมล</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>จัดการ</th>
                    </tr>
                    <?php while ($row = $data['students']->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['student_id'] ?></td>
                            <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['phone_number'] ?></td>
                            <td>
                                <a href="/students-chgpwd?id=<?= $row['student_id'] ?>">เปลี่ยนรหัสผ่าน</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">ไม่พบข้อมูลนิสิต</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>

    <?php include 'footer.php' ?>
</body>
</html>