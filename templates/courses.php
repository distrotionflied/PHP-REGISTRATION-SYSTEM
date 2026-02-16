<html>

<head><link rel="stylesheet" href="style.css"></head>

<body>
    <?php include 'header.php' ?>

    <!-- ส่วนแสดงผลหลักของหน้า -->
    <main>
        <h1><?= htmlspecialchars($title) ?></h1>
        <?php  if (empty($courses)) : ?>
            <h4>ไม่พบข้อมูล</h4>
        <?php else:?>
        <table class="table">
                <tr>
                    <th>ลำดับที่</th>
                    <th>ชื่อวิชา</th>
                    <th>รหัสวิชา</th>
                    <th>อาจารย์ผู้สอน</th>
                    <th></th>
                </tr>
                <?php foreach ($courses as $course):?>
                        <tr>
                        <td><?= htmlspecialchars($course['id']) ?></td>
                        <td><?= htmlspecialchars($course['name']) ?></td>
                        <td><?= htmlspecialchars($course['code']) ?></td>
                        <td><?= htmlspecialchars($course['teacher']) ?></td>
                        <td><a href="/enroll-insert?id=<?= htmlspecialchars($course['id']) ?>" onclick="return confirmSubmission()">ลงทะเบียน</a></td>
                        </tr>
                <?php endforeach;?>
            </table>
        <?php endif;?>
        
    </main>
    <!-- ส่วนแสดงผลหลักของหน้า -->

    <?php include 'footer.php' ?>
    <script>
        function confirmSubmission() {
            return confirm("ยืนยันการลงทะเบียน ?");
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