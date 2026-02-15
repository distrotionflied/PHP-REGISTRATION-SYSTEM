<?php
// ไม่ต้อง session_start() ซ้ำถ้าไฟล์ index.php ทำไปแล้ว แต่ถ้ารันแยกต้องใส่นะครับ

// 1. อ่านไฟล์ .env เก็บเข้าตัวแปร $local_env
$local_env = parse_ini_file(__DIR__ . '/../.env');

// 2. ตรวจสอบว่าอ่านไฟล์สำเร็จไหม และยัดค่าลง $_ENV (ถ้าต้องการใช้ $_ENV ทั่วโปรเจกต์)
if ($local_env) {
    foreach ($local_env as $key => $value) {
        $_ENV[$key] = $value;
        putenv("$key=$value");
    }
}

$admin_pass = $_ENV['ADMIN_PASS'] ?? '';
$input_pass = $_GET['pass'] ?? '';

// 3. เช็คเงื่อนไข
if ($input_pass !== '' && $input_pass === $admin_pass) {
    // เซ็ต session สำคัญ 2 ตัวตามโครงสร้าง index.php ของคุณ
    $_SESSION['admin'] = $admin_pass;
    $_SESSION['timestamp'] = time(); 
    
    echo "Login Success! กำลังพาไปหน้า Home...";
    header('Refresh: 1; URL=/home');
    exit;
} else {
    echo "<h3>Error!</h3>";
    echo "รหัสที่คุณส่งมา: " . htmlspecialchars($input_pass) . "<br>";
    echo "รหัสใน .env ที่อ่านได้: " . ($admin_pass ? "ดึงค่าได้สำเร็จ" : "ยังดึงค่าไม่ได้ (ค่าว่าง)");
    die();
}