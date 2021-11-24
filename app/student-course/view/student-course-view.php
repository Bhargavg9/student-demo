<?php 
require_once ("app/layout/header.php"); 
require_once ("app/student-course/controller/student-course-controller.php");
?>  
<style>
a {
    text-decoration: none;
}

.btn-success {
    background: #218838
}

.pagination {
    text-align: center;
}
</style>  
<div class='panel panel-primary'>
    <div class='panel-heading'>Student-Course Details
        <div class='pull-right' >
            <a href="index.php?action=student-course-add" style='color: white' class='btnAddAction'><b>+ Student Course Registration</b></a>
        </div>
    </div>
    <div class='panel-body'>
        <table class='table'>
            <thead>
                <tr>
                    <th><strong>Student Name</strong></th>
                    <th><strong>Course</strong></th>

                </tr>
            </thead>
            <tbody>
                <?php
                if (! empty($result)) {
                    foreach ($result as $k => $v) {
                ?>
                <tr>
                    <td><?php echo $result[$k]["student_name"]." ".$result[$k]["student_last_name"]; ?></td>
                    <!-- <td><?php echo $result[$k]["course_name"]." ".$result[$k]["course_description"]; ?></td> -->
                    <td><?php echo $result[$k]["course_name"]; ?></td>
                </tr>
                <?php
                    }
                }
                ?>
            <tbody>
        </table>
    </div>
    <?php
        // construct the pagination
        $studentcourse = new StudentCourse();
        $recsPerPage = $studentcourse->getStudentCoursePaginationval();
        $totalStudentsCourseRes = $studentcourse->getAllStudentCoursesCount();
        if ($totalStudentsCourseRes) {
            $totalStudentsCourses = $totalStudentsCourseRes[0]['cnt'];
            $start = 0;
            $end = $recsPerPage;
            $counter = 0;
            echo "<div class='pagination'>";
            while(ceil($totalStudentsCourses/$recsPerPage) > 0) {
                $end = $start + $recsPerPage;
                //$start=$start+1;
                echo "&nbsp;&nbsp;<a class='btnPagination' href='index.php?action=student-course-view&from=$start'> ".++$counter." </a>&nbsp;&nbsp;";
                $start = $end;
                $totalStudentsCourses -= $recsPerPage;
            }
            echo "</div>";
        }             
    ?>
    <br/>
</div>
    
</body>
</html>