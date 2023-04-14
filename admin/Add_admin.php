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
                        <li><a href="./studentRegister.php">Add Student</a></li>
                        <li><a href="#">View Student</a></li>
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
                            <li><a href="#">View Courses</a></li>
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
                            <li><a href="#">View Lecturers</a></li>
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
                            <li><a href="#">View Admins</a></li>
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
                    <h3>Add Admin</h3>
                    <?php 
                        include('conn.php');

                        if(isset($_POST['register'])) {
                            $fname = $_POST['fname'];
                            $lname = $_POST['lname'];
                            $email = $_POST['email'];
                            $phone = $_POST['phone'];
                            $a_id = $_POST['a_id'];
                            

                            $sql = "SELECT * FROM admins WHERE admin_id='$a_id' OR email='$email'";
                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result) > 0) {
                                    echo "<p style='color:red'>Admin or email already exists.</p>";
                                } else {

                                    $hashed_password = password_hash($a_id, PASSWORD_DEFAULT);
                                    // Insert user data into database
                                    $sql = "INSERT INTO admins (fname,lname, email,phone,admin_id,password) VALUES 
                                            ('$fname','$lname', '$email','$phone','$a_id', '$hashed_password')";

                                    if (mysqli_query($conn, $sql)) {
                                        echo "<p style='color:green'>Admin created successfully.</p>";
                                    } else {
                                        echo "<p style='color:red'>Error creating admin: " . mysqli_error($conn) . "</p>";
                                    }
                                }
                            // Hash the password for security
                            
                        }
    
    
                    ?>
                    <form action="" method="post">
                        <fieldset>
                            <legend>First Name :</legend>
                            <input type="text" name="fname" id="" required placeholder="First Name">
                        </fieldset>
                        <fieldset>
                            <legend>Last Name :</legend>
                            <input type="text" name="lname" id="" required placeholder="Last Name">
                        </fieldset>
                        <fieldset>
                            <legend>Email :</legend>
                            <input type="email" name="email" id="" required placeholder="Email">
                        </fieldset>
                        <fieldset>
                            <legend>Phone Number:</legend>
                            <input type="tel" name="phone" id="" required placeholder="Phone Number">
                        </fieldset>
                       
                        <fieldset>
                      
                        <fieldset>
                            <legend>Admin No :</legend>
                            <input type="text" name="a_id" id="" required placeholder="Admin Number" value="Admin42">
                        </fieldset>
                        
                        <div class="form-group">
                            <input type="submit" value="Register" class="reg-submit" name="register">
                        </div>
                    </form>
                </div>
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