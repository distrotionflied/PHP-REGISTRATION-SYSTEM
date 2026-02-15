<?php
declare(strict_types=1);

// เพิ่มบรรทัดนี้ไว้ก่อนเช็ค if
$env = parse_ini_file(__DIR__ . '/../.env');
foreach ($env as $key => $value) {
    $_ENV[$key] = $value;
}

// เช็คสิทธิ์ก่อน (สมมติว่าต้องเป็น Admin ถึงจะดูรายชื่อนักเรียนทั้งหมดได้)
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != $_ENV['ADMIN_PASS']) {
    header('Location: /home');
    exit;
}

// เรียกฟังก์ชันที่คุณเตรียมไว้
$result = getStudents(); 

// ส่งข้อมูลไปที่หน้า Template
renderView('students-list', [
    'title' => 'รายชื่อนิสิตทั้งหมด',
    'students' => $result
]);