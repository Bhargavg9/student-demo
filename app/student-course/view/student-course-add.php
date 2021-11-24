<?php require_once ("app/layout/header.php"); ?>
<?php require_once ("app/student/controller/student-controller.php"); ?>
<?php require_once ("app/course/controller/course-controller.php"); ?>
<link rel="stylesheet" href="app/layout/css/form-style.css" type="text/css">
<style>


</style>

<div class='panel panel-primary'>
    <div class='panel-heading'>Student Course Registration
    </div>
    <div class='panel-body'>
        <form class='form' name="frmAdd" method="post" action="" onSubmit="return validate();" class='form'>
            <div class='form-row'>
                <div class='form-label'>
                    <label style='padding: 60px;'>Student Name</label> <span id="student-name-info" class="info"></span>
                    <?php
                        $student = new Student();
                        $result = $student->getAllStudents();
                        echo "<select style='width: 81%;' name='student_name' id='student_name'  class='form-control' place-holder='please select'>";
                        if (! empty($result)) {
                            echo "<option value='' selected>Please select</option>";
                            foreach ($result as $k => $v) {
                                echo "<option value=".$result[$k]["student_id"].">".$result[$k]["student_name"]." ".$result[$k]["student_last_name"]."</option>";    
                            }
                        }            
                        echo "</select>";
                    ?>    
                </div>
                <div class='form-label'>
                    <label style='padding: 60px;'>Course Name</label> <span id="course-name-info" class="info"></span>
                    <?php
                        $course = new Course();
                        $result = $course->getAllCourses();
                        echo "<select style='width: 81%;' name='course_name' id='course_name' class='form-control' place-holder='please select'>";
                        echo "<option value='' selected>Please select</option>";
                        if (! empty($result)) {
                            foreach ($result as $k => $v) {
                                echo "<option value=".$result[$k]["course_id"].">".$result[$k]["course_name"]."</option>";    
                            }
                        }            
                        echo "</select>";
                    ?>  
                </div>
                <div class='col-sm-1'>
                    <label>&nbsp;</label>
                    <input class='btnAddAction' style='height: 24px; margin: 34px;' type="button" value="+" onClick="return addMapping()">
                </div>
            </div>
            <br/><br/>
            <div id='selected_mapping'>
                <table class='table'>
                    <thead>
                        <tr><th>Student name</th><th>Course name</th></tr>
                    </thead>
                    <tbody id='selected_mapping_rows'>

                    </tbody>
                </table>
            </div>
            <div class='submit-button' >
                <input class='btnAddAction' type="submit" name="add" id="btnSubmit" value="Submit" />
            </div>
        </form>
    </div>
</div>


<script>



    var savedMappings = [];
    function addMapping() {
        const studentId = $('#student_name').val();
        const courseId = $('#course_name').val();
        const checkStr = studentId+'course'+courseId;
        if (savedMappings.includes(checkStr)) {
            alert('Student to course Subscription is already available here');
            return false;
        }
        savedMappings.push(studentId+'course'+courseId);
        const selectedStudentName = $('#student_name option:selected').text();
        const selectedCourseName = $('#course_name option:selected').text();        
        if(studentId == '' || courseId == '') {
            alert('Please select both student and the course to Add');
            return false;
        }
        $('#selected_mapping_rows').append(`<tr><td>${selectedStudentName}</td><td>${selectedCourseName}</td></tr>`);
        $('#selected_mapping_rows').append(`<input type='hidden' value='${studentId}' name='student_ids[]'>`);
        $('#selected_mapping_rows').append(`<input type='hidden' value='${courseId}' name='course_ids[]'>`);
    }

    function validate() {
        var valid = true;   
        $(".demoInputBox").css('background-color','');
        $(".info").html('');
        
        if(!$("#student_name").val()) {
            $("#student-name-info").html("(required)");
            $("#student_name").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!$("#course_name").val()) {
            $("#course-name-info").html("(required)");
            $("#course_name").css('background-color','#FFFFDF');
            valid = false;
        }    
        // check if any mappings added, else throw error
        const mappings = $('input[name*="student_ids"]').length;
        if (mappings == 0) { 
            alert('Please select atleast one student and subscribe the course to add');
            valid = false;
        }
        return valid;
    }
</script>
</body>
</html>