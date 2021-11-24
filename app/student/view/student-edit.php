<?php require_once ("app/layout/header.php");; ?>
<link rel="stylesheet" href="app/layout/css/form-style.css" type="text/css">
<div class='panel panel-primary'>
    <div class='panel-heading'>
        Edit Student
    </div>
    <div class='panel-body'>
        <form class='form' name="frmAdd" method="post" action="" onSubmit="return validate();">
            <div class='form-row'>
                <div class='form-label'><label>Student Name</label> <span id="student-name-info" class="info"></span></div>
                <div class='col-sm-7'><input class='form-control' type="text" name="student_name" id="student_name" class="demoInputBox" placeholder="First name" required value="<?php echo $resultStudent[0]["student_name"]; ?>"></div>
            </div>
            <br/>
            <div class='form-row'>
                <div class='form-label'><label>Student Last Name</label> <span id="student-last-name-info" class="info"></span></div>
                <div class='col-sm-7'><input type="text"  class='form-control'  name="student_last_name" id="student_last_name" class="demoInputBox" placeholder="Last name" value="<?php echo $resultStudent[0]["student_last_name"]; ?>" required></div>
            </div>
            <br/>
            <div class='form-row'>
                <div class='form-label'><label>Date of Birth</label> <span id="dob-info" class="info"></span></div>
                <div class='col-sm-7'><input type="date" value="<?php echo $resultStudent[0]["student_dob"]; ?>"  class='form-control' name="dob" id="dob" class="demoInputBox"></div>
            </div>
            <br/>
            <div class='form-row'>
                <div class='form-label'><label>Contact No</label> <span id="contact-no-info" class="info"></span></div>
                <div class='col-sm-7'><input type="text" value="<?php echo $resultStudent[0]["student_contact_no"]; ?>" class='form-control' name="contact_no" id="contact_no" class="demoInputBox" placeholder="Contact name" required>
                <input type="hidden" value="<?php echo $resultStudent[0]["version_flag"]; ?>" class='form-control' name="version_flag" id="version_flag" >
            </div>
            </div>
            <br/><br/>
            <div class='submit-button'>
                <input type="submit"  class='btnAddAction' name="add" id="btnSubmit" value="Save">
            </div>
        </form>
    </div>
</div>

    <script>
        function validate() {
            var valid = true;   
            $(".demoInputBox").css('background-color','');
            $(".info").html('');
            
            if(!$("#student_name").val()) {
                $("#student-name-info").html("(required)");
                $("#student_name").css('background-color','#FFFFDF');
                valid = false;
            }
            if(!$("#student_last_name").val()) {
                $("#student-last-name-info").html("(required)");
                $("#student_last_name").css('background-color','#FFFFDF');
                valid = false;
            }
            if(!$("#dob").val()) {
                $("#dob-info").html("(required)");
                $("#dob").css('background-color','#FFFFDF');
                valid = false;
            }
            if(!$("#contact_no").val()) {
                $("#contact-no-info").html("(required)");
                $("#contact_no").css('background-color','#FFFFDF');
                valid = false;
            }   
            return valid;
        }
    </script>
</body>
</html>