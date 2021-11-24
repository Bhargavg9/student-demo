<?php
require_once ("app/db/db-controller.php");
require_once ("app/student/controller/student-controller.php");
require_once ("app/course/controller/course-controller.php");
require_once ("app/student-course/controller/student-course-controller.php");

$db_handle = new DBController();

if (! empty($_GET["from"])) {
    $from=$_GET["from"];
}
else{
    $from=0;
}

$action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];      
}

function function_alert($message) {
    echo "<script>alert('$message');</script>";
}

try {
    switch ($action) {
        case "student-view": 
            $student = new Student();
            $to = $student->getStudentPaginationval();
            $resultStudent = $student->getAllStudentsFromTo($from , $to);
            require_once "student/view/student-view.php";
            break;
        case "student-add":
            if (isset($_POST['add'])) {
                //var_dump($_POST)."<br>";
                $student_name = $_POST['student_name'];
                $student_last_name = $_POST['student_last_name'];
                $dob = "";
                if ($_POST["dob"]) {
                    $dob_timestamp = strtotime($_POST["dob"]);
                    $dob = date("Y-m-d", $dob_timestamp);
                }
                $contact_no = $_POST['contact_no'];                
                $student = new Student();
                $to = $student->getStudentPaginationval();
                $result = $student->addStudent($student_name, $student_last_name, $dob, $contact_no);
                if ($result==1) {
                    $msg='Student Added Successfully';                   
                } else {
                    $msg='Failed to add Student. Please try again';                    
                }
                function_alert($msg); 
                $resultStudent = $student->getAllStudentsFromTo($from , $to);
                require_once "student/view/student-view.php";    
            }
            else{
                require_once "student/view/student-add.php";
            }
            
            break;
        case "student-edit":
            $student_id = $_GET["id"];
            $student = new Student();
            $to = $student->getStudentPaginationval();            
            if (isset($_POST['add'])) {
                $student_name = $_POST['student_name'];
                $student_last_name = $_POST['student_last_name'];
                $dob = "";
                if ($_POST["dob"]) {
                    $dob_timestamp = strtotime($_POST["dob"]);
                    $dob = date("Y-m-d", $dob_timestamp);
                }
                $contact_no = $_POST['contact_no'];
                $version = $_POST['version_flag'];
                $result = $student->editStudent($student_name, $student_last_name, $dob, $contact_no, $version, $student_id);
                if($result==1)
                {
                    $msg='Student Updated Successfully.';                
                }
                else 
                {
                    $msg='Failed to Update the Student details. Please try again';
                }
                function_alert($msg);
                $resultStudent = $student->getAllStudentsFromTo($from,$to);
                require_once "student/view/student-view.php";
            }else{           
                $resultStudent = $student->getStudentById($student_id);
                require_once "student/view/student-edit.php";
            }
            break;
        case "student-delete":
            $student_id = $_GET["id"];
            $student = new Student();
            $to = $student->getStudentPaginationval();        
            $result = $student->deleteStudent($student_id); 
            if($result==1)
            {
                $msg='Student Successfully Removed';                
            }
            else
            {
                $msg='Student Already mapped to Course. Please try again';
            }
            function_alert($msg);
            $resultStudent = $student->getAllStudentsFromTo($from,$to);
            require_once "student/view/student-view.php";
            break;
        case "course-view":
            $course = new Course();
            $to = $course->getCoursePaginationval();
            $resultCourse = $course->getAllCoursesFromTo($from, $to);
            require_once "course/view/course-view.php";
            break;    
        case "course-add":
            if (isset($_POST['add'])) {
                //var_dump($_POST)."<br>";
                $course_name = $_POST['course_name'];
                $course_description = $_POST['course_description'];                
                $course = new Course();
                $to = $course->getCoursePaginationval();
                $result = $course->addCourse($course_name, $course_description);
                if ($result==1) {
                    $msg='Course Added Successfully';                   
                } else {
                    $msg='Failed to add Course. Please try again';                    
                }
                function_alert($msg);
                $resultCourse = $course->getAllCoursesFromTo($from, $to);
                require_once "course/view/course-view.php";
            }else{
                require_once "course/view/course-add.php";
            }           
            break;
        case "course-edit":
            $course_id = $_GET["id"];
            $course = new Course();
            $to = $course->getCoursePaginationval();
            if (isset($_POST['add'])) {
                $course_name = $_POST['course_name'];
                $course_description = $_POST['course_description'];            
                $version = $_POST['version_flag'];
                $result = $course->editCourse($course_name, $course_description, $version, $course_id); 
                if($result==1)
                {
                    $msg='Course Updated Successfully.';                
                }
                else 
                {
                    $msg='Failed to Update the Course details. Please try again';
                }
                function_alert($msg);           
                $resultCourse = $course->getAllCoursesFromTo($from, $to);
                require_once "course/view/course-view.php";
            }else{
                $resultCourse = $course->getCourseById($course_id);
                require_once "course/view/course-edit.php";
            }
            break;
        
        case "course-delete":
            $course_id = $_GET["id"];
            $course = new Course();
            $to = $course->getCoursePaginationval();        
            $resultSet = $course->deleteCourse($course_id);  
            if($resultSet==1)
            {
                $msg='Course Successfully Removed';                
            }
            else
            {
                $msg='Course Already mapped to Student. Please try again';
            }
            function_alert($msg);
            $resultCourse = $course->getAllCoursesFromTo($from,$to);
            require_once "course/view/course-view.php";
            break;
        
        case "student-course-view":
            $studentcourse = new StudentCourse();
            $to = $studentcourse->getStudentCoursePaginationval();
            $result = $studentcourse->getAllStudentCoursesFromTo($from, $to);
            require_once "student-course/view/student-course-view.php";
            break; 
        case "student-course-add":
            if (isset($_POST['add'])) {
                $course_ids = $_POST['course_ids'];
                $student_ids = $_POST['student_ids'];
                $studentcourse = new StudentCourse();
                $to = $studentcourse->getStudentCoursePaginationval();
                $result = $studentcourse->addStudentCourse($student_ids, $course_ids);
                if ($result==1) {
                    $msg='students successfully subscribed courses.';                   
                } else {
                    $msg='Failed to add Course. Please try again';                    
                }
                function_alert($msg);
                $result = $studentcourse->getAllStudentCoursesFromTo($from, $to);
                require_once "student-course/view/student-course-view.php";
            }else{
                require_once "student-course/view/student-course-add.php";
            }           
            break;
        
        default:
            require_once "layout/landing-page.php";
            break;
    }
} catch (Exception $e) {
    echo "Error Occured: ".$e->getMessage();
}
?>