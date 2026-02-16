<?php
function getCourses(): array
{
    global $conn;
    $sql = 'SELECT 
            course_id   AS id,
            course_name AS name,
            course_code AS code,
            instructor  AS teacher 
            FROM courses';
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows === 0) {
            return [];
        }

    return $result->fetch_all(MYSQLI_ASSOC);
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

function getCourseById(int $id): array
{
    global $conn;
    $sql = 'select * from courses where course_id = ?';
    $statement = $conn->prepare($sql);
    $statement->execute([$id]);
    $result = $statement->get_result();
    if($result->num_rows > 0 ){
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    return [];
}

