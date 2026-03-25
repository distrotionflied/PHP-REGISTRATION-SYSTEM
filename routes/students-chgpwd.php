<?php
declare(strict_types=1);

$id = (int)($_GET['id'] ?? 0); 

if ($id <= 0) { notFound(); }

// --- ส่วนที่จัดการตอนกดปุ่ม (POST) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($password) || $password !== $confirm_password) {
        // ต้อง Redirect กลับมาที่ชื่อไฟล์ตรงๆ พร้อม ?id=
        header("Location: /students-chgpwd?id=$id&error=mismatch");
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $isUpdated = updateStudentPassword($id, $hashed_password);

    if ($isUpdated) {
        header('Location: /students?success=password_changed');
    } else {
        // ถ้า update ไม่ได้ (เช่นรหัสเดิม) ก็ต้องกลับมาที่หน้าเดิมให้ถูก
        header("Location: /students-chgpwd?id=$id&error=update_failed");
    }
    exit;
}

// --- ส่วนที่ดึงข้อมูลมาแสดงหน้าจอ (GET) ---
$student = getStudentById($id);
if (!$student) { notFound(); exit; }

renderView('students-chgpwd', [
    'id' => $id,
    'student' => $student
]);