<?php 
require_once ("app/db/db-controller.php");
class StudentCourse
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addStudentCourse($student_ids, $course_ids) {  
        try{
            $this->db_handle->startTransaction();
            foreach($student_ids as $index => $student_id) {
                $course_id = $course_ids[$index];
                $student_version = $this-> getStudentCourseRecordById($student_id, $course_id);
                if(empty($student_version)) {

                    $query = "INSERT INTO student_course (student_id,course_id,created_user) VALUES (?, ?, ?)";
                    $paramType = "iis";
                    $created_user='Admin';
                    $paramValue = array(
                        $student_id,
                        $course_id,
                        $created_user
                    );
                    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);                    
                    // if the incoming request has only 1 mapping and is already mapped, then throw an error                    
                }  
                else{
                    if (sizeof($student_ids) == 1) {
                        throw new Exception("Student to Course Mapping Already exist");
                    } else {
                        // go to the next mapping if the existing mapping is already mapped
                        continue;
                    }
                }
                //throw new Exception("Erroe");
            }            
            $this->db_handle->commitTransaction();
            return 1;
        }catch(Exception $e) {
            $this->db_handle->closeTransaction();
            return $e->getMessage();
        }
    }
       
    function getStudentCourseById($student_course_id) {
        $query = "SELECT * FROM student_course WHERE student_course_id = ?";
        $paramType = "i";
        $paramValue = array(
            $student_course_id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function getStudentCourseRecordById($student_id, $course_id) {
        $query = "SELECT * FROM student_course WHERE student_id = ? and course_id = ?";
        $paramType = "ii";
        $paramValue = array(
            $student_id,
            $course_id
        );        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllStudentCoursesFromTo($from, $to) {
        $sql = "SELECT student_name,student_last_name, course_name,course_description FROM student_course 
        LEFT JOIN student_info ON student_info.student_id=student_course.student_id
        LEFT JOIN course ON course.course_id=student_course.course_id ORDER BY student_course.created_at limit $from, $to";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getAllStudentCourses() {
        $sql = "SELECT student_name,student_last_name, course_name,course_description FROM student_course 
        LEFT JOIN student_info ON student_info.student_id=student_course.student_id
        LEFT JOIN course ON course.course_id=student_course.course_id ORDER BY student_course.created_at";
        //echo $sql."<bR>";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getAllStudentCoursesCount() {
        $sql = "SELECT COUNT(1) as cnt FROM student_course";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getStudentCoursePaginationval() {        
        $value=4;
        return $value;
    }
}
?>