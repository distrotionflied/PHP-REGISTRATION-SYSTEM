<html>

<head>
    <title><?= htmlspecialchars($data['title']) ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'header.php' ?>
    <main>
        <h1><?= htmlspecialchars($data['title']) ?></h1>
        <h2>ข้อมูลนักเรียน</h2>
        <?php
        //ข้อมูลนิสิต
        $user = null;
        //ส่วนที่ดึงจาก enroll เพื่อจะได้ดึงจาก course เพื่อแสดงผล
        //ต้องเป็นอาเรย์เพราะมีหลายตัว
        $user_enroll = [];
        //ส่วนที่จะเอาไปแสดงผล 
        $course_enroll = [];
        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
            //เตรียมข้อมูลนิสิต
            $user_result = getStudentById($id);

            if ($user_result && $user_result->num_rows > 0) {
                //มันจะดึงแค่ครั้งเดียว
                $user = $user_result->fetch_assoc();
            }
            //เตรียมข้อมูลรายวิชาที่นิสิตลงทะเบียน

            $enroll_result = getEnrollById($id);

            if ($enroll_result && $enroll_result->num_rows > 0) {
                //ดึงหมด
                $user_enroll = $enroll_result->fetch_all(MYSQLI_ASSOC);

                foreach ($user_enroll as $row) {
                    $course_enroll[] = [
                        'enroll_id' => $row['enrollment_id'],
                        'id'   => $row['course_id'],
                        'date' => $row['enrollment_date']
                    ];
                }
            }
        }


        ?>
        <table border="2">
            <tr>
                <th>ชื่อ</th>
                <td><?= $user ? queryData('first_name', $user) : '' ?></td>
            </tr>
            <tr>
                <th>นามสกุล</th>
                <td><?= $user ? queryData('last_name', $user) : '' ?></td>
            </tr>
            <tr>
                <th>วันเกิด</th>
                <td><?= $user ? queryData('date_of_birth', $user) : '' ?></td>
            </tr>
            <tr>
                <th>เบอร์โทรศัพท์</th>
                <td><?= $user ? queryData('phone_number', $user) : '' ?></td>
            </tr>
        </table>

        <h2>วิชาที่ลงทะเบียน</h2>
    <table border="2">
        <?php
        if (!$course_enroll) {
            echo 'ไม่พบข้อมูล';
        }
        echo '
                <tr>
                    <th>รหัสวิชา</th>
                    <th>ชื่อวิชา</th>
                    <th>อาจารย์ผู้สอน</th>
                    <th>วันที่ลงทะเบียน</th>
                    <th></th>
                </tr>
                ';
        foreach ($course_enroll as $item) {
            $course_result = getCourseById($item['id']);
            $check_statement = ($course_result && $course_result->num_rows > 0);
            if (!$check_statement) {
                continue;
            }
            $course = $course_result->fetch_assoc();
            $c_code = queryData('course_code', $course);
            $c_name = queryData('course_name', $course);
            $c_instrictor = queryData('instructor', $course);
            $reg_date = $item['date'];
            echo '<tr>';
                echo '<td>' .
                    ($c_code ?: 'ไม่มีข้อมูล')
                    . '</td>';
                echo '<td>' .
                    ($c_name ?: 'ไม่มีข้อมูล')
                    . '</td>';
                echo '<td>' .
                    ($c_instrictor ?: 'ไม่มีข้อมูล')
                    . '</td>';
                echo '<td>' .
                    ($reg_date ?: 'ไม่มีข้อมูล')
                    . '</td>';
                echo '<td>
                        <a href="/enroll-delete?id=' . $item['enroll_id'] . '" 
                        onclick="return confirmSubmission()">ถอนรายวิชา</a>
                    </td>';
            echo '</tr>';
        }
        ?>

    </table>
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