<?php
// ประมวลผลก่อนแสดงผลหน้า
$title = 'Welcome to Registration System';
$studentData = null;
if (isset($_SESSION['user_id'])) {
    $result = getStudentNameById($_SESSION['user_id']);
    if($result){
        $studentData = $result;
    }
}
renderView(
    'home',
    [
        'title' => $title,
        'name' => $studentData
    ]
);
