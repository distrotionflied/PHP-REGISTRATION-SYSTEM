<?php

declare(strict_types=1);

if (!isset($_GET['id'])) {
    header('Location: /students');
    exit;
} else {
    $id = (int)$_GET['id'];    
    $res = deleteEnrollById($id);
    if ($res) {
        header('Location: /students?status=success&message=ถอนรายวิชาสำเร็จ');
        exit;
    } else {
        // ถ้าลบไม่สำเร็จ (เช่น มีคนลบไปแล้ว หรือ SQL พัง)
        header('Location: /students?status=error&message=ไม่สามารถดำเนินการได้');
        exit;
    } 
}
