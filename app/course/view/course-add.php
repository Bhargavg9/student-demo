<?php require_once ("app/layout/header.php"); ?>
<link rel="stylesheet" href="app/layout/css/form-style.css" type="text/css">
<div class='panel panel-primary'>
    <div class='panel-heading'>
        Course Details
        <!-- <div class='pull-right' >
            <a href="index.php?action=course-view" style='color: white' class='btn btn-warning btn-xs'><b> Cancel the Trasaction </b></a>
        </div> -->
    </div>
    
    <div class='panel-body'>
        <form class='form' method="post" action="" onSubmit="return validate();">
            <div class='form-row'>
                <div class='form-label'><label >Course Name</label> <span id="course-name-info" class="info"></span></div>
                <div class='col-sm-7'><input class='form-control' type="text" name="course_name" id="course_name" class="demoInputBox"></div>
            </div>
            <br/>
            <div class='form-row'>
                <div class='form-label'><label>Course Description</label> <span id="course-description-info" class="info"></span></div>
                <div class='col-sm-7'><textarea class='form-control' rows="10" cols="40" type="text" name="course_description" id="course_description" class="demoInputBox"></textarea></div>
            </div>
            <br/>
            <br/>
            <div class='submit-button'>
                <input  class='btnAddAction' type="submit" name="add" id="btnSubmit" value="Submit" />
            </div>
        </form>
    </div>
</div>

<script>
    function validate() {
        let valid = true;
        $(".demoInputBox").css('background-color','');
        if(!$("#course_name").val()) {
            $("#course-name-info").html("(required)");
            $("#course_name").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!$("#course_description").val()) {
            $("#course-description-info").html("(required)");
            $("#course_description").css('background-color','#FFFFDF');
            valid = false;
        }
        return valid;
    }
</script>
</body>
</html>