<link rel="stylesheet" href="app/layout/css/style.css" type="text/css">
<script src="app/layout/lib/jquery-2.1.1.min.js" type="text/javascript"></script>
<html>
<head>
<style>
body {
  font-family: Arial;
}
.navbar {
    opacity: 1;
    color: black;
    font-size: 15px;
    height: 50px;
    display: flex;
    background-color: white;
}
.navbar .navbar-header {
    color: black
}

.navbar ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  height: 50px;
  overflow: hidden;
  background-color: white;
}

.navbar li {
  float: left;
}

.navbar li a {
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.navbar li a:hover {
  background-color: #ddd;
  border-radius: 8px;
}

.active {
  background-color: #04AA6D;
}

</style>

</head>
<body>
    <div>
        <nav class="navbar">
            <div class="container-fluid">
                <ul class="nav-items">
                    <li><a href="index.php?action=student-view">Student Details</a></li>
                    <li><a href="index.php?action=course-view">Course Details</a></li>
                    <li><a href="index.php?action=student-course-view">Student & Courses Details</a></li>
                </ul>
            </div>
        </nav>
        
    </div>


  