<?php
function getCourses(): mysqli_result|bool
{
    global $conn;
    $sql = 'select * from courses';
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function insertCourse($course): bool
{
    global $conn;
    $sql = 'insert into courses (course_name, course_code, instructor) VALUES (?,?,?)';
    $statement = $conn->prepare($sql);
    $statement->execute([$course['name'], $course['code'], $course['instructor']]);
    return $statement->affected_rows > 0;
}

function deleteCouresById(int $id): bool
{
    global $conn;
    $sql = 'delete from courses where course_id = ?';
    $statement = $conn->prepare($sql);
    $statement->execute([$id]);
    return $statement->affected_rows > 0;
}

function getCourseById(int $id): mysqli_result|bool
{
    global $conn;
    $sql = 'select * from courses where course_id = ?';
    $statement = $conn->prepare($sql);
    $statement->execute([$id]);
    return $statement->get_result();
}

