<?php 
require_once ("app/db/db-controller.php");
class Student
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addStudent($student_name, $student_last_name, $student_dob, $student_contact) {  
        try{             
            $query = "INSERT INTO student_info (student_name,student_last_name,student_dob,student_contact_no,created_user) VALUES (?, ?, ?, ?, ?)";
            $paramType = "sssss";
            $created_user='Admin';
            $paramValue = array(
                $student_name,
                $student_last_name,
                $student_dob,
                $student_contact,
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
    
    function editStudent($student_name, $student_last_name, $student_dob, $student_contact, $version,  $student_id) {
        try{            
            $student_version = $this-> getStudentById($student_id);            
            if($student_version[0]['version_flag']==$version)
            {
                $version=$version+1;
                $student_id=(int)$student_id;
                $query = "UPDATE student_info SET student_name = ?,student_last_name = ?,student_dob = ?,student_contact_no = ?,updated_user = ?,updated_at = ?,version_flag = ? WHERE student_id = ?";
                $paramType = "ssssssii";
                $updated_user='Uadmin';
                $updated_at=date("Y-m-d H:i:s");
                $paramValue = array(
                    $student_name,
                    $student_last_name,
                    $student_dob,
                    $student_contact,           
                    $updated_user,
                    $updated_at,
                    $version,
                    $student_id
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
    
    function deleteStudent($student_id) {
        try{
            $student_map = $this-> getStudentMapById($student_id);
            // Validating weather student already mapped to Course
            if(empty($student_map))
            {
                //throw new Exception("Student to Course Mapping Already exist");
                $query = "UPDATE student_info set is_active = 0 WHERE student_id = ?";
                $paramType = "i";
                $paramValue = array(
                    $student_id
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
    
    function getStudentMapById($student_id) {
        $query = "SELECT * FROM student_course WHERE student_id = ?";
        $paramType = "i";
        $paramValue = array(
            $student_id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function getStudentById($student_id) {
        $query = "SELECT * FROM student_info WHERE student_id = ?";
        $paramType = "i";
        $paramValue = array(
            $student_id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllStudentsFromTo($from, $to) {
        $sql = "SELECT * FROM student_info where is_active=true ORDER BY created_at  limit $from, $to";
        //echo $sql;
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getAllStudents() {
        $sql = "SELECT * FROM student_info where is_active=true ORDER BY created_at";
        //echo $sql;
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getStudentsCount() {
        $sql = "SELECT COUNT(1) as cnt FROM student_info where is_active=true";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getStudentPaginationval() {        
        $value=3;
        return $value;
    }
}
?>