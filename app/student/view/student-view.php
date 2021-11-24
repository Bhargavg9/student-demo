<?php 
    require_once ("app/layout/header.php"); 
    require_once ("app/student/controller/student-controller.php");
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
    <div class='panel-heading' >Students Details
        <div class='pull-right' >
            <a href="index.php?action=student-add" style='color: white' class='btnAddAction'><b>+ Add Student</b></a>
        </div>
    </div>
    <div class='panel-body'>
    <table class='table'>
        <thead>
            <tr>
                <th></th>
                <th>Student Name</th>
                <th>Student Last Name</th>
                <!-- <th>Date of Birth</th>
                <th>Contact No</th> -->
                <th></th>
            </tr>
        </thead>
        <tbody>
                <?php
                if (! empty($resultStudent)) {
                    foreach ($resultStudent as $k => $v) {
                ?>
            <tr>
                <td><a class="btnEditAction" href="index.php?action=student-edit&id=<?php echo $resultStudent[$k]["student_id"]; ?>">
                Edit</a></td>
                <td><?php echo $resultStudent[$k]["student_name"]; ?></td>
                <td><?php echo $resultStudent[$k]["student_last_name"]; ?></td>
                <!-- <td><?php echo $resultStudent[$k]["student_dob"]; ?></td>
                <td><?php echo $resultStudent[$k]["student_contact_no"]; ?></td> -->
                <td><a class="btnDeleteAction" href="index.php?action=student-delete&id=<?php echo $resultStudent[$k]["student_id"]; ?>">
                Delete</a></td>
            </tr>
                <?php
                    }
                }
                ?>                
        <tbody>
    </table>
    </div>
<br/>
<?php
    // construct the pagination
    $student = new Student();
    $totalStudentsRes = $student->getStudentsCount();
    $recsPerPage = $student->getStudentPaginationval();
    if ($totalStudentsRes) {
        $totalStudents = $totalStudentsRes[0]['cnt'];
        $start = 0;
        $end = $recsPerPage;
        $counter = 0;
        echo "<div class='pagination'>";
        while($totalStudents/$recsPerPage > 0) {
            $end = $start + $recsPerPage;
            echo "&nbsp;&nbsp;<a class='btnPagination' href='index.php?action=student-view&from=$start'> ".++$counter." </a>&nbsp;&nbsp;";
            $start = $end;
            $totalStudents -= $recsPerPage;
        }
        echo "</div>";
    }
?>
<br/>
<script>
// function validate() {

//     if(!confirm("Do you really want to do this?")) {
//     return false;
//   }
//   this.form.submit();
//     // if(!valid) {
//     //     alert('Please correct the errors in the form!');
//     //     return false;
//     // }
//     // else {
//     //     return confirm('Do you really want to submit the form?');
//     // }
// }
</script>