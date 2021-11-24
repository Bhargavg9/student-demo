<?php 
require_once ("app/layout/header.php");
require_once ("app/db/db-controller.php");

class Course
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addCourse($course_name, $course_description) {  
        try{             
            $query = "INSERT INTO course (course_name,course_description,created_user) VALUES (?, ?, ?)";
            $paramType = "sss";
            $created_user='Admin';
            $paramValue = array(
                $course_name,
                $course_description,
                $created_user
            );
            $this->db_handle->startTransaction();
            $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
            //throw new Exception("Erroe");
            $this->db_handle->commitTransaction();
            return 1;
        }catch(Exception $e) {
            $this->db_handle->closeTransaction();
            return $e->getMessage();
        }
    }
    
    function editCourse($course_name, $course_description, $version,  $course_id) {
        try{
            $course_version = $this-> getCourseById($course_id);
            //var_dump($student_version)."<br>";
            if($course_version[0]['version_flag']==$version)
            {
                $version=$version+1;
                $course_id=(int)$course_id;
                $query = "UPDATE course SET course_name = ?,course_description = ?,updated_user = ?,updated_at = ?,version_flag = ? WHERE course_id = ?";
                $paramType = "ssssii";
                $updated_user='Uadmin';
                $updated_at=date("Y-m-d H:i:s");
                $paramValue = array(
                    $course_name,
                    $course_description,      
                    $updated_user,
                    $updated_at,
                    $version,
                    $course_id
                );
                $this->db_handle->startTransaction();
                $this->db_handle->update($query, $paramType, $paramValue);
                $this->db_handle->commitTransaction();
                return 1;
            }
            else
            {
                return 0;  
            }
        }catch(Exception $e) {
            $this->db_handle->closeTransaction();
            return $e->getMessage();
        }        
    }
    
    function deleteCourse($course_id) {
        try{
            $course_map = $this-> getCourseMapById($course_id);            
            //Validating weather student already mapped to Course
            if(empty($course_map))
            {
                //throw new Exception("Student to Course Mapping Already exist");
                $query = "UPDATE course set is_active = 0 WHERE course_id = ?";
                $paramType = "i";
                $paramValue = array(
                    $course_id
                );
                $this->db_handle->startTransaction();
                $this->db_handle->update($query, $paramType, $paramValue);
                $this->db_handle->commitTransaction();   
                return 1;             
            }
            else
            {                
               return 0;               
            }  
          
        }catch(Exception $e) {
            $this->db_handle->closeTransaction();
            return $e->getMessage();
        } 
    }
    
    function getCourseMapById($course_id) {
        $query = "SELECT * FROM student_course WHERE course_id = ?";
        $paramType = "i";
        $paramValue = array(
            $course_id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function getCourseById($course_id) {
        $query = "SELECT * FROM course WHERE course_id = ?";
        $paramType = "i";
        $paramValue = array(
            $course_id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function getAllCoursesFromTo($from, $to) {
        $sql = "SELECT * FROM course where is_active=true ORDER BY created_at  limit $from, $to";
        //echo $sql;
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getAllCourses() {
        $sql = "SELECT * FROM course where is_active=true ORDER BY created_at";
        //echo $sql;
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getCourseCount() {
        $sql = "SELECT COUNT(1) as cnt FROM course where is_active=true";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getCoursePaginationval() {        
        $value=2;
        return $value;
    }
}
?>