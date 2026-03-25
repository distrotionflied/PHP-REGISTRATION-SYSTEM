<?php

declare(strict_types=1);

if (!isset($_GET['id'])) {
    header('Location: /courses');
    exit;
} else {
    $id = (int)$_GET['id'];    
    $res = insertEnroll($_SESSION['user_id'],$id);
    if ($res['success']) {
        header('Location: /students?status=success&message=ลงทะเบียนรายวิชาสำเร็จ');
        exit;
    } else {
        // ถ้าลบไม่สำเร็จ (เช่น มีคนลบไปแล้ว หรือ SQL พัง)
        header('Location: /courses?status=error&message=ไม่สามารถดำเนินการได้ ('. $res['error'] .')');
        exit;
    }
}
