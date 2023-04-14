<?php

    session_start();

    if(!isset($_SESSION['admin'])){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register student</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <h3>Admin Dashboard</h3>
        </div>
        <div class="account">
            <h5>Welcome Admin. <span><?php echo $_SESSION['fname']; ?></span></h5>
            <p><?php echo $_SESSION['admin']; ?></p>
        </div>
    </div>
    <div class="admin-content">
        <div class="side-bar">
            <div class="side">
                <h4><a href="index.php">Dashboard</a></h4>
            </div>
            <div class="side">
                <div class="dropdown">
                    <div class="dropdown-button">
                      <h3>Students</h3>
                    </div>
                    <div class="actions">
                      <ul>
                        <li><a href="studentRegister.php">Add Student</a></li>
                        <li><a href="students.php">View Student</a></li>
                      </ul>
                    </div>
                </div>
                
            </div>
            <div class="side">
                <div class="dropdown">
                    <div class="dropdown-button">
                      <h3>Courses</h3>
                    </div>
                    <div class="actions">
                        <ul>
                            <li><a href="./Add_course.php">Add Course</a></li>
                            <li><a href="courses.php">View Courses</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
            <div class="side">
                <div class="dropdown">
                    <div class="dropdown-button">
                      <h3>Lecturers</h3>
                    </div>
                    <div class="actions">
                        <ul>
                            <li><a href="./Add_lecturer.php">Register Lecturer</a></li>'
                            <li><a href="lecturers.php">View Lecturers</a></li>
                        </ul>
                      
                      
                    </div>
                </div>
                
            </div>
            <div class="side">
                <div class="dropdown">
                    <div class="dropdown-button">
                      <h3>Admins</h3>
                    </div>
                    <div class="actions">
                        <ul>
                            <li> <a href="./Add_admin.php">Add Admins</a></li>
                            <li><a href="admins.php">View Admins</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
            <div class="side">
                <h3>Settings</h3>
                <p>Profile</p>
                <form action="logout.php" method="post">
                    <button type="submit" name="logout">Logout</button>
                </form>
            </div>
           
            
        </div>
        <div class="content">
            <div class="register">
                <div class="stu-form">
                    <h3>Add a Course</h3>
                    <?php 
                        include('conn.php');

                        

                        if(isset($_POST['register'])) {
                            $cname = $_POST['cname'];
                            $course_id = $_POST['course_id'];
                            $school = $_POST['school'];
                            $ucode = $_POST['ucode'];
                            

                            $sql = "SELECT * FROM courses WHERE unit_code='$ucode' OR c_name='$cname'";
                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result) > 0) {
                                    echo "<p style='color:red'>Course already exists.</p>";
                                } else {
                                    // Insert user data into database
                                    $sql = "INSERT INTO courses (c_name,course_id,unit_code, school) VALUES 
                                            ('$cname','$course_id','$ucode', '$school')";

                                    if (mysqli_query($conn, $sql)) {
                                        echo "<p style='color:green'>Course created successfully.</p>";
                                    } else {
                                        echo "<p style='color:red'>Error creating course: " . mysqli_error($conn) . "</p>";
                                    }
                                }
                            
                        }
    
    
                    ?>
                    <form action="" method="post">
                        <fieldset>
                            <legend>Unit Name :</legend>
                            <input type="text" name="cname" id="" required placeholder="Course Name">
                        </fieldset>
                        <fieldset>
                            <legend>Unit Code :</legend>
                            <input type="text" name="ucode" id="" required placeholder="Unit Code">
                        </fieldset>
                        
                        <fieldset>
                            <legend>Course Id :</legend>
                            <select name="course_id" id="" placeholder="Course Id">
                                <option value="">--Course Id--</option>
                                <option value="G127">G127</option>
                                <option value="G126">G126</option>
                                <option value="B113">B113</option>
                                <option value="J139">J139</option>
                            </select>
                        </fieldset>
                        <fieldset>
                            <legend>School :</legend>
                            <select name="school" id="" placeholder="School">
                                <option value="">--School--</option>
                                <option value="Science and computing">Science and Computing</option>
                                <option value="Human Sciences">Human Sciences</option>
                                <option value="Humanities">Humanities</option>
                                <option value="Engeneering">Engeneering</option>
                            </select>
                        </fieldset>
                       
                  
                        
                        <div class="form-group">
                            <input type="submit" value="Register" class="reg-submit" name="register">
                        </div>
                    </form>
                </div>
            </div>
            <div class="courses">
                <h3>Enrolled Courses</h3>
            </div>
        </div>
    </div>
    <script>
        var dropdownButton = document.querySelector(".dropdown-button");
        var dropdownContent = document.querySelector(".dropdown-content");
    
        dropdownButton.addEventListener("click", function() {
            dropdownContent.classList.toggle("show");
        });
    
    </script>
</body>

</html>