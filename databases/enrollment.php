<?php
function insertEnroll(int $student_id,int $course_id ): array
{
    global $conn;
    try {
        $sql = 'insert into enrollment (student_id,course_id) VALUES (?,?)';
        $statement = $conn->prepare($sql);
        $statement->execute([$student_id,$course_id]);
        $data_chack = $statement->affected_rows > 0;
        return [
                'success' =>  $data_chack,
                'error' => $data_chack ? null :'data eror',
                'code' => 0
            ];
    } catch (mysqli_sql_exception $e) {
            return [
                'success' => false, 
                'error' => $e->getCode() == 1062 ? 'duplicate' : 'unknown',
                'code' => $e->getCode() // เผื่อต้อง Debug
            ];
    }
}

function deleteEnrollById(int $id): bool
{
    global $conn;
    $sql = 'delete from enrollment where enrollment_id = ?';
    $statement = $conn->prepare($sql);
    $statement->bind_param("i",$id);
    $statement->execute();
    return $statement->affected_rows > 0;
}

function getEnrollById($student_id): mysqli_result|bool
{
    global $conn;
    $sql = 'select * from enrollment where student_id = ?';
    $statement = $conn->prepare($sql);
    $statement->execute([$student_id]);
    $result = $statement->get_result();
    $statement->close();
    return $result;
}
