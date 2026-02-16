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
    $statement = $conn->prepare($sql);
    if (!$statement) {
        return false; // หรือจัดการ error ตามต้องการ
    }
    // สร้างตัวแปรใหม่เพื่อป้องกันการทับซ้ำค่าเดิม
    $searchTerm = '%' . $keyword . '%';
    // ผูกค่า (Binding)
    $statement->bind_param('ss', $searchTerm, $searchTerm);
    
    // ตรวจสอบว่า Execute สำเร็จหรือไม่
    if ($statement->execute()) {
        $result = $statement->get_result();
        return $result;
    }

    return false;
}

function deleteStudentsById(int $id): bool
{
    global $conn;
    $sql = 'delete from students where student_id = ?';
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $id);
    $statement->execute();
    return $statement->affected_rows > 0;
}

function getStudentById(int $id): array
{
    global $conn;
    $sql = 'select * from students where student_id = ?';
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $id);
    $statement->execute();
    $result = $statement->get_result();
    if ($result->num_rows > 0) {
        //ดึง row เดียว
        $user = $result->fetch_assoc();
        return $user;
    }
    return [];
}

function updateStudentPassword(int $id, string $hashed_password): bool
{
    global $conn;
    $sql = 'update students set password = ? where student_id = ?';
    $statement = $conn->prepare($sql);
    $statement->bind_param('si', $hashed_password, $id);
    $statement->execute();
    return  $statement->affected_rows > 0;
}

function checkLogin(string $email, string $password): array|false
{
    global $conn;
    $sql = 'select * from students where email = ?';
    $statement = $conn->prepare($sql);
    $statement->bind_param('s', $email);
    $statement->execute();
    $result = $statement->get_result();
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if(!password_verify($password, $row['password']))return false;
        return $row;
    }
    return false;
}
