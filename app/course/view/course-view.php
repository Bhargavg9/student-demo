<?php 
require_once ("app/layout/header.php");
require_once ("app/course/controller/course-controller.php");
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
    <div class='panel-heading'>Course Details
        <div class='pull-right' >
            <a href="index.php?action=course-add" style='color: white' class='btnAddAction'><b>+ Add Course</b></a>
        </div>
    </div>
    <div class='panel-body'>
        <table class='table table-bordered table-primary'>
            <thead>
                <tr>
                    <th><strong>Edit Control</strong></th>
                    <th><strong>Course Name</strong></th>
                    <!-- <th><strong>Course Description</strong></th> -->
                    <th><strong>Remove Control</strong></th>

                </tr>
            </thead>
            <tbody>
                <?php
                    if (!empty($resultCourse)) {
                        foreach ($resultCourse as $k => $v) {
                    ?>
                <tr>
                    <td><a class="btnEditAction" href="index.php?action=course-edit&id=<?php echo $resultCourse[$k]["course_id"]; ?>">
                    Edit</a></td>
                    <td><?php echo $resultCourse[$k]["course_name"]; ?></td>
                    <!-- <td><?php echo $resultCourse[$k]["course_description"]; ?></td> -->
                    <td><a class="btnDeleteAction"  href="index.php?action=course-delete&id=<?php echo $resultCourse[$k]["course_id"]; ?>">
                    Delete</a></td>
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
    $course = new Course();
    $recsPerPage = $course->getCoursePaginationval();
    $totalCourseRes = $course->getCourseCount();
    if ($totalCourseRes) {
        $totalCourse = $totalCourseRes[0]['cnt'];
        $start = 0;
        $end = $recsPerPage;
        $counter = 0;
        echo "<div class='pagination'>";
        while($totalCourse/$recsPerPage > 0) {
            $end = $start + $recsPerPage;
            echo "&nbsp;&nbsp;<a class='btnPagination' href='index.php?action=course-view&from=$start'> ".++$counter." </a>&nbsp;&nbsp;";
            $start = $end;
            $totalCourse -= $recsPerPage;
        }
        echo "</div>";
    }
?>
<br/>