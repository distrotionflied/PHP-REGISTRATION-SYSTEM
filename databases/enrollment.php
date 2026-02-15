<?php
    function insertEnroll(int $course_id): mysqli_result|bool
    {
         //not complete 
         global $conn;
        $sql = 'select * from students';
        $result = $conn->query($sql);
        //$conn->close();
        return $result; 
    }

    function deleteEnroll(int $course_id): mysqli_result|bool
    {
        //not complete 
        global $conn;
        $sql = 'select * from students';
        $result = $conn->query($sql);
        //$conn->close();
        return $result;
    }
    
    function getEnroll(): mysqli_result|bool
    {
         //not complete 
        global $conn;
        $sql = 'select * from enrollment';
        $result = $conn->query($sql);
        //$conn->close();
        return $result;
    }