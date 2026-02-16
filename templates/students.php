<html>

<head>
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'header.php' ?>
    <main>
        
        <h1><?= htmlspecialchars($title) ?></h1>
        <div class="container">
        <h2>ข้อมูลนักเรียน</h2>
        <?php
        if(empty($user)):
        ?>
        <h5>ไม่พบข้อมูล</h5>
        <?php else: 
            $table_head = ['ชื่อ','นามสกุล','วันเกิด','เบอร์โทรศัพท์'];?>
        <table border="2">
            <tr>
                <th>ชื่อ</th>
                <td><?= htmlspecialchars($user['fname'] ?? 'unknown') ?></td>
            </tr>
            <tr>
                <th>นามสกุล</th>
                <td><?= htmlspecialchars($user['lanme'] ?? 'unknown') ?></td>
            </tr>
            <tr>
                <th>วันเกิด</th>
                <td><?= htmlspecialchars($user['birthday'] ?? 'unknown') ?></td>
            </tr>
            <tr>
                <th>เบอร์โทรศัพท์</th>
                <td><?= htmlspecialchars($user['tel'] ?? 'unknown') ?></td>
            </tr>
        </table>
        <?php endif; ?>
        </div>
        <div class="container">
        <h2>วิชาที่ลงทะเบียน</h2>
            <?php if (empty($enroll)): ?>

                <h5>ไม่พบข้อมูล</h5>

            <?php else: ?>

            <table border="2">
                <tr>
                    <th>รหัสวิชา</th>
                    <th>ชื่อวิชา</th>
                    <th>อาจารย์ผู้สอน</th>
                    <th>วันที่ลงทะเบียน</th>
                    <th>จัดการ</th>
                </tr>

                <?php foreach ($enroll as $course): ?>
                    <tr>
                        <td><?= htmlspecialchars($course['code']) ?></td>
                        <td><?= htmlspecialchars($course['name']) ?></td>
                        <td><?= htmlspecialchars($course['teacher']) ?></td>
                        <td><?= htmlspecialchars($course['enroll_date']) ?></td>
                        <td>
                            <a href="/enroll-delete?id=<?= htmlspecialchars($course['id']) ?>"
                            onclick="return confirmSubmission()"
                            class="a">
                            ถอนรายวิชา
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>

            <?php endif; ?>
        </div>
    </main>

    
    <?php include 'footer.php' ?>
    <script>
        function confirmSubmission() {
            return confirm("ยืนยันการถอนรายวิชา ?");
        }
    </script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('message');

        if (message) {
            alert(message); // แสดงข้อความที่ส่งมาจาก URL
            
            // ล้าง URL ให้สวยงาม ไม่ให้มี ?message=... ค้างอยู่
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    </script>
</body>

</html>