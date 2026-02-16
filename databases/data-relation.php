<?php
    //แสดงผลการลงทะเบียนของนิสิต
    function getStudentEnrollmentDetail($stdID): array{
        global $conn;
        $sql = 'select
                c.course_code      AS code,
                c.course_name      AS name,
                c.instructor       AS teacher,
                e.enrollment_date  AS enroll_date,
                e.enrollment_id    AS id
        from    enrollment e
        join    courses c on e.course_id = c.course_id
        where   e.student_id = ?
        ';
        $statement = $conn->prepare($sql);
        if (!$statement) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $statement->execute([$stdID]);
        $result = $statement->get_result(); 
        if ($result->num_rows === 0) {
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);

    }

    //แสดงข้อมูลทั่วไปของนิสิต
    function getStudentIdentifyDetail($stdID){
        global $conn;
        $sql = '
        select  first_name as fname,
                last_name  as lname, 
                date_of_birth as birthday,
                phone_number as tel
        from students
        where student_id = ?
        ';
        $statement = $conn->prepare($sql);
        if (!$statement) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $statement->execute([$stdID]);
        $result = $statement->get_result(); 
         if ($result->num_rows > 0) {
                //ดึง row เดียว
                $user = $result->fetch_assoc();
                return $user;
        }
        return [];
    }

    function getStudentNameById($stdID){
        global $conn;
        $sql = '
            select  first_name as first,
                    last_name  as last
            from students
            where student_id = ?
        ';
        $statement = $conn->prepare($sql);
        if (!$statement) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $statement->execute([$stdID]);
        $result = $statement->get_result(); 
         if ($result->num_rows > 0) {
                //ดึง row เดียว
                $user = $result->fetch_assoc();
                return $user;
        }
        return [];
    }