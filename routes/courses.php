<?php
// get data for data for databases
$result = getCourses();
// 
renderView('courses',[
'title' => 'รายวิชาที่เปิดให้ลงทะเบียน',
'courses' => $result
]);