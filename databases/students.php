<?php
// ฟังก์ชันสำหรับดึงข้อมูลนักเรียนจากฐานข้อมูล
function getStudents(): mysqli_result|bool
{
    global $conn;
    $sql = 'select * from students';
    $result = $conn->query($sql);
    //$conn->close();
    return $result;
}

function getStudentsByKeyword(string $keyword): mysqli_result|bool
{
    global $conn;
    $conn = getConnection();
    $sql = 'SELECT * FROM students WHERE first_name LIKE ? OR last_name LIKE ?';
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false; // หรือจัดการ error ตามต้องการ
    }
    // สร้างตัวแปรใหม่เพื่อป้องกันการทับซ้ำค่าเดิม
    $searchTerm = '%' . $keyword . '%';
    // ผูกค่า (Binding)
    $stmt->bind_param('ss', $searchTerm, $searchTerm);
    
    // ตรวจสอบว่า Execute สำเร็จหรือไม่
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return $result;
    }

    return false;
}

function deleteStudentsById(int $id): bool
{
    global $conn;
    $sql = 'delete from students where student_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    return $stmt->affected_rows > 0;
}

function getStudentById(int $id): mysqli_result|bool
{
    global $conn;
    $sql = 'select * from students where student_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function updateStudentPassword(int $id, string $hashed_password): bool
{
    global $conn;
    $sql = 'update students set password = ? where student_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $hashed_password, $id);
    $stmt->execute();
    return  $stmt->affected_rows > 0;
}

function checkLogin(string $email, string $password): array|false
{
    global $conn;
    $sql = 'select * from students where email = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if(!password_verify($password, $row['password']))return false;
        return $row;
    }
    return false;
}
